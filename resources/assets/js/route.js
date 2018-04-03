import Vue from 'vue';
import VueRouter from 'vue-router';
import SaleList from './components/sales/SaleList';

import MainLayout from './components/layouts/MainLayout';

import OrderForm from './components/orders/OrderForm';
import OrderShow from './components/orders/OrderShow';
import OrderList from './components/orders/OrderList';

import StockShow from './components/stocks/StockShow';
import StockForm from './components/stocks/StockForm';
import StockList from './components/stocks/StockList';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    base: '/seller',
    routes: [
        {path: '/', component: SaleList},

        {
            path: '/orders',
            component: MainLayout,
            children: [
                {name: 'orders.list', path: '', component: OrderList},
                {name: 'orders.create', path: 'create', component: OrderForm, meta: { mode: 'create'}},
                {name: 'orders.update', path: ':id/edit', component: OrderForm, meta: { mode: 'update'}},
                {name: 'orders.show', path: ':id', component: OrderShow},
            ]

        },

        {
            path: '/stocks',
            component: MainLayout,
            children: [
                {name: 'stocks.list', path: '/', component: StockList},
                {name: 'stocks.create', path: '/stocks/create', component: StockForm, meta: {mode: 'create'}},
                {name: 'stocks.show', path: '/stocks/:id', component: StockShow},
                {name: 'stocks.edit', path: '/stocks/:id/edit', component: StockForm, meta: {mode: 'edit'}}
            ]
        },


    ]
});

export default router;
