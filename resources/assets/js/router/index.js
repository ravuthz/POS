import Vue from 'vue'
import VueRouter from 'vue-router'

import Pos from '../views/pos/index.vue'
import Stock from '../views/stock/index.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {path: '/seller', component: Pos},
        {path: '/adminz/stocks/create', component: Stock, meta: {mode: 'create'}},
    ]
})

export default router
