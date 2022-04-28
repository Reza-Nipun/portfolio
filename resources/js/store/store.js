import axios from 'axios';
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)

axios.defaults.baseURL = "/api"

export const store = new Vuex.Store({
    state: {
      user_info: {},
      skills: {},
      certificates: {},
      services: {},
      portfolios: {},
      links: {},
      blogs: {},
      logged_in_user_name: localStorage.getItem('user_name') || null,
      token: localStorage.getItem('portfolio_token') || null,
    },
    getters: {
      getUserId(state){
        return state.user_info.id
      },
      loggedIn(state){
        return state.token !== null
      },
    },
    mutations: {
      SET_USER: (state, user) => (state.user_info = user),
      SET_SKILLS: (state, skills) => (state.skills = skills),
      SET_CERTIFICATES: (state, certificates) => (state.certificates = certificates),
      SET_SERVICES: (state, services) => (state.services = services),
      SET_PORTFOLIOS: (state, portfolios) => (state.portfolios = portfolios),
      SET_LINKS: (state, links) => (state.links = links),
      SET_BLOGS: (state, blogs) => (state.blogs = blogs),
      SET_TOKEN: (state, token) => (state.token = token),
      SET_LOGGED_IN_USER_NAME: (state, logged_in_user_name) => (state.logged_in_user_name = logged_in_user_name),
      REMOVE_TOKEN: (state) => {
        state.token = null;
        state.logged_in_user_name = null;
      },
    },
    actions: {
      async getUserProfile({state}) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/me')
      },
      async getUserWiseTags({state}, data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/tags?page='+data)
      },
      async getTagById({state}, tag_id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/tag/'+tag_id)
      },
      async updateTag({state}, {id, tag_info}) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.put('/tag/'+id, tag_info)
      },
      async getUserWiseSkills({state}, data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/skills?page='+data)
      },
      async saveUserProfile({state}, data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.post('/update_user', data)
      },
      async getUserInfo ({commit, state}) {
        await axios.get('/user/'+state.route.params.user_name).then((response) => {
          commit('SET_USER', response.data);
          
          this.dispatch('getUserSkills', response.data.id);
          this.dispatch('getUserCertificates', response.data.id);
          this.dispatch('getUserServices', response.data.id);
          this.dispatch('getUserPortfolios', response.data.id);
          this.dispatch('getUserLinks', response.data.id);
          this.dispatch('getUserBlogs', response.data.id);
        })
      },
      async getUserSkills ({commit}, user_id) {
        const response = await axios.get('/skills/'+user_id);
        commit('SET_SKILLS', response.data);
      },
      async getUserCertificates ({commit}, user_id) {
        const response = await axios.get('/certificates/'+user_id);
        commit('SET_CERTIFICATES', response.data);
      },
      async getUserServices ({commit}, user_id) {
        const response = await axios.get('/services/'+user_id);
        commit('SET_SERVICES', response.data);
      },
      async getUserPortfolios ({commit}, user_id) {
        const response = await axios.get('/portfolios/'+user_id);
        commit('SET_PORTFOLIOS', response.data);
      },
      async getUserLinks ({commit}, user_id) {
        const response = await axios.get('/links/'+user_id);
        commit('SET_LINKS', response.data);
      },
      async getUserBlogs ({commit}, user_id) {
        const response = await axios.get('/blogs/'+user_id);
        commit('SET_BLOGS', response.data);
      },
      async sendMessage({}, data) {
        return await axios.post('/send_message', data)
      },
      async login({}, data) {
        return await axios.post('/login', data)
      },
      setToken({commit}, token) {
        commit('SET_TOKEN', token)
      },
      setLoggedInUserName({commit}, user_name) {
        commit('SET_LOGGED_IN_USER_NAME', user_name)
      },
      async logout({state}) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/logout')
      },
      removeToken({commit}){
        if(localStorage.getItem('portfolio_token') || localStorage.getItem('user_name')){
          commit('REMOVE_TOKEN')
          localStorage.removeItem('portfolio_token');
          localStorage.removeItem('user_name');
      }
      },
    },
})