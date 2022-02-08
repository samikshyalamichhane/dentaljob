@extends('front::layouts.front')
@section('content')
    <!-- searchbox -->
    <section class="company-profile-banner ">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <div class="employer-logo-box">
                        @if ($detail->employer->profile_image)
                            <img src="{{ asset('images/main/' . $detail->employer->profile_image) }}" alt="profile-image">
                        @endif
                    </div>
                </div>
                <div class="col-sm-5 col-md-6 ">
                    <div class="employer-name">
                        <h4 class="poppin-bold text-white">{{ $detail->name }}</h4>
                        {{-- <p class="text-white">Visit us @ <a
                                href="https://webhousenepal.com/" target="_blank">webhousenepal.com</a></p> --}}
                    </div>
                </div>
                <div class="col-sm-3 text-right ">
                    <h6 class="text-white poppin-bold">Follow Us</h6>
                    <ul>
                        <li><a target="_blank" href="{{ $detail->employer->facebook }}"><i class="fa fa-facebook"></i></a></li>
                        <li><a target="_blank" href="{{ $detail->employer->twitter }}"><i class="fa fa-twitter"></i></a></li>
                        <li><a target="_blank" href="{{ $detail->employer->instagram }}"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- search ends -->

    <!-- job detials -->
    <section class="company-profile-wrap  py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 mt-2 mt-lg-5">
                    <div class="company-profile-box mt-4">
                        <div class="company-detail-section">
                            <div class="sub-title">
                                <h6><strong>Company Summary </strong></h6>
                            </div>
                            <p>{{ $detail->employer->organization_summary }}</p>
                        </div>
                        <div class="company-detail-section">
                            <div class="sub-title">
                                <h6><strong>Contact Number</strong></h6>
                            </div>
                            <p>{{ $detail->employer->mobile_number }}</p>
                        </div>
                        <div class="company-detail-section">
                            <div class="sub-title">
                                <h6><strong>Email</strong></h6>
                            </div>
                            <p>{{ $detail->email ?? '' }}</p>
                        </div>
                        <div class="company-detail-section">
                            <div class="sub-title">
                                <h6><strong>Company Address</strong></h6>
                            </div>
                            <p>{{ $detail->employer->address }}</p>

                            {{-- <ul>
                                <li><strong>Country:</strong>UK</li>
                                <li><strong>Town City/County:</strong>LONDON</li>
                                <li><strong>Street:</strong>10 Downing Street</li>
                                <li><strong>Postal Code:</strong>SW1A 2AA</li>
                            </ul> --}}
                        </div>
                        <div class="company-detail-section">
                            <div class="sub-title">
                                <h6><strong>Employee Size</strong></h6>
                            </div>
                            <p><span>{{ $detail->employer->organization_employee_size }}</span> Employee </p>
                        </div>
                    </div>
                </div>
                <div class="col-dm-12 col-md-4 mt-2">
                    <div class="contact-person-box">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h6 class="poppin-bold">Contact Person</h6>
                                        <ul>
                                            <li><i class="fa fa-user "></i> {{ $detail->employer->employer_name }} </li>
                                            <li><i class="fa fa-envelope"></i> {{ $detail->employer->employer_email ?? '' }}</li>
                                            <li><i class="fa fa-phone"></i>{{ $detail->employer->employer_contact_number }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- update profile section ends -->
@endsection

@push('scripts')
    <script src="/assets/front/js/jquery.min.js"></script>
    <script src="/assets/front/js/bootstrap.js"></script>
    <script src="/assets/front/js/custom.js"></script>
@endpush
