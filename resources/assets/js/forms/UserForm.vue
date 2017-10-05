<script>
    export default {
        props: ['user'],
        data() {
            return {
                form: new Form({
                    name: '',
                    email: '',
                })
            }
        },
        mounted() {
            this.form.name = this.user.name;
            this.form.email = this.user.email;
        },
        methods: {
            submit() {
                this.form.put(`/api/users/${this.user.id}`)
                    .then(response => {
                        bus.$emit('confirm', response.message);
                    })
                    .catch(error => {
                        bus.$emit('alert', this.form.errors.message);
                    })
            }
        }
    }
</script>
