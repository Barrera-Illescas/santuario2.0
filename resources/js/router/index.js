import { createRouter, createWebHashHistory } from 'vue-router';
const home = () => import('../web/HomeCom.vue');

const routes = [
  {
    path: '/',
    name: 'home',
    component: home,
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
