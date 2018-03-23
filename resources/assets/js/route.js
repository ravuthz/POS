import VueRouter from 'vue-router';
import SaleList from './components/sales/SaleList';
import StockList from './components/stocks/StockList';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {path: '/seller', component: SaleList},
        {path: '/seller/stocks', component: StockList},
        {path: '/seller/stocks/create', component: StockList, meta: {mode: 'create'}},
    ]
});

export default router;
