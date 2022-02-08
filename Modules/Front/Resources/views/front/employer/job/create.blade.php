@extends('front::layouts.front')
@section('content')
@push('styles')
<style>
   .help-block {
    display: block;
    font-size: 13px;
    margin-bottom: 0;
    margin-top: 2px;
    color: #e74c3c;
    }
</style>
<style>
    #seo_title{
        
    }
    .seo_title_accept{
        color:green
    }

    .seo_title_short{
        color:red
    }
</style>

@endpush



<!-- post job form  -->
<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="poppin-bold text-blue">Post Your New Job Here</h5>
                <p>Find the Best employee by Posting your vacancy on Dental Job.</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-8 mt-2">
                <div class="post-job-form">
                    <div class="title-box  text-blue">
                        <div class="row py-2">
                            <div class="col-9">
                                <h6><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Job Information</h6>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('employer.job.store') }}" id="form" class="row mt-3" method="POST">
                        @csrf
                        

                        {{-- Basic Info Starts --}}
                        <div class="form-group col-md-6">
                            <label>Company Names</label>
                            <input class="form-control" name="employer_name" value="{{ Auth::user()->name }}"
                                type="text" placeholder="Enter Company Name">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Job Category:</label>
                            <select type="text" class="form-control" name="jobcategory_id" id="jobcategory_id">
                                <option value="" selected disabled>Choose Job Category</option>
                                @forelse ($jobCategories as $jobCategory)
                                <option value="{{ $jobCategory->id }}">
                                    {{ $jobCategory->title }}
                                </option>
                                @empty
                                @endforelse
                            </select>
                            @if ($errors->has('jobcategory_id'))
                            <span class="text-danger">{{ $errors->first('jobcategory_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Job Title</label>
                            <input class="form-control" id="title" name="job_title" value="{{ old('job_title') }}" type="text"
                                placeholder="Enter Job Title">
                            @if ($errors->has('job_title'))
                            <span class="text-danger">{{ $errors->first('job_title') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Job Reference Id:</label>
                            <input class="form-control" name="job_reference_id" value="{{ old('job_reference_id') }}"
                                type="text" placeholder="Enter Job Reference ID">
                        </div>

                        <div class="form-group col-12">
                            <label>Type of Employment</label>
                            <select name="type_of_employment" class="form-control">
                                <option value="" selected disabled>--Please Select Type</option>
                                @foreach ($dashboard_employmentTypes as $employmentType)
                                <option value="{{ $employmentType->id }}"> {{ $employmentType->title }}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        <?php 
                            $dt = \Carbon\Carbon::now()->toDateString();
                        ?>
                        <div class="form-group col-md-6">
                            <label>Published Date</label>
                            <input class="form-control" name="published_date" id="published_date" type="date"
                                value="{{ $dt }}" placeholder="Enter Published Date">
                            @if ($errors->has('published_date'))
                            <span class="text-danger">{{ $errors->first('published_date') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Deadline Date:</label>
                            <input class="form-control" name="deadline_date" id="deadline_date" type="date"
                                value="{{ old('deadline_date') }}" placeholder="Enter Deadline Date">
                            @if ($errors->has('deadline_date'))
                            <span class="text-danger">{{ $errors->first('deadline_date') }}</span>
                            @endif

                        </div>

                        <div class="form-group col-md-6">
                            <label>Where will employee report to?</label>
                            <input class="form-control" name="employee_reporting"
                                value="{{ old('employee_reporting') }}" type="text" placeholder="Enter Job Title">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Country</label>
                            <select name="country" class="form-control">
                                <option value="" selected disabled>--Please Select Type</option>
                                @forelse ($dashboard_countries as $slug => $country)
                                <option value="{{ $slug }}">
                                    {{ $country }}
                                </option>
                                @empty
                                @endforelse
                            </select>
                            @if ($errors->has('country'))
                            <span class="text-danger">{{ $errors->first('country') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Town/City/County</label>
                            <input class="form-control" name="town_city" value="{{ old('town_city') }}" type="text"
                                placeholder="Enter Town/City/County">
                                @if ($errors->has('town_city'))
                            <span class="text-danger">{{ $errors->first('town_city') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Street Address</label>
                            <input class="form-control" name="street_address" value="{{ old('street_address') }}"
                                type="text" placeholder="Enter Street Address">
                                @if ($errors->has('street_address'))
                            <span class="text-danger">{{ $errors->first('street_address') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Postal Code</label>
                            <input class="form-control" name="post_code" value="{{ old('post_code') }}" type="text"
                                placeholder="Enter Postal Code'">
                        </div>


                        <div class="form-group col-md-6">
                            <label>Number of hires</label>
                            <input class="form-control" name="number_of_vacancy" value="{{ old('number_of_vacancy') }}"
                                type="text" placeholder="Enter Number Of Hires">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Is there a planned start date for this job?</label>
                            <br>
                            <input type="radio" name="joining_status" value="yes" class="start_date_yes">
                            Yes
                            <input type="radio" name="joining_status" value="no" class="start_date_no"> No

                            <div class="preferred-date" style="display: block;">
                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="start_date">Start Date </label>
                                        <input type="date" name="start_date" class="form-control" id="start_date"
                                            required="">
                                    </div>
                                </div>
                            </div>


                        </div>
                            
                        <div class="form-group col-md-6">
                            <label>How do you want to receive application?</label>
                            <br>

                            <input type="checkbox" id="customCheck" name="application_receive_email">
                            <label>Email</label>
                            <input type="checkbox" id="customCheck" name="application_receive_phone">
                            <label>Contact</label>
                            @if ($errors->has('application_receive_email'))
                            <span class="text-danger">{{ $errors->first('application_receive_email') }}</span>
                            @endif
                            @if ($errors->has('application_receive_phone'))
                            <span class="text-danger">{{ $errors->first('application_receive_phone') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Do you want to submit resume?</label>
                            <input type="radio" name="resume_receive" value="yes"> Yes
                            <input type="radio" name="resume_receive" value="no"> No
                        </div>

                        <div class="form-group col-md-6">
                            <label>Job Status</label>
                            <input type="radio" name="job_status" value="open"> Open
                            <input type="radio" name="job_status" value="paused"> Paused
                            <input type="radio" name="job_status" value="closed"> Closed
                            @if ($errors->has('job_status'))
                            <span class="text-danger">{{ $errors->first('job_status') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-sm-12">
                            <div class="row preferred">
                                <div class="col-sm-12">
                                    <p class="poppin-bold">Offered Salary</p>
                                </div>
                                <div class="col-sm-12 mt-2">
                                    <input type="checkbox" class="form-control range-salary tick-two"
                                        name="offerred_salary_type" value="range">
                                    <label for="range"> Range </label>
                                    <input type="checkbox" class="form-control fixed-salary tick-two"
                                        name="offerred_salary_type" value="fixed">

                                    <label for="fixed"> Fixed </label>
                                    <input type="checkbox" class="form-control negotiable-salary tick-two"
                                        name="offerred_salary_type" value="negotiable">

                                    <label for="negotiable"> Negotiable </label>
                                </div>
                            </div>
                            @if ($errors->has('offerred_salary_type'))
                            <span class="text-danger mt-2">{{ $errors->first('offerred_salary_type') }}</span>
                            @endif
                        </div>
                        <div class="col-sm-12">
                            <div class="salary-input-range">
                                <h6>Offered Salary</h6>
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-3">
                                        <select class="form-control" id="currency" name="currencies">
                                            <option value="" selected disabled>--Please Select Currency
                                            </option>
                                            @foreach ($dashboard_currencies as $key => $currency)
                                            <option value="{{ $key }}">{{ $currency }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('currencies'))
                                        <span class="text-danger">{{ $errors->first('currencies') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <input type="text" class="form-control" placeholder="Minimum Salary"
                                            name="minimum_salary" value="{{ old('minimum_salary') }}">
                                        @if ($errors->has('minimum_salary'))
                                        <span class="text-danger">{{ $errors->first('minimum_salary') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6b col-md-3">
                                        <input type="text" class="form-control" placeholder="Maximum Salary"
                                            name="maximum_salary" value="{{ old('maximum_salary') }}">
                                        @if ($errors->has('maximum_salary'))
                                        <span class="text-danger">{{ $errors->first('maximum_salary') }}</span>
                                        @endif
                                    </div>
                                    {{-- <div class="form-group col-sm-6 col-md-3">
                                        <select class="form-control" id="currency" name="time_period">
                                            <option value="" selected disabled>--Please Time Period
                                            </option>
                                            @foreach ($dashboard_time_periods as $key => $time_period)
                                            <option value="{{ $key }}">{{ $time_period }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('time_period'))
                                        <span class="text-danger">{{ $errors->first('time_period') }}</span>
                                        @endif
                                    </div> --}}
                                </div>
                            </div>
                            <div class="salary-input-fixed">
                                <h6>Offered Salary</h6>
                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-4">
                                        <select class="form-control" id="currency" name="currencies">
                                            <option value="" selected disabled>--Please Select Currency
                                            </option>
                                            @foreach ($dashboard_currencies as $key => $currency)
                                            <option value="{{ $key }}">{{ $currency }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('currencies'))
                                        <span class="text-danger">{{ $errors->first('currencies') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-12 col-md-4">
                                        <input type="text" class="form-control" placeholder="Offered Salary">
                                    </div>
                                    {{-- <div class="form-group col-sm-12 col-md-4">
                                        <select class="form-control" id="currency" name="time_period">
                                            <option value="" selected disabled>--Please Time Period
                                            </option>
                                            @foreach ($dashboard_time_periods as $key => $time_period)
                                            <option value="{{ $key }}">{{ $time_period }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('time_period'))
                                        <span class="text-danger">{{ $errors->first('time_period') }}</span>
                                        @endif
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Type of Salary</label>
                            <select name="salary_type" class="form-control">
                                <option value="" selected disabled>Please Select Type</option>
                                @foreach ($dashboard_salaryTypes as $salaryType)
                                <option value="{{ $salaryType->id }}">
                                    {{ $salaryType->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Salary benefits</label>
                            <textarea name="benefits" class="form-control" rows="8"
                                cols="80">{{ old('benefits') }}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Job Description</label>
                            <textarea name="job_description" class="form-control" rows="8"
                                cols="80">{{ old('job_description') }}</textarea>
                                @if ($errors->has('job_description'))
                            <span class="text-danger">{{ $errors->first('job_description') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-12">
                            <label>Notes</label>
                            <input class="form-control" name="notes" value="{{ old('notes') }}" type="text"
                                placeholder="Enter Notes'">
                        </div>

                        {{-- SEO starts --}}
                        <div class="form-group col-md-6">
                            <label>Meta Title</label>
                            <input class="form-control" type="text" name="meta_title" id="meta_title"  value="{{ old('meta_title') }}"
                                placeholder="Enter Meta Title">
                                <div id="seo_title"></div>
                            @if ($errors->has('meta_title'))
                            <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Keywords</label>
                            <input class="form-control" type="text" value="{{ old('keyword') }}" name="keyword"
                                placeholder="Enter Keywords">
                            @if ($errors->has('keyword'))
                            <span class="text-danger">{{ $errors->first('keyword') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-12">
                            <label>Meta Description </label>
                            <textarea name="meta_description" id="meta_description" class="form-control" rows="8"
                                placeholder="Enter Meta Description" cols="80">{{ old('meta_description') }} </textarea>
                                <div id="seo_desc"></div>
                            @if ($errors->has('meta_description'))
                            <span class="text-danger">{{ $errors->first('meta_description') }}</span>
                            @endif
                        </div>
                        {{-- SEO Ends --}}

                        {{-- Basic Info Ends --}}
                        <div class="form-group col-sm-12">
                            <button class="btn bg-green text-white"> Post Now</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 mt-2">
                <div class="aside-job-seeker-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-4 col-md-3">
                                    @if (auth()->user()->employer->profile_image)
                                    <div class="aside-image-box">
                                        <img src="/images/main/{{ auth()->user()->employer->profile_image }}" alt="">
                                    </div>
                                    @endif
                                </div>
                                <div class="col-8 col-md-9 no-gutters">
                                    <ul>
                                        <li><i class="fa fa-user"></i> {{ auth()->user()->name ?? '' }} </li>
                                        <li><i class="fa fa-envelope"></i>{{ auth()->user()->email ?? '' }}</li>
                                        @if (auth()->user()->employer->employer_contact_number)
                                        <li>
                                            <i
                                                class="fa fa-phone"></i>{{ auth()->user()->employer->employer_contact_number }}
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="complete-profile-box mt-2">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 text-center">
                            <x-progressbar></x-progressbar>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3  d-flex justify-content-center align-items-center ">
                            <button class="btn bg-green"><a
                                    href="{{ route('employer.getProfile', auth()->user()->employer->id) }}">Update
                                    Your
                                    Profile</a></button>
                        </div>
                    </div>
                </div>
                <div class="similar-job-box mt-3">
                    <div class="title-box py-2">
                        <h6 class="poppin-bold">Paused Jobs</h6>
                    </div>
                    @include('include.paused_job_sidebar')
                </div>
            </div>
        </div>

    </div>
</section>
<!-- post job -->
@endsection

@push('scripts')
{{-- <script src="/assets/front/js/jquery.min.js"></script>
<script src="/assets/front/js/bootstrap.js"></script>
<script src="/assets/front/js/custom.js"></script> --}}

<script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> --}}
<script src="{{ asset('assets/admin/vendors/jquery-validation/dist/jquery.validate.min.js') }}"
type="text/javascript"></script>

<script> 
    $(document).ready(function(){
        $("#title").keyup(function(){
       $("#meta_title").val($(this).val());
    });
    });
    </script>

 <script>
    // $(document).ready(function() {

    //         $('#form').validate({ // initialize the plugin
    //             errorClass: "help-block",
    //             rules: {

    //                 meta_description: {
    //                     // required: true,
    //                     // maxlength: 160,

    //                 },

    //                 meta_title: {
    //                     // required: true,
    //                     // maxlength: 50
    //                 },

    //             }
    //             highlight: function(e) {
    //                     $(e).closest(".form-group").addClass("has-error")
    //                 },
    //                 unhighlight: function(e) {
    //                     $(e).closest(".form-group").removeClass("has-error")
    //                 },
    //         });
    //     });

</script> 

<script>
     var maxLength = 160;
$('#meta_description').keyup(function() {
  var textlen = maxLength - $(this).val().length;
  if($(this).val().length < 150){
    $('#seo_desc').empty()
$('#seo_desc').append('<strong class="seo_title_short">Your meta description length <b style="color:red">('+$(this).val().length +') </b> is short! </strong>')
  }
  if($(this).val().length >= 150 && $(this).val().length < 159 ){
    $('#seo_desc').empty()
$('#seo_desc').append('<strong class="seo_title_accept">Your meta description length <b style="color:green">('+$(this).val().length +') </b> is acceptable! </strong>')
  }
  if($(this).val().length == 160 ){
    $('#seo_desc').empty()
$('#seo_desc').append('<strong class="seo_title_short">You reached maximum length <b style="color:red">('+$(this).val().length +') </b>! </strong>')
  }
});
var maxlength = 70;
$('#meta_title').keyup(function() {
    // debugger
  var titlelen = maxlength - $(this).val().length;
//   console.log($(this).val().length)
  if($(this).val().length < 50){
    $('#seo_title').empty()
    $('#seo_title').append('<strong class="seo_title_short">Your meta title length <b style="color:red">('+$(this).val().length +')</b> is too short.</strong>');
  }
  else if($(this).val().length >= 50 && $(this).val().length < 69){
    $('#seo_title').empty()
    $('#seo_title').append('<strong class="seo_title_accept">Your meta title length <b style="color:green">('+$(this).val().length +')</b> is acceptable.</strong>');

  }
  else if($(this).val().length == 70) {
    $('#seo_title').empty()
    $('#seo_title').append('<strong class="seo_title_short">Your reached maxium length <b style="color:red">('+$(this).val().length +')</b>.</strong>');

  }
});
    $(function() {
        $('#form').validate({
            errorClass: "help-block",
            rules: {
                meta_title: {
                    // required: true,
                    // minlength: 50,
                    // maxlength: 70
                },
                keywords: {
                    // required: true,
                },
                meta_description: {
                    // required: true,
                    // minlength: 150,
                    // maxlength: 160
                }
            },
            highlight: function(e) {
                $(e).closest(".form-group").addClass("has-error")
            },
            unhighlight: function(e) {
                $(e).closest(".form-group").removeClass("has-error")
            },
        });
    });
</script>

<script>
    var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };

        CKEDITOR.replace('job_description', options);
        CKEDITOR.config.height = 200;
        CKEDITOR.config.colorButton_colors = 'CF5D4E,454545,FFF,CCC,DDD,CCEAEE,66AB16';
        CKEDITOR.config.colorButton_enableMore = true;
        CKEDITOR.config.floatpanel = true;
        CKEDITOR.config.removeButtons =
            'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,CreateDiv,BidiLtr,BidiRtl,Language,PageBreak,Styles,Format,Maximize,ShowBlocks,About';

</script>
<script>
    var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };

        CKEDITOR.replace('benefits', options);
        CKEDITOR.config.height = 200;
        CKEDITOR.config.colorButton_colors = 'CF5D4E,454545,FFF,CCC,DDD,CCEAEE,66AB16';
        CKEDITOR.config.colorButton_enableMore = true;
        CKEDITOR.config.floatpanel = true;
        CKEDITOR.config.removeButtons =
            'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,CreateDiv,BidiLtr,BidiRtl,Language,PageBreak,Styles,Format,Maximize,ShowBlocks,About';

</script>
@endpush