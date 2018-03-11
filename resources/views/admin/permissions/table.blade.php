<div class="row">
    <div class="col-md-5">
<<<<<<< HEAD
        <h3 class="modal-title">{{ $permission->total() }} {{ str_plural('Permission', $permission->count()) }} </h3>
=======
        <h3 class="modal-title">{{ $permissions->total() }} {{ str_plural('Permission', $permissions->count()) }} </h3>
>>>>>>> e924bb970cd7bfd1f80755a58e2ac52be68b2887
    </div>
    <div class="col-md-7 page-action text-right">
        @can('CREATE_PERMISSION')
            <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i>&nbsp&nbsp;New
            </a>
        @endcan
    </div>
</div>

<div class="result-set">
    <table class="table table-bordered table-striped table-hover crud-table" id="data-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Created At</th>

            @can('UPDATE_PERMISSION', 'DELETE_PERMISSION')
                <th class="text-center">Actions</th>
            @endcan

        </tr>
        </thead>
        <tbody>
<<<<<<< HEAD
        @foreach($permission as $item)
=======
        @foreach($permissions as $item)
>>>>>>> e924bb970cd7bfd1f80755a58e2ac52be68b2887
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->created_at->toFormattedDateString() }}</td>

                @can('UPDATE_PERMISSION', 'DELETE_PERMISSION')
                    <td class="text-center">

                        @can('UPDATE_PERMISSION')
                            <a href="{{ route($route_prefix . '.edit', $item) }}" class="btn btn-xs btn-info btn-edit-row">
                                <i class="fa fa-edit"></i>&nbsp;Modify</a>
                            </a>
                        @endcan

                        @can('DELETE_PERMISSION')
                            <a href="javascript:void(0);" class="btn btn-xs btn-danger btn-delete-row">
                                <i class="fa fa-times" aria-hidden="true"></i>&nbsp;Delete
                            </a>
                            <form method="POST" class="form-delete-row" action="{!! route($route_prefix . '.destroy', $item) !!}" accept-charset="UTF-8">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        @endcan

                    </td>
                @endcan

            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">
<<<<<<< HEAD
        {{ $permission->links() }}
=======
        {{ $permissions->links() }}
>>>>>>> e924bb970cd7bfd1f80755a58e2ac52be68b2887
    </div>
</div>