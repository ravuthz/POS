<template>
    <div class="div">
        <navbar></navbar>
        <div class="container-fluid">
            <div class="falert alert-success" v-if="flash.success">
                {{ flash.success }}
            </div>
            <div class="alert alert-danger" v-if="flash.error">
                {{ flash.error }}
            </div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Navbar from '../partials/navbar.vue'
    import Flash from '../../helpers/flash'

    export default {
        name: "main-layout",
        components: {Navbar},
        data() {
            return {
                flash: Flash.state
            }
        }
    }
</script>

<style scoped>

</style>
