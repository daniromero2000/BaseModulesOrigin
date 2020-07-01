import Vuex from 'vuex'
import Vue from 'vue'
import store from './store';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'


Vue.use(BootstrapVue)
Vue.use(Vuex)
Vue.component('list-products', require('./components/products/listProducts.vue').default);


// const ecommerce = new Vue({
//     el: '#ecommerce',
//     store
// });
