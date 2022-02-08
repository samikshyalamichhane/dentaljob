@extends('front::layouts.front')
@section('content')
    <section class="inner-search-form">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h3 class="poppin-bold">Locations</h3>
                    <p>Browse Jobs By Location</p>
                </div>
            </div>
        </div>
    </section>
    <section class="location-wrap py-3 py-lg-5">
        <div class="container">
            <div class="row justify-content-center">

                @forelse ($locations->unique('town_city') as $location)

                    @php
                        $jobCountByLocation = Modules\Job\Entities\Job::published()->open()
                            ->whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString())
                            // ->where('town_city', 'like', '%' . $location->town_city . '%')
                            ->where('town_city', $location->town_city)
                            ->count();
                        $dt = \Carbon\Carbon::now();
                        $jobToday = Modules\Job\Entities\Job::where('town_city', 'like', '%' . $location->town_city . '%')
                            ->whereDate('created_at', $dt->format('Y-m-d'))
                            ->count();
                    @endphp

                    <div class="col-sm-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title poppin-medium"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                    {{ ucfirst(str_replace('-', ' ', $location->town_city)) }}</h5>
                                <p><i class="fa fa-list-ul" aria-hidden="true"></i><span class="sub-text">Total
                                        Jobs</span>{{ $jobCountByLocation }} jobs</p>
                                <p><i class="fa fa-calendar-check-o" aria-hidden="true"></i><span class="sub-text">Today
                                        Jobs</span>{{ $jobToday }}</p>
                                <a
                                    href="{{ route('city.locations', $location->town_city ? $location->town_city : 'united-kingdom') }}">View
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
