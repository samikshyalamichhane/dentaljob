@extends('layouts.front')
@section('content')
    @if (Session::has('flash_message_error'))
        <div class="col-6 alert alert-sm alert-danger alert-block mt-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span area-hidden="true">&times;</span>
            </button>
            <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif
    <h3 class="my-3">Enter your email to get Password Reset link </h3>
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

@endsection
