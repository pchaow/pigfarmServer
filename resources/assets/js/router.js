// router.js
import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import route_login from "./routes/login";
import route_admin_user from "./routes/users";
import route_admin_role from "./routes/roles";

import route_admin_choice from "./routes/choices";


export function createRouter() {
    let router = new Router({

        routes: [
            route_login,
            {
                path: '/home',
                component: require('./components/main.vue'),
                children: [
                    {
                        path: '/',
                        component: require('./components/example-charts/chart1')
                    },
                    {
                        path: 'chart1',
                        component: require('./components/example-charts/chart1')
                    },
                ]
            },
            route_admin_user,
            route_admin_role,
            route_admin_choice
        ]
    })

    router.beforeEach((to, from, next) => {
        if (to.fullPath !== "/login") {

            if (localStorage.key('user')) {
                if (to.fullPath == "/") {
                    router.push("/home")
                }
                next();
            } else {
                router.push('/login');
            }
        } else {
            next();
        }
    },)

    return router;
}