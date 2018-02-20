<div class="row">
    <div class="col-md-6">
        {!! BootForm::text('type_id') !!}
    </div>

    <div class="col-md-6">
        {!! BootForm::text('type_model') !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! BootForm::text('name_en') !!}
    </div>
    <div class="col-md-6">
        {!! BootForm::text('name_kh') !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! BootForm::text('slug') !!}
    </div>
    <div class="col-md-6">
        {!! BootForm::text('value') !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! BootForm::text('note') !!}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        {!! link_to_route($route_prefix . '.index', 'Back to list', [], ['class' => 'btn btn-default']) !!}
        {!! Form::submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
    </div>
</div>