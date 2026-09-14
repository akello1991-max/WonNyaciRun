import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import axios from 'axios'
import App from './App.vue'
import Home from './views/Home.vue'
import Payments from './views/Payments.vue'
import Blog from './views/Blog.vue'
import PostDetail from './views/PostDetail.vue'
import Contact from './views/Contact.vue'
import Clans from './views/Clans.vue'
import Practice from './views/Practice.vue'
import AdminLogin from './views/AdminLogin.vue'
import AdminDashboard from './views/AdminDashboard.vue'
import AdminPosts from './views/AdminPosts.vue'
import AdminMessages from './views/AdminMessages.vue'
import AdminSettings from './views/AdminSettings.vue'
import AdminClans from './views/AdminClans.vue'
import AdminPractice from './views/AdminPractice.vue'
import Partners from './views/Partners.vue'
import AdminPartners from './views/AdminPartners.vue'
import './styles.css'

axios.defaults.withCredentials = true
axios.defaults.baseURL = import.meta.env.VITE_API_URL || ''
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.xsrfCookieName = 'XSRF-TOKEN'
axios.defaults.xsrfHeaderName = 'X-XSRF-TOKEN'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', component: Home },
    { path: '/pay', component: Payments },
    { path: '/blog', component: Blog },
    { path: '/blog/:slug', component: PostDetail },
    { path: '/contact', component: Contact },
    { path: '/clans', component: Clans },
    { path: '/practice', component: Practice },
    { path: '/partners', component: Partners },
    { path: '/admin/login', component: AdminLogin },
    { path: '/admin', component: AdminDashboard, meta: { admin: true } },
    { path: '/admin/posts', component: AdminPosts, meta: { admin: true } },
    { path: '/admin/messages', component: AdminMessages, meta: { admin: true } },
    { path: '/admin/settings', component: AdminSettings, meta: { admin: true } },
    { path: '/admin/clans', component: AdminClans, meta: { admin: true } },
    { path: '/admin/practice', component: AdminPractice, meta: { admin: true } },
    { path: '/admin/partners', component: AdminPartners, meta: { admin: true } },
  ],
  scrollBehavior: (to) => to.hash ? { el: to.hash, top: 88, behavior: 'smooth' } : { top: 0 }
})

router.beforeEach(async (to) => {
  if (!to.meta.admin) return true
  try {
    const { data } = await axios.get('/api/admin/me')
    if (data.authenticated) return true
  } catch (_) {}
  return '/admin/login'
})

createApp(App).use(router).mount('#app')
