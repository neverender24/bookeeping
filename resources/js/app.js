require('./bootstrap');
window.Vue = require('vue').default;

import {
    store
} from './store'
import Vue from 'vue';
import App from './app.vue'
import router from "../js/routes"
import VueLoading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import Snotify from 'vue-snotify';
import 'vue-snotify/styles/material.css';
import JsonExcel from "vue-json-excel";


Vue.use(Snotify);
Vue.component("downloadExcel", JsonExcel);
Vue.use(VueLoading, {
    // props
    canCancel: false,
    backgroundColor: "#c4c4c4",
    loader: 'dots'
}, {
    // slots
    container: 'formContainer',
})

new Vue({
    el: '#app',
    components: {App},
    router,
    store: store,
});