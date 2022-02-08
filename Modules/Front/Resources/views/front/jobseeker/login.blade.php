@extends('front::layouts.front')
@section('content')
    <!-- login-form -->
    <section class="login-form mt-5">
        <div class="container">
            <div class="form-box  mt-2">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-5 mt-3">
                        <div class="px-4 mt-4">
                            <h4 class="poppin-bold text-blue">Login</h4>
                            <p class="text-sentence">Login With your Existing Account</p>
                            @if (Session::has('flash_message_error'))
                                <div class="col-12 alert alert-sm alert-danger alert-block mt-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span area-hidden="true">&times;</span>
                                    </button>
                                    <strong>{!! session('flash_message_error') !!}</strong>
                                </div>
                            @endif
                            @if (session('message'))
                                <x-alert type="{{ session('type') }}" message="{{ session('message') }}" />
                            @endif
                            <div class="login-box mt-3">
                           
                                <h1>I am </h1>
                                 <form>
                                    <select id='mySelect'>
                                        <option value='0'>JobSeeker</option>
                                        <option value='1'>Employer</option>
                                    </select>
                                </form>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="job-seeker-tab" data-toggle="tab"
                                        href="#job-seeker" role="tab" aria-controls="job-seeker" aria-selected="true">Job
                                        Seeker</a>
                                    <a class="nav-item nav-link" id="employer-tab" data-toggle="tab" href="#employer"
                                        role="tab" aria-controls="employer" aria-selected="false">Employer</a>
                                </div>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="job-seeker" role="tabpanel"
                                        aria-labelledby="job-seeker-tab">
                                        <form class="cf" method="post" action="{{ route('postJobseekerLogin') }}">
                                            {{ csrf_field() }}

                                            <div class="form row justify-content-center mt-3">
                                                <div class="from-group col-sm-12  mt-3">
                                                    <input type="text" class="form-control" name="email" placeholder="Email"
                                                        value="{{ old('email') }}" />
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                                <div class="from-group col-sm-12  mt-3">
                                                    <input type="password" class="form-control" name="password"
                                                        placeholder="Password" value="{{ old('password') }}">
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                                <div class="from-group col-sm-12 col-md-8 mt-3">
                                                    <input type="checkbox" name="remember-password">
                                                    <label for="remember-password">Remember Password</label>
                                                </div>
                                                <div class="from-group col-sm-12 col-md-4 mt-3">
                                                    <button class="d-btn bg-green">login</button>
                                                </div>

                                                @if (session()->has('verification_code_not_received'))
                                                    <div class="from-group col-sm-12 col-md-6 mt-3">
                                                        <p for="forget-password" class="float-lg-right"><a
                                                                href="{{ route('verificationCode') }}">Resend verification
                                                                Code</a> </p>
                                                    </div>
                                                @endif

                                                <div class="from-group col-sm-12 col-md-12 mt-3">
                                                    <p for="forget-password" class="float-lg-right"><a
                                                            href="{{ route('password.reset') }}">Forget Your Password
                                                            ?</a> </p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="employer" role="tabpanel" aria-labelledby="employer-tab">
                                        <form class="cf" action="{{ route('employer.post.login') }}" method="POST">
                                            @csrf

                                            <div class="form row justify-content-center mt-3">
                                                <div class="from-group col-sm-12  mt-3">
                                                    <input type="text" class="form-control" name="email"
                                                        placeholder="Email" />
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                                <div class="from-group col-sm-12  mt-3">
                                                    <input type="password" class="form-control" name="password"
                                                        placeholder="Password">
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                                <div class="from-group col-sm-12 col-md-8 mt-3">
                                                    <input type="checkbox" name="remember-password">
                                                    <label for="remember-password">Remember Password</label>
                                                </div>
                                                <div class="from-group col-sm-12 col-md-4 mt-3">
                                                    <button class="d-btn  bg-green ">login</button>
                                                </div>
                                                <div class="from-group col-sm-12 col-md-12 mt-3">
                                                    <p for="forget-password" class="float-lg-right"><a
                                                            href="{{ route('password.reset') }}">Forget Your Password
                                                            ?</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7 mt-3 mt-lg-0">
                        <div class="dont-have-acc">
                            <div class="image-box bg-blue">
                                <img src="{{ asset('images/hospital.png') }}" alt="" srcset=""></a>
                            </div>
                            <div class="overlay">
                                <h4 class="poppin-bold">Don't Have An Account Yet?</h4>
                                <button class="d-btn  bg-green "><a href="{{ route('jobseeker.register') }}">Register
                                        Now</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<script> 
    if(localStorage.mySelect  == 1)
        {
            $("#mySelect option[value=1]").attr('selected', 'selected');
            $('#nav-tab a').tab('show'); 
            $('#nav-tabContent .tab-pane fade').removeClass('active show')
            $('#nav-tabContent tab-pane fade').addClass('active show');
        }

        if (localStorage.mySelect)
        {
            localStorage.clear();
        }
</script> 
    <script>
        
        $('#mySelect').on('change', function (e) {
            $('#nav-tab a').eq($(this).val()).tab('show');
            var value = $('#mySelect').val();
            if(value == 0){
                $('#job-seeker .cf').append('<input type="hidden" name="tab" value="'+value+'" />');
            } else{
                $('#employer .cf').append('<input type="hidden" name="tab" value="'+value+'" />');
            } 
        });
        var logedInUser = `<?php echo session('tab'); ?>`
            if(logedInUser == 1){
                $("#mySelect option[value=1]").attr('selected', 'selected');
                $('#nav-tab a').tab('show'); 
                $('#nav-tabContent .tab-pane fade').removeClass('active show')
                $('#nav-tabContent tab-pane fade').addClass('active show');
            }
    </script>
@endpush
