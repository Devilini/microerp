import Vue from "vue";
import Router from "vue-router";
import TransportView from '../components/TransportView.vue';
import TransportForm from '../components/TransportForm.vue';
import Developer from '../components/Developer.vue';
Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/transport',
            component: TransportView
        },
        {
            path: '/transport/create',
            component: TransportForm
        },
        {
            path: '/transport/edit/:id',
            component: TransportForm,
            name: 'edit'
        },
        {
            path: '/developer',
            component: Developer
        }
    ]
});
