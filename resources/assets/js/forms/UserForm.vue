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
                this.form.post(`/users/${this.user.id}`)
                    .then(response => {

                    })
                    .catch(error => {
                        bus.$emit('alert', this.form.errors.message);
                    })
            }
        }
    }
</script>
