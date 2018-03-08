<div class="row">
    <div class="col-md-6">
        {!! BootForm::text('name') !!}
    </div>
    
    <div class="col-md-6">
        {!! BootForm::text('email') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        {!! BootForm::password('password') !!}
    </div>
    
    <div class="col-md-6">
        {!! BootForm::select('roles[]', 'Roles', $roles, null, ['multiple' => true]) !!}
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @if(isset($user))
            @include('shared._permissions', ['closed' => 'true', 'model' => $user ])
        @endif
    </div>
</div>