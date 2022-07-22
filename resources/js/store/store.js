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
      async getSkillById({state}, skill_id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/skill/'+skill_id)
      },
      async updateSkill({state}, {id, skill_info}) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.put('/skill/'+id, skill_info)
      },
      async getUserCertifications({state}, data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/certificates?page='+data)
      },
      async getCertificateById({state}, certificate_id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/certificate/'+certificate_id)
      },
      async saveUserCertificate({state}, postData) {
        let id = postData.id;

        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.post('/certificate/'+id, postData.form_data)
      },
      async getUserWiseServices({state}, data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/services?page='+data)
      },
      async getServiceById({state}, service_id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/service/'+service_id)
      },
      async saveUserService({state}, postData) {
        let id = postData.id;

        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token

        if(typeof id !== 'undefined'){
          return await axios.post('/service/'+id, postData.form_data)
        } else {
          return await axios.post('/service/create', postData.form_data)
        }
        
      },
      async getUserSocialLinks({state}, data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/links?page='+data)
      },
      async getSocialLinkById({state}, link_id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/link/'+link_id)
      },
      async updateSocialLink({state}, {id, social_link_info}) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.put('/link/'+id, social_link_info)
      },
      async getUserWisePortfolios({state}, data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/portfolios?page='+data)
      },
      async getUserWisePortfolioById({state}, portfolio_id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/portfolio/'+portfolio_id)
      },
      async saveUserPortfolio({state}, postData) {
        let id = postData.id;

        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.post('/portfolio/'+id, postData.form_data)
      },
      async getUserWiseBlogs({state}, data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/blogs?page='+data)
      },
      async getUserWiseBlogById({state}, blog_id) {
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.get('/blog/'+blog_id)
      },
      async saveUserBlog({state}, postData) {
        let id = postData.id;

        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.token
        return await axios.post('/blog/'+id, postData.form_data)
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