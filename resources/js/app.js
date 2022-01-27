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
