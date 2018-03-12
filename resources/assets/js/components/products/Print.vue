<template>
    <div>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" screen="print">

</div>
</template>

<script>

    // require('../../../../../node_modules/bootstrap-sass/assets/stylesheets/_bootstrap.scss')

    export default{
        props: {
            items:{
                type: Array
            },
            total: {
                type: Number
            }
        },
        methods: {
            createSaleProduct() {
                var printContents = document.getElementById("printPlace").innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
                /*let data = {
                    items: this.items,
                    total: this.total
                };

                axios.post('/api/sales', data).then(res => {
                    console.log("Order: ", res.data);
                });*/
                this.clearSaleProduct();
                window.location.href = "/seller";
                // this.setStorage('items', []);
                // this.items = [];
            },
            clearSaleProduct: function() {
                this.$store.dispatch('clearAllItems');
            }
        }
    }

</script>

<style type="text/css">

    @import url(http://fonts.googleapis.com/css?family=Bree+Serif);

    /*
        Roll Paper => 80 x 297 mm

        @page {
            size: A4;
            size: A4 landscape;
            margin: 20;
        }

    */

    @media print {
        @page {
            size: 80mm 297mm;
            margin: 3mm;
        }
    }

    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Bree Serif', serif;
    }

    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td,
    .table>thead>tr>th {
        padding: 0;
    }

    .table-borderless>tbody>tr>td {
        border-top: 0;
    }

    .border-top {
        border-top: 1px solid #dddddd !important;
    }

    .border-bottom {
        border-bottom: 1px solid #dddddd !important;
    }

    .border-left1 {
        padding-left: 6px !important;
        border-left: 1px solid #dddddd !important;
    }

    .border-right1 {
        padding-right: 6px !important;
        border-right: 1px solid #dddddd !important;
    }

    .big-line {
        border-top: 2px solid #dddddd !important;
        border-bottom: 0px;
    }

    .khmer {
        font-family: 'Khmer OS Battambang', 'Battambang ';
    }
</style>
