/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vuex = require('vuex');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('password-meter', require('./components/PasswordMeter.vue'));
Vue.component('example', require('./components/Example.vue'));
Vue.component('announcements', require('./components/Announcements.vue'));
Vue.component('announcement', require('./components/Announcement.vue'));
Vue.component('notification', require('./components/Notification.vue'));

Vue.component('subscription-plans', require('./components/SubscriptionPlans.vue'));
Vue.component('subscribe', require('./components/Subscribe.vue'));
Vue.component('subscriptions', require('./components/Subscriptions.vue'));

Vue.component('card-details', require('./components/CardDetails.vue'));

window.bus = new Vue();

App.store = new Vuex.Store({
    state: {
        user: [],
    },
    mutations: {
        user(state, user) {
            state.user = user;
        }
    }
})

const app = new Vue({
    el: '#app',
    mounted() {
        if(App.user == true) {
            this.getUser();
        }
    },
    methods: {
        getUser() {
            axios.get('/api/user')
                .then(response => {
                    App.store.commit('user', response.data);
                    bus.$emit('userRetrieved', response.data);
                })
        }
    }
});
