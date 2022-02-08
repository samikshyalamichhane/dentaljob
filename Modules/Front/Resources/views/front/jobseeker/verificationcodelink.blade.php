@extends('front::layouts.front')
@section('content')
    @if (Session::has('flash_message_error'))
        <div class="col-md-8 offset-md-2 alert alert-sm alert-danger alert-block" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span area-hidden="true">&times;</span>
            </button>
            <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif

    <section class="mt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="password-box">
                        <h5 class="poppin-bold">Resend Verification code</h5>
                        <form class="mt-3" action="{{ route('sendVerificationLink') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Enter Email Here">

                            </div>
                            <div class="form-group">
                                <button class="btn bg-green" type="submit"> Resend Verification code </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
