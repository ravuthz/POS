import VueRouter from 'vue-router';
import SaleList from './components/sales/SaleList';
import StockList from './components/stocks/StockList';
import StockForm from './components/stocks/StockForm';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {path: '/seller', component: SaleList},
        {path: '/seller/stocks', component: StockList},
        {path: '/seller/stocks/create', component: StockForm, meta: {mode: 'create'}},
    ]
});

export default router;
