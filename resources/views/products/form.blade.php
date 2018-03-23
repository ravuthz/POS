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
        {!! BootForm::select('category_id', 'Category', $categories) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! BootForm::text('buy_price') !!}
    </div>
    <div class="col-md-6">
        {!! BootForm::text('sale_price') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        {!! BootForm::textarea('note') !!}
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
