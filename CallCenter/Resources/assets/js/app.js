require('./bootstrap');

import Vuex from 'vuex'
import Vue from 'vue'
import store from './store';

Vue.use(Vuex)

Vue.component('app-create', require('./components/admin/questionnarie/create.vue').default);

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     namespace: 'Modules.Companies.Events',
//     key: 1234,
//     wsHost: window.location.hostname,
//     wsPort: 6001,
//     forceTLS: false,
//     disableStats: true,
// });

const header = new Vue({
    el: '#callCenter',
    store
});