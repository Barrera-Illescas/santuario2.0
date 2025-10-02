import { createRouter, createWebHashHistory } from 'vue-router';
const home = () => import('../web/HomeCom.vue');
const Portafolio = () => import('../web/Portafolio.vue');

const routes = [
  {
    path: '/',
    name: 'home',
    component: home,
  },
  { 
    path: '/portafolio',
    name: 'portafolio',
    component: Portafolio,
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
