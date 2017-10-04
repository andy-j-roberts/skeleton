<template>
    <div class="mb-5">
        <label>Password Strength</label>
        <p class="mb-0 password-strength" :data-score="passwordStrength"><small>{{ indicators[passwordStrength] }}</small></p>
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
    .password-strength { transition: 0.3s all linear; }
    .password-strength[data-score='0']{ color:#FF0074; }
    .password-strength[data-score='1']{ color:orangered; }
    .password-strength[data-score='2']{ color:orange; }
    .password-strength[data-score='3']{ color:yellowgreen; }
    .password-strength[data-score='4']{ color:green; }
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
        created() {
            bus.$on('passwordEntered', (value) => {
                this.password = value;
            })
        },
        computed: {
            passwordStrength() {
                return this.password ? zxcvbn(this.password).score : null
            }
        },
        mounted() {
        },
        methods: {
        }
    }
</script>
