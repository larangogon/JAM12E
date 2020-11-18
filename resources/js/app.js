import orderMetric from "./metrics/orderMetric";
import paymentMetric from "./metrics/paymentMetric";
import cancelledMetric from "./metrics/cancelledMetric";

require('./bootstrap');

window.Vue = require('vue');

Vue.component("orderMetric", orderMetric);
Vue.component("paymentMetric", paymentMetric);
Vue.component("cancelledMetric", cancelledMetric);

const app = new Vue({
    el: '#app',
});

const compiler = require('vue-template-compiler')




