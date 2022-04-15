import Vue from 'vue';
import App from './components/App'
import VueRouter from 'vue-router'
import Routes from './routes'
import { store } from './store/store'
import VueMeta from 'vue-meta'
import { sync } from 'vuex-router-sync'

require('./bootstrap');

Vue.use(VueRouter)
Vue.use(VueMeta)

const router = new VueRouter({
    routes: Routes,
    mode: 'history'
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      
      if (!store.getters.loggedIn) {
        next({
          name: 'Login'
        })
        location.reload();
      } else {
        next()
      }
    } else if (to.matched.some(record => record.meta.visitor)) {
      
        if (store.getters.loggedIn) {
          next({
            name: 'Dashboard'
          })
          location.reload();
        } else {
          next()
        }
      }
    else {
      next()
    }
  })

const unsync = sync(store, router)

const app = new Vue({
    store: store,
    el: '#app',
    components:{
        App
    },
    router: router
});

unsync();
