<script>
    export default {
        props: ['plans'],
        data() {
            return {
                filtered_plans: [],
                interval: 'month',
                ui: {
                    plan_selected: false
                }
            }
        },
        created() {
            bus.$on('cancel-plan', () => {
                this.ui.plan_selected = false;
            });
        },
        mounted() {
            this.filterPlans();
        },
        methods: {
            switchInterval(interval) {
                this.interval = interval;
                this.filterPlans();
            },
            filterPlans() {
              this.filtered_plans = _.filter(this.plans, {'interval': this.interval});
            },
            selectPlan(plan) {
                this.ui.plan_selected = true;
                bus.$emit('plan-selected', plan);
            }
        }
    }
</script>
