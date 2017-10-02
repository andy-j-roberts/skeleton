<template></template>
<script>
    export default {
        props: ['messages'],
        data() {
            return {
            }
        },
        created() {
          bus.$on('confirm', message => {
              var notyf = new Notyf();
              notyf.confirm(message);
          });
            bus.$on('alert', message => {
                var notyf = new Notyf();
                notyf.alert(message);
            });
        },
        mounted() {
            var notyf = new Notyf();
            this.messages.forEach(function(message) {
                notyf[message.level](message.message);
            });
        }
    }
</script>
