import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "top",
      component: HomeView,
    },

    {
      path: "/sports",
      name: "sports",
      component: HomeView,
    },

    {
      path: "/health",
      name: "health",
      component: HomeView,
    },

    {
      path: "/technology",
      name: "technology",
      component: HomeView,
    },

    {
      path: "/business",
      name: "business",
      component: HomeView,
    },
    {
      path: "/entertainment",
      name: "entertainment",
      component: HomeView,
    },
    {
      path: "/science",
      name: "science",
      component: HomeView,
    },
    {
      path: "/politics",
      name: "politics",
      component: HomeView,
    },
  ],
});

export default router;
