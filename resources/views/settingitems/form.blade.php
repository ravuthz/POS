<div class="row">
    <div class="col-md-6">
        {!! BootForm::select('setting_type_id', 'Parent', $setting_type) !!}
    </div>

    <div class="col-md-6">
        {!! BootForm::text('setting_type_model') !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! BootForm::text('name') !!}
    </div>
    <div class="col-md-6">
        {!! BootForm::text('name_kh') !!}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        {!! BootForm::text('value') !!}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        {!! BootForm::textarea('note') !!}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        {!! link_to_route($route_prefix . '.index', 'Back to list', [], ['class' => 'btn btn-default']) !!}
        {!! Form::submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
    </div>
</div>
