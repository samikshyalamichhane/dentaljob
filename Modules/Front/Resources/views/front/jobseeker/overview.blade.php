@extends('front::layouts.front')
@section('content')

    <!-- searchbox -->
    @include('front::layouts.search')
    <!-- search ends -->
    <!-- update profile section-->
    @include('front::layouts.complete_profile')
    <!-- update profile section ends -->



   
  <!-- latest jobs list  -->
    
    <section class="job-section mt-4">
        <div class="container ">
            <div class="d-job-list-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box  text-blue">
                            <div class="row py-2">
                                <div class="col-9">
                                    <h6><i class="fa fa-briefcase" aria-hidden="true"></i>Latest Jobs</h6>
                                </div>
                                <div class="col-3 text-right">
                                    <a href="{{route('allJobs')}}" class="bg-blue">View All</a>
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
                                @forelse ($searchResults as $job)
                                <tbody>


                                    @forelse ($job as $jobs)
                                        <tr>
                                            <td>
                                                <h6 class="text-blue"><i class="fa fa-id-badge" aria-hidden="true"></i>
                                                    {{ $jobs->job_title }}</h6>
                                            </td>
                                            <td colspan="2">
                                                <div class="media">
                                                    <div class="d-hospital-logo">
                                                        <img src="{{ asset('images/logo3.png') }}" alt="">
                                                    </div>
                                                    <div class="media-body mt-1">
                                                        {{ $jobs->employer->employer_name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $jobs->published_date ? $jobs->published_date->format(' jS \\ F Y ') : null }}</td>
                                            <td>{{ $jobs->deadline_date ? $jobs->deadline_date->format(' jS \\ F Y ') : null }}</td>
                                            <td><a href="{{ route('jobInner', $jobs->slug) }}">Details</a> </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <span class="color:red">No Jobs Found!!</span>
                                            </td>
                                        </tr>
                                    @endforelse




                                </tbody>
                            @empty
                                <tr>
                                    <td>
                                        <span style="color:red">No Jobs Matching your profile Found!! </span>
                                    </td>
                                </tr>
                            @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- latest job list ends -->
   
    <!-- latest jobs list  -->
    <!--  applied jobs list  -->
    <section class="job-section mt-4">
        <div class="container ">
            <div class="d-job-list-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box  text-blue">
                            <div class="row py-2">
                                <div class="col-9">
                                    <h6><i class="fa fa-briefcase" aria-hidden="true"></i>Applied Jobs</h6>
                                </div>
                                <div class="col-3 text-right">
                                    <a href="{{ route('appliedJobs', Auth::user()->username) }}" class="bg-blue">View All</a>
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
                                    @forelse ($applies as $item)
                                    <tr>
                                        <td>
                                            <h6 class="text-blue"><i class="fa fa-id-badge" aria-hidden="true"></i> {{ $item->job_title }}</h6>
                                        </td>
                                        <td colspan="2">
                                            <div class="media">
                                                <div class="d-hospital-logo">
                                                    <img src="{{ asset('images/logo3.png') }}" alt="">
                                                </div>
                                                <div class="media-body mt-1">
                                                    {{ $item->employer->employer_name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->created_at->format(' jS \\ F Y ') }}</td>
                                            <td>{{ $item->deadline_date->format(' jS \\ F Y ') }}</td>
                                            <td><a href="{{ route('jobInner', $item->slug) }}">Details</a> </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>
                                            <span style="color:red">No Jobs Found!!</span>
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
    <!-- latest job list ends -->
    <!--  applied jobs list  -->
    
@endsection
