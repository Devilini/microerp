/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import router from "./router";
import Transport from './components/Transport';
import {Form, HasError, AlertError, AlertErrors} from 'vform';
import Swal from 'sweetalert2';

window.swal = Swal;

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3500,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer);
        toast.addEventListener('mouseleave', swal.resumeTimer);
    }
});

window.toast = toast;
window.Form = Form;

Vue.component('Transport', Transport);
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component(AlertErrors.name, AlertErrors);

const app = new Vue({
    router,
}).$mount('#app');
