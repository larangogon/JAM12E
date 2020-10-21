import OrderMetric from "./metrics/orderMetric";

require('./bootstrap');

window.Vue = require('vue');

Vue.component("orderMetric", OrderMetric);

const app = new Vue({
    el: '#app',
});

const compiler = require('vue-template-compiler')




