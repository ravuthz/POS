<div class="row">
    @foreach($permissions as $permission)
        <?php
        $per_found = null;

        if (isset($role)) {
            $per_found = $role->hasPermissionTo($permission->name);
        }

        if (isset($user)) {
            $per_found = $user->hasDirectPermission($permission->name);
        }
        ?>

        <div class="col-md-3">
            <div class="checkbox">
                <label class="{{ str_contains($permission->name, 'delete') ? 'text-danger' : '' }}">
                    {!! Form::checkbox("permissions[]", $permission->name, $per_found, isset($options) ? $options : []) !!} {{ $permission->name }}
                </label>
            </div>
        </div>
    @endforeach
</div>