<x-auth-layout title="Password Reset">
    <h3 class="my-3">Enter your email to get password reset link </h3>
    <form action="{{ route('sendEmailLink') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-12">
                <div class="form-group has-feedback">
                    <label for="">Enter email</label>
                    <input type="email" class="form-control" placeholder="Email" name="email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Send Email Link</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
</x-auth-layout>
