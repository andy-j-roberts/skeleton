<template>
    <div class="col my-3">
        <div class="card card-border">
            <div class="card-body">
                <h4 class="mb-3">Update Card Details</h4>
                <p>xxxx-xxxx-xxxx-4242</p>
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
            }
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
