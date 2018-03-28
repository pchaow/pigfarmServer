// router.js
import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)


export function createRouter() {
    return new Router({
        beforeEach: function (to, from, next) {
            console.log("FULLPATH", to.fullPath);

            if (to.fullPath !== "/login") {

                if (localStorage.accessToken != null) {
                    axios.defaults.headers.common['Authorization'] = "Bearer " + localStorage.accessToken
                }

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
        },
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
                        component: require('./components/ExampleComponent')
                    },
                ]
            },
            {
                path: '/admin',
                component: require('./components/admin.vue'),
                children: [
                    {
                        path: 'user',
                        component: require('./components/admin/user/index')
                    },
                    {
                        path: 'role',
                        component: require('./components/admin/role/index')
                    },
                ]
            },

        ]
    })
}