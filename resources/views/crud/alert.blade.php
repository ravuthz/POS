@if(Session::has('success'))
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-success">
                <p>{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

@if(Session::has('warning'))
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-warning">
                <p>{{ session('warning') }}</p>
            </div>
        </div>
    </div>
@endif

@if(Session::has('danger'))
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-danger">
                <p>{{ session('danger') }}</p>
            </div>
        </div>
    </div>
@endif

@if(Session::has('info'))
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-info">
                <p>{{ session('info') }}</p>
            </div>
        </div>
    </div>
@endif