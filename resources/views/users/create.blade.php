@extends('adminlte::page')

@section('title', 'Create User')

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Create User</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('users.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i>
                Back</a>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            {!! Form::open(['route' => ['users.store'] ]) !!}
                @include('users._form')    
            {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
      
        </div>
    </div>
    
@endsection