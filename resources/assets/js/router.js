// router.js
import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)


export function createRouter () {
    return new Router({
        routes: [
            {
                path: '/home',
                component: require('./components/main.vue'),
                children: [
                    {path: '', component: require('./components/example-charts/chart1')},
                    {path: 'chart1', component: require('./components/ExampleComponent')},
                ]
            },
            {
                path: '/login',
                component: require("./components/auth/login.vue"),
            },
        ]
    })
}