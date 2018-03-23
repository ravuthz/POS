<div class="row">
    <div class="col-md-6">
        {!! BootForm::select('product_id', 'Product', $products) !!}
    </div>

    <div class="col-md-6">
        {!! BootForm::text('quantity') !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! BootForm::text('type') !!}
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        {!! link_to_route($route_prefix . '.index', 'Back to list', [], ['class' => 'btn btn-default']) !!}
        {!! Form::submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
    </div>
</div>
