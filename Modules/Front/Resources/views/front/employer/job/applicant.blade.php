@extends('front::layouts.front')

@section('content')
    <!-- view -profile -->
    <section class="mt-4">
        <div class="container">
            <div class="view-profile-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box  text-blue">
                            <div class="row py-2">
                                <div class="col-9">
                                    <h6><i class="fa fa-pencil-square-o" aria-hidden="true"></i>My Profile</h6>
                                </div>
                                <div class="col-3 text-right">
                                    <a href="{{ route('employer.jobseeker.downloadcv', $user->jobseeker->id) }}"
                                        target="_blank" class="bg-blue">Download CV</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="basic-info-box px-3 mt-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="profile-image-box">
                                @if (!$user->jobseeker->profile_image)
                                    <img src="{{ asset('/images/man1.png') }}" alt="Alex image">
                                @endif
                                <img src="{{ asset('images/listing/' . $user->jobseeker->profile_image) }}" alt="">
                            </div>

                        </div>
                        <div class="col-sm-8">
                            <div class="basic-info-list">
                                <ul class="row">
                                    <li class="col-12"> <span class="basic-info-title">Full Name</span> :<span
                                            class="basic-info-detial">{{ $user->jobseeker->first_name }}
                                            {{ $user->jobseeker->middle_name }} {{ $user->jobseeker->last_name }}</span>
                                    </li>
                                    <li class="col-12"> <span class="basic-info-title">Email</span> :<span
                                            class="basic-info-detial">{{ $user->jobseeker->email }}</span></li>

                                    <li class="col-12"> <span class="basic-info-title">Gender</span> :<span
                                            class="basic-info-detial">{{ ucfirst($user->jobseeker->gender) }}</span></li>
                                    @if ($user->jobseeker->gender == 'others')
                                        <li class="col-12"> <span class="basic-info-title">Others Description</span>
                                            :<span
                                                class="basic-info-detial">{{ ucfirst($user->jobseeker->other_desc) }}</span>
                                        </li>
                                    @endif

                                    <li class="col-12"> <span class="basic-info-title">Mobile</span> :<span
                                            class="basic-info-detial">{{ $user->jobseeker->mobile }}</span></li>
                                    <li class="col-12"> <span class="basic-info-title">GDC Number</span> :<span
                                            class="basic-info-detial">{{ $user->jobseeker->gdc_number }} </span></li>
                                    <li class="col-12"> <span class="basic-info-title">Country</span> :<span
                                            class="basic-info-detial">{{ ucfirst($user->jobseeker->country) }} </span>
                                    </li>
                                    <li class="col-12"> <span class="basic-info-title">City /County</span> :<span
                                            class="basic-info-detial">{{ ucfirst($user->jobseeker->city_county) }}
                                        </span>
                                    </li>
                                    <li class="col-12"> <span class="basic-info-title">Resume</span> :
                                        @if ($user->jobseeker->resume)
                                            <span class="basic-info-detial">
                                                <a href="{{ asset('files/' . $user->jobseeker->resume) }}"
                                                    target="_blank">
                                                    View Resume
                                                </a>
                                            </span>
                                        @endif
                                    </li>
                                    <li class="col-12">
                                        <span class="basic-info-title">Cover Letter</span> :
                                        @if ($user->jobseeker->cover_letter)
                                            <span class="basic-info-detial">
                                                <a href="{{ asset('files/' . $user->jobseeker->cover_letter) }}"
                                                    target="_blank">
                                                    View Cover Letter</a>
                                            </span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="basic-info-box px-3 mt-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="title-box pb-2">
                                <h6 class="poppin-bold"> <i class="fa fa-tasks"></i>Work Experience</h6>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="basic-info-list px-3">
                                @forelse ($user->jobseeker->experiences as $experience)
                                    <div class="row mt-4">
                                        <div class="col-4">
                                            <div class="date-box">
                                                <i class="fa fa-calendar"></i><span>
                                                    {{ \Carbon\Carbon::parse($experience->start_date)->format(' F, Y') }}</span>
                                                -
                                                <span>{{ \Carbon\Carbon::parse($experience->end_date)->format(' F, Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-8">
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
                                    @forelse ($user->jobseeker->documents as $key=>$document)
                                        <li><a href="{{ asset('files/' . $document->documents) }}"
                                                target="_blank">Certificate
                                                {{ $key }}</a></li>
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
