@extends('adminlte::page')

@section('title', $site_title)

@section('content_header')
    <h1>{{ $page_title }}</h1>
@stop

@section('content')

    @include('crud.alert')

    <div class="row">
        <div class="col-lg-12">
            @if (view()->exists($view_include_form))
                <div class="panel panel-default">
                    <div class="panel-body">
                        @php $form_model = $__data[$item_name] @endphp
                        {!! BootForm::open([
                            'files' => true,
                            'model' => $form_model,
                            'store' => $route_prefix . '.store',
                            'update' => $route_prefix . '.update'
                        ]) !!}
                            @include($view_include_form)
                            <button class="btn btn-primary" type="submit">
                                <i class="glyphicon glyphicon-floppy-saved"></i>&nbsp;&nbsp;Update
                            </button>
                            <a href="{{ route($route_prefix . '.index') }}" class="btn btn-default pull-right">
                                <i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back
                            </a>
                        {!! BootForm::close() !!}
                    </div>
                </div>
            @else
                <div class="alert alert-danger">
                    <p>No views <strong>form.blade.php</strong> found in <strong>views.{{ $view_prefix }}</strong></p>
                </div>
            @endif
        </div>
    </div>
    
@stop