<template>
    <div class="my-5 container">
        <div class="card card-border">
            <div class="card-body">
                <h3 class="card-title">Subscriptions</h3>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex align-items-center" v-for="subscription in subscriptions">
                    <p class="mb-0">{{ subscription.plan.name }} @ {{ subscription.plan.amount }} / per {{ subscription.plan.interval }}<br/>
                        <small class="text-muted" v-if="subscription.ends_at">Ends at {{ subscription.ends_at }}</small></p>
                    <a @click.prevent="cancelSubscription(subscription.plan)" class="btn text-danger ml-auto btn-link" v-if="!subscription.ends_at">Cancel</a>
                    <a :href="resumeSubscriptionUrl(subscription.plan)" class="btn text-success ml-auto btn-link" v-if="subscription.ends_at">Resume</a>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                subscriptions: []
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
                axios.get('/subscriptions/' + plan.stripe_id)
                    .then(response => {
                        this.getSubscriptions();
                        bus.$emit('confirm', 'Subscription has been cancelled');
                    })
                    .catch(error => {

                    })
                return "/subscriptions/" + plan.stripe_id;

            },
            resumeSubscriptionUrl(plan) {
                return "/subscriptions/" + plan.stripe_id + "/resume";
            }
        }
    }
</script>
