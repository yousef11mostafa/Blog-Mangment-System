import { createRouter, createWebHistory } from 'vue-router';

import HomeView from '../views/HomeView.vue'
import PostsView from '../components/pages/posts.vue'
import ProfileView from '../components/pages/profile.vue'
import DashboardView from '../components/pages/dashboard.vue'

import LoginView from '../components/auth/login.vue'
import RegisterView from '../components/auth/register.vue'
import PasswordLink from '../components/auth/password-link.vue'
import PasswordReset from '../components/auth/password-reset.vue'


// import Home from '../components/pages/Home.vue';
// import About from '../components/pages/About.vue';
import NotFound from '../components/pages/NotFound.vue';
import UnAuthorized from '../components/pages/unauthorized.vue';

const routes = [

    {
        path: '/',
        name: 'home',
        component: HomeView,
        // meta: { requiresAuth: true },
      },
      {
        path: '/login',
        name: 'login',
        component: LoginView,
        meta: { requiresGuest: true }
      },
      {
        path: '/register',
        name: 'register',
        component: RegisterView ,
        meta: { requiresGuest: true }
      },
      {
        path: '/forgot-password',
        name: 'passwordLink',
        component: PasswordLink ,
        // props: route => ({ token: route.query.token, email: route.query.email })
        meta: { requiresGuest: true }
      },
      {
        path: '/api/reset-password',
        name: 'passwordReset',
        component: PasswordReset ,
        meta: { requiresGuest: true }
      },
      {
        path: '/posts',
        name: 'posts',
        component: PostsView,
        meta: { requiresAuth: true },
      },
      {
        path: '/profile',
        name: 'profile',
        component: ProfileView,
        meta: { requiresAuth: true },
      },
      {
        path: '/dashboard',
        name: 'dashboard',
        component: DashboardView,
        meta: { requiresAuth: true , role:'admin' },
      },




    { path: '/unauthorized', component: UnAuthorized },
    { path: '/:pathMatch(.*)*', component: NotFound },

];

const router = createRouter({
  history: createWebHistory(),
  routes,
});


import store  from '../store';



router.beforeEach((to, from, next) => {

    const isAuthenticated = store.getters['auth/isAuthenticated']; // Get auth status from Vuex

    if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated ) {
      next('/login'); // Redirect to login if not authenticated
    } else if (to.matched.some(record => record.meta.requiresGuest) && isAuthenticated) {
      next('/'); // Redirect to home if authenticated and trying to access guest-only pages
    }
    // test
    else if (to.matched.some(record => record.meta.role)) {
        const requiredRole = to.meta.role;
        console.log(requiredRole);
        const hasRole = store.getters['auth/isAuthorized']("admin") // Check if user has the required role
        console.log(hasRole);

        if (hasRole) {
            next(); // Allow access if the user has the required role
        } else {
            next('/unauthorized'); // Redirect to unauthorized page if the user lacks the required role
        }
    }
    // test

    else {
      next(); // Allow access
    }
  });


export default router;
