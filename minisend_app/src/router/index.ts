import Vue from 'vue'
import VueRouter, {RouteConfig} from 'vue-router'
import store from '../store/index';

Vue.use(VueRouter)

function lazy(component: string) {
    return () => import(`../views/${component}.vue`);
}

const routes: Array<RouteConfig> = [
    {
        path: '/',
        name: 'Mail',
        component: lazy('Mail'),
        beforeEnter(to, from, next) {
            if (store.getters["auth/authenticated"]) next()
            else next({
                path: '/auth'
            })
        }
    },
    {
        path: '/auth',
        name: 'Auth',
        component: lazy('Auth')
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
});

export default router
