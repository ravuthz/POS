<template>
    <div class="container">
        <div class="row text-center text-lg-left">
            <div class="col-md-11">

                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <figure class="figure">
                            <img src="https://lorempixel.com/270/270/?9" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                            <figcaption class="figure-caption">A caption for the above image.</figcaption>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-md-1" >
                <a href="#" id="sidebar" data-toggle="popover" data-trigger="focus"><<</a>
            </div>
        </div>
    </div>


</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
