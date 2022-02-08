@extends('front::layouts.front')
@section('content')


    <!-- main body  -->
    <!-- advertsiern your dental job -->
    <section class="mt-3 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (session('message'))
                        <x-alert type="{{ 'success' }}" message="{{ session('message') }}"></x-alert>
                    @endif
                    <div class="ads-job-section">
                        <div class="ads-tittle">
                            <h2 class="text-capitalize poppin-medium">Advertise your dental job for FREE </h2>
                            <h6> Reach out to hundreds of active dental jobseekers. Browse and search through candidate
                                profiles to find the right one for your practice.
                            </h6>
                        </div>
                        {{-- <div id="progress">Please wait...</div> --}}
                        <div class="ads-asset-upload">
                            <div class="row">
                                <div class="col-sm-12 col-md-8">
                                <a href="#" id="cvregister" class="d-btn resume-btn "> Register Your CV Now </a>
                                <!-- {{ auth()->check() ? route('allJobs') : route('jobseeker.register') }} -->
                                
                                    <!-- <div class="media">
                                        <div class="pointer-icon">
                                            <img src="{{ asset('images/Asset-1.png') }}" alt="" srcset="">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="text-capitalize poppin-regular text-blue">Get Hired !
                                            </h4>

                                            <a class="ulpoad-text"
                                                href="{{ auth()->check() ? route('allJobs') : route('jobseeker.register') }}">Get
                                                your
                                                Resume Here</a>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="col-sm-12 col-md-4 mt-3 mt-lg-0 text-sm-center text-lg-right d-flex align-items-center">
                                    <a href="#" id="postjob" class="d-btn post-btn ">Post
                                        Your Job
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- searchbox -->
    <section class="search-form mt-3 py-2">
        <div class="container bdr-btm pb-5">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <!-- <div class="share-like-box">
                        <span class="fa fa-thumbs-up"><label class="poppin-regular">Like</label> </span>
                        <span class="fa fa-share"><label class="poppin-regular">share</label></span>
                    </div> -->
                    <h2 class="text-blue mt-4 poppin-regular"><img src="./images/search-blue.png" alt="" srcset=""> Search
                        Jobs</h2>
                </div>
            </div>
            <div class="form mt-3 mt-lg-4">
                <form action="{{ route('search') }}" method="get" class="form row justify-content-center">
                    <div class="from-group col-sm-5 mt-2 no-gutters">
                    <select class="js-example-basic-single  form-control job-input" id="job_title" name="title">
                    @forelse ($categories as $item)
                            <option  value="{{$item->title}}" >{{ ucfirst($item->title) }}</option>
                            

                        @empty

                        @endforelse
                    </select>
                        <!-- <input type="text" class="form-control job-input" name="title" id="job_title"
                            placeholder="What: Job Title Keywords, Company" autocomplete="off"/>
                        <div class="searched_title_options">

                        </div> -->
                    </div>
                    <div class="from-group col-sm-4 mt-2 no-gutters">
                    <select class="js-example-basic-multiple  form-control location-input" id="job_location" name="location">
                    @forelse ($locations->unique('town_city') as $item)
                            <option  value="{{$item->town_city}}">{{ ucfirst(str_replace('-', ' ', $item->town_city)) }}</option>
                        @empty
                        @endforelse
                    </select>
                        <!-- <input type="text" class="form-control location-input" name="location" id="job_location"
                            placeholder="Where: City, Country" autocomplete="off">
                        <div class="searched_locations_options">

                        </div> -->
                    </div>
                    <div class="from-group col-sm-3 mt-2  no-gutters">
                        <button class="search-btn bg-green"  type="submit"><i class="fa fa-search"></i>
                            search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
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
                    <a href="{{@$advertisements->link}}" target="_blank"><img
                            src="{{ asset('images/main/' . ($advertisements == null ? 'bannerv.gif' : $advertisements->image)) }}"
                            alt="{{ $advertisement->title ?? 'advertisement-test' }}" ></a>
                </div>
                <div class="col-sm-12 col-md-8">
                    <div class="job-list">

                        @foreach ($alljobs as $job)
                            <div class="job-box mb-3">
                                <h2 class="text-capitalize text-blue"><a
                                        href="{{ route('jobInner', $job->slug) }}">{{ $job->job_title }}</a>
                                </h2>
                                <p class="p-date">Published on:
                                    @if ($job->published_date)
                                        <span>{{ $job->published_date->format(' jS \\ F Y ') }}</span>
                                    @endif

                                </p>
                                <p>{!! Str::limit($job->job_description, 150) !!}<a href="{{ route('jobInner', $job->slug) }}">Read More</a>
                                </p>
                            </div>
                        @endforeach
                    </div>
                    {{ $alljobs->links('pagination.default') }}
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 style="text-align: center;">You do not have access to Post Job. Please login as Employer!!!</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 style="text-align: center;">You are logged in as Admin/Super Admin. Please login as Jobseeker!!!</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="employerModal" tabindex="-1" role="dialog" aria-labelledby="employerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 style="text-align: center;">You are logged in as Employer. Please login as Jobseeker to register your cv!!!</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() { 
        $(".alert" ).fadeOut(3000);

    });
     </script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script> --}}
    {{-- <script>
    
        if ($('#job_title').val() == 0 && $('#job_location').val() == 0) {
            //    $('#searchSubmit').appendClass('disable')
            $('#searchSubmit').prop('disabled', true);
        }

        $('#job_title').on('keyup', function() {
            $('#searchSubmit').prop('disabled', false);
        })

        $('#job_location').on('keyup', function() {
            $('#searchSubmit').prop('disabled', false);
        })

    </script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script>
        if ($('#job_title').val() == 0 && $('#job_location').val() == 0) {
            //    $('#searchSubmit').appendClass('disable')
            $('#searchSubmit').prop('disabled', true);
        }

        $('#job_title').on('keyup', function() {
            $('#searchSubmit').prop('disabled', false);
        })

        $('#job_location').on('keyup', function() {
            $('#searchSubmit').prop('disabled', false);
        })

        $('#job_title').keyup(function() {
            var keyword = $("#search").val();
            var dataString = 'keyword=' + keyword;
        })

    </script>
    <!-- jQuery -->
    <!-- BS JavaScript -->

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">

        const AUTH_USER = '{{ auth()->user() ? auth()->user()->role : false }}';
        console.log(AUTH_USER)
        $(document).ready(function() {
            
            $("#postjob").click(function() {
                var logedInUser = `<?php echo session('frontSession'); ?>`

                let user = localStorage.setItem('logedInUser', logedInUser);
                console.log(localStorage.logedInUser.role)
                // localStorage.setItem('logedInUser', logedInUser);

                // this will redirect to login page with employer tab active
                // if (AUTH_USER == '') {
                //     localStorage.setItem('employerTabActive', true);
                //     return location.href = "{{ route('employer.job.create') }}";
                // }
                if (AUTH_USER == '') {
                    localStorage.setItem('mySelect', 1);
                    return location.href = "{{ route('employer.job.create') }}";
                }
                if (AUTH_USER == 'employer') {
                    return location.href = "{{ route('employer.job.create') }}"
                }
                if (AUTH_USER == 'admin') {
                    return location.href = "{{ url('admin/job/create') }}"
                }
                if (AUTH_USER == 'super-admin') {
                    return location.href = "{{ url('admin/job/create') }}"
                }
                if (AUTH_USER == 'jobseeker') {
                    $('#exampleModal').modal('show')
                    // $('#myModal').modal('show')
                    // $('#progress').show();
                } else {
                    console.log('error')
                    // sessionStorage.clear()
                    // window.localStorage.clear();
                    // sessionStorage.removeItem('logedInUser');
                    // localStorage.clear();
                }
                window.location.href = "{{ route('jobseeker.login') }}";


                // $.session.set("employerTab", "employerTab");

                // var yetVisited = localStorage['logedInUser'];
                // debugger
                // if (!yetVisited)
                //     localStorage['visited'] = "yes";
                // else
                //     localStorage['visited'] = "no";
                // debugger
                // if (employerTab === 'tab-fade pane')
                //     debugger
            });
            $("#cvregister").click(function() {
                var logedInUser = `<?php echo session('frontSession'); ?>`
                let user = localStorage.setItem('logedInUser', logedInUser);
                console.log(localStorage.logedInUser.role)
                if (AUTH_USER == 'admin') {
                    
                    $('#myModal').modal('show')
                }
                if (AUTH_USER == 'super-admin') {
                    $('#myModal').modal('show')
                }
                if (AUTH_USER == 'employer') {
                    $('#employerModal').modal('show')
                }
                if (AUTH_USER == 'jobseeker') {

                    console.log(AUTH_USER)
        
                }
                
                if (AUTH_USER == '') {
                    return location.href = "{{ route('jobseeker.register') }}";
                }
            });
        });

    </script>
<script type="application/javascript">
      $(document).ready(function() { 
        
            $("#categories").keyup(function(){ 
                debugger 
        $("input").css("background-color", "pink");  
    
      });
      });

</script>

    {{-- <script type="application/javascript">
        $(document).ready(function() {

            $('#job_title , #job_location').on('keyup', function() {
                debugger
                var title = $('#job_title').val();
                var location = $('#job_location').val();
                if (title.length >= 2 || location.length >= 2) {
                    $.ajax({
                        type: "GET",
                        url: '/search-on-key-up',
                        data: {
                            title: title,
                            location: location
                        },
                        success: function(response) {
                            debugger
                            console.log(response)
                            $('.searched_title_options').empty()
                            $('.searched_locations_options').empty()
                            $.each(response.data, function(key, job) {
                                $('.searched_title_options').append(
                                    `<a href="/job-detail/${job.slug}" target="_blank">${job.job_title}</a> <br/>`
                                )
                                $('.searched_locations_options').append(
                                    `<a href="/job-detail/${job.slug}" target="_blank">${job.town_city}</a> <br/> `
                                )

                            });

                        }
                    });
                }

            });

        });

    </script> --}}
    
@endpush
