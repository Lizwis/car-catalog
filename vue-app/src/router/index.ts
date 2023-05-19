import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AutobidList from '../views/AutobidCarList.vue';
import AutobidShowVehicle from '../views/ShowAutobidCar.vue';

import Login from "../views/Login.vue";
import { useAuthStore } from "@/stores/auth";



const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,


    },
    {
      path: '/autobid/list',
      name: 'autobidList',
      component: AutobidList,

    },
    {
      path: '/autobid/show/vehicle',
      name: 'AutobidShowVehicle',
      component: AutobidShowVehicle,

    },
    {
      path: "/login",
      name: "login",
      component: Login,
      meta: { guestOnly: true },
    }, 
  ]

  
})

function isLoggedIn() {
  const authStore = useAuthStore();
  return authStore.user;
}
router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.authOnly)) {
    if (!isLoggedIn()) {
      next({
        path: "/login",
        query: { redirect: to.fullPath },
      });
    } else {
      next();
    }
  } else if (to.matched.some((record) => record.meta.guestOnly)) {
    if (isLoggedIn()) {
      next({
        path: "/",
        query: { redirect: to.fullPath },
      });
    } else {
      next();
    }
  } else {
    next();
  }
});


export default router

