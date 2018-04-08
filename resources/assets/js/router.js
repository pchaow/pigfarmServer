// router.js
import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)


export function createRouter() {
    let router = new Router({

        routes: [
            {
                path: '/login',
                component: require("./components/auth/login.vue"),
            },
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
            {
                path: '/admin/user',
                component: require('./components/main.vue'),
                children: [
                    {
                        path: '',
                        component: require('./components/admin/user/index'),
                    },
                    {
                        path: 'add',
                        component: require('./components/admin/user/add'),
                    },
                    {
                        path: ':id/edit',
                        name: 'user-edit',
                        component: require('./components/admin/user/edit'),
                    },
                ]
            },
            {
                path: '/admin/role',
                component: require('./components/main.vue'),
                children: [
                    {
                        path: '',
                        component: require('./components/admin/role/index'),
                    },
                    {
                        path: 'add',
                        component: require('./components/admin/role/add'),
                    },
                ]
            },
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