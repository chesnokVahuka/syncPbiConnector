
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// components for router
import entityFields from './components/entityFields';
import ConfigMenu from './components/ConfigMenu';    
// import AppConfig from './components/AppConfig'; 
       
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/config/deals',
            name: 'deals',
            component: entityFields
        },
        // {
        //     path: '/config/appconfig',
        //     name: 'appconfig',
        //     component: AppConfig,
        // },
    ],
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('entity-fields', require('./components/entityFields.vue'));
Vue.component('config-menu', require('./components/ConfigMenu.vue'));
Vue.component('app-config', require('./components/AppConfig.vue'));


const app = new Vue({
    el: '#app',
    router,
});
