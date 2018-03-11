<div class="row">
    <div class="col-lg-11 col-md-10 col-sm-10">
        {!! BootForm::text('name', false, null, ['class' => 'dd', 'placeholder' => 'Search name here...']) !!}
    </div>
    <div class="col-lg-1 col-md-2 col-sm-2 text-center">
        {!! Form::submit('Search', ['class' => 'col-xs-12 btn btn-primary']) !!}
    </div>
</div>
