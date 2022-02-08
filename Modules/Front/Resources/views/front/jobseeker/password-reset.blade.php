@extends('front::layouts.front')
@section('content')
    <!-- header ends -->
    @if (Session::has('flash_message_error'))
        <div class="col-md-8 offset-md-2 alert alert-sm alert-danger alert-block" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span area-hidden="true">&times;</span>
            </button>
            <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif
    <section class="mt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="password-box">
                        <h5 class="poppin-bold">Password Reset</h5>
                        <p class="mt-3">Forgotten your password?</p>
                        <p class="mt-1">Enter your e-mail address below, and we'll send you an e-mail allowing you to reset
                            it.</p>
                        <form class="mt-3" action="{{ route('sendEmailLink') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Enter Your Email Here">
                            </div>
                            <div class="form-group">
                                <button class="btn bg-green" type="submit"> Reset </button>
                            </div>
                        </form>
                        <p>Please contact us if your are having problem in resetting password.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
