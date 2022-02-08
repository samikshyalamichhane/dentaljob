@extends('front::layouts.front')
@section('content')
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
            @foreach ($alljobs as $job)
                <div class="col-sm-12 col-md-4">
                    <div class="all-job-box">
                        <div class="card">
                            <div class="card-body">
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
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>

    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 style="text-align: center;">You do not have access to Post Job. Please login as Employer!!!</h5>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
{{-- @push('scripts')

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
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
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
            $("#target").click(function() {
                var logedInUser = `<?php echo session('frontSession'); ?>`

                let user = localStorage.setItem('logedInUser', logedInUser);
                console.log(localStorage.logedInUser.role)
                // localStorage.setItem('logedInUser', logedInUser);

                // this will redirect to login page with employer tab active
                if (AUTH_USER == '') {
                    localStorage.setItem('employerTabActive', true);
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
        });

    </script>


    <script type="application/javascript">
        $(document).ready(function() {

            $('#job_title , #job_location').on('keyup', function() {
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
    
{{-- @endpush  --}}
