@extends('front::layouts.front')
@section('content')


    <!-- login-form -->
    <section class="registeration-form mt-5">
        <div class="container">
            <div class="form-box  mt-2">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-5">
                        <div class=" px-3 mt-4">
                            <h4 class="poppin-bold text-blue">Register</h4>
                            <p class="text-sentence">Create your free Account</p>
                            @if (Session::has('flash_message_error'))
                                <div class="col-md-12 alert alert-sm alert-success alert-block" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span area-hidden="true">&times;</span>
                                    </button>
                                    <strong>{!! session('flash_message_error') !!}</strong>
                                </div>
                            @endif

                            @if (session('message'))
                                <x-alert type="success" message="{{ session('message') }}" />
                            @endif

                            <div class="register-box px-3 mt-4">
                            <h1>I am </h1>
                                <form>
                                    <select id="registerSelect">
                                        <option value='0'>JobSeeker</option>
                                        <option value='1'>Employer</option>
                                    </select>
                                </form>
                                <div class="nav nav-tabs" id="register-nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="job-seeker-tab" data-toggle="tab"
                                        href="#job-seeker" role="tab" aria-controls="job-seeker" aria-selected="true">Job
                                        Seeker</a>
                                    <a class="nav-item nav-link" id="employer-tab" data-toggle="tab" href="#employer"
                                        role="tab" aria-controls="employer" aria-selected="false">Employer</a>
                                </div>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="job-seeker" role="tabpanel"
                                        aria-labelledby="job-seeker-tab">
                                        <form class="cf" method="post" action="{{ route('postJobseekerRegister') }}">
                                            {{ csrf_field() }}

                                            <div class=" row justify-content-center mt-3">
                                                <div class="from-group col-sm-12 mt-3">
                                                    <select class="form-control" id="title_id" name="title_id">
                                                    @foreach($titles as $title)    
                                                    <option value="{{$title->id}}">{{ucfirst($title->title)}}</option>
                                                    @endforeach
                                                    </select>
                                                    
                                                </div>
                                                <div class="from-group col-sm-12 mt-3">
                                                    <input type="text" class="form-control" name="first_name"
                                                        placeholder="*First Name" value="{{ old('first_name') }}" />
                                                    @if ($errors->has('first_name'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('first_name') }}</span>
                                                    @endif
                                                </div>
                                                <!-- <div class="from-group col-sm-12 mt-3">
                                                    <input type="text" class="form-control" name="middle_name"
                                                        placeholder="*Middle Name" value="{{ old('middle_name') }}" />
                                                </div> -->
                                                <div class="from-group col-sm-12 mt-3">
                                                    <input type="text" class="form-control" name="last_name"
                                                        placeholder="*Last Name" value="{{ old('last_name') }}" />
                                                    @if ($errors->has('last_name'))
                                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="from-group col-sm-12 mt-3">
                                                    <input type="text" class="form-control" placeholder="*phone"
                                                        name="mobile" value="{{old('mobile')}}"  required />
                                                    @if ($errors->has('mobile'))
                                                        <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                                    @endif
                                                </div>

                                                <div class="from-group col-sm-12 mt-3">
                                                    <input type="text" class="form-control" placeholder="*Email"
                                                        name="email" value="{{ old('email') }}" />
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                                <div class="from-group col-sm-12 mt-3">
                                                    <input type="password" class="form-control" placeholder="*Password"
                                                        name="password" />
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                                <div class="from-group col-sm-12 mt-3">
                                                    <input type="password" class="form-control"
                                                        placeholder="*Confirm Password" name="confirm_password" />
                                                    @if ($errors->has('confirm_password'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                                    @endif
                                                </div>
                                                <div class="from-group col-sm-12 mt-3">
                                                    <div class="terms-condition">
                                                        <input type="checkbox" name="terms_condition">
                                                        <label for=" remember-password">Yes, I agree to the processing
                                                            of my
                                                            personal data in line with the Privacy Policy</label>
                                                        @if ($errors->has('terms_condition'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('terms_condition') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="from-group col-sm-12 mt-3">
                                                    <button class="d-btn  bg-green " type="submit"> Register</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="employer" role="tabpanel" aria-labelledby="employer-tab">
                                        <form class="cf" action="{{ route('employer.post.register') }}" method="POST">
                                            @csrf

                                            <div class=" row justify-content-center mt-3">
                                            <div class="from-group col-sm-12 mt-3">
                                                    <select class="form-control" id="title_id" name="title_id">
                                                    @foreach($titles as $title)    
                                                    <option value="{{$title->id}}">{{ucfirst($title->title)}}</option>
                                                    @endforeach
                                                    </select>
                                                    
                                                </div>
                                                <div class="from-group col-sm-12 mt-3">
                                                    <input type="text" class="form-control" placeholder="First Name"
                                                        name="first_name" value="{{old('first_name')}}" required />
                                                    @if ($errors->has('first_name'))
                                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="from-group col-sm-12 mt-3">
                                                    <input type="text" class="form-control" placeholder="Last name"
                                                        name="last_name" value="{{old('last_name')}}" required />
                                                    @if ($errors->has('last_name'))
                                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="from-group col-sm-12 mt-3">
                                                    <input type="text" class="form-control" placeholder="Organization name"
                                                        name="name" value="{{old('name')}}" required />
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="from-group col-sm-12 mt-3">
                                                    <input type="text" class="form-control" placeholder="*phone"
                                                        name="mobile_number" value="{{old('mobile_number')}}"  required />
                                                    @if ($errors->has('mobile_number'))
                                                        <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                                                    @endif
                                                </div>
                                                <div class="from-group col-sm-12 mt-3">
                                                    <input type="text" class="form-control" placeholder="*Email"
                                                        name="email" value="{{old('email')}}"  required />
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                                <div class="from-group col-sm-12 mt-3">
                                                    <input type="password" class="form-control" placeholder="*Password"
                                                        name="password" required />
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                                <div class="from-group col-sm-12 mt-3">
                                                    <input type="password" class="form-control"
                                                        placeholder="*confirm Password" name="password_confirmation"
                                                        required />
                                                    @if ($errors->has('password_confirmation'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                                    @endif
                                                </div>
                                                <div class="from-group col-sm-12 mt-3">
                                                    <div class="terms-condition">
                                                        <input type="checkbox" name="terms_condition">
                                                        <label for="remember-password">Yes, I agree to the processing of my
                                                            personal data in line with the Privacy Policy</label>
                                                        @if ($errors->has('terms_condition'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('terms_condition') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="from-group col-sm-12 mt-3">
                                                    <button class="d-btn  bg-green " type="submit">Register</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="have-acc">
                            <div class="image-box bg-blue">
                                <img src="{{ asset('images/register.png') }}" alt="" srcset=""></a>
                            </div>
                            <div class="overlay">
                                <h4 class="poppin-bold">Already Have An Account?</h4>
                                <button class="d-btn  bg-green "><a href="{{ route('jobseeker.login') }}">Login
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
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script> -->
    <script language="javascript" type="text/javascript">
        $('.message').delay(10000).fadeOut();
        $('#registerSelect').on('change', function (e) {
            $('#register-nav-tab a').eq($(this).val()).tab('show'); 
            var value = $('#registerSelect').val();
            // var outerdiv= $('<input type"hidden" name="tab" value="'+to_be_appended+'">')
            if(value == 0){
                $('#job-seeker .cf').append('<input type="hidden" name="tab" value="'+value+'" />');
            } else{
                $('#employer .cf').append('<input type="hidden" name="tab" value="'+value+'" />');
            }
            
        });
        var logedInUser = `<?php echo session('tab'); ?>`
            // console.log(logedInUser)
            if(logedInUser == 1){
                // debugger
                $("#registerSelect option[value=1]").attr('selected', 'selected');
                $('#register-nav-tab a').tab('show'); 
                $('#nav-tabContent .tab-pane fade').removeClass('active show')
                $('#nav-tabContent tab-pane fade').addClass('active show');
            }
        
    </script>
@endpush
