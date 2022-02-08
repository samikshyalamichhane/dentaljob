@extends('front::layouts.front')

@section('content')
    <!-- edit-profile -->
    <section class="mt-4">
        <div class="container">
            <div class="edit-profile-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box  text-blue">
                            <div class="row py-2">
                                <div class="col-9">
                                    <h5 class="poppin-bold"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>All
                                        Applicants
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="d-job-list-box ">
                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="d-job-list job_type_lists">
                                        <table class="table table-borderless table-responsive">
                                            <thead>
                                                <tr class="text-green">
                                                    <th>SN</th>
                                                    <th>Full Name</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($details->applications as $key => $data)
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td>
                                                            {{ $data->jobseeker->first_name }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('employer.jobseeker.infos', $data->jobseeker->user->username) }}"
                                                                class="btn btn-success btn-sm text-white"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8">
                                                            You do not have any data yet.
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
                </div>
            </div>

        </div>
    </section>
    <!--  edit-profile ends -->
@endsection
