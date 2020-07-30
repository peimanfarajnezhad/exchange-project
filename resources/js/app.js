import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

import App from './App.vue';

const router = new Router({
    mode: 'history',
    routes: [
        {
            alias: '',
            path: '/exchange',
            component: () => import('./pages/Exchange.vue')
        },
        {
            path: '/history',
            component: () => import('./pages/History.vue')
        }
    ]
});

const app = new Vue({
    router,
    el: '#app',
    components: { App },
});
