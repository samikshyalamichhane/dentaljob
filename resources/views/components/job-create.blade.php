@push('styles')
<style>
    .preferred label,
    .preferred input {
        display: inline-block;
        width: auto;
        vertical-align: middle;
        margin: 0 10px 0 0;
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




<div class="row">
    <div class="col-md-12">
        <div class="ibox">
            <div class="ibox-head">
                {{ $title }}
            </div>

            <div class="ibox-body" style="">
                <div class="row">
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
                            @foreach ($jobCategories as $jobCategory)
                            @if (isset($detail))
                            <option value="{{ $jobCategory->id }}"
                                {{ $detail->jobcategory_id == $jobCategory->id ? 'selected' : '' }}>
                                {{ $jobCategory->title }}
                            </option>
                            @else
                            <option value="{{ $jobCategory->id }}">
                                {{ $jobCategory->title }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Job Title</label>
                        <input class="form-control" id="title" name="job_title"
                            value="{{ $detail->job_title ?? old('job_title') }}" type="text"
                            placeholder="Enter Job Title">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Job Reference Id:</label>
                        <input class="form-control" name="job_reference_id"
                            value="{{ $detail->job_reference_id ?? old('job_reference_id') }}" type="text"
                            placeholder="Enter Job Reference ID">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Type of Employment</label>
                        <select name="type_of_employment" class="form-control">
                            <option value="" selected disabled>--Please Select Type</option>
                            @foreach ($dashboard_employmentTypes as $employmentType)
                            @if (isset($detail->type_of_employment))
                            <option value="{{ $employmentType->id }}"
                                {{ $detail->type_of_employment == $employmentType->id ? 'selected' : '' }}>
                                {{ $employmentType->title }}
                            </option>
                            @else
                            <option value="{{ $employmentType->id }}"> {{ $employmentType->title }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    {{ $slot }}

                </div>

                <?php 
                $dt = \Carbon\Carbon::now()->toDateString();
                ?>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Published Date</label>
                        <input class="form-control" name="published_date" id="published_date" type="date"
                            value="{{ $pubDate ?? $dt }}" placeholder="Enter Published Date">
                        @if ($errors->has('published_date'))
                        <span class="text-danger">{{ $errors->first('published_date') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label>Deadline Date:</label>
                        <input class="form-control" name="deadline_date" id="deadline_date" type="date"
                            value="{{ $deadDate ?? old('deadline_date') }}" placeholder="Enter Deadline Date">
                        {{-- @if ($errors->has('deadline_date'))
                            <span class="text-danger">{{ $errors->first('deadline_date') }}</span>
                        @endif --}}

                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Where will employee report to?</label>
                        <input class="form-control" name="employee_reporting"
                            value="{{ $detail->employee_reporting ?? old('employee_reporting') }}" type="text"
                            placeholder="Enter Job Title">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Country</label>
                        <select name="country" class="form-control">
                            <option value="" selected disabled>--Please Select Type</option>
                            @foreach ($dashboard_countries as $slug => $country)
                            @if (isset($detail->country))
                            <option value="{{ $slug }}" {{ $detail->country == $slug ? 'selected' : '' }}>
                                {{ $country }}
                            </option>
                            @else
                            <option value="{{ $slug }}">
                                {{ $country }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Town/City/County</label>
                        <input class="form-control" name="town_city"
                            value="{{ $detail->town_city ?? old('town_city') }}" type="text"
                            placeholder="Enter Town/City/County">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Street Address</label>
                        <input class="form-control" name="street_address"
                            value="{{ $detail->street_address ?? old('street_address') }}" type="text"
                            placeholder="Enter Street Address">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Postal Code</label>
                        <input class="form-control" name="post_code"
                            value="{{ $detail->post_code ?? old('post_code') }}" type="text"
                            placeholder="Enter Postal Code'">
                    </div>


                    <div class="form-group col-md-6">
                        <label>Number of hires</label>
                        <input class="form-control" name="number_of_vacancy"
                            value="{{ $detail->number_of_vacancy ?? old('number_of_vacancy') }}" type="text"
                            placeholder="Enter Number Of Hires">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Is there a planned start date for this job?</label>
                        <input id="sdy" type="radio" name="joining_status" class="start_date_yes" value="yes"
                            {{ isset($detail) && $detail->joining_status == 'yes' ? 'checked' : null }}>
                        Yes
                        <input type="radio" name="joining_status" class="start_date_no" value="no"
                            {{ isset($detail) && $detail->joining_status == 'no' ? 'checked' : null }}>No
                        <div class="preferred-date" style="display: block;">
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="start_date">Start Date </label>
                                    <input type="date" name="start_date" class="form-control" id="start_date"
                                        value="{{ $startDate ?? old('start_date') }}" required="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>How do you want to receive application?</label>
                        <?php if (isset($detail->application_receive)) {
                        $application_received = explode(',', $detail->application_receive);
                        $email = $application_received[0];
                        $phone = $application_received[1];
                        } ?>
                        <input type="checkbox" id="customCheck" name="application_receive_email"
                            {{ @$email == 'email_ok' ? 'checked' : '' }}>
                        <label>Email</label>
                        <input type="checkbox" id="customCheck" name="application_receive_phone"
                            {{ @$phone == 'phone_ok' ? 'checked' : '' }}>
                        <label>Contact</label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Do you want to submit resume?</label>
                        <input type="radio" name="resume_receive" value="yes"
                            {{ isset($detail->resume_receive) && $detail->resume_receive == 'yes' ? 'checked' : null }}>Yes
                        <input type="radio" name="resume_receive" value="no"
                            {{ isset($detail->resume_receive) && $detail->resume_receive == 'no' ? 'checked' : null }}>No
                    </div>

                    <div class="form-group col-md-6">
                        <label>Job Status</label>
                        <input type="radio" name="job_status" value="open"
                            {{ isset($detail->job_status) && $detail->job_status == 'open' ? 'checked' : null }}>Open
                        <input type="radio" name="job_status" value="paused"
                            {{ isset($detail->job_status) && $detail->job_status == 'paused' ? 'checked' : null }}>Paused
                        <input type="radio" name="job_status" value="closed"
                            {{ isset($detail->job_status) && $detail->job_status == 'closed' ? 'checked' : null }}>Closed

                    </div>
                </div>

                <div class="row">
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
                    </div>
                    <div class="col-sm-12">
                        <div class="salary-input-range">
                            <h6>Offered Salary</h6>
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-3">
                                    <select class="form-control" id="currency" name="currencies">
                                        <option value="" selected disabled>Please Select Currency
                                        </option>
                                        <option value="euro"
                                            {{ isset($detail->currencies) && $detail->currencies == 'euro' ? 'selected' : null }}>
                                            Euro</option>
                                        <option value="american_dollar"
                                            {{ isset($detail->currencies) && $detail->currencies == 'american_dollar' ? 'selected' : null }}>
                                            American Dollar</option>
                                        <option value="pound"
                                            {{ isset($detail->currencies) && $detail->currencies == 'pound' ? 'selected' : null }}>
                                            Pound</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6 col-md-3">
                                    <input type="text" class="form-control" placeholder="Minimum Salary"
                                        name="minimum_salary"
                                        value="{{ $detail->minimum_salary ?? old('minimum_salary') }}">
                                </div>
                                <div class="form-group col-sm-6b col-md-3">
                                    <input type="text" class="form-control" placeholder="Maximum Salary"
                                        name="maximum_salary"
                                        value="{{ $detail->maximum_salary ?? old('maximum_salary') }}">
                                </div>
                                {{-- <div class="form-group col-sm-6 col-md-3">
                                    <select class="form-control" id="currency" name="time_period">
                                        <option value="" selected disabled>Please Select Time Period
                                        </option>
                                        <option value="annually"
                                            {{ isset($detail->time_period) && $detail->time_period == 'annually' ? 'selected' : null }}>
                                            Annually</option>
                                        <option value="monthly"
                                            {{ isset($detail->time_period) && $detail->time_period == 'monthly' ? 'selected' : null }}>
                                            Monthly</option>
                                        <option value="weekly"
                                            {{ isset($detail->time_period) && $detail->time_period == 'weekly' ? 'selected' : null }}>
                                            Weekly</option>
                                        <option value="hourly"
                                            {{ isset($detail->time_period) && $detail->time_period == 'hourly' ? 'selected' : null }}>
                                            Hourly</option>
                                        <option value="contract"
                                            {{ isset($detail->time_period) && $detail->time_period == 'contract' ? 'selected' : null }}>
                                            Contract</option>
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                        <div class="salary-input-fixed">
                            <h6>Offered Salary</h6>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-4">
                                    <select class="form-control" id="currency" name="currencies">
                                        <option value="" selected disabled>Please Select Currency
                                        </option>
                                        <option value="euro"
                                            {{ isset($detail->currencies) && $detail->currencies == 'euro' ? 'selected' : null }}>
                                            Euro</option>
                                        <option value="american_dollar"
                                            {{ isset($detail->currencies) && $detail->currencies == 'american_dollar' ? 'selected' : null }}>
                                            American Dollar</option>
                                        <option value="pound"
                                            {{ isset($detail->currencies) && $detail->currencies == 'pound' ? 'selected' : null }}>
                                            Pound</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <input type="text" class="form-control" name="fixed_salary"
                                        value="{{ $detail->fixed_salary ?? old('fixed_salary') }}"
                                        placeholder="Offered Salary">
                                </div>
                                {{-- <div class="form-group col-sm-12 col-md-4">
                                    <select class="form-control" id="currency" name="time_period">
                                        <option value="" selected disabled>Please Select Time Period
                                        </option>
                                        <option value="annually"
                                            {{ isset($detail->time_period) && $detail->time_period == 'annually' ? 'selected' : null }}>
                                            Annually</option>
                                        <option value="monthly"
                                            {{ isset($detail->time_period) && $detail->time_period == 'monthly' ? 'selected' : null }}>
                                            Monthly</option>
                                        <option value="weekly"
                                            {{ isset($detail->time_period) && $detail->time_period == 'weekly' ? 'selected' : null }}>
                                            Weekly</option>
                                        <option value="hourly"
                                            {{ isset($detail->time_period) && $detail->time_period == 'hourly' ? 'selected' : null }}>
                                            Hourly</option>
                                        <option value="contract"
                                            {{ isset($detail->time_period) && $detail->time_period == 'contract' ? 'selected' : null }}>
                                            Contract</option>
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Type of Salary</label>
                        <select name="salary_type" class="form-control">
                            <option value="" selected disabled>Please Select Type</option>
                            @foreach ($dashboard_salaryTypes as $salaryType)
                            <option value="{{ $salaryType->id }}"
                                {{ $detail != null && $detail->type == $salaryType->id ? 'selected' : '' }}>
                                {{ $salaryType->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Notes</label>
                        <input class="form-control" name="notes"
                            value="{{ $detail->notes ?? old('notes') }}" type="text"
                            placeholder="Enter Notes'">
                    </div>



                    {{-- <div class="form-group col-md-6">
                        <label>Salary Range</label>
                        <select name="salary" class="form-control">
                            <option value="" selected disabled>--Please Select Type</option>
                            @foreach ($dashboard_salary as $salary)
                            @if (isset($detail->salary))
                            <option value="{{ $salary }}" {{ $detail->salary == $salary ? 'selected' : '' }}>
                                {{ $salary }}
                            </option>
                            @else
                            <option value="{{ $salary }}">
                                {{ $salary }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="form-group col-md-12">
                        <label>Salary benefits</label>
                        <textarea name="benefits" class="form-control" rows="8"
                            cols="80">{{ $detail->benefits ?? old('benefits') }}</textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Job Description</label>
                        <textarea name="job_description" class="form-control" rows="8"
                            cols="80">{{ $detail->job_description ?? old('job_description') }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">SEO Details</div>
                            </div>
                            <div class="ibox-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Meta Title</label>
                                        <input class="form-control" type="text" id="meta_title"  name="meta_title"
                                            value="{{ $detail->meta_title ?? old('meta_title') }}" placeholder="Enter Meta Title">
                                            <div id="seo_title"></div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Keywords</label>
                                        <input class="form-control" type="text" value="{{ $detail->keyword ?? old('keyword') }}"
                                            name="keyword" placeholder="Enter Keywords">
                                    </div>
                                    {{-- <div class="form-group col-md-6">
                                        <label>Meta Tag</label>
                                        <input class="form-control" type="text" name="meta_phrase"
                                            value="{{ $detail->meta_phrase ?? old('meta_phrase') }}" placeholder="Enter Meta Phrase">
                                </div> --}}
                                <div class="form-group col-md-6">
                                    <label>Meta Description</label>
                                    <textarea name="meta_description" id="meta_description"  class="form-control" rows="8" placeholder="Enter Meta Description"
                                        cols="80">{{ $detail->meta_description ?? old('meta_description') }} </textarea>
                                        <div id="seo_desc"></div>
                                </div>
                
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="check-list">
                    <label class="ui-checkbox ui-checkbox-primary">
                        <input name="publish" type="checkbox"
                            {{ isset($detail->publish) && $detail->publish ? 'checked' : null }}>
                        <span class="input-span"></span>Publish</label>
                </div>

                <br>

                <div class="form-group">
                    <button class="btn btn-default" type="submit">Submit</button>
                </div>

            </div>
            <!-- </div> -->
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script src="{{ asset('assets/admin/vendors/jquery-validation/dist/jquery.validate.min.js') }}"
type="text/javascript"></script>
<script>
    var joining_status = "<?php if (isset($detail->joining_status)) { echo $detail->start_date; } else { echo ''; } ?>"
    if (joining_status != "") {
        var result = joining_status.split(' ');
        $('#start_date').val(result[0])
    } else {

    }

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
@push('scripts')

<script>
    $(document).ready(function() {
            const offerred_salary_type =
                '{{ isset($detail->offerred_salary_type) ? $detail->offerred_salary_type : '' }}';

            // console.log(offerred_salary_type)

            if (offerred_salary_type == '') return;

            if (offerred_salary_type == "range") {
                $(".salary-input-range").show();
            }
            if (offerred_salary_type == "fixed") {
                $(".salary-input-fixed").show();
            }
        });

        // range salary
        $(".salary-input-range").hide();
        $(".range-salary").click(function() {
            if ($(this).is(":checked")) {
                $(".salary-input-range").show(300);
                $(".salary-input-fixed").hide(200);
            } else {
                $(".salary-input-range").hide(200);

            }
        });
        // fixed salary
        $(".salary-input-fixed").hide();
        $(".fixed-salary").click(function() {
            if ($(this).is(":checked")) {
                $(".salary-input-fixed").show(300);
                $(".salary-input-range").hide(200);
            } else {
                $(".salary-input-fixed").hide(200);
            }
        });
        $(".negotiable-salary").click(function() {
            if ($(this).is(":checked")) {
                $(".salary-input-fixed").hide(300);
                $(".salary-input-range").hide(200);
            }
        });

        // salary
        // on check other uncheck
        $('input.tick').on('change', function() {
            $('input.tick').not(this).prop('checked', false);
        });
        $('input.tick-one').on('change', function() {
            $('input.tick-one').not(this).prop('checked', false);
        });
        $('input.tick-two').on('change', function() {
            $('input.tick-two').not(this).prop('checked', false);
        });
        $('input.tick-three').on('change', function() {
            $('input.tick-three').not(this).prop('checked', false);
        });
        $('input.tick-four').on('change', function() {
            $('input.tick-four').not(this).prop('checked', false);
        });

        // planned date

        // $(document).ready(function() {
        //     const offerred_salary_type =
        //         '{{ isset($detail->offerred_salary_type) ? $detail->offerred_salary_type : '' }}';

        //     // console.log(offerred_salary_type)

        //     if (offerred_salary_type == '') return;

        //     if (offerred_salary_type == "range") {
        //         $(".salary-input-range").show();
        //     }
        //     if (offerred_salary_type == "fixed") {
        //         $(".salary-input-fixed").show();
        //     }
        // });

        $(".preferred-date").hide();
        $(".start_date_yes").click(function() {
            if ($(this).is(":checked")) {
                $(".preferred-date").show(300);
            } else {
                $(".preferred-date").hide(200);
            }
        });
        $(".start_date_no").click(function() {
            $(".preferred-date").hide(200);
        });

        $(document).ready(function() {
            if ($('#sdy').is(':checked')) {
                $(".preferred-date").show(300);
            }
        });

</script>
@endpush