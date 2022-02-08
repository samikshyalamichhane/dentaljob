@extends('front::layouts.front')
@section('content')
    <!-- update profile section-->
    <section class="d-complete-profile mt-3">
        <div class="container">
            <div class="complete-profile-box">
                <div class="row">
                    <div class="col-sm-12 col-md-3 text-center">
                        <x-progressbar></x-progressbar>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="complete-text-box">
                            <h6 class="poppin-regular"><i class="fa fa-user"></i>Profile Completeness</h6>
                            <p>Please complete your profile to 100% to increase the chance of getting right job matching
                                with your Profile. </p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3  d-flex justify-content-center align-items-center ">
                        <button class="btn bg-green"><a
                                href="{{ route('employer.getProfile', auth()->user()->employer->id) }}">Update Your
                                Profile</a></button>
                        <div class="close-btn">
                            x
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- update profile section ends -->
    @if(auth()->user()->employer->opened_jobs()->get()->isEmpty()){
<!-- post a job section will be shown when the user  register for the first time  -->
    <!-- post a job -->
    <section class=" mt-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="post-job-btn-box py-2">
                        <i class="fa fa-briefcase text-blue"></i>
                        <h6 class="poppin-bold text-blue text-capitalize">You have not Posted a Job yet</h6>
                        <button class="btn bg-green"><a href="{{ route('employer.job.create') }}">Post a
                                Job</a></button>
                        <p>this section will be shown when the user register for the first time and have not posted any job
                            yet.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- post a job ends -->
    }
    @endif
    

    <!--  applied jobs list  -->
    <section class="job-section mt-4">
        <div class="container ">
            <div class="d-job-list-box mt-3">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box  text-blue">
                            <div class="row py-2">
                                <div class="col-6 col-md-9">
                                    <h6><i class="fa fa-briefcase" aria-hidden="true"></i>Open Jobs</h6>
                                </div>
                                <div class="col-6 col-md-3 text-right">
                                    <a href="{{ route('employer.job.index') }}" class="bg-blue">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <div class="d-job-list">
                            <table class="table table-borderless table-responsive">
                                <thead>
                                    <tr class="text-green">
                                        <th>Position</th>
                                        <th colspan="2">Hospital</th>
                                        <th>Published On</th>
                                        <th>Apply Before</th>
                                        <th>Details</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (auth()->user()->employer->opened_jobs()->get() as $opened_job)
                                        <tr>
                                            <td>
                                                <h6 class="text-blue"><i class="fa fa-id-badge" aria-hidden="true"></i>
                                                    {{ $opened_job->job_title }}
                                                </h6>
                                            </td>
                                            <td colspan="2">
                                                <div class="media">
                                                    <div class="d-hospital-logo">
                                                        <img src="{{ asset('images/logo3.png') }}" alt="">
                                                    </div>
                                                    <div class="media-body mt-1">
                                                        {{ $opened_job->employer_name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $opened_job->published_date ? $opened_job->published_date->format(' jS \\ F Y ') : null }}
                                            </td>
                                            <td>{{ $opened_job->deadline_date ? $opened_job->deadline_date->format(' jS \\ F Y ') : null }}
                                            </td>
                                            <td><a href="{{ route('jobInner', $opened_job->slug) }}">Details</a> </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <span class="color:red">No Jobs Found!!</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-job-list-box mt-3">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box  text-blue">
                            <div class="row py-2">
                                <div class="col-6 col-md-9">
                                    <h6><i class="fa fa-briefcase" aria-hidden="true"></i>Closed Jobs</h6>
                                </div>
                                <div class="col-6 col-md-3 text-right">
                                    <a href="{{ route('employer.job.index') }}" class="bg-blue">View All</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <div class="d-job-list">
                            <table class="table table-borderless  table-responsive">
                                <thead>
                                    <tr class="text-green">
                                        <th>Position</th>
                                        <th colspan="2">Hospital</th>
                                        <th>Published On</th>
                                        <th>Apply Before</th>
                                        <th>Details</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (auth()->user()->employer->closed_jobs()->get() as $closed_job)
                                        <tr>
                                            <td>
                                                <h6 class="text-blue"><i class="fa fa-id-badge" aria-hidden="true"></i>
                                                    {{ $closed_job->job_title }}
                                                </h6>
                                            </td>
                                            <td colspan="2">
                                                <div class="media">
                                                    <div class="d-hospital-logo">
                                                        <img src="{{ asset('images/logo3.png') }}" alt="">
                                                    </div>
                                                    <div class="media-body mt-1">
                                                        {{ $closed_job->employer_name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $closed_job->published_date ? $closed_job->published_date->format(' jS \\ F Y ') : null }}
                                            </td>
                                            <td>{{ $closed_job->deadline_date ? $closed_job->deadline_date->format(' jS \\ F Y ') : null }}
                                            </td>
                                            <td><a href="{{ route('jobInner', $closed_job->slug) }}">Details</a> </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <span class="color:red">No Jobs Found!!</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-job-list-box mt-3">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box  text-blue">
                            <div class="row py-2">
                                <div class="col-6 col-md-9">
                                    <h6><i class="fa fa-briefcase" aria-hidden="true"></i>Paused Jobs</h6>
                                </div>
                                <div class="col-6 col-md-3 text-right">
                                    <a href="{{ route('employer.job.index') }}" class="bg-blue">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <div class="d-job-list">
                            <table class="table table-borderless  table-responsive">
                                <thead>
                                    <tr class="text-green">
                                        <th>Position</th>
                                        <th colspan="2">Hospital</th>
                                        <th>Published On</th>
                                        <th>Apply Before</th>
                                        <th>Details</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (auth()->user()->employer->paused_jobs()->get() as $paused_job)
                                        <tr>
                                            <td>
                                                <h6 class="text-blue"><i class="fa fa-id-badge" aria-hidden="true"></i>
                                                    {{ $paused_job->job_title }}
                                                </h6>
                                            </td>
                                            <td colspan="2">
                                                <div class="media">
                                                    <div class="d-hospital-logo">
                                                        <img src="{{ asset('images/logo3.png') }}" alt="">
                                                    </div>
                                                    <div class="media-body mt-1">
                                                        {{ $paused_job->employer_name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $paused_job->published_date ? $paused_job->published_date->format(' jS \\ F Y ') : null }}
                                            </td>
                                            <td>{{ $paused_job->deadline_date ? $paused_job->deadline_date->format(' jS \\ F Y ') : null }}
                                            </td>
                                            <td><a href="{{ route('jobInner', $paused_job->slug) }}">Details</a> </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <span class="color:red">No Jobs Found!!</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  applied job list ends -->
@endsection

@push('scripts')
    <script src="/assets/front/js/jquery.min.js"></script>
    <script src="/assets/front/js/bootstrap.js"></script>
    <script src="/assets/front/js/custom.js"></script>
@endpush
