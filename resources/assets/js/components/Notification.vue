<template></template>
<style>
</style>
<script>
    export default {
        props: ['messages'],
        data() {
            return {
                notyf: new Notyf()
            }
        },
        created() {
            bus.$on('confirm', message => {
                this.notyf.confirm(message);
            });
            bus.$on('alert', message => {
                this.notyf.alert(message);
            });
        },
        mounted() {
            this.messages.forEach((message) => {
                this.notyf[message.level](message.message);
            });
        }
    }
</script>
