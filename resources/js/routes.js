import App from './components/App.vue'
import DefaultApp from './components/Default/App.vue'
import Login from './components/Admin/Login.vue'

export default [
    { path: '/', component: DefaultApp},
    { path: '/login', component: Login},
    { path: '/:user_name', component: App},
]