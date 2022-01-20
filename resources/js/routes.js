import App from './components/App.vue'
import DefaultApp from './components/Default/App.vue'

export default [
    { path: '/', component: DefaultApp},
    { path: '/:user_name', component: App},
]