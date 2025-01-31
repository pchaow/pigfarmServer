/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuetify from 'vuetify'
Vue.use(Vuetify)

window._ = require('lodash');
Object.defineProperty(Vue.prototype, '_', { value: window._ });




// Vue Highcharts
import VueHighcharts from 'vue-highcharts';

Vue.use(VueHighcharts);
Vue.use(require('vue-moment'));

Vue.component('pagination', require('laravel-vue-pagination'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// Vue Router
import {createRouter} from './router'

const router = createRouter()

const app = new Vue({
    el: '#app',
    router,
    components: {
    }

});
