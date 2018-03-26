import Vue from 'vue';
import VueRouter from 'vue-router';
import SaleList from './components/sales/SaleList';
import StockList from './components/stocks/StockList';
import StockForm from './components/stocks/StockForm';
import StockShow from './components/stocks/StockShow';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {path: '/seller', component: SaleList},
        {path: '/seller/stocks', component: StockList},
        {path: '/seller/stocks/create', component: StockForm, meta: {mode: 'create'}},
        {path: '/seller/stocks/:id/edit', component: StockForm, meta: {mode: 'edit'}},
        {path: '/seller/stocks/:id', component: StockShow}
    ]
});

export default router;
