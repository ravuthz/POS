<template>
    <div class="container">
        <navbar></navbar>
        <form>
            <p class="h4 text-center mb-4">List Stock</p>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="stock in stocks">
                            <td>{{ stock.product_id }}</td>
                            <td>{{ stock.price }}</td>
                            <td>{{ stock.quantity }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>

</template>

<script>
    import Navbar from '../partials/navbar.vue'
    import { getAllStock } from '../../api.js'
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
            getAllStock(`/api/stocks`)
                .then((res) => {
                    this.stocks = res.data.stocks
                    console.log(this.stocks)
                })
        }
    }
</script>

<style scoped>

</style>
