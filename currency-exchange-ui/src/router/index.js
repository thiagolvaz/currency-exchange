import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/currencies',
    name: 'Currencies',
    component: () => import(/* webpackChunkName: "about" */ '../views/Currencies.vue')
  },
  {
    path: '/exchange',
    name: 'Exchange',
    component: () => import(/* webpackChunkName: "about" */ '../views/Exchange.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
