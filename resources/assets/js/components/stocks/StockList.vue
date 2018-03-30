<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $t('stocks.list') }}</h3>
            <div>
                 <router-link :to=" { name: 'stocks.create' }" class="btn btn-primary">
                        {{ $t('buttons.addNew') }}
                </router-link>
            </div>

        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ $t('tables.movement') }}</th>
                        <th scope="col">{{ $t('tables.created_by') }}</th>
                        <th scope="col">{{ $t('tables.created_at') }}</th>
                        <th scope="col">{{ $t('tables.updated_by') }}</th>
                        <th scope="col">{{ $t('tables.updated_at') }}</th>
                        <th scope="col">{{ $t('tables.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(stock, index) in stocks">
                        <td>{{ index + 1 }}</td>
                        <td v-if="stock.movement === 0">{{ $t('tables.out') }}</td>
                        <td v-else>{{ $t('tables.in') }}</td>
                        <td>{{ stock.created_by }}</td>
                        <td>{{ stock.created_at }}</td>
                        <td>{{ stock.updated_by }}</td>
                        <td>{{ stock.updated_at }}</td>
                        <td>
                            <router-link :to="{ name: 'stocks.show', params: {id: stock.id} }" class="btn btn-info">
                                {{ $t('buttons.detail') }}
                            </router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <div>
                <b-pagination size="md" @change="changePage" :total-rows="totalRows" :per-page="perPage"></b-pagination>
            </div>
    </div>
</template>

<script>
    import { get } from '../../api.js'
    export default {
        fields: [ 'first_name', 'last_name', 'age' ],
        data() {
            return {
                stocks: [],
                perPage: 10,
                totalRows: null,
            }
        },
        beforeCreate() {
            get(`/api/stocks`)
                .then((res) => {
                    this.stocks = res.data.data
                    this.totalRows = res.data.meta.total
                })
        },
        methods: {
            changePage(pageNum, productName) {
                get(`/api/stocks?page=${pageNum}`)
                .then((res) => {
                    this.stocks = res.data.data
                    this.totalRows = res.data.meta.total
                })
            },
        }
    }
</script>

<style scoped>
</style>
