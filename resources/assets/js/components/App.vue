<template>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <sidebar></sidebar>

        <!-- Page Content Holder -->
        <productlist></productlist>
    </div>
</template>

<script>

    export default{
       //
    }

</script>

<style type="text/css">
    .card{
        cursor:pointer;
        padding: 15px;
        margin: 15px 0px;
    }
    .badge{
        background-color: white;
        position: absolute;
        right: 5px;
        color: red;
        font-size: 14px;
    }
    .navbar{
        background: #e5e5e5;
    }
</style>
