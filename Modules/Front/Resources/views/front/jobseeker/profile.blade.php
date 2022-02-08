@extends('front::layouts.front')
@section('content')

    @include('front::layouts.search')

    <!-- view -profile -->
    <section class="mt-4">
        <div class="container">
            <div class="view-profile-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box  text-blue">
                            <div class="row py-2">
                                <div class="col-6 col-md-9">
                                    <h6><i class="fa fa-pencil-square-o" aria-hidden="true"></i>My Profile</h6>
                                </div>
                                <div class="col-6 col-md-3 text-lg-right">
                                    <a href="{{ route('downloadCv', $jobseeker->user_id) }}" target="_blank"
                                        class="bg-blue">Download
                                        My CV</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="basic-info-box px-2 px-lg-3 mt-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="profile-image-box">
                                @if (!$jobseeker->profile_image)
                                    <img src="{{ asset('/images/man1.png') }}" alt="Alex image">
                                @endif
                                <img src="{{ asset('images/listing/' . $jobseeker->profile_image) }}" alt="">
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div class="basic-info-list">
                                <ul class="row">
                                    <li class="col-12"> <span class="basic-info-title">Full Name</span> :<span
                                            class="basic-info-detial">{{$title->title}}{{ ucfirst($jobseeker->first_name) }}
                                            {{ $jobseeker->middle_name }} {{ ucfirst($jobseeker->last_name) }}</span></li>
                                    <li class="col-12"> <span class="basic-info-title">Email</span> :<span
                                            class="basic-info-detial">{{ $jobseeker->email }}</span></li>
                                    <li class="col-12"> <span class="basic-info-title">Gender</span> :<span
                                            class="basic-info-detial">{{ ucfirst($jobseeker->gender) }}</span></li>

                                    @if ($jobseeker->gender == 'others' && !empty($jobseeker->other_desc))
                                        <li class="col-12"> <span class="basic-info-title">Others Description</span>
                                            :<span class="basic-info-detial">{{ ucfirst($jobseeker->other_desc) }}</span>
                                        </li>
                                    @endif
                                    <li class="col-12"> <span class="basic-info-title">Mobile</span> :<span
                                            class="basic-info-detial">{{ $jobseeker->mobile }}</span></li>
                                    <li class="col-12"> <span class="basic-info-title">GDC Number</span> :<span
                                            class="basic-info-detial">{{ $jobseeker->gdc_number }} </span></li>
                                    <li class="col-12"> <span class="basic-info-title">Country</span> :<span
                                            class="basic-info-detial">{{ ucfirst($jobseeker->country) }} </span></li>
                                    <li class="col-12"> <span class="basic-info-title">Profession</span> :<span
                                            class="basic-info-detial">{{ ucfirst($jobseeker->profession) }} </span></li>
                                    <li class="col-12"> <span class="basic-info-title">City /County</span> :<span
                                            class="basic-info-detial">{{ ucfirst($jobseeker->city_county) }} </span></li>
                                    @if ($jobseeker->resume)
                                        <li class="col-12"> <span class="basic-info-title">Resume</span> :<span
                                                class="basic-info-detial"><a
                                                    href="{{ asset('files/' . $jobseeker->resume) }}"
                                                    target="_blank">View
                                                    Resume</a></span></li>
                                    @endif
                                    @if ($jobseeker->cover_letter)
                                        <li class="col-12"> <span class="basic-info-title">Cover Letter</span> :<span
                                                class="basic-info-detial"><a
                                                    href="{{ asset('files/' . $jobseeker->cover_letter) }}"
                                                    target="_blank">View
                                                    Cover Letter</a></span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="basic-info-box px-2 px-lg-3 mt-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="title-box pb-2">
                                <h6 class="poppin-bold"> <i class="fa fa-tasks"></i>Work Experience</h6>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="basic-info-list px-2">
                                @forelse ($jobseeker->experiences as $experience)
                                    <div class="row mt-4">
                                        <div class="col-sm-12 col-md-4">
                                            <div class="date-box">
                                                <i class="fa fa-calendar"></i><span>
                                                    {{ \Carbon\Carbon::parse($experience->start_date)->format(' F, Y') }}</span>
                                                -
                                                <span>{{ \Carbon\Carbon::parse($experience->end_date)->format(' F, Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <p><i class="fa fa-user"></i> {{ $experience->job_title }}</p>
                                            <p><i class="fa fa-building"></i> {{ $experience->company_name }}</p>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="basic-info-box px-3 mt-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="title-box pb-2">
                                <h6 class="poppin-bold"> <i class="fa fa-files-o" aria-hidden="true"></i>Additional Document
                                </h6>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="basic-info-list mt-3">

                                <ul>
                                    @forelse ($jobseeker->documents as $key=>$document)
                                        <li>
                                            <a href="{{ asset('files/' . $document->documents) }}"
                                                target="_blank">{{ $document->title }}
                                            </a>
                                        </li>
                                    @empty

                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--  edit-profile ends -->
@endsection
