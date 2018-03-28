<template>
    <div class="container">
        <navbar></navbar>
        <div class="card">
            <div class="card-header">
                <span class="card-title">Stock Detail</span>
                <div>
                     <router-link :to="`/seller/stocks/`" class="btn btn-secondary">
                            Cancel
                    </router-link>
                    <router-link :to="`/seller/stocks/${stock.id}/edit`" class="btn btn-primary">
                            Edit
                    </router-link>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Stock Id: {{ stock.id }}</h5>
                <p class="card-text" >Movement: {{ stock.movement === 0 ? 'OUT' : 'IN'}}</p>
                <p class="card-text">Created Ad: {{ stock.created_at }}</p>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Amout</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in stock.items">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.product.name }}</td>
                            <td>{{ item.price | currency('R ') }}</td>
                            <td>{{ item.quantity }}</td>
                            <td>{{ item.quantity * item.price | currency('R ') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
    import Navbar from '../partials/navbar.vue'
    import { get } from '../../api.js'

    export default {
        components: {
            Navbar
        },
        data() {
            return {
                stock: {},
            }
        },
        created() {
            get(`/api/stocks/${this.$route.params.id}`)
                .then((res) => {
                    this.stock = res.data.data
                })
        }
    }
</script>

<style scoped>
.card-header{
    background: #fff;
}
.card-title {
    font-size: 18px;
    line-height: 24px;
}
</style>
