<template>
    <div :class="[isOpen ? 'typeahead typeahead-open' : 'typeahead']">
        <div class="form-group">
            <input class="form-control" :tabindex="tabindex" ref="toggle" @click="onToggle" @keydown="onKey" v-model="selectedText">
            <div class="dropdown show typeahead-dropdown" v-if="isOpen">
                <div class="typeahead-input_wrap">
                <input type="text" class="typeahead-input" autocomplete="off" placeholder="Search..." id="dropdownMenuLink" data-toggle="dropdown"
                    ref="search"
                    @blur="onBlur"
                    @input="onSearch"
                    @keydown.esc="onEsc"
                    @keydown.up="onUpkey"
                    @keydown.down="onDownkey"
                    @keydown.enter="onEnterKey"
                >
                </div>
                <div aria-labelledby="dropdownMenuLink" v-if="results.length">
                        <li class="dropdown-item" v-for="(result, index) in results" :key="result.id"
                            @mousedown.prevent="select(result)"
                            @mouseover.prevent="onMouse(index)">
                            {{ result.name }}
                        </li>
                </div>
            </div>
        </div>
    </div>

</template>
<script type="text/javascript">
    import Vue from 'vue'
    import { getAllProducts } from '../../api'

    export default {
        props: {
            initialize: {
                default: null
            },
            url: {
                required: true
            },
            tabindex: {
                default: 0
            }
        },
        data() {
            return {
                selectIndex: -1,
                isOpen: false,
                search: '',
                results: []
            }
        },
        computed: {
            selectedText() {
                return this.initialize ? this.initialize.name_kh : 'Type or click to select'
            }
        },
        methods: {
            onToggle() {
                if(this.isOpen) {
                    this.isOpen = false
                }else {
                    this.open()
                }
            },
            onKey(e) {
                const KeyCode = e.KeyCode || e.which
                if(e.shiftKey && KeyCode !== 9 && !this.isOpen){
                    this.open()
                }
            },
            open() {
                this.fetchData('')
                this.isOpen = true
                this.$nextTick(() => {
                    this.$refs.search.focus()
                })
            },
            fetchData(q) {
                getAllProducts({filter: q})
                    .then((res) => {
                        Vue.set(this.$data, 'results', res.data.data)
                    })
            },
            onBlur() {
                this.close()
            },
            onEsc() {
                this.close()
            },
            close() {
                this.results = []
                this.isOpen = false
                this.search = ''
                this.selectIndex = -1
            },
            onSearch(e) {
                const q = e.target.value
                this.selectIndex = 0
                this.fetchData(q)
            },
            onUpkey(e) {
                if(this.selectIndex > 0) {
                    this.selectIndex--
                }
            },
            onDownkey(e) {
                if(this.results.length - 1 > this.selectIndex) {
                    this.selectIndex++
                }
            },
            onDownkey(e) {
                if(this.results.length -1 > this.selectIndex) {
                    this.selectIndex++
                }
            },
            onEnterKey() {
                const found = this.results[this.selectIndex]
                if(found) {
                    this.select(found)
                }
            },
            select(results) {
                this.$emit('input', {
                    target: {
                        value: results
                    }
                })
                this.close()
            },
            onMouse(index) {
                this.selectIndex = index
            }
        }
    }
</script>
