
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import Vue2Filters from 'vue2-filters'
import BootstrapVue from 'bootstrap-vue';

import App from './components/App.vue';
import Dashboard from './components/dashboard/Home.vue';
import ProductList from './components/products/ProductList.vue';
import ProductShow from './components/products/ProductShow.vue';

Vue.use(VueRouter);
Vue.use(Vue2Filters)
Vue.use(BootstrapVue);

Vue.component('crud-table', require('./components/core/CrudTable.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    mode: 'history',
    routes: [
      {
        name: 'dashboard.home',
        path: '/adminz/',
        component: Dashboard
      },
      {
        name: 'product.list',
        path: '/adminz/products',
        component: ProductList
      },
      {
        name: 'product.show',
        path: '/adminz/products/:id',
        component: ProductShow
      }
    ]
});

const app = new Vue({
    el: '#app',
    components: { App },
    router
});
