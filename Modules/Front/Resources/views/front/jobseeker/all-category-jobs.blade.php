@extends('front::layouts.front')
@section('content')
    <section class="inner-search-form">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h3 class="poppin-bold">Categories</h3>
                    <p>Browse Jobs By Category</p>
                </div>
            </div>
        </div>
    </section>
    <section class="location-wrap py-3 py-lg-5">
        <div class="container">
            <div class="row justify-content-center">
                @forelse ($jobcategory as $category)
                @php
                $jobCountByCategory = Modules\Job\Entities\Job::published()->open()
                    ->where('jobcategory_id', $category->id)
                    ->whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString())
                    ->count();
                @endphp
                    <div class="col-sm-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title poppin-medium"><i class="fa fa-th-large" aria-hidden="true"></i>
                                    {{ $category->title }}</h5>
                                <p><i class="fa fa-list-ul" aria-hidden="true"></i><span class="sub-text">Total
                                        Jobs</span> {{$jobCountByCategory }} </p>
                                <a href="{{ route('jobByCategories', $category->slug) }}">View
                                    Jobs</a>

                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
        </div>
    </section>
@endsection
