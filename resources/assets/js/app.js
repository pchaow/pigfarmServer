
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// Vue Router

import VueRouter from 'vue-router';
Vue.use(VueRouter);

// Vue Highcharts
import VueHighcharts from 'vue-highcharts';
Vue.use(VueHighcharts);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

Vue.component(
    'example-chart-1',
    require("./components/example-charts/chart1.vue")
)


const router = new VueRouter({
    routes: [
        { path: '/', component: require('./components/main.vue') },
    ]
});


const app = new Vue({
    el: '#app',
    router,
});
