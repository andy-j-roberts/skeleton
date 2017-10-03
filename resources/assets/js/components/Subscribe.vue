<template>
    <div class="col-6 mx-auto my-3">
        <div class="card">
            <div class="card-header">Confirm your Subscription</div>
            <div class="card-body">
                <p class="lead">{{ plan.description }}</p>
                <table class="table">
                    <thead>
                        <th>Plan</th>
                        <th>Billing Cycle</th>
                        <th>Cost</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ plan.name }}</td>
                            <td>{{ plan.interval }}</td>
                            <td>{{ plan.amount }}</td>
                        </tr>
                    </tbody>
                </table>
                <p class="text-muted text-center mb-0">You can manage your subscriptions from your dashboard.</p>
            </div>

            <div class="card-body">
                <form action="/charge" method="post" id="payment-form" v-show="!subscribed">
                    <h2 class="mb-3">Add Payment Details</h2>
                    <div class="form-group">
                        <label for="card-element">
                            Credit or debit card
                        </label>
                        <div id="card-element">
                            <!-- a Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors -->
                        <div id="card-errors" class="text-muted" role="alert"></div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-link btn-lg" @click.prevent="cancel">Cancel</button>
                        <button class="btn btn-success btn-lg">Submit Payment</button>
                    </div>
                </form>
                <div class="text-right" v-if="subscribed">
                    <button class="btn btn-link btn-lg" @click.prevent="cancel">Cancel</button>
                    <button class="btn btn-success btn-lg" @click.prevent="changePlan(plan)">
                        <i class="fa fa-spinner fa-spin" v-if="ui.busy"></i>
                        <span v-if="!ui.busy">Change Plan</span>
                        <span v-if="ui.busy">Changing</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>
<style>
    .StripeElement {
        background-color: white;
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid #E0E0E0;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
        width: 100%;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
<script>
    export default {
        props: ['subscribed'],
        data() {
            return {
                plan: [],
                ui: {
                    busy: false
                }
            }
        },
        created() {
            bus.$on('plan-selected', plan => {
                console.log(plan);
                this.plan = plan;

            });
        },
        mounted() {
            var stripe = Stripe('pk_test_9BcKJTKJyjAD9cONUF4h3CEP');
            var elements = stripe.elements();
            var style = {
                base: {
                    color: '#32325d',
                    lineHeight: '24px',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            var card = elements.create('card', {style: style});
            card.mount('#card-element');
            card.addEventListener('change', function (event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            var form = document.getElementById('payment-form');
            form.addEventListener('submit', (event) => {
                event.preventDefault();

                stripe.createToken(card).then((result) => {
                    if (result.error) {
                        // Inform the user if there was an error
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        this.subscribe(result.token);
                    }
                });
            });
        },
        methods: {
            cancel() {
                bus.$emit('cancel-plan');
            },
            subscribe(token) {
                axios.post('/subscribe', {'stripeToken': token, 'stripe_id': this.plan.stripe_id})
                    .then(response => {

                    })
                    .catch(error => {

                    })
            },
            changePlan(plan) {
                this.ui.busy = true;
                axios.put('/api/subscription', {stripe_id: plan.stripe_id})
                    .then(response => {
                        this.ui.busy = false;
                        window.location.replace('/home');
                    })
                    .catch(error => {

                    })
            }
        }
    }
</script>
