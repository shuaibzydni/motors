/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue').default;

require('./bootstrap')

import store from "./stores";
import GlobalMixin from "./mixins/GlobalMixin";
import LaravelVuePagination from 'laravel-vue-pagination'
import VModal from 'vue-js-modal'
import SweetAlert from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css';
import { modal } from './constants'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import VueMask from 'v-mask'
import Loading from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/vue-loading.css'


//Mixin
Vue.mixin(GlobalMixin)

Vue.prototype._modal = modal

Vue.use(Loading, {
    color: '#343a40',
})
Vue.use(SweetAlert)
Vue.component('pagination', LaravelVuePagination)
Vue.use(VModal, {
    componentName: 'v-modal',
    dynamic: true,
})
Vue.use(VueMask)
Vue.component('v-select', vSelect)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
});
