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
                    <h5 class="poppin-bold text-blue">Edit Your Job Here</h5>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-8">
                    <div class="post-job-form">
                        <div class="title-box  text-blue">
                            <div class="row py-2">
                                <div class="col-9">
                                    <h6><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Job Information</h6>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('employer.job.update', $detail->id) }}" id="form" class="row mt-3" method="POST">
                            @csrf
                            @method('PUT')
                           


                            {{-- Basic Info Starts --}}
                            <div class="form-group col-md-6">
                                <label>Company Name</label>
                                <input class="form-control" name="employer_name"
                                    value="{{ $detail->employer_name ?? Auth::user()->name }}" type="text"
                                    placeholder="Enter Company Name">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Job Category:</label>
                                <select type="text" class="form-control" name="jobcategory_id" id="jobcategory_id">
                                    <option value="" selected disabled>Choose Job Category</option>
                                    @forelse ($jobCategories as $jobCategory)
                                        <option {{ $detail->jobcategory_id == $jobCategory->id ? 'selected' : null }}
                                            value="{{ $jobCategory->id }}">
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
                                <input class="form-control" id="title" name="job_title" value="{{ $detail->job_title }}" type="text"
                                    placeholder="Enter Job Title">
                                @if ($errors->has('job_title'))
                                    <span class="text-danger">{{ $errors->first('job_title') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label>Job Reference Id:</label>
                                <input class="form-control" name="job_reference_id" value="{{ $detail->job_reference_id }}"
                                    type="text" placeholder="Enter Job Reference ID">
                            </div>

                            <div class="form-group col-12">
                                <label>Type of Employment</label>
                                <select name="type_of_employment" class="form-control">
                                    <option value="" selected disabled>--Please Select Type</option>
                                    @foreach ($dashboard_employmentTypes as $employmentType)
                                        <option value="{{ $employmentType->id }}"
                                            {{ $detail->type_of_employment == $employmentType->id ? 'selected' : null }}>
                                            {{ $employmentType->title }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Published Date</label>
                                <input class="form-control" name="published_date" id="published_date" type="date"
                                    value="{{ $detail->published_date }}" placeholder="Enter Published Date">
                                @if ($errors->has('published_date'))
                                    <span class="text-danger">{{ $errors->first('published_date') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label>Deadline Date:</label>
                                <input class="form-control" name="deadline_date" id="deadline_date" type="date"
                                    value="{{ $detail->deadline_date }}" placeholder="Enter Deadline Date">
                                @if ($errors->has('deadline_date'))
                                    <span class="text-danger">{{ $errors->first('deadline_date') }}</span>
                                @endif

                            </div>

                            <div class="form-group col-md-6">
                                <label>Where will employee report to?</label>
                                <input class="form-control" name="employee_reporting"
                                    value="{{ $detail->employee_reporting }}" type="text" placeholder="Enter Job Title">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Country</label>
                                <select name="country" class="form-control">
                                    <option value="" selected disabled>--Please Select Type</option>
                                    @forelse ($dashboard_countries as $slug => $country)
                                        <option value="{{ $slug }}" {{ $detail->country == $slug ? 'selected' : null }}>
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
                                <input class="form-control" name="town_city" value="{{ $detail->town_city }}" type="text"
                                    placeholder="Enter Town/City/County">
                                    @if ($errors->has('town_city'))
                            <span class="text-danger">{{ $errors->first('town_city') }}</span>
                            @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label>Street Address</label>
                                <input class="form-control" name="street_address" value="{{ $detail->street_address }}"
                                    type="text" placeholder="Enter Street Address">
                                    @if ($errors->has('street_address'))
                                    <span class="text-danger">{{ $errors->first('street_address') }}</span>
                                    @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label>Postal Code</label>
                                <input class="form-control" name="post_code" value="{{ $detail->post_code }}" type="text"
                                    placeholder="Enter Postal Code'">
                            </div>


                            <div class="form-group col-md-6">
                                <label>Number of hires</label>
                                <input class="form-control" name="number_of_vacancy"
                                    value="{{ $detail->number_of_vacancy }}" type="text"
                                    placeholder="Enter Number Of Hires">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Is there a planned start date for this job?</label>
                                <br>
                                <input type="radio" name="start_date" value="yes"
                                    {{ $detail->start_date == 'yes' ? 'checked' : null }}>
                                Yes
                                <input type="radio" name="start_date" value="no"
                                    {{ $detail->start_date == 'no' ? 'checked' : null }}> No

                            </div>

                            <div class="form-group col-md-6">
                                <label>How do you want to receive application?</label>
                                <br>
                                @php if (isset($detail->application_receive)) {
                                $application_received = explode(',', $detail->application_receive);
                                $email = $application_received[0];
                                $phone = $application_received[1];
                                } @endphp
                                <input type="checkbox" id="customCheck" name="application_receive_email"
                                    {{ @$email == 'email_ok' ? 'checked' : '' }}>
                                <label>Email</label>
                                <input type="checkbox" id="customCheck" name="application_receive_phone"
                                    {{ @$phone == 'phone_ok' ? 'checked' : '' }}>
                                <label>Contact</label>
                                @if ($errors->has('application_receive'))
                                <span class="text-danger">{{ $errors->first('application_receive') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label>Do you want to submit resume?</label>
                                <input type="radio" name="resume_receive" value="yes"
                                    {{ isset($detail->resume_receive) && $detail->resume_receive == 'yes' ? 'checked' : null }}>
                                Yes
                                <input type="radio" name="resume_receive" value="no"
                                    {{ isset($detail->resume_receive) && $detail->resume_receive == 'no' ? 'checked' : null }}>
                                No
                            </div>

                            <div class="form-group col-md-6">
                                <label>Job Status</label>
                                <input type="radio" name="job_status" value="open"
                                    {{ isset($detail->job_status) && $detail->job_status == 'open' ? 'checked' : null }}>
                                Open
                                <input type="radio" name="job_status" value="paused"
                                    {{ isset($detail->job_status) && $detail->job_status == 'paused' ? 'checked' : null }}>
                                Paused
                                <input type="radio" name="job_status" value="closed"
                                    {{ isset($detail->job_status) && $detail->job_status == 'closed' ? 'checked' : null }}>
                                Closed
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="row preferred">
                                    <div class="col-sm-12">
                                        <p class="poppin-bold">Offered Salary</p>
                                    </div>
                                    <div class="col-sm-12 mt-2">
                                        <input type="checkbox" class="form-control range-salary tick-two"
                                            name="offerred_salary_type" value="range"
                                            {{ isset($detail->offerred_salary_type) && $detail->offerred_salary_type == 'range' ? 'checked' : null }}>
                                        <label for="range"> Range </label>
                                        <input type="checkbox" class="form-control fixed-salary tick-two"
                                            name="offerred_salary_type" value="fixed"
                                            {{ isset($detail->offerred_salary_type) && $detail->offerred_salary_type == 'fixed' ? 'checked' : null }}>

                                        <label for="fixed"> Fixed </label>
                                        <input type="checkbox" class="form-control negotiable-salary tick-two"
                                            name="offerred_salary_type" value="negotiable"
                                            {{ isset($detail->offerred_salary_type) && $detail->offerred_salary_type == 'negotiable' ? 'checked' : null }}>

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
                                                    <option value="{{ $key }}"
                                                        {{ $detail->currencies == $key ? 'selected' : null }}>
                                                        {{ $currency }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('currencies'))
                                                <span class="text-danger">{{ $errors->first('currencies') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-6 col-md-3">
                                            <input type="text" class="form-control" placeholder="Minimum Salary"
                                                name="minimum_salary" value="{{ $detail->minimum_salary }}">
                                            @if ($errors->has('minimum_salary'))
                                                <span class="text-danger">{{ $errors->first('minimum_salary') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-6b col-md-3">
                                            <input type="text" class="form-control" placeholder="Maximum Salary"
                                                name="maximum_salary" value="{{ $detail->maximum_salary }}">
                                            @if ($errors->has('maximum_salary'))
                                                <span class="text-danger">{{ $errors->first('maximum_salary') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-6 col-md-3">
                                            <select class="form-control" id="currency" name="time_period">
                                                <option value="" selected disabled>--Please Time Period
                                                </option>
                                                @foreach ($dashboard_time_periods as $key => $time_period)
                                                    <option value="{{ $key }}"
                                                        {{ $detail->time_period == $key ? 'selected' : null }}>
                                                        {{ $time_period }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('time_period'))
                                                <span class="text-danger">{{ $errors->first('time_period') }}</span>
                                            @endif
                                        </div>
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
                                                    <option value="{{ $key }}"
                                                        {{ $detail->currencies == $key ? 'selected' : null }}>
                                                        {{ $currency }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('currencies'))
                                                <span class="text-danger">{{ $errors->first('currencies') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <input type="text" class="form-control" placeholder="Offered Salary">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <select class="form-control" id="currency" name="time_period">
                                                <option value="" selected disabled>--Please Time Period
                                                </option>
                                                @foreach ($dashboard_time_periods as $key => $time_period)
                                                    <option value="{{ $key }}"
                                                        {{ $detail->time_period == $key ? 'selected' : null }}>
                                                        {{ $time_period }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('time_period'))
                                                <span class="text-danger">{{ $errors->first('time_period') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Type of Salary</label>
                                <select name="salary_type" class="form-control">
                                    <option value="" selected disabled>Please Select Type</option>
                                    @foreach ($dashboard_salaryTypes as $salaryType)
                                        <option value="{{ $salaryType->id }}"
                                            {{ $detail->salary_type == $salaryType->id ? 'selected' : null }}>
                                            {{ $salaryType->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Salary benefits</label>
                                <textarea name="benefits" class="form-control" rows="8"
                                    cols="80">{{ $detail->benefits }}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Job Description</label>
                                <textarea name="job_description" class="form-control" rows="8"
                                    cols="80">{{ $detail->job_description }}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                            <label>Notes</label>
                            <input class="form-control" name="notes" value="{{ $detail->notes }}" type="text"
                                placeholder="Enter Notes'">
                        </div>

                            {{-- Basic Info Ends --}}

                             {{-- SEO starts --}}
                             <div class="form-group col-md-6">
                                <label>Meta Title</label>
                                <input class="form-control" type="text" name="meta_title" id="meta_title" maxlength="70" value="{{ $detail->meta_title }}"
                                    placeholder="Enter Meta Title">
                                    <div id="seo_title"></div>
                                @if ($errors->has('meta_title'))
                                    <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Keywords</label>
                                <input class="form-control" type="text" value="{{ $detail->keyword }}" name="keyword"
                                    placeholder="Enter Keywords">
                                @if ($errors->has('keyword'))
                                    <span class="text-danger">{{ $errors->first('keyword') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-12">
                                <label>Meta Description</label>
                                <textarea name="meta_description"  id="meta_description" maxlength="160" class="form-control" rows="8"
                                    placeholder="Enter Meta Description" cols="80">{{ $detail->meta_description }}
                                </textarea>
                                <div id="seo_desc"></div>
                                @if ($errors->has('meta_description'))
                                    <span class="text-danger">{{ $errors->first('meta_description') }}</span>
                                @endif
                            </div>
                            {{-- SEO Ends --}}
                            <div class="form-group col-sm-12">
                                <button class="btn bg-green text-white"> Post Now</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-dm-12 col-md-4">
                    <div class="aside-job-seeker-box">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        @if (auth()->user()->employer->profile_image)
                                            <div class="aside-image-box">
                                                <img src="/images/main/{{ auth()->user()->employer->profile_image }}"
                                                    alt="">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-md-9 no-gutters">
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
                                        href="{{ route('employer.getProfile', auth()->user()->employer->id) }}">Update Your
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
    

    <script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
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
       var maxLength = 160;
$('#meta_description').keyup(function() {
  var textlen = maxLength - $(this).val().length;
//   console.log($(this).val().length)
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
                    maxlength: 70
                },
                keywords: {
                    // required: true,
                },
                meta_description: {
                    // required: true,
                    // minlength: 150,
                    maxlength: 160
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
