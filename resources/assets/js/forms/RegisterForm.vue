<script>
    export default {
        data() {
            return {
                form: new Form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                })
            }
        },
        watch: {
            'form.password': function (val) {
                bus.$emit('passwordEntered', val); //just to active password strength meter
            }
        },
        methods: {
            submit() {
                this.form.post('/api/register')
                    .then(response => {
                        window.location.replace('/home');
                    })
                    .catch(error => {
                        bus.$emit('alert', this.form.errors.message)
                    })
            }
        }
    }
</script>
