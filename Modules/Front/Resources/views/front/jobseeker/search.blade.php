@extends('front::layouts.front')
@section('content')
    <!-- login-form -->
    <!-- searchbox -->
    @include('front::layouts.search')
    <!-- jobs list  -->
    <section class="job-section mt-4">
        <div class="container ">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="img-box">
                        <img src="./images/job-blue.png" alt="" srcset="">
                    </div>
                    <span class="jobs-text  text-blue">Jobs</span>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-12 col-md-4">
                    <a href="#" target="_blank"><img src="{{ asset('images/main/' . @$advertisements->image) }}" alt=""
                            srcset=""></a>
                </div>
                <div class="col-sm-12 col-md-8">
                    <div class="job-list">
                            @forelse ($searched as $item)
                            {{-- @php
                                $item = $items
                                        ->whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString());
                                        dd($item);
                            @endphp --}}
                            <div class="job-box mb-3">
                                <h5 class=" text-capitalize text-blue">{{ $item->job_title }}</h5>
                                <p class="p-date">Published on:
                                    <span>{{ $item->published_date->format(' jS \\ F Y ') }}</span>
                                </p>
                                <p>{!! Str::limit($item->job_description, 150) !!}<a href="{{ route('jobInner', $item->slug) }}" target="_blank">Read
                                        More</a></p>
                            </div>
                            @empty
                            
                            <div class="job-box mb-3">
                                <h5 class=" text-capitalize text-blue">No Search Results Found!!</h5>
                            </div>
                                
                            @endforelse

                    </div>
                    {{ $searched->withQueryString()->links('pagination.default') }}

                </div>

            </div>
        </div>
    </section>

@endsection
