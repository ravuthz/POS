@extends('adminlte::page')

@section('title', 'Edit User ' . $user->first_name)

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Edit {{ $user->first_name }}</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('users.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i>
                Back</a>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            
            {!! Form::model($user, ['method' => 'PUT', 'route' => ['users.update',  $user->id ] ]) !!}
            @include('users._form')
                    <!-- Submit Form Button -->
            {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}

        </div>
    </div>
    
@endsection