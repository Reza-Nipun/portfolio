import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
      user_info: {},
      skills: {},
    },
    mutations: {
      getUserInfo (state) {
        axios.get('/api/user/'+state.route.params.user_name).then((response) => {
          state.user_info = response.data
        })
      },
      getUserSkills (state, user_id) {
        axios.get('/api/skills/'+user_id).then((response) => {
          state.skills = response.data
        })
      },
    },
})