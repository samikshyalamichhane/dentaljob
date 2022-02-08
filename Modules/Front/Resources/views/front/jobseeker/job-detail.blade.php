@extends('front::layouts.front')
@section('meta_title', $job->meta_title)
@section('meta_description', $job->meta_description)
@section('keyword', $job->keyword)
@section('author', $job->employer->user->name)
   <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=609b5cf4c62db20018311d13&product=sop' async='async'></script>
@section('content')

    <!-- login-form -->
  <!-- searchbox -->
  <!-- <section class="job-detail-banner ">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="employer-logo-box">
                    <img src="{{ asset('images/main/' . $job->employer->profile_image) }}" alt="">
                </div>
            </div>
            <div class="col-sm-9 ">
                <div class="employer-name">
                    <h4 class="poppin-bold text-blue">{{$job->employer->user->name}}</h4>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- search ends -->

    <!-- job detials -->
    <section class="job-detail-wrap py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    @if (session('message'))
                        <x-alert type="{{ 'success' }}" message="{{ session('message') }}"></x-alert>
                    @endif

                    <div class="job-detail-box pb-2 ">
                        <div class="p-date row">
                            <div class="col-sm-12 col-md-8">
                                <h5 class="poppin-bold text-blue"><i class="fa fa-briefcase"></i>
                                    {{ ucfirst($job->job_title) }}
                                    
                                </h5>
                                    Posted On:
                                    <span>{{ isset($job->published_date) ? $job->published_date->format(' jS \\ F Y ') : null }}</span>
                                    <a style="color:green" href="{{ route('CompanyProfile', $job->employer->user->username) }}">
                                    By {{ucfirst($job->employer->user->name)}} 
                                </a>
                            </div>
                            <div class="col-sm-12 col-md-4 text-right">
                                Deadline:{{ isset($job->deadline_date) ? $job->deadline_date->format(' jS \\ F Y ') : null }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-10">
                                <div class="important-information">
                                    <div class="row">
                                        @if($job->offerred_salary_type)
                                        <div class="col-12 col-sm-6 mt-2">
                                                {{-- {{ dd(($job->currencies == 'american_dollar' ? '$' : $job->currencies == 'euro') ? '€' : '£', $job->fixed_salary) }} --}}
                                                <p>
                                                <i class="fa fa-eur" aria-hidden="true"></i>
                                               
                                                @if ($job->offerred_salary_type == 'negotiable')
                                                    <span> {{ ucfirst($job->offerred_salary_type) }}</span>
                                                @elseif($job->offerred_salary_type == 'fixed')
                                                    <span>
                                                        {{ ($job->currencies == 'american_dollar' ? '$' : $job->currencies == 'euro') ? '€' : '£' }}
                                                        {{ number_format($job->fixed_salary) }}
                                                    </span>
                                                    <span> {{ ucfirst($job->time_period) }} </span>
                                                @elseif($job->offerred_salary_type == 'range')
                                                    <span>
                                                        {{ ($job->currencies == 'american_dollar' ? '$' : $job->currencies == 'euro') ? '€' : '£' }}
                                                        {{ number_format($job->minimum_salary) }}
                                                    </span> -
                                                    <span>
                                                        {{ number_format($job->maximum_salary) }}
                                                    </span>
                                                    <span> {{ ucfirst($job->time_period) }} </span>
                                                @endif
                                                </p>
                                        </div>
                                        @endif

                                        <div class="col-12 col-sm-6 mt-2">
                                            <p><i class="fa fa-map-marker" aria-hidden="true"></i> <span>{{ ucfirst($job->country) }}, {{ ucfirst(str_replace('-', ' ', $job->town_city)) }}</span></p>
                                            <!-- <p><i class="fa fa-map-marker" aria-hidden="true"></i> <span>{{ ucfirst($job->country) }}, {{ ucfirst(str_replace('-', ' ', $job->town_city)) }}, {{ ucfirst($job->street_address) }} {{ $job->post_code }}</span></p> -->

                                        </div>
                                        @if($job->employementSalaryType)
                                        <div class="col-12 col-sm-6 mt-2">
                                                <p> <i class="fa fa-clock-o" aria-hidden="true"></i> <span>{{ $job->employementSalaryType != null ? ucfirst($job->employementSalaryType->title) : '' }}</span> </p>
                                        </div>
                                        @endif
                                        @if($job->number_of_vacancy)
                                        <div class="col-12 col-sm-6 mt-2">
                                                <p><i class="fa fa-user-o" aria-hidden="true"></i><span>{{ $job->number_of_vacancy }} Nos</span></p>
                                        </div>
                                        @endif
                                        @if($job->application_receive)
                                        <div class="col-12 col-sm-6 mt-2">
                                            <p><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                 @if ($job->application_receive == 'email_ok,phone_not_ok')
                                                <span> Email </span>
                                            @elseif($job->application_receive == 'email_not_ok,phone_ok')
                                                <span> Phone </span>
                                            @elseif($job->application_receive == 'email_ok,phone_ok')
                                                <span> Email and Phone Both</span>
                                            @endif 
                                            </p>
                                               
                                        </div>
                                        @endif
                                    
                                        @if($job->joining_status == 'yes')
                                        <div class="col-12 col-sm-6 mt-2">
                                            <p><i class="fa fa-calendar" aria-hidden="true"></i><span>Joining Date: {{$job->start_date->format(' jS \\ F Y ') }}</span></p>
                                        </div>
                                        
                                        @endif
                                    </div>
                                </div>
                                @if($job->employee_reporting)
                                <div class="job-detail-section">
                                    <div class="sub-title">
                                        <h6><strong>Employee Reporting</strong></h6>
                                    </div>
                                    <p><span>{{ $job->employee_reporting }}</span></p>
                                </div>
                                @endif
                                @if($job->resume_receive)
                                <div class="job-detail-section">
                                    <div class="sub-title">
                                        <h6><strong>Resume </strong></h6>

                                    </div>
                                    <p>{{ $job->resume_receive == 'yes' ? 'Required' : 'Not Required' }}</p>
                                </div>
                                @endif
                                @if($job->job_description)
                                <div class="job-detail-section">
                                    <div class="sub-title">
                                        <h6><strong>Job Description </strong></h6>
                                    </div>
                                    <p>{!! $job->job_description !!}</p>

                                </div>
                                @endif
                                @if($job->benefits)
                                <div class="job-detail-section">
                                    <div class="sub-title">
                                        <h6><strong>Benefits</strong></h6>
                                    </div>
                                    <ul>
                                        {!! $job->benefits !!}

                                    </ul>
                                </div>
                                @endif
                                @if($job->job_reference_id)
                                <div class="job-detail-section">
                                    <div class="sub-title">
                                        <h6><strong>Job Reference ID</strong> </h6>
                                    </div>
                                    <p>{{ $job->job_reference_id }}</p>
                                </div>
                                @endif
                                @if($job->notes)
                                <p class="mt-3"><strong>Notes:</strong> {{$job->notes}}</p>
                                @endif
                            </div>
                            
                            <div class="col-12 col-md-2">
                                @if (count($applied) == 0)
                                <form method="post" action="{{ route('apply') }}">
                                    @csrf
                                    <input type="hidden" name="jobseeker_id" value="{{ @$jobseeker->id }}">
                                    <input type="hidden" name="job_id" value="{{ $job->id }}">
                                    <?php
                                    $dt = \Carbon\Carbon::now();
                                    $deadline_date_org = $job->deadline_date->diffForHumans();
                                    // dd($deadline_date_org);
                                    $deadline_date = explode(' ', $deadline_date_org);
                                    ?>
    
                                    @if (auth()->check() && (auth()->user()->role != 'employer' && auth()->user()->role != 'super-admin' && auth()->user()->role != 'admin'))
                                        @if ($deadline_date[2] === 'ago')
                                            @if ($deadline_date[1] === 'days' && $deadline_date[0] <= 2)
                                                <span style="margin-top: -20px" class="text-danger pull-right"><strong>Expired
                                                        {{ $deadline_date_org }}</strong></span>
                                            @elseif($deadline_date[0]<=2) <span style="margin-top: -20px"
                                                    class="text-danger pull-right"><strong>Expired
                                                        {{ $deadline_date_org }}</strong></span>
                                                @else
                                                    <span class="text-danger"><strong>Expired</strong></span>
                                            @endif
                                        @else
                                            @if (($deadline_date[0] > 0 && $deadline_date[1] === 'hours') || ($deadline_date[0] >= 0 && $deadline_date[1] === 'minutes') || ($deadline_date[0] >= 0 && $deadline_date[1] === 'year'))
                                                <span
                                                    class="text-danger pull-right"><strong>{{ $deadline_date_org }}</strong></span>
                                            @endif
                                        @endif
    
                                        <button class="btn bg-green" type="submit">Apply Now</a></button>
                                    @elseif((auth()->check() && auth()->user()->role=='jobseeker') || !auth()->check())
                                        @if ($deadline_date[2] === 'ago')
                                            <span style="margin-top: -20px" class="text-danger pull-right"><strong>Expired
                                                    {{ $deadline_date_org }}</strong></span>
                                        @endif
                                        @if ($deadline_date[2] === 'from')
                                            <button class="btn bg-green" type="submit">Apply Now</a></button>
                                        @endif
                                    @elseif(auth()->user()->role=='employer' || (auth()->user()->role=='admin' ||
                                        auth()->user()->role=='super-admin'))
                                        @if ($deadline_date[2] === 'ago')
                                            <span style="margin-top: -20px" class="text-danger pull-right"><strong>Expired
                                                    {{ $deadline_date_org }}</strong></span>
                                        @else
                                            <span style="margin-top: -20px" class="text-success pull-right"><strong> Time left:
                                                    {{ $deadline_date_org }}</strong></span>
                                        @endif
                                    @else
                                        <button class="btn bg-green apply" type="submit">Apply Now</a></button>
                                    @endif
                                </form>
                                @else
                                    <p class="text-danger">Already Applied!</p>
                                @endif
                                <!-- ShareThis BEGIN -->
                                <div class="sharethis-inline-share-buttons mt-3"></div>
                                <!-- ShareThis END -->
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            @if (count($applied) == 0)
                            <form method="post" action="{{ route('apply') }}">
                                @csrf
                                <input type="hidden" name="jobseeker_id" value="{{ @$jobseeker->id }}">
                                <input type="hidden" name="job_id" value="{{ $job->id }}">
                                <?php
                                $dt = \Carbon\Carbon::now();
                                $deadline_date_org = $job->deadline_date->diffForHumans();
                                // dd($deadline_date_org);
                                $deadline_date = explode(' ', $deadline_date_org);
                                ?>

                                @if (auth()->check() && (auth()->user()->role != 'employer' && auth()->user()->role != 'super-admin' && auth()->user()->role != 'admin'))
                                    @if ($deadline_date[2] === 'ago')
                                        @if ($deadline_date[1] === 'days' && $deadline_date[0] <= 2)
                                            <span style="margin-top: -20px" class="text-danger pull-right"><strong>Expired
                                                    {{ $deadline_date_org }}</strong></span>
                                        @elseif($deadline_date[0]<=2) <span style="margin-top: -20px"
                                                class="text-danger pull-right"><strong>Expired
                                                    {{ $deadline_date_org }}</strong></span>
                                            @else
                                                <span class="text-danger"><strong>Expired</strong></span>
                                        @endif
                                    @else
                                        @if (($deadline_date[0] > 0 && $deadline_date[1] === 'hours') || ($deadline_date[0] >= 0 && $deadline_date[1] === 'minutes') || ($deadline_date[0] >= 0 && $deadline_date[1] === 'year'))
                                            <span
                                                class="text-danger pull-right"><strong>{{ $deadline_date_org }}</strong></span>
                                        @endif
                                    @endif

                                    <button class="btn bg-green" type="submit">Apply Now</a></button>
                                @elseif((auth()->check() && auth()->user()->role=='jobseeker') || !auth()->check())
                                    @if ($deadline_date[2] === 'ago')
                                        <span style="margin-top: -20px" class="text-danger pull-right"><strong>Expired
                                                {{ $deadline_date_org }}</strong></span>
                                    @endif
                                    @if ($deadline_date[2] === 'from')
                                        <button class="btn bg-green" type="submit">Apply Now</a></button>
                                    @endif
                                @elseif(auth()->user()->role=='employer' || (auth()->user()->role=='admin' ||
                                    auth()->user()->role=='super-admin'))
                                    @if ($deadline_date[2] === 'ago')
                                        <span style="margin-top: -20px" class="text-danger pull-right"><strong>Expired
                                                {{ $deadline_date_org }}</strong></span>
                                    @else
                                        <span style="margin-top: -20px" class="text-success pull-right"><strong> Time left:
                                                {{ $deadline_date_org }}</strong></span>
                                    @endif
                                @else
                                    <button class="btn bg-green apply" type="submit">Apply Now</a></button>
                                @endif
                            </form>
                            @else
                                <p class="text-danger">Already Applied!</p>
                            @endif
                            
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    @if (Auth::user() && Auth::user()->role == 'jobseeker')
                    <div class="aside-job-seeker-box">
                        <div class="row">
                            <div class="col-sm-12 col-md-3">
                                <div class="aside-image-box">

                                    @if (!$jobseeker->profile_image)
                                        <img src="{{ asset('/images/man1.png') }}" alt="Alex image">
                                    @else
                                        <img src="{{ asset('images/thumbnail/' . $jobseeker->profile_image) }}"
                                            alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-9 no-gutters">
                                <ul>
                                    <li><i class="fa fa-user"></i> {{ $jobseeker->first_name }}
                                        {{ $jobseeker->middle_name }} {{ $jobseeker->last_name }}</li>
                                    <li><i class="fa fa-envelope"></i> {{ $jobseeker->email }}</li>
                                    <li><i class="fa fa-phone"></i>{{ $jobseeker->mobile }}</li>
                                </ul>
                            </div> 
                        </div>
                    </div>
                    <div class="complete-profile-box mt-2">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 text-center">
                                <x-progressbar></x-progressbar>
                            </div>
                            @if ($profile_progres != 100)
                            <div class="col-sm-12 col-md-6 mt-3  d-flex justify-content-center align-items-center ">
                                <button class="btn bg-green"><a
                                        href="{{ route('editProfile', Auth::user()->username) }}">Update Your
                                        Profile</a></button>
                            </div>
                            @else
                            <div class="col-sm-12 col-md-6 mt-3  d-flex justify-content-center align-items-center ">
                                <p style="color:green">Congratulations!</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="similar-job-box mt-3">  
                        <div class="title-box py-2">
                            <h6 class="poppin-bold">Similar Jobs</h6>
                        </div>
                        @forelse ($similarjobs as $item)
                        <div class="similar-job mt-2">
                            <div class="row">
                                <div class="col-sm-12 ">
                                    <h6 class="text-blue poppin-bold"><a href="{{ route('jobInner', $item->slug) }}">
                                            {{ $item->job_title }}</a>
                                    </h6>
                                    <p><strong>Employer:</strong> {{ $item->employer->employer_name }}</p>
                                    <p><strong>Apply
                                            before:</strong>{{ $item->deadline_date->format(' jS \\ F Y ') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p style="color:red"> No similar jobs found!!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- update profile section ends -->

@endsection
