<template>
    <section id="subscriberForm">
        <h2>Subscribe to Bitcoin Tracker</h2>
        <div class="alert alert-success" v-if="errors.length === 0 && hasSuccessfullySubscribed">You have been successfully subscribed.</div>
        <div class="alert alert-notify" v-if="errors.length === 0">Enter your e-mail and your limit of BTC in USD. After the price has exceeded your set limit, we will notify you via e-mail.</div>
        <div class="alert alert-error" v-if="errors.length > 0">
            We have found the following errors:
            <ul>
                <li v-for="error in errors">
                    {{ error }}
                </li>
            </ul>
        </div>
        <form @submit.prevent="submit">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email"
                       name="email"
                       id="email"
                       class="form-control"
                       placeholder="name@example.com"
                       v-model="subscriber.email"
                       required>
            </div>
            <div class="form-group">
                <label for="btc_to_usd_limit">Your BTC to USD limit</label>
                <input type="text"
                       name="btc_to_usd_limit"
                       id="btcToUsdLimit"
                       class="form-control"
                       v-model="subscriber.btc_to_usd_limit"
                       required>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" :disabled="isDisabled">Submit</button>
            </div>
        </form>
    </section>
</template>

<script>
export default {
    name: "Form",
    data() {
        return {
            subscriber: {
                email: '',
                btc_to_usd_limit: 0,
            },
            isSending: false,
            hasSuccessfullySubscribed: false,
            errors: [],
        }
    },
    computed: {
        isDisabled() {
            return this.isSending || (this.subscriber.email.length === 0 || Number(this.subscriber.btc_to_usd_limit) <= 0)
        }
    },
    methods: {
        submit() {
            this.isSending = true;
            this.errors = [];

            axios.post('/api/subscribers', this.subscriber)
                .then(() => {
                    this.hasSuccessfullySubscribed = true;

                    setTimeout(() => this.hasSuccessfullySubscribed = false, 5000);
                })
                .catch((error) => {
                    const res = error.response.data;
                    const errorList = res.errors;
                    Object.keys(errorList).forEach(key => {
                        this.errors.push(errorList[key][0]);
                    })
                })
                .finally(() => {
                    this.isSending = false;
                })
        }
    }
}
</script>

<style scoped>
    #subscriberForm {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        max-width: 600px;
        border: 1px #e9e9e9 solid;
        padding: 1rem 2rem;
        width: 100%;
    }
    #subscriberForm > form {
        width: 100%;
    }
</style>
