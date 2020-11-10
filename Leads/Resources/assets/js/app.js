require('./bootstrap');
import Vuex from 'vuex'
import Vue from 'vue'
import store from './store';

Vue.use(Vuex)
Vue.component('assigne-lead', require('./components/admin/toAssigneLead.vue').default);

const leadAssing = new Vue({
    el: '#leadAssing',
});


