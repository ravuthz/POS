<template>
    <div class="wrapper">
        <sale-side-bar class="d-print-none" v-model="showSideBar"></sale-side-bar>
        <sale-product-list class="d-print-none" @onTopCloseClick="topCloseClick"></sale-product-list>
        <div class="d-none d-print-block">
            <sale-print class="d-none d-print-block"></sale-print>
        </div>
    </div>
</template>
<script type="text/javascript">
    import SalePrint from './SalePrint';
    import SaleSideBar from './SaleSideBar';
    import SaleProductList from './SaleProductList';

    export default {
        components: {
            SalePrint,
            SaleSideBar,
            SaleProductList
        },
        data() {
            return {
                showSideBar: false
            }
        },
        methods: {
            topCloseClick(event) {
                this.showSideBar = event;
            }
        }
    }

</script>