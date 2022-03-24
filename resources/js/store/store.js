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
      REMOVE_TOKEN: (state) => (state.token = null),
    },
    actions: {
      async getUserInfo ({commit, state}) {
        const response = await axios.get('/user/'+state.route.params.user_name);
        commit('SET_USER', response.data);
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
      async logout({state}) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/logout')
      },
      removeToken({commit}){
        if(localStorage.getItem('portfolio_token')){
          commit('REMOVE_TOKEN')
          localStorage.removeItem('portfolio_token');
      }
      },
    },
})