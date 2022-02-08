@extends('front::layouts.front')
@section('content')
    <!-- searchbox -->
    @include('front::layouts.search')
    <!-- edit-profile -->
    <section class="mt-4">
        <div class="container">
            <div class="edit-profile-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box  text-blue">
                            <div class="row py-2">
                                <div class="col-6 col-md-9">
                                    <h6><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Profile</h6>
                                </div>
                                <div class="col-6 col-md-3 text-lg-right">
                                    <a href="{{ route('profileInfo', Auth::user()->username) }}" class="bg-blue">Preview
                                        Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="basic-info-tab" data-toggle="pill" href="#basic-info" role="tab"
                                aria-controls="basic-info" aria-selected="true"><i class="fa fa-id-card-o"
                                    aria-hidden="true"></i>Basic Information</a>
                            <a class="nav-link" id="work-experience-tab" data-toggle="pill" href="#work-experience"
                                role="tab" aria-controls="work-experience" aria-selected="false"><i class="fa fa-tasks"
                                    aria-hidden="true" onclick=" userValidate()"></i>Work Experience</a>
                            <a class="nav-link" id="add-document-tab" data-toggle="pill" href="#document-tab" role="tab"
                                aria-controls="document-tab" aria-selected="false"><i class="fa fa-files-o"
                                    aria-hidden="true" onclick=" userValidate()"></i> Additional Document</a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <div class="tab-content mt-4" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="basic-info" role="tabpanel"
                                aria-labelledby="basic-info-tab">
                                <div class="d-detail-box">
                                    <div class="title-box pb-2">
                                        <div class="row py-2">
                                            <div class="col-6 col-md-9">
                                                @if (session('message'))
                                                    <x-alert type="{{ 'success' }}"
                                                        message="{{ session('message') }}"></x-alert>
                                                @endif
                                                <h6>Basic Information</h6>

                                            </div>
                                            <div class="col-6 col-md-3 text-right">
                                                <button class="bg-blue btn edit-btn"><i class="fa fa-edit"></i>Edit
                                                    Profile</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="basic-info-box px-3 mt-3">
                                        <ul class="row">
                                            <li class="col-12"> <span class="basic-info-title">Profile Image</span> <span
                                                    class="basic-info-detial">
                                                    @if (!$user->profile_image)
                                                        <img src="{{ asset('/images/man1.png') }}" alt="Alex image">
                                                    @endif
                                                    <img src="{{ asset('images/main/' . @$user->profile_image) }}" alt="">
                                                </span></li>
                                                
                                            <li class="col-12"> <span class="basic-info-title">Full Name</span> :<span
                                                    class="basic-info-detial">{{$title->title}} {{ $user->first_name }}
                                                    {{ $user->middle_name }} {{ $user->last_name }}</span></li>
                                            <li class="col-12"> <span class="basic-info-title">Email</span> :<span
                                                    class="basic-info-detial">{{ $user->email }}</span></li>
                                            <li class="col-12"> <span class="basic-info-title">Gender</span> :<span
                                                    class="basic-info-detial">{{ ucfirst($user->gender) }}</span></li>
                                            @if ($user->gender == 'others' && !empty($user->other_desc))
                                                <li class="col-12"> <span class="basic-info-title">Others Description</span>
                                                    :<span
                                                        class="basic-info-detial">{{ ucfirst($user->other_desc) }}</span>
                                                </li>
                                            @endif
                                            <li class="col-12"> <span class="basic-info-title">Mobile</span> :<span
                                                    class="basic-info-detial">{{ $user->mobile }}</span></li>
                                            <li class="col-12"> <span class="basic-info-title">GDC Number</span> :<span
                                                    class="basic-info-detial">{{ $user->gdc_number }} </span></li>
                                            <li class="col-12"> <span class="basic-info-title">Country</span> :<span
                                                    class="basic-info-detial">{{ ucfirst($user->country) }} </span></li>
                                            <li class="col-12"> <span class="basic-info-title">Profession</span> :<span
                                                    class="basic-info-detial">{{ ucfirst($user->profession) }} </span>
                                            </li>
                                            <li class="col-12"> <span class="basic-info-title">City /County</span> :<span
                                                    class="basic-info-detial">{{ ucfirst($user->city_county) }} </span>
                                            </li>
                                            <li class="col-12"> <span class="basic-info-title">Street</span> :<span
                                                    class="basic-info-detial">{{ ucfirst($user->street) }}</span></li>
                                            <li class="col-12"> <span class="basic-info-title">Postal Code</span> :<span
                                                    class="basic-info-detial">{{ $user->postal_code }}</span></li>
                                            @if ($user->resume)
                                                <li class="col-12"> <span class="basic-info-title">Resume</span> :<span
                                                        class="basic-info-detial"><a
                                                            href="{{ asset('files/' . $user->resume) }}"
                                                            target="_blank">View
                                                            Resume</a></span></li>

                                            @endif
                                            @if ($user->cover_letter)
                                                <li class="col-12"> <span class="basic-info-title">Cover Letter</span>
                                                    :<span class="basic-info-detial"><a
                                                            href="{{ asset('files/' . $user->cover_letter) }}"
                                                            target="_blank">View
                                                            Cover Letter</a></span></li>

                                            @endif

                                        </ul>
                                    </div>
                                    <?php $users = Auth::user(); ?>

                                    <div class="basic-info-form mt-3 px-3">
                                        <form action="{{ route('updateProfile', $user->id) }}" method="post" class="row"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="tab" value="basic-info-tab">
                                            <div class="form-group col-sm-12 col-md-4">
                                                <label for="first_name">First Name</label>
                                                <input type="text" class="form-control" name="first_name"
                                                    placeholder="First Name" value="{{ $users->first_name }}">
                                                @if ($errors->has('first_name'))
                                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-12 col-md-4">
                                                <label for="middle_name">Middle Name</label>
                                                <input type="text" class="form-control" name="middle_name"
                                                    placeholder="Middle Name" value="{{ $users->middle_name }}">

                                            </div>
                                            <div class="form-group col-sm-12 col-md-4">
                                                <label for="Last_name">Last Name</label>
                                                <input type="text" class="form-control" placeholder="Last Name"
                                                    name="last_name" value="{{ $users->last_name }}">
                                                @if ($errors->has('last_name'))
                                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-12 col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" disabled name="email"
                                                    placeholder="Email" value="{{ $users->email }}">
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-12 col-md-6">
                                                <label for="Mobile">Mobile </label>
                                                <input type="text" class="form-control" name="mobile" placeholder="Mobile"
                                                    value="{{ old('mobile') ? old('mobile') : $user->mobile }} ">
                                                @if ($errors->has('mobile'))
                                                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-12 col-md-4">
                                                <label for="gdc_number">GDC Number </label>
                                                <input type="text" class="form-control" name="gdc_number"
                                                    placeholder="GDC Number"
                                                    value="{{ old('gdc_number') ? old('gdc_number') : $user->gdc_number }} ">
                                                @if ($errors->has('gdc_number'))
                                                    <span class="text-danger">{{ $errors->first('gdc_number') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-12 col-md-4">
                                                <label for="city_county">Country</label>
                                                <select class="js-example-basic-single form-control" name="country"
                                                    id="country">
                                                    <option value="" selected disabled>--Please Select Country</option>
                                                    {{-- <option
                                                        value="{{ $user->country }} >
                                                                                                                                                                                                                                                                                                                                                                                                                        <option value="
                                                        @if ($user->country == 'uk') {{ 'selected' }} @endif>UK</option> --}}
                                                    <option value="england" @if ($user->country == 'england') {{ 'selected' }} @endif>England</option>
                                                    <option value="scotland" @if ($user->country == 'scotland') {{ 'selected' }} @endif>Scotland</option>
                                                    <option value="wales" @if ($user->country == 'wales') {{ 'selected' }} @endif>Wales</option>
                                                    <option value="northern_india" @if ($user->country == 'northern-ireland') {{ 'selected' }} @endif>Northern-Ireland
                                                    </option>

                                                </select>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-4">
                                                <label for="city_county">City /County </label>
                                                <input type="text" class="form-control" name="city_county"
                                                    value="{{ old('city_county') ? old('city_county') : $user->city_county }}">
                                                @if ($errors->has('city_county'))
                                                    <span class="text-danger">{{ $errors->first('city_county') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-12 col-md-4">
                                                <label for="Street">Street </label>
                                                <input type="text" class="form-control" name="street"
                                                    value="{{ old('street') ? old('street') : $user->street }}">
                                                @if ($errors->has('street'))
                                                    <span class="text-danger">{{ $errors->first('street') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-12 col-md-4">
                                                <label for="postal-code">Postal Code</label>
                                                <input type="text" class="form-control" name="postal_code"
                                                    value="{{ old('postal_code') ? old('postal_code') : $user->postal_code }}">
                                                @if ($errors->has('postal_code'))
                                                    <span class="text-danger">{{ $errors->first('postal_code') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-12 col-md-4">
                                                <label for="profession">Profession</label>
                                                <input type="text" class="form-control" name="profession"
                                                    value="{{ old('profession') ? old('profession') : $user->profession }}">
                                                @if ($errors->has('profession'))
                                                    <span class="text-danger">{{ $errors->first('profession') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group col-sm-12 col-md-4">
                                                <label for="other-desc">Gender</label>
                                                <input type="radio" class="gender-radio" name="gender" value="male" @if ($user->gender == 'male') {{ 'checked' }} @endif> Male
                                                <input type="radio" class="gender-radio" name="gender" value="female" @if ($user->gender == 'female') {{ 'checked' }} @endif>
                                                Female
                                                <input type="radio" class="gender-radio" name="gender" value="others" @if ($user->gender == 'others') {{ 'checked' }} @endif id="others">
                                                Others


                                                @if ($errors->has('gender'))
                                                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group col-sm-12 col-md-4 other">

                                                @if ($errors->has('other_desc'))
                                                    <span class="text-danger">{{ $errors->first('other_desc') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-sm-12 ">
                                                <label for="profile">Upload Image</label>
                                                <input type="file" name="profile_image" onchange='Test.UpdatePreview(this)'>
                                                <p> The image file must be in png, jpeg, jpg format with ration of
                                                    width=100px and height=90px. </p>

                                                @if ($user->profile_image)
                                                    <div class="u-proifle-image">
                                                        <img src="{{ asset('images/thumbnail/' . $user->profile_image) }}"
                                                            alt="Profile Image">
                                                    </div>
                                                @endif

                                                @if ($errors->has('profile_image'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('profile_image') }}</span>
                                                @endif

                                            </div>

                                            <div class="form-group col-sm-12 ">
                                                <label for="resume">Upload Resume</label>
                                                <input type="file" name="resume" id="myResume" /><br>
                                                <p> The file must be in pdf format. </p>

                                                <canvas id="pdfViewer"></canvas>

                                                @if ($errors->has('profile_image'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('profile_image') }}</span>
                                                @endif

                                            </div>
                                            <div class="form-group col-sm-12 ">
                                                <label for="cover_letter">Upload Cover Letter</label>
                                                <input type="file" name="cover_letter" id="myCoverLetter">
                                                <p> The file must be in pdf format. </p>

                                                <canvas id="pdfViewerOne"></canvas>
                                            </div>
                                            <div class="form-group col-sm-12 border-top pt-2 text-right">
                                                <button class="btn bg-green" type="submit">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="work-experience" role="tabpanel"
                                aria-labelledby="work-experience-tab">
                                <div class="d-detail-box">
                                    <div class="title-box pb-2">
                                        Work Experience
                                    </div>

                                    <div class=" px-3 mt-3">
                                        @if (session('message'))
                                            <x-alert  id="error" type="{{ 'success' }}" message="{{ session('message') }}">
                                            </x-alert>
                                        @endif
                                        <div class="work-experience-box" >
                                            @forelse ($user->experiences as $experience)
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-5">
                                                        <p> <i class="fa fa-calendar text-blue"></i> <span>
                                                                {{ \Carbon\Carbon::parse($experience->start_date)->format(' F, Y') }}</span>-
                                                            <span>
                                                                {{ \Carbon\Carbon::parse($experience->end_date)->format(' F, Y') }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <ul>
                                                                    <li><i class="fa fa-briefcase text-blue"></i>
                                                                        {{ $experience->job_title }}</li>
                                                                    <li><i class="fa fa-building text-blue"></i>
                                                                        {{ $experience->company_name }}</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <a href="javascript:void(0);" class="editButton pull-right"
                                                                    title="Add Field"
                                                                    data-company="{{ $experience->company_name }}"
                                                                    data-job="{{ $experience->job_title }}"
                                                                    data-start="{{ $experience->start_date }}"
                                                                    data-id="{{ $experience->id }}"
                                                                    data-end="{{ $experience->end_date }}"><span
                                                                        class="fa fa-pencil-square-o fa-2x" title="Edit">

                                                                    </span></a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @empty

                                            @endforelse

                                        </div>

                                    </div>

                                    <div class="mt-3 px-3" >
                                        @if( $errors->isEmpty()) 
                                          <div class="progress d-none">
                                           </div> 
                                            @else 
                                            
                                            <span
                                            class="text-danger">{{ $errors->first('job_title.*') }}</span> <br>
                                          <span
                                          class="text-danger">{{ $errors->first('company_name.*') }}</span><br>
                                          <span
                                          class="text-danger">{{ $errors->first('start_date.*') }}</span><br>
                                          <span
                                          class="text-danger">{{ $errors->first('end_date.*') }}</span><br>
  
                                          @endif
                                        <form method="post" action="{{ route('updateExperience') }}">
                                            <input type="hidden" name="tab" value="work-experience">
                                            <input type="hidden" name="work-exp-count" id="countExps">
                                            @csrf
                                            <div class="work-form">
                                                <div class="hidden  row ">
                                                    <div class="example-template">
                                                        <div class="form-group col-sm-12 mt-2">
                                                            <label for="job_title">Job Title</label>
                                                            <input type="text" class="form-control" id="job_title"
                                                                name="job_title[]" placeholder="Job Title "
                                                                value="{{ old('job_title[]') }}">
                                                            @if ($errors->has('job_title[]'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('job_title') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="company_name ">Company Name</label>
                                                            <input type="text" class="form-control" id="company_name"
                                                                name="company_name[]" placeholder="Company Name "
                                                                value="{{ old('company_name[]') }}">
                                                            @if ($errors->has('company_name'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('company_name') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="Last_name">Duration</label>
                                                            <div class="row ">
                                                                <p class="col-6">From:<input type="date" name="start_date[]"
                                                                        id="start_date" class="form-control "></p>
                                                                @if ($errors->has('start_date'))
                                                                    <span
                                                                        class="text-danger">{{ $errors->first('start_date') }}</span>
                                                                @endif
                                                                <p class="col-6">To:<input type="date" name="end_date[]"
                                                                        id="end_date" class="form-control "></p>
                                                                @if ($errors->has('end_date'))
                                                                    <span
                                                                        class="text-danger">{{ $errors->first('end_date') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <button class="del btn bg-green">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12  text-right ">
                                                <div class="border-top pt-2 save-btn">
                                                    <button class="btn bg-green" type="btn" id="exps">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>



                                    <div class="add-work-box mt-3 "><button class="add_field_button "> <i
                                                class="fa fa-plus "></i> Add Work Experience</button></div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="document-tab" role="tabpanel"
                                aria-labelledby="add-document-tab ">
                                <div class="d-detail-box ">

                                    <div class="title-box pb-2">
                                        <h6>Additional Document</h6>
                                    </div>




                                    <div class="multiple-upload-form mt-3 px-3 ">
                                        <div class="col-sm-12">
                                            <ul>
                                                @forelse ($user->documents as $key=>$document)

                                                    <div class="row">
                                                        <div class="col-sm-9">
                                                            <li>
                                                                <a href="{{ asset('files/' . $document->documents) }}"
                                                                    target="_blank">{{ $document->title }}
                                                                </a>
                                                            </li>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <a href="{{ route('delete', $document->id) }}" class="pull-right"
                                                                ;><span class="fa fa-trash fa-2x" style="color: red"
                                                                    title="Delete">

                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>


                                                @empty

                                                @endforelse
                                            </ul>
                                        </div>
                                        <div class="field_wrapper">
                                            
                                            <form method="post" action="{{ route('additionalDocuments', Auth::id()) }} "
                                                class="row" id="document" enctype="multipart/form-data">
                                                <input type="hidden" name="tab" value="document-tab">

                                                @csrf
                                                <div class="form-group col-sm-6 ">
                                                    <label for="city_county">Title</label>
                                                    <input type="text" name="title[]" id="text" class="form-control ">
                                                    @if ($errors->has('title.*'))
                                                        <span
                                                        class="text-danger">{{ $errors->first('title.*') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-sm-6 ">
                                                    <label for="city_county">Upload Additional Documents</label>
                                                    <input type="file" name="documents[]" accept="image/*">
                                                    <p>Please Upload file in pdf, jpg, jpeg, png foramt and The file size
                                                        must
                                                        not exceed 2mb.</p>
                                                        @if ($errors->has('documents'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('documents') }}</span>
                                                    @endif
                                                </div>
                                                <div class="field_wrapper_form col-12">

                                                </div>


                                                <a href="javascript:void(0);" class="add_button mt-4"
                                                    title="Add Field"><span
                                                        style="border: 1px solid #255625; margin-left: 6px;padding: 5px 18px; color:#fff; background-color: #398439; vertical-align: middle;">More</span></a>
                                                <div class="form-group col-sm-12 border-top pt-2 text-right ">
                                                    <button class="btn bg-green " type="submit">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--  edit-profile ends -->
@endsection



@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="{{ asset('js/jquery.min.js') }} "></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
    $(document).ready(function() { 
        $(".alert" ).fadeOut(3000);

    });
     </script>

    <script>
        $(".add_field_button").on('click', function() {
            var countWorkExps = $('.example-template').length
            $('#countExps').val(countWorkExps + 1)
        })

        var error_holding_tab = "<?php echo session('tab'); ?>"
        var numberOfForms = "<?php echo session('work-exp-count'); ?>"
        numberOfForms = parseInt(numberOfForms)
        if (error_holding_tab === 'basic-info-tab') {
            $('#work-experience-tab').removeClass('active')
            $('#work-experience').removeClass('show active')

            $('.basic-info-box').addClass('d-none')
            $('.basic-info-form').addClass('display-block')

            $('#basic-info-tab').addClass('active')
            $('#basic-info').addClass('show active')
        }

        if (error_holding_tab === 'work-experience') {

            $('#basic-info-tab').removeClass('active')
            $('#basic-info').removeClass('show active')

            $('.basic-info-box').addClass('d-none')
            $('.basic-info-form').addClass('display-block')

            $('#work-experience-tab').addClass('active')
            $('#work-experience').addClass('show active')

            var itemNumber = numberOfForms
            var clone = $('.example-template').clone().appendTo($('.work-form'));

            clone.find('[id]').attr('id', function() {
                return $(this).attr('id') + '_' + itemNumber;
            });

        }
        if (error_holding_tab === 'document-tab') {
            $('#basic-info-tab').removeClass('active')
            $('#basic-info').removeClass('show active')

            $('.basic-info-box').addClass('d-none')
            $('.basic-info-form').addClass('display-block')

            $('#add-document-tab').addClass('active')
            $('#document-tab').addClass('show active')

            var itemNumber = numberOfForms
            var clone = $('.example-template').clone().appendTo($('.work-form'));

            clone.find('[id]').attr('id', function() {
                return $(this).attr('id') + '_' + itemNumber;
            });
        }

    </script>

    <script> 
//     $("#add-document-tab").on('click', function() {
//         debugger
//         var error_message = "<?php echo session('errors'); ?>"
//       console.log(error_message)
//        if (error_message)
//     $("#error").hide();
//     //          return true;
//     //    else return false;
// });


    
    
    </script>
    <script>
        var genderEdit = "{{ $user->gender }}"
        $(document).ready(function() {
            var wrapper = $("#input_fields_wrap");
            var genderValue = $("input[name='gender']:checked").val()
            if (genderEdit === 'others') {
                $('.other').append(
                    '<label class="other_label" for="other_desc">Others Description</label><input type="text" class="form-control other_class"  name="other_desc" value="{{ $user->other_desc }}" >'
                );
            }

            $('.gender-radio').click(function() {
                var genderVal = $("input[name='gender']:checked").val()
                if (genderVal === 'others') {
                    $(".other_label").remove();
                    $(".other_class").remove();

                    $('.other').append(
                        '<label class="other_label" for="other_desc">Others Description</label><input type="text" class="form-control other_class"  name="other_desc" placeholder="Please Specify ..." value=" {{ $user->other_desc }}" >'
                    );
                } else {
                    $(".other_label").remove();
                    $(".other_class").remove();
                }

            })
        });

    </script>
    <script>
        $(document).ready(function() {
            var template =
                `<div class="hidden  row "></div>
                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="example-template"><div class="form-group col-sm-12 mt-2">
                                                                                                                                                                                                                                                                                                                                                                                                                                <label for="job_title">Job Title</label>
                                                                                                                                                                                                                                                                                                                                                                                                                                <input type="hidden" name="exp_id" class="exp_id">
                                                                                                                                                                                                                                                                                                                                                                                                                                <input type="text" class="form-control job_title" id="job_title_1" name="job_title[]" placeholder="Job Title " value="">
                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="form-group col-sm-12">
                                                                                                                                                                                                                                                                                                                                                                                                                                <label for="company_name ">Company Name</label>
                                                                                                                                                                                                                                                                                                                                                                                                                                <input type="text" class="form-control company_name" id="company_name_1" name="company_name[]" placeholder="Company Name " value="">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="form-group col-sm-12">
                                                                                                                                                                                                                                                                                                                                                                                                                                <label for="Last_name">Duration</label>
                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="row ">
                                                                                                                                                                                                                                                                                                                                                                                                                                    <p class="col-6">From:<input type="date" name="start_date[]" id="start_date_1" class="form-control start_date"></p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <p class="col-6">To:<input type="date" name="end_date[]" id="end_date_1" class="form-control end_date "></p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="form-group col-sm-12">
                                                                                                                                                                                                                                                                                                                                                                                                                                <button class="del btn bg-green">Remove</button>
                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                        </div>`
            editArea = $('.work-form');
            var edit = $('.editButton');
            $(edit).on('click', function() {
                editArea.empty();
                editArea.append(template);
                var company_name = $(this).data('company')
                var job = $(this).data('job')
                var start = $(this).data('start')
                var end = $(this).data('end')
                var id = $(this).data('id')
                $(".job_title").val($(".job_title").val() + job);
                $(".company_name").val($(".company_name").val() + company_name);
                $(".start_date").val($(".start_date").val() + start);
                $(".end_date").val($(".end_date").val() + end);
                $(".exp_id").val($(".exp_id").val() + id);


                $('.save-btn').addClass('d-block');
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper_form'); //Input field wrapper
            var fieldHTML =
                `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="row mt-4">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="form-group col-sm-6 ">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <label for="city_county">Title</label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <input type="text" name="title[]" id="text" class="form-control ">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="form-group col-sm-6 ">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <label for="city_county">Upload Additional Documents</label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <input type="file" name="documents[]" >
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a href="javascript:void(0);" class="remove_button btn btn-danger" style="color:#fff; border:1px solid #255625;padding:8px 8px;margin-left:6px;">Remove</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            `
            // '<div style="display: flex; margin-top: 18px;"><label style="width: 500px;">Title:</label><input type="text" name="title[]" id="title" class="form-control" style="width: 50%; margin-right:20px; text-align:center;"><input  type="file" name="documents[]" id="image" class="form-control" style="width: 400px; margin-right:20px;"/> <a href="javascript:void(0);" class="remove_button" style="background-color: #398439;color:#fff; border:1px solid #255625;padding:8px 8px;margin-left:6px;">Remove</a></div>'; //New input field html 
            let imageField = '<div id="field_wrapper"><div class="image-holder"></div></div>';
            var x = 1; //Initial field counter is 1
            //Once add button is clicked
            $(addButton).on('click', function() {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                    $(wrapper).append(imageField);
                }
            });
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });

    </script>
    {{-- <script>
        // #add rows when add button is clicked
        $(document).on 'click', '.js-add-document', (e) - >
            e.preventDefault()
        documentList = $('#document')
        clone = documentList.children('.form-group:first').clone(true)
        clone.append($('<button>').addClass('btn btn-danger js-remove-document').html('Remove'))
        // #reset values in cloned inputs and
        // #add enumerated ID 's to input fields
        clone.find('input').val('').attr('id', () - >
            return $(this).attr('id') + '_' + (documentList.children('.form-group').length + 1)
        )
        documentList.append(clone)

        // #remove rows when remove button is clicked
        $(document).on 'click', '.js-remove-document', (e) - >
            e.preventDefault()
        $(this).parent().remove()

    </script> --}}
    {{-- <script type="text/JavaScript">
        function other_desc_field() {
                                                         debugger
                                                        // First create a DIV element.
                                                        var txtNewInputBox = document.createElement('div');
                                                    
                                                        // Then add the content (a new input box) of the element.
                                                        txtNewInputBox.innerHTML =  "<input type="text" id='newInputBox' class="form-control" name="other_desc"
                                                                    value="{{ $user->other_desc }}">";
                                                    
                                                        // Finally put it where it is supposed to appear.
                                                        document.getElementById("newInputBox").appendChild(txtNewInputBox);
                                                    }
                                                    </script> --}}

@endpush
