<template>
    <div class="col my-3">
        <div class="card card-border">
            <div class="card-body">
                <h4 class="mb-3">Update Card Details</h4>
                <h2 class="mb-3 text-muted"><span class="card-brand">{{ this.card.brand }}</span> <span class="card-blanks">**** **** ****</span> {{ this.card.last_four }}</h2>
                <form action="/charge" method="post" id="payment-form">
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
                        <button class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>
<style>
    .card-brand {
        background: #22206A;
        border-radius: 5px;
        color: white;
        font-size: 12px;
        font-weight: bolder;
        padding: 8px;
        text-transform: uppercase;
        vertical-align: middle;
    }
    .card-blanks {
        vertical-align: middle;
    }
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
        data() {
            return {
                card: {
                    brand: '',
                    last_four: ''
                }
            }
        },
        mounted() {
            axios.get('/api/card-details')
                .then(response => {
                    console.log(response);
                    this.card.brand = response.data.card_brand;
                    this.card.last_four = response.data.card_last_four;
                })
                .catch(error => {

                })
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
                        this.update(result.token);
                    }
                });
            });
        },
        methods: {
            update(token) {
                axios.put('/card-details', {'stripeToken': token})
                    .then(response => {

                    })
                    .catch(error => {

                    })
            }
        }
    }
</script>
