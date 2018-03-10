<template>
    <div>
        <b-row>
            <b-col md="6">
                <b-form-group horizontal label="Filter">
                    <b-input-group>
                        <b-form-input v-model="filter" placeholder="Type to Search"/>
                        <b-btn :disabled="!filter" @click="filter = ''">
                            Clear
                        </b-btn>
                    </b-input-group>
                </b-form-group>
            </b-col>

            <b-col md="6">
                <b-form-group horizontal label="Sort">
                    <b-input-group>
                        <b-form-select v-model="sortBy" :options="sortOptions">
                            <option slot="first" :value="null">-- none --</option>
                        </b-form-select>
                        <b-form-select :disabled="!sortBy" v-model="sortDesc">
                            <option :value="false">Asc</option>
                            <option :value="true">Desc</option>
                        </b-form-select>
                    </b-input-group>
                </b-form-group>
            </b-col>
        </b-row>

        <b-table show-empty
            stacked="md"
            :items="items"
            :fields="fields"
            :filter="filter"
            :per-page="perPage"
            :current-page="currentPage">

            <template slot="actions" slot-scope="row">
                <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
                <b-button size="sm" @click.stop="info(row.item, row.index, $event.target)">
                    Info modal
                </b-button>
                <b-button size="sm" @click.stop="row.toggleDetails">
                    {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
                </b-button>
            </template>

            <template slot="row-details" slot-scope="row">
                <b-card>
                    <ul>
                        <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value}}</li>
                    </ul>
                </b-card>
            </template>

        </b-table>

        <b-row>
            <b-col md="6" class="my-1">
                <b-pagination :total-rows="getTotalRows" :per-page="getPerPage" v-model="currentPage" />
            </b-col>

            <b-col md="6" class="my-1">
                <b-form-group horizontal label="Per page">
                    <b-form-select :options="pageOptions" v-model="perPage" />
                </b-form-group>
            </b-col>
        </b-row>

        <!-- Info modal -->
        <b-modal id="modalInfo" @hide="resetModal" :title="modalInfo.title" ok-only>
            <pre>{{ modalInfo.content }}</pre>
        </b-modal>

    </div>

</template>

<script>
    export default {
        props: ['items', 'fields', 'totalRows', 'currentPage'],
        data() {
            return {
                filter: null,
                sortBy: null,
                sortDesc: false,

                perPage: 5,
                pageOptions: [5, 10, 15, 20, 25],

                modalInfo: {
                    title: '',
                    content: ''
                }
            }
        },
        created() {
            console.log("CrudTable initialize");
        },
        computed: {
            sortOptions() {
                // Create an options list from our fields
                return this.fields.filter(f => f.sortable).map(f => {
                    return {
                        text: f.label,
                        value: f.key
                    }
                })
            },
            getPerPage() {
                return this.perPage || 5;
            },
            getTotalRows() {
                return this.totalRows || this.items.length;
            }
        },
        methods: {
            info(item, index, button) {
                this.modalInfo.title = `Row index: ${index}`
                this.modalInfo.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', 'modalInfo', button)
            },
            resetModal() {
                this.modalInfo.title = ''
                this.modalInfo.content = ''
            }
        }
    }
</script>
