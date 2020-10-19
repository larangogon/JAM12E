<script>
import BarChart from "./charts/BarChart";
import {stringify} from "qs";
import PieChart from "./charts/PieChart";
import LineChart from "./charts/LineChart";
export default {
    name: "OrderMetric",
    data() {
        return {
            orderCount: {},
            orderData: {},
            labelX: "Fecha",
            labelY: "Cantidad",
            to: null,
            from: null,
            orderBarChart: null,
            orderLineChart: null,
            orderPieChart: null,
        }
    },
    computed: {
        dates() {
            const days = [];
            const dates = [];
            for(let i = this.rangeOnDays; i >= 0; i--){
                days[i] = (new Date(
                    this.to.getFullYear(),
                    this.to.getMonth(),
                    (this.to.getDate() - i))).toISOString().slice(0,10);
            }
            Object.values(days).reverse().forEach(date => {
                dates[date] = date;
            });
            return dates;
        },
        rangeOnDays() {
            return Math.round((this.to - this.from) / (1000 * 60 * 60 * 24));
        },
        labels() {
            return Object.keys(this.orderData[Object.keys(this.orderData)[0] ?? 0] ?? [])
        },
        total() {
            const mapper = item => Number(item);
            return this.sum([
                this.sum(Object.values(this.orderData['APPROVED'] ?? [0]).map(mapper)),
                this.sum(Object.values(this.orderData['REJECTED'] ?? [0]).map(mapper)),
                this.sum(Object.values(this.orderData['PENDING'] ?? [0]).map(mapper)),
            ]);
        }
    },
    created() {
        this.to = new Date();
        this.from = new Date(
            this.to.getFullYear(),
            this.to.getMonth(),
            (this.to.getDate() - 7)
        );
        this.getMetrics();
    },
    methods: {
        sum(array) {
            return +array.reduce(function (carry, b) {
                return Number(carry) + Number(b);
            }, 0).toFixed(2);
        },
        getMetrics() {
            axios.get('/metrics/order-count', {
                params: {
                    'filter': {
                        'from': this.from.toISOString().slice(0, 10),
                        'to': this.to.toISOString().slice(0, 10),
                        'primary': 'all',
                    }
                }
            }).then(({data: {metric}}) => {
                this.orderCount = Object.assign({}, metric);
                this.buildMetric();
                this.loading = false;
            }).catch(error => {
                console.log(error);
                this.loading = false;
            })
        },
        buildMetric() {
            this.completeLabels();
            this.drawCharts();
        },
        completeLabels() {
            Object.keys(this.orderCount ?? []).forEach(item => {
                this.orderData[item] = {};
                let listFormat = {};
                let keys = this.dates;
                let byStatus = this.orderCount[item] ?? [];
                Object.keys(byStatus).forEach(date => {
                    listFormat[keys[date]] = this.orderCount[item][date];
                });
                Object.values(keys).forEach(period => {
                    if (!Object.keys(listFormat).includes(period.toString())) listFormat[period] = 0;
                });
                listFormat = Object.fromEntries(Object.entries(listFormat).sort());
                this.orderData[item] = listFormat;
            });
        },
        drawCharts() {
            this.drawOrderBar();
            this.drawOrderLine();
            this.drawOrderPie();
        },
        drawOrderBar() {
            this.orderBarChart = (new BarChart).drawBarChart(
                'orderBar',
                this.labels,
                this.mapOrderBarDataset(),
                this.orderBarChart,
                this.labelX, this.labelY,
            );
        },
        drawOrderLine() {
            this.orderLineChart = (new LineChart).drawLineChart(
                'orderLine',
                this.labels,
                this.mapOrderBarDataset(),
                this.orderLineChart,
                this.labelX, this.labelY,
            );
        },
        mapOrderBarDataset() {
            return [
                {
                    'label': 'APPROVED',
                    'data': Object.values(this.orderData['APPROVED'] ?? [0]),
                    'hidden': stringify([0]) === stringify(Object.values(this.orderData['APPROVED'] ?? [0])),
                    'borderColor': 'rgba(54, 162, 235)',
                    'borderWidth': 2,
                    'backgroundColor': 'rgba(54, 162, 235, 0.6)'
                },
                {
                    'label': 'REJECTED',
                    'data': Object.values(this.orderData['REJECTED'] ?? [0]),
                    'hidden': stringify([0]) === stringify(Object.values(this.orderData['REJECTED'] ?? [0])),
                    'borderColor': 'rgba(255, 99, 132)',
                    'borderWidth': 2,
                    'backgroundColor': 'rgba(255, 99, 132, 0.6)',
                },
                {
                    'label': 'PENDING',
                    'data': Object.values(this.orderData['PENDING'] ?? [0]),
                    'hidden': stringify([0]) === stringify(Object.values(this.orderData['PENDING'] ?? [0])),
                    'borderColor': 'rgba(255, 206, 86)',
                    'borderWidth': 2,
                    'backgroundColor': 'rgba(255, 206, 86, 0.6)'
                },
            ]
        },
        drawOrderPie() {
            this.orderPieChart = (new PieChart).drawPieChart(
                'orderPie',
                this.mapOrderPieDataset(),
                this.orderPieChart);
        },
        mapOrderPieDataset() {
            return {
                'datasets': [{
                    data: [
                        this.sum(Object.values(this.orderData['APPROVED'] ?? [0])),
                        this.sum(Object.values(this.orderData['REJECTED'] ?? [0])),
                        this.sum(Object.values(this.orderData['PENDING'] ?? [0])),
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235)',
                        'rgba(255,99,132)',
                        'rgba(255, 206, 86)',
                    ],
                    borderWidth: 2,
                }],
                'totals': this.total,
                'labels': ['APPROVED', 'REJECTED', 'PENDING']
            }
        },
    },
}
</script>
