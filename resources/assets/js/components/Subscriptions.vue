<template>
    <div class="my-5 container">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Subscriptions</h3>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex align-items-center" v-for="subscription in subscriptions">
                    <p class="mb-0">{{ subscription.plan.name }} @ {{ subscription.plan.amount }} / per {{ subscription.plan.interval }}<br/>
                        <small class="text-muted">Ends at {{ subscription.ends_at }}</small></p>
                    <a :href="cancellationUrl(subscription.plan)" class="btn text-danger ml-auto btn-link" v-if="!subscription.ends_at">Cancel</a>
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
        mounted() {
            axios.get('/api/subscriptions')
                .then(response => {
                    this.subscriptions = response.data.data;
                })
                .catch(error => {

                })
        },
        methods: {
            cancellationUrl(plan) {
                return "/subscriptions/" + plan.stripe_id;
            },
            resumeSubscriptionUrl(plan) {
                return "/subscriptions/" + plan.stripe_id;
            }
        }
    }
</script>
