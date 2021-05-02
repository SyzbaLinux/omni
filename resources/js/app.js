require('./bootstrap');
import Vue from 'vue'
import store from './store/index'
import router from './router'
import Router from './Router.vue'
import Vuetify from 'vuetify'
import http from "./http";

require('./store/subscriber')
Vue.use(Vuetify)

import VImageInput from 'vuetify-image-input';
Vue.component(VImageInput.name, VImageInput);

import { Form } from 'vform'
window.Form = Form;

import colors from 'vuetify/lib/util/colors'

store.dispatch('auth/attempt', localStorage.getItem('token')).then((res)=>{
    new Vue({
        store,
        router,
        http,
        render: h => h(Router),
        vuetify: new Vuetify(),
    }).$mount('#app')
})
