<template></template>
<script>
    export default {
        props: ['messages'],
        data() {
            return {
            }
        },
        mounted() {
            var notyf = new Notyf();
            this.messages.forEach(function(message) {
                notyf[message.level](message.message);
            });
        }
    }
</script>
