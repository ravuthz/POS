<template>
    <div class="wrapper">
        <sidebar class="d-print-none" v-model="showSideBar"></sidebar>

        <productlist class="d-print-none" @onTopCloseClick="topCloseClick"></productlist>

        <div class="d-none d-print-block">
            <small-print class="d-none d-print-block"></small-print>
        </div>
    </div>
</template>

<script>

    export default {
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
