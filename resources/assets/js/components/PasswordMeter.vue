<template>
    <div class="mb-5">
        <input type="password" v-model="password">
        <label>Password Strength</label>
        <p class="mb-0"><small>{{ indicators[passwordStrength] }}</small></p>
        <div class="progress">
            <div class="progress-bar" role="progressbar" :data-score="passwordStrength" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>

</template>
<style>
    .progress {
        height: 5px;
    }
    .progress-bar {
        transition: all 0.3s linear;
    }
    .progress-bar[data-score='0'] {
        background: #FF0074;
        width: 20%;
    }
    .progress-bar[data-score='1'] {
        background: orangered;
        width: 40%;
    }
    .progress-bar[data-score='2'] {
        background: orange;
        width: 60%;
    }
    .progress-bar[data-score='3'] {
        background: yellowgreen;
        width: 80%;
    }
    .progress-bar[data-score='4'] {
        background: green;
        width: 100%;
    }
    </style>
<script>
    export default {
        props: [''],
        data() {
            return {
                password: '',
                indicators: {
                    0: 'weak',
                    1: 'weaker',
                    2: 'ok',
                    3: 'strong',
                    4: 'very strong'
                }
            }
        },
        watch: {
            password: function (val) {
                this.password = val
            },
        },
        computed: {
            passwordStrength()
            {
                return this.password ? zxcvbn(this.password).score : null
            }
        },
        created() {
        },
        mounted() {
        },
        methods: {
        }
    }
</script>
