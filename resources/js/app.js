import OrderMetric from "./metrics/orderMetric";
import orderMetric from "./metrics/paymentMetric";
import cancelledMetric from "./metrics/cancelledMetric";

require('./bootstrap');

window.Vue = require('vue');

Vue.component("orderMetric", OrderMetric);
Vue.component("paymentMetric", orderMetric);
Vue.component("cancelledMetric", cancelledMetric);

const app = new Vue({
    el: '#app',
});

const compiler = require('vue-template-compiler')




