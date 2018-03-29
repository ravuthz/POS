<template>
    <div class="div">
        <navbar></navbar>
        <div class="container-fluid">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Navbar from '../partials/navbar.vue'

    export default {
        name: "main-layout",
        components: {Navbar}
    }
</script>

<style scoped>

</style>