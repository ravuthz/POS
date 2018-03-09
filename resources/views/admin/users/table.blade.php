<div class="row">
    <div class="col-md-5">
        <h3 class="modal-title">{{ $users->total() }} {{ str_plural('User', $users->count()) }} </h3>
    </div>
    <div class="col-md-7 page-action text-right">
        @can('CREATE_USER')
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
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
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>

            @can('UPDATE_USER', 'DELETE_USER')
                <th class="text-center">Actions</th>
            @endcan

        </tr>
        </thead>
        <tbody>
        @foreach($users as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->roles->implode('name', ', ') }}</td>
                <td>{{ $item->created_at->toFormattedDateString() }}</td>

                @can('UPDATE_USER', 'DELETE_USER')
                    <td class="text-center">

                        @can('UPDATE_USER')
                            <a href="{{ route($route_prefix . '.edit', $item) }}" class="btn btn-xs btn-info btn-edit-row">
                                <i class="fa fa-edit"></i>&nbsp;Modify</a>
                            </a>
                        @endcan

                        @can('DELETE_USER')
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
        {{ $users->links() }}
    </div>
</div>