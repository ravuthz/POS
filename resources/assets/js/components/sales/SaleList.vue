<template>
    <div class="wrapper">
        <sidebar class="d-print-none" v-model="showSideBar"></sidebar>

        <productlist class="d-print-none" @onTopCloseClick="topCloseClick"></productlist>

        <div class="d-none d-print-block">
            <print class="d-none d-print-block"></print>
        </div>
    </div>
</template>
<script type="text/javascript">
    import Sidebar from '../../components/products/Sidebar.vue'
    import Productlist from '../../components/products/Productlist.vue'
    import Print from '../../components/products/Print.vue'
    export default {
        components: {
            Sidebar,
            Productlist,
            Print
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