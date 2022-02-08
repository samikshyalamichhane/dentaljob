<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name ?? old('name') }}"
                placeholder="Enter full name">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email ?? old('email') }}"
                placeholder="Enter email">
        </div>

        <div class="form-group">
            <label>Password</label>
            <div class="d-flex">
                <input type="password" class="form-control show__password" name="password" value="{{ old('password') }}"
                    placeholder="Enter Password">
                <i class="fa fa-eye show__eye"></i>
            </div>
        </div>

        <div class="form-group">
            <label>Re-Password</label>
            <div class="d-flex">
                <input type="password" class="form-control show__password" name="password_confirmation"
                    value="{{ old('password_confirmation') }}" placeholder="Enter Password">
                <i class="fa fa-eye show__eye"></i>
            </div>
        </div>

        <div class="form-group">
            <label> Select Role</label>
            <select name="role" class="form-control">
                <option value>--Please Select Role</option>
                @foreach ($dashboard_roles as $role)
                    <option @isset($user->role)
                            {{ $user->role == $role ? 'selected' : null }}
                        @endisset
                        value="{{ $role }}">{{ ucfirst($role) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="check-list">
            <label class="ui-checkbox ui-checkbox-primary">
                <input name="publish" type="checkbox" checked>
                <span class="input-span"></span>Publish</label>
        </div>
    </div>
</div>
