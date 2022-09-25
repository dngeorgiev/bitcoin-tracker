<template>
    <div id="chartContainer">
        <Line
            v-if="loaded"
            :chart-options="chartOptions"
            :chart-data="chartData"
            :chart-id="chartId"
            :dataset-id-key="datasetIdKey"
            :plugins="plugins"
            :css-classes="cssClasses"
            :styles="styles"
            :width="width"
            :height="height"
        />
        <div class="chart-footer">
            <div class="filter-buttons-container">
                <button class="btn btn-primary" :class="{active: selectedChartType === 'one_hour'}" @click="changeChartType('one_hour')">1h</button>
                <button class="btn btn-primary" :class="{active: selectedChartType === 'six_hours'}" @click="changeChartType('six_hours')">6h</button>
                <button class="btn btn-primary" :class="{active: selectedChartType === 'one_day'}" @click="changeChartType('one_day')">1d</button>
                <button class="btn btn-primary" :class="{active: selectedChartType === 'three_days'}" @click="changeChartType('three_days')">3d</button>
                <button class="btn btn-primary" :class="{active: selectedChartType === 'seven_days'}" @click="changeChartType('seven_days')">7d</button>
                <button class="btn btn-primary" :class="{active: selectedChartType === 'one_month'}" @click="changeChartType('one_month')">1m</button>
                <button class="btn btn-primary" :class="{active: selectedChartType === 'three_months'}" @click="changeChartType('three_months')">3m</button>
                <button class="btn btn-primary" :class="{active: selectedChartType === 'one_year'}" @click="changeChartType('one_year')">1y</button>
                <button class="btn btn-primary" :class="{active: selectedChartType === 'three_years'}" @click="changeChartType('three_years')">3y</button>
            </div>
            <div class="chart-footer-description">
                All times are in UTC.
            </div>
        </div>
    </div>
</template>

<script>
import { Line } from 'vue-chartjs';
import {Chart as ChartJS, Title, Tooltip, Legend, CategoryScale, LinearScale, LineElement, PointElement} from 'chart.js'
import moment from 'moment';

ChartJS.register(Title, Tooltip, Legend, LineElement, CategoryScale, LinearScale, PointElement)

export default {
    name: 'Chart',
    components: { Line },
    props: {
        chartId: {
            type: String,
            default: 'line-chart'
        },
        datasetIdKey: {
            type: String,
            default: 'label'
        },
        width: {
            type: Number,
            default: 1280
        },
        height: {
            type: Number,
            default: 500
        },
        cssClasses: {
            default: '',
            type: String
        },
        styles: {
            type: Object,
            default: () => {}
        },
        plugins: {
            type: Object,
            default: () => {}
        }
    },
    data() {
        return {
            selectedChartType: 'one_hour',
            loaded: false,
            chartData: null,
            chartOptions: {
                responsive: true,
                scales: {
                    xAxis: {
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: 5,
                            maxRotation: 0,
                            minRotation: 0,
                        }
                    }
                },
                borderColor: '#007bff',
                plugins: {
                    legend: {
                        display: false
                    }
                }

            }
        }
    },
    methods: {
        async changeChartType(chartType) {
            this.loaded = false;

            await this.collectData(chartType);
        },
        async collectData(chartType) {
            return axios.get(`/api/ticker_data/btc/usd/${chartType}`)
                .then((res) => {
                    const {data} = res;

                    let labels = [];
                    let dataset = [];
                    data.forEach((tickerDatum) => {
                        let label = moment(tickerDatum.date).format('HH:mm');
                        if (chartType === 'one_day') {
                            label = moment(tickerDatum.date).format('DD.MM HH:mm');
                        } else if (chartType === 'three_days') {
                            label = moment(tickerDatum.date).format('DD.MM HH:mm');
                        } else if (chartType === 'seven_days') {
                            label = moment(tickerDatum.date).format('DD.MM HH:mm');
                        } else if (chartType === 'one_month') {
                            label = moment(tickerDatum.date).format('DD.MM HH:mm');
                        } else if (chartType === 'three_months') {
                            label = moment(tickerDatum.date).format('DD.MM HH:mm');
                        } else if (chartType === 'one_year') {
                            label = moment(tickerDatum.date).format('DD.MM HH:mm');
                        } else if (chartType === 'three_years') {
                            label = moment(tickerDatum.date).format('DD.MM.YYYY HH:mm');
                        }

                        labels.push(label);
                        dataset.push(tickerDatum.price);
                    })
                    this.chartData = {
                        labels: labels,
                        datasets: [
                            {
                                data: dataset
                            }
                        ]
                    }
                    this.loaded = true;
                    this.selectedChartType = chartType;
                })
                .catch((err) => {
                    console.error(err);
                })
                .finally(() => {
                    console.log('finally');
                })
        }
    },
    async mounted() {
        this.loaded = false;

        await this.collectData('one_hour');
    }
}
</script>

<style scoped>
    #chartContainer {
        margin-top: 1rem;
        height: 600px;
    }
    .chart-footer {
        display: flex;
        align-items: center;
        margin-top: 2rem;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    .filter-buttons-container > button {
        margin: 0.25rem;
        padding: 5px 10px;
    }
    .filter-buttons-container > button.active {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
</style>
