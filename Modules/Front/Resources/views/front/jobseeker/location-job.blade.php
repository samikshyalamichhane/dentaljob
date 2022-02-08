@extends('front::layouts.front')
@section('content')
    <!-- header ends -->
    @include('front::layouts.search')
    <!--  applied jobs list  -->
    <section class="job-section mt-4">
        <div class="container ">
            <div class="d-job-list-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box  text-blue">
                            <div class="row py-2">
                                <div class="col-9">
                                    <h6><i class="fa fa-briefcase" aria-hidden="true"></i>{{ $town_city }} Jobs</h6>
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
                                    @forelse ($job as $item)
                                        <tr>
                                            <td>
                                                <h6 class="text-blue"><i class="fa fa-id-badge" aria-hidden="true"></i>
                                                    {{ $item->job_title }}</h6>
                                            </td>
                                            <td colspan="2">
                                                <div class="media">
                                                    <div class="d-hospital-logo">
                                                        <img src="{{ asset('images/logo3.png') }}" alt="">
                                                    </div>
                                                    <div class="media-body mt-1">
                                                        {{ $item->employer_name }}
                                                    </div>
                                                </div>
                                            </td>

                                            <td>{{ $item->created_at->format(' jS \\ F Y ') }}</td>
                                            <td>{{ $item->deadline_date->format(' jS \\ F Y ') }}</td>
                                            <td><a href="{{ route('jobInner', $item->slug) }}">Details</a> </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
                                                <span style="color:red">No job found in this location! </span>
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
