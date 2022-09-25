<template>
    <div class="container">
        <Chart />
        <Form />
    </div>
</template>

<script>
import Form from './components/Form.vue';
import Chart from './components/Chart.vue';

export default {
    name: 'BitcoinTracker',
    components: { Form, Chart }
}
</script>
