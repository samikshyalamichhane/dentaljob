<x-auth-layout title="Password Reset">

    <form action="{{ route('updatePassword') }}" method="post" id="editor">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Email(required)</label>
            <input type="text" name="email" class="form-control" value="{{ $data->email }}">
        </div>
        <div class="form-group">
            <label>Password(required)</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block btn-flat" type="submit">Submit</button>
        </div>
    </form>
</x-auth-layout>
