<div class="row">
    <div class="col-md-6">
        {!! BootForm::text('name') !!}
    </div>
    <div class="col-md-6">
        {!! BootForm::text('name_kh') !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! BootForm::select('parent_id', 'Parent', $parent_lists) !!}
    </div>
</div>

<div class="row">
    @if (optional($form_model)->image)
        <div class="col-lg-6 col-md-4 col-xs-12">
            <img src="{{ asset('uploads/'. optional($form_model)->image) }}" class="img-fluid img-thumbnail" alt="Responsive image">
        </div>
    @endif
</div>
<div class="row">
    <div class="col-md-12">
        {!! BootForm::file('image') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        {!! link_to_route($route_prefix . '.index', 'Back to list', [], ['class' => 'btn btn-default']) !!}
        {!! Form::submit('Submit', ['class' => 'btn btn-primary pull-right']) !!}
    </div>
</div>
