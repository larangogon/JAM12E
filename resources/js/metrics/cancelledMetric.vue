<script>
import BarChart from "./charts/BarChart";
import {stringify} from "qs";
import PieChart from "./charts/PieChart";
import LineChart from "./charts/LineChart";
export default {
    name: "cancelledMetric",
    data() {
        return {
            cancelledCount: {},
            cancelledData: {},
            labelX: "Fecha",
            labelY: "Cantidad",
            to: null,
            from: null,
            cancelledBarChart: null,
            cancelledLineChart: null,
            cancelledPieChart: null,
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
            return Object.keys(this.cancelledData[Object.keys(this.cancelledData)[0] ?? 0] ?? [])
        },
        total() {
            const mapper = item => Number(item);
            return this.sum([
                this.sum(Object.values(this.cancelledData['CANCELADO'] ?? [0]).map(mapper)),
            ]);
        }
    },
    created() {
        this.to = new Date();
        this.from = new Date(
            this.to.getFullYear(),
            this.to.getMonth(),
            (this.to.getDate() - 15)
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
            axios.get('/metrics/cancelled-count', {
                params: {
                    'filter': {
                        'from': this.from.toISOString().slice(0, 10),
                        'to': this.to.toISOString().slice(0, 10),
                        'primary': 'all',
                    }
                }
            }).then(({data: {metric}}) => {
                this.cancelledCount = Object.assign({}, metric);
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
            Object.keys(this.cancelledCount ?? []).forEach(item => {
                this.cancelledData[item] = {};
                let listFormat = {};
                let keys = this.dates;
                let byStatus = this.cancelledCount[item] ?? [];
                Object.keys(byStatus).forEach(date => {
                    listFormat[keys[date]] = this.cancelledCount[item][date];
                });
                Object.values(keys).forEach(period => {
                    if (!Object.keys(listFormat).includes(period.toString())) listFormat[period] = 0;
                });
                listFormat = Object.fromEntries(Object.entries(listFormat).sort());
                this.cancelledData[item] = listFormat;
            });
        },
        drawCharts() {
            this.drawCancelledBar();
            this.drawCancelledLine();
            this.drawCancelledPie();
        },
        drawCancelledBar() {
            this.cancelledBarChart = (new BarChart).drawBarChart(
                'cancelledBar',
                this.labels,
                this.mapCancelledBarDataset(),
                this.cancelledBarChart,
                this.labelX, this.labelY,
            );
        },
        drawCancelledLine() {
            this.cancelledLineChart = (new LineChart).drawLineChart(
                'cancelledLine',
                this.labels,
                this.mapCancelledBarDataset(),
                this.cancelledLineChart,
                this.labelX, this.labelY,
            );
        },
        mapCancelledBarDataset() {
            return [
                {
                    'label': 'CANCELADO',
                    'data': Object.values(this.cancelledData['CANCELADO'] ?? [0]),
                    'hidden': stringify([0]) === stringify(Object.values(this.cancelledData['CANCELADO'] ?? [0])),
                    'borderColor': 'rgba(255, 99, 132)',
                    'borderWidth': 2,
                    'backgroundColor': 'rgba(255, 99, 132, 0.6)',
                },
            ]
        },
        drawCancelledPie() {
            this.cancelledPieChart = (new PieChart).drawPieChart(
                'cancelledPie',
                this.mapCancelledPieDataset(),
                this.cancelledPieChart);
        },
        mapCancelledPieDataset() {
            return {
                'datasets': [{
                    data: [
                        this.sum(Object.values(this.cancelledData['CANCELADO'] ?? [0])),
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                    ],
                    borderColor: [
                        'rgba(255,99,132)',
                    ],
                    borderWidth: 2,
                }],
                'totals': this.total,
                'labels': ['CANCELADO']
            }
        },
    },
}
</script>
