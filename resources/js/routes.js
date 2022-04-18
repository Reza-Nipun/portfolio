import App from './components/App.vue'
import DefaultApp from './components/Default/App.vue'
import Login from './components/Admin/Login.vue'
import DashboardApp from './components/Admin/Dashboard.vue'
import DashboardProfile from './components/Admin/Profile.vue'
import DashboardLogout from './components/Admin/Logout.vue'

export default [
    { path: '/', component: DefaultApp},
    { path: '/login', name: 'Login', component: Login, meta: { visitor: true }},
    { path: '/:user_name', name: 'Portfolio', component: App},
    { path: '/dashboard/home', name: 'Dashboard', component: DashboardApp, meta: { requiresAuth: true }},
    { path: '/dashboard/profile', name: 'Profile', component: DashboardProfile, meta: { requiresAuth: true }},
    { path: '/dashboard/logout', name: 'Logout', component: DashboardLogout, meta: { requiresAuth: true }},
]
