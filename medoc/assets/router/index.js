import { createRouter, createMemoryHistory } from 'vue-router'
import medocList from '../views/medocList.vue'

const router = createRouter({
  history: createMemoryHistory(),
  routes: [
    {
      path: '/',
      name: 'medocList',
      component: medocList
    },
    {
      path: '/medocAdd',
      name: 'medocAdd',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/medocAdd.vue')
    }
  ]
})

export default router

