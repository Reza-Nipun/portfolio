import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
      user_info: {},
      skills: {},
      certificates: {},
      services: {},
      portfolios: {},
      links: {},
      blogs: {},
    },
    getters: {
      getUserId(state){
        return state.user_info.id
      }
    },
    mutations: {
      SET_USER: (state, user) => (state.user_info = user),
      SET_SKILLS: (state, skills) => (state.skills = skills),
      SET_CERTIFICATES: (state, certificates) => (state.certificates = certificates),
      SET_SERVICES: (state, services) => (state.services = services),
      SET_PORTFOLIOS: (state, portfolios) => (state.portfolios = portfolios),
      SET_LINKS: (state, links) => (state.links = links),
      SET_BLOGS: (state, blogs) => (state.blogs = blogs),
    },
    actions: {
      async getUserInfo ({commit, state}) {
        const response = await axios.get('/api/user/'+state.route.params.user_name);
        commit('SET_USER', response.data);
      },
      async getUserSkills ({commit}, user_id) {
        const response = await axios.get('/api/skills/'+user_id);
        commit('SET_SKILLS', response.data);
      },
      async getUserCertificates ({commit}, user_id) {
        const response = await axios.get('/api/certificates/'+user_id);
        commit('SET_CERTIFICATES', response.data);
      },
      async getUserServices ({commit}, user_id) {
        const response = await axios.get('/api/services/'+user_id);
        commit('SET_SERVICES', response.data);
      },
      async getUserPortfolios ({commit}, user_id) {
        const response = await axios.get('/api/portfolios/'+user_id);
        commit('SET_PORTFOLIOS', response.data);
      },
      async getUserLinks ({commit}, user_id) {
        const response = await axios.get('/api/links/'+user_id);
        commit('SET_LINKS', response.data);
      },
      async getUserBlogs ({commit}, user_id) {
        const response = await axios.get('/api/blogs/'+user_id);
        commit('SET_BLOGS', response.data);
      },
    },
})