<template>
    <div class="container">
        <navbar></navbar>
        <form>
            <p class="h4 text-center mb-4">List Stock</p>
            <div>
                <button class="btn" >Create</button>
            </div>
            <div class="row">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Movement</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Updated By</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(stock, index) in stocks">
                            <td>{{ index + 1 }}</td>
                            <td v-if="stock.movement === 0">OUT</td>
                            <td v-else>IN</td>
                            <td>{{ stock.created_by }}</td>
                            <td>{{ stock.created_at }}</td>
                            <td>{{ stock.updated_by }}</td>
                            <td>{{ stock.updated_at }}</td>
                            <td>
                                <router-link :to="`/seller/stocks/${stock.id}`" class="btn btn-info">
                                    Detail
                                </router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>

</template>

<script>
    import Navbar from '../partials/navbar.vue'
    import { getStock } from '../../api.js'
    export default {
        components: {
            Navbar
        },
        fields: [ 'first_name', 'last_name', 'age' ],
        data() {
            return {
                stocks: []
            }
        },
        created() {
            getStock(`/api/stocks`)
                .then((res) => {
                    this.stocks = res.data.data

                })
        }
    }
</script>

<style scoped>

</style>
