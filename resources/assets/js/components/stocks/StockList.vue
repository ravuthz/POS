<template>
    <div class="container">
        <navbar></navbar>
        <form>
            <p class="h4 text-center mb-4">List Stock</p>

        </form>
    </div>

</template>

<script>
    import Navbar from '../partials/navbar.vue'
    export default {
        components: {
            Navbar
        },
        name: "stock-list"
    }
</script>

<style scoped>

</style>
