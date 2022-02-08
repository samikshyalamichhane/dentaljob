@extends('front::layouts.front')

@push('scripts')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $('.job_type').change(async function(e) {
            $('.loader__overlay__box').removeClass('d-none')
            $('.job_type_lists').addClass('d-none')
            var element = $(this).find('option:selected')
            const url = element.attr('data-url')
            const response = await axios.get(url)
            $('.job_type_title').html(response.data.type)
            $('.job_type_lists').html(response.data.html)

            $('.loader__overlay__box').addClass('d-none')
            $('.job_type_lists').removeClass('d-none')

        });

    </script>
@endpush

@section('content')
    <!-- edit-profile -->
    <section class="mt-4">
        <div class="container">
            <div class="edit-profile-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box  text-blue">
                            <div class="row py-2">
                                <div class="col-6 col-md-9">
                                    <h5><i class="fa fa-pencil-square-o" aria-hidden="true"></i>All Jobs
                                    </h5>
                                </div>
                                <div class="col-6 col-md-3 text-right">
                                    <select class="form-control job_type">
                                        <option value="open" data-url="{{ route('employer.job.jobtype', 'open') }}">Open
                                            Job </option>
                                        <option value="paused" data-url="{{ route('employer.job.jobtype', 'paused') }}">
                                            Paused Job</option>
                                        <option value="closed" data-url="{{ route('employer.job.jobtype', 'closed') }}">
                                            Close Job</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="d-job-list-box ">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="title-box  text-blue">
                                        <div class="row py-2">
                                            <div class="col-9">
                                                <h6><i class="fa fa-briefcase" aria-hidden="true"></i><span
                                                        class="job_type_title text-capitalize">Opened</span> Jobs</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="d-job-list job_type_lists">
                                        <x-front-job-list :jobs="$details" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="loader__overlay__box d-none">
            <div class="loading">
                <x-loader />
            </div>
        </div>
    </section>
    <!--  edit-profile ends -->
@endsection
