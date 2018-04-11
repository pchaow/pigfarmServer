// router.js
import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import route_login from "./routes/login";
import route_admin_user from "./routes/users";
import route_admin_role from "./routes/roles";


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
]
    })

    router.beforeEach((to, from, next) => {
        console.log(to.fullPath)
        if (to.fullPath !== "/login") {

            axios.get('/api/user').then(response => {

                if (to.fullPath == "/") {
                    router.push("/home")
                }

                next();
            }).catch(error => {
                router.push('/login');
            })
        } else {
            next();
        }
    },)

    return router;
}