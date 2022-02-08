<x-auth-layout title="Admin Login">

    <form id="login-form" action="{{ route('admin.postLogin') }}" method="POST">
        @csrf
        <h2 class="login-title">Log in</h2>
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-envelope"></i></div>
                <input class="form-control" type="email" name="email" placeholder="Email" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="d-flex">
                    <input type="password" class="form-control show__password" name="password" placeholder="Password">
                    <i class="fa fa-eye show__eye"></i>
                </div>
            </div>
        </div>

        <div class="form-group text-center">
            <button class="btn btn-info btn-block mb-4" type="submit">Login</button>

            <a href="{{ route('password-reset') }}" style="margin-right: 12px" class="btn btn-success">Forgot
                Password</a>
            <a href="/" class="btn btn-success">Home</a>

        </div>

    </form>

</x-auth-layout>
