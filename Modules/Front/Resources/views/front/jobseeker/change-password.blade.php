@extends('front::layouts.front')
@section('content')
    <!-- header ends -->

    <section class="mt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    @if (session('message'))
                        <x-alert type="success" message="{{ session('message') }}"></x-alert>
                    @endif
                    @if (session('error'))
                        <x-alert type="danger" message="{{ session('error') }}"></x-alert>
                    @endif
                    <div class="password-box">
                        <h5 class="poppin-bold">Change password</h5>

                        <form class="mt-3" action="{{ route('changePassword') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="password" name="old_password" class="form-control" placeholder="Old Password">

                            </div>
                            <div class="form-group">
                                <input type="password" name="new_password" class="form-control" placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <input type="password" name="new_confirm_password" class="form-control"
                                    placeholder="Confirm Password">
                                @if ($errors->has('new_confirm_password'))
                                    <span class="text-danger">{{ $errors->first('new_confirm_password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn bg-green" type="submit"> Change Password </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
