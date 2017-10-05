<template>
    <div class="my-5 container">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Subscriptions</h3>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex align-items-center" v-for="subscription in subscriptions">
                    <p class="mb-0">{{ subscription.plan.name }} @ {{ subscription.plan.amount }} / per {{
                        subscription.plan.interval }}<br/>
                        <small class="text-muted" v-if="subscription.ends_at">Ends at {{ subscription.ends_at }}</small>
                    </p>
                    <button @click.prevent="cancelSubscription(subscription.plan)"
                            class="btn text-danger ml-auto btn-link"
                            v-if="!subscription.ends_at">
                        <i class="fa fa-spinner fa-spin" v-if="ui.busy"></i>
                        <span v-if="!ui.busy">Cancel</span>
                        <span v-if="ui.busy">Cancelling</span>
                    </button>
                    <button @click.prevent="resumeSubscription(subscription.plan)"
                            class="btn text-success ml-auto btn-link"
                            v-if="subscription.ends_at">
                        <i class="fa fa-spinner fa-spin" v-if="ui.busy"></i>
                        <span v-if="!ui.busy">Resume</span>
                        <span v-if="ui.busy">Resuming</span>
                    </button>
                </li>
            </ul>
            <div class="card-footer text-right">
                <a class="btn btn-primary" href="plans"><i class="fa fa-refresh"
                                                                                      aria-hidden="true"></i>
                    Change My Plan</a>
            </div>

        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                subscriptions: [],
                ui: {
                    busy: false
                }
            }
        },
        created() {
            bus.$on('userRetrieved', () => {
                this.getSubscriptions();
            })
        },
        methods: {
            getSubscriptions() {
                axios.get('/api/subscriptions')
                    .then(response => {
                        this.subscriptions = response.data;
                    })
                    .catch(error => {

                    })
            },
            cancelSubscription(plan) {
                this.ui.busy = true;
                axios.get('/subscriptions/' + plan.stripe_id)
                    .then(response => {
                        this.ui.busy = false;
                        this.getSubscriptions();
                        bus.$emit('confirm', 'Subscription has been cancelled');
                    })
                    .catch(error => {

                    })
            },
            resumeSubscription(plan) {
                this.ui.busy = true;
                axios.get(`/subscriptions/${plan.stripe_id}/resume`)
                    .then(response => {
                        this.ui.busy = false;
                        this.getSubscriptions();
                        bus.$emit('confirm', 'Subscription has been resumed');
                    })
                    .catch(error => {

                    })
            },
        }
    }
</script>
