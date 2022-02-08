@extends('front::layouts.front')
@section('content')
    <!-- edit-profile -->
    <section class="mt-4">
        <div class="container">
            @if ($errors->all())
                <div class="d-none validation_errors" data-errors-count="{{ count($errors->all()) }}"></div>
            @endif
            @if (session('message'))
                <x-alert type="{{ session('type') }}" message="{{ session('message') }}" />
            @endif
            <div class="edit-profile-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box  text-blue">
                            <div class="row py-2">
                                <div class="col-9">
                                    <h6><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Profile</h6>
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
                            <a class="nav-link" id="contact-person-tab" data-toggle="pill" href="#contact-person" role="tab"
                                aria-controls="work-experience" aria-selected="false"><i class="fa fa-volume-control-phone"
                                    aria-hidden="true"></i>Contact Person</a>
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
                                                <h6>Basic Information</h6>
                                            </div>
                                            <div class="col-6 col-md-3 text-right">
                                                <button class="bg-blue btn edit-btn"><i class="fa fa-edit"></i>Edit
                                                    Basic
                                                    Info</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="basic-info-box employer-basic-detail-box px-3 mt-3">
                                        <ul class="row">
                                            <li class="col-12"> <span class="basic-info-title p">Company
                                                    Logo</span>:<span class="basic-info-detial">
                                                    @if ($detail->profile_image)
                                                        <img src="/images/main/{{ $detail->profile_image }}"
                                                            alt="company logo">
                                                    @endif
                                                </span>
                                            </li>
                                            <li class="col-12"> <span class="basic-info-title">Company Name</span>:<span
                                                    class="basic-info-detial">{{ $detail->user->name }}</span></li>
                                            <li class="col-12"> <span class="basic-info-title">Email</span>:<span
                                                    class="basic-info-detial">{{ $detail->user->email ?? '' }}</span></li>
                                            <li class="col-12"> <span class="basic-info-title">Mobile</span>:<span
                                                    class="basic-info-detial">{{ $detail->mobile_number }}</span></li>
                                            <li class="col-12"> <span class="basic-info-title poppin-bold">Summary</span>:<span></span>
                                                <p class="basic-info-detial">
                                                    {{ $detail->organization_summary }}
                                                </p>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="basic-info-form mt-3 px-3">
                                        <form action="{{ route('employer.updateProfile', $detail->id) }}" class="row"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group col-md-6">
                                                <label>Organization mobile number</label>
                                                <input class="form-control" type="text" name="mobile_number"
                                                    value="{{ $detail->mobile_number }}"
                                                    placeholder="Organization mobile number">
                                                    @if ($errors->has('mobile_number'))
                                                    <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Organization address</label>
                                                <input class="form-control" type="text" name="address"
                                                    value="{{ $detail->address }}"
                                                    placeholder="Enter Organization address">
                                            </div>


                                            {{-- Social links --}}
                                            <div class="col-md-6 form-group">
                                                <label>Facebook Link</label>
                                                <input class="form-control" type="text" value="{{ $detail->facebook }}"
                                                    name="facebook" placeholder="Enter facebook link">
                                                @if ($errors->has('facebook'))
                                                    <span class="text-danger">{{ $errors->first('facebook') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Twitter Link</label>
                                                <input class="form-control" type="text" value="{{ $detail->twitter }}"
                                                    name="twitter" placeholder="Enter twitter link">
                                                @if ($errors->has('twitter'))
                                                    <span class="text-danger">{{ $errors->first('twitter') }}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>instagram Link</label>
                                                <input class="form-control" type="text" value="{{ $detail->instagram }}"
                                                    name="instagram" placeholder="Enter instagram link">
                                                @if ($errors->has('instagram'))
                                                    <span class="text-danger">{{ $errors->first('instagram') }}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>linked Link</label>
                                                <input class="form-control" type="text" value="{{ $detail->linkedin }}"
                                                    name="linkedin" placeholder="Enter linked Link">
                                                @if ($errors->has('linkedin'))
                                                    <span class="text-danger">{{ $errors->first('linkedin') }}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>youtube Link</label>
                                                <input class="form-control" type="text" value="{{ $detail->youtube }}"
                                                    name="youtube" placeholder="Enter youtube Link">
                                                @if ($errors->has('youtube'))
                                                    <span class="text-danger">{{ $errors->first('youtube') }}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>whatsapp Link</label>
                                                <input class="form-control" type="text" value="{{ $detail->whatsapp }}"
                                                    name="whatsapp" placeholder="Enter whatsapp Link">
                                                @if ($errors->has('whatsapp'))
                                                    <span class="text-danger">{{ $errors->first('whatsapp') }}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <label>Organization Summary</label>
                                                <textarea class="form-control" name="organization_summary" cols="30"
                                                    rows="10">{{ $detail->organization_summary }}</textarea>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>Organization Employee Size</label>
                                                <select name="organization_employee_size" class="form-control">
                                                    <option value>-- Organization Employee Size --</option>
                                                    @forelse ($dashboard_employees_size as $size)
                                                        <option
                                                            {{ $detail->organization_employee_size == $size ? 'selected' : null }}
                                                            value="{{ $size }}">{{ $size }}</option>
                                                    @empty

                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>Profile image</label>
                                                <input type="file" name="profile_image"
                                                    value="{{ $detail->profile_image }}" class="form-control fileUpload">
                                                @if ($errors->has('profile_image'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('profile_image') }}</span>
                                                @endif
                                                <div class="mt-2 wrapper">
                                                    <div class="image-holder">
                                                        @if ($detail->profile_image)
                                                            <img src="{{ asset('images/main/' . $detail->profile_image) }}"
                                                                alt="" class="thumb-image w-50 my-2">
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-12 border-top pt-2 text-right">
                                                <button class="btn bg-green">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact-person" role="tabpanel"
                                aria-labelledby="contact-person-tab">
                                <div class="d-detail-box">
                                    <div class="title-box pb-2">
                                        <div class="row py-2">
                                            <div class="col-6">
                                                <h6>Contact Person</h6>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="bg-blue btn edit-btn"><i class="fa fa-edit"></i>Edit
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="basic-info-box px-3 mt-3">
                                        <ul class="row">
                                            <li class="col-12"> <span class="basic-info-title">Full Name</span>:<span
                                                    class="basic-info-detial">{{$title->title}} {{ $detail->first_name }} {{ $detail->last_name }}</span></li>
                                            <li class="col-12"> <span class="basic-info-title p">Designation</span>:<span
                                                    class="basic-info-detial">{{ $detail->employer_designation }}</span>
                                            </li>
                                            <li class="col-12"> <span class="basic-info-title">Email</span>:<span
                                                    class="basic-info-detial">{{ $detail->employer_email }}</span></li>
                                            <li class="col-12"> <span class="basic-info-title">Mobile</span>:<span
                                                    class="basic-info-detial">{{ $detail->employer_contact_number }}</span>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="basic-info-form mt-3 px-3">
                                        <form action="{{ route('employer.updateProfile', $detail->id) }}" class="row"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group col-sm-12 col-md-6">
                                                <label>Employer Name</label>
                                                <input class="form-control" type="text"
                                                    value="{{ $detail->employer_name }}" name="employer_name"
                                                    placeholder="Enter Employer Name">
                                            </div>

                                            <div class="form-group col-sm-12 col-md-6">
                                                <label>Employer designation</label>
                                                <input class="form-control" type="text"
                                                    value="{{ $detail->employer_designation }}"
                                                    name="employer_designation" placeholder="Enter Employer designation">
                                            </div>

                                            <div class="form-group col-sm-12 col-md-6">
                                                <label>employer contact number</label>
                                                <input class="form-control" type="text"
                                                    value="{{ $detail->employer_contact_number }}"
                                                    name="employer_contact_number"
                                                    placeholder="Enter employer contact number">
                                            </div>

                                            <div class="form-group col-sm-12 col-md-6">
                                                <label>employer email</label>
                                                <input class="form-control" type="text"
                                                    value="{{ $detail->employer_email }}" name="employer_email"
                                                    placeholder="Enter employer email">
                                            </div>
                                            <div class="form-group col-sm-12 border-top pt-2 text-right">
                                                <button class="btn bg-green">Save</button>
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
        const validation_errors = $('.validation_errors').attr('data-errors-count');
        $(document).ready(function() {
            if (validation_errors >= 1) {
                $('.edit-btn')[0].click();
            }
        })

    </script>
@endpush
