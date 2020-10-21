import OrderMetric from "./metrics/orderMetric";
import orderMetric from "./metrics/paymentMetric";

require('./bootstrap');

window.Vue = require('vue');

Vue.component("orderMetric", OrderMetric);
Vue.component("paymentMetric", orderMetric);

const app = new Vue({
    el: '#app',
});

const compiler = require('vue-template-compiler')




