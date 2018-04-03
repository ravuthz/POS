<template>
    <div class="div">
        <b-card :title="$t('orders.list')" tag="article" header-tag="h3">
            <div class="card-text">
                <b-row>
                    <b-col lg="2" md="3" xs="6">
                        <b-button variant="primary">{{ $t('buttons.addNew') }}</b-button>
                    </b-col>
                    <b-col offset-lg="6" lg="4" offset-md="4" md="5" xs="12">
                        <search-bar
                                :keyword="filter"
                                @onClear="filter = ''"
                                @onSearch="onSearch">
                        </search-bar>
                    </b-col>
                </b-row>
                <b-table show-empty
                         stacked="md"
                         :items="dataProvider"
                         :fields="fields"
                         :filter="filter"
                         :busy.sync="loading"
                         :per-page="perPage"
                         :current-page="currentPage"
                >
                    <template slot="type" slot-scope="data">
                        {{ orderTypes[data.value] }}
                    </template>
                    <template slot="actions" slot-scope="data">
                        <router-link :to="{ name: 'orders.show', params: {id: data.item.id} }" class="btn btn-info">
                            {{ $t('buttons.detail') }}
                        </router-link>
                        <router-link :to="{ name: 'orders.update', params: {id: data.item.id} }"
                                     class="btn btn-success">
                            {{ $t('buttons.modify') }}
                        </router-link>
                        <b-button variant="danger">
                            {{ $t('buttons.delete') }}
                        </b-button>
                    </template>
                </b-table>
                <b-row v-if="orders.length > 0">
                    <b-col lg="3" md="6" xs="12">
                        <b-pagination :total-rows="totalRows" :per-page="getPerPage" v-model="currentPage" />
                    </b-col>
                    <b-col offset-lg="6" lg="3" offset-md="3" md="6" xs="12">
                        <b-form-group horizontal :label="$t('labels.perPage')">
                            <b-form-select :options="pageOptions" v-model="perPage"/>
                        </b-form-group>
                    </b-col>
                </b-row>
            </div>
        </b-card>
    </div>
</template>

<script>
    import SearchBar from '../core/SearchBar';
    import CrudTable from '../core/CrudTable';
    import {getAllOrders, getOrderTypes} from '../../api.js'

    export default {
        name: "order-list",
        components: {
            SearchBar,
            CrudTable,
        },
        data() {
            return {
                loading: false,
                errors: [],
                orders: [],
                fields: [
                    {key: 'id', label: '#', sortable: true},
                    {key: 'type', label: 'Type', sortable: true},
                    {key: 'no_of_items', label: 'No of Products', sortable: false},
                    {key: 'created_by', label: 'Created By', sortable: true},
                    {key: 'created_at', label: 'Created At', sortable: true},
                    {key: 'actions', label: 'Actions', sortable: false}
                ],
                orderTypes: [],
                perPage: 5,
                totalRows: 12,
                currentPage: 1,
                pageOptions: [5, 10, 15, 20],
                filter: null,
            }
        },
        computed: {
            getPerPage() {
                this.currentPage = 1;
                return this.perPage;
            },
        },
        beforeCreate() {
            getOrderTypes().then(res => this.orderTypes = res.data.data);
        },
        methods: {
            dataProvider(ctx) {
                const params = {
                    page: this.filter ? 1 : ctx.currentPage,
                    size: ctx.perPage,
                    sort: ctx.sortBy,
                    desc: ctx.sortDesc,
                    filter: this.filter
                };
                this.loading = true;
                return getAllOrders(params).then(res => {
                    console.log("getAllOrders(res): ", res.data);
                    this.orders = res.data.data;
                    this.totalRows = res.data.meta.total;
                    this.loading = false;
                    return this.orders;
                }).catch(err => {
                    console.log("getAllOrders(err): ", err.data);
                    this.loading = false;
                    this.errors = err;
                    return [];
                });
            },
            onSearch(text) {
                this.filter = text;
            }
        }
    }
</script>

<style scoped>

</style>