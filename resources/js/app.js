require('./bootstrap');
window.Vue = require('vue');
Vue.component('v-header', require('./components/Header.vue').default);
import router from "./router";

const app = new Vue({
    el: '#app',
    router
});
