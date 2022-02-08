<x-employer-layout title="All Applicant's name">
    <x-slot name="scripts">
        <script src="{{ asset('/assets/admin/vendors/DataTables/datatables.min.js') }}" type="text/javascript">
        </script>
        <script type="text/javascript">
            $(function() {
                $('#example-table').DataTable({
                    pageLength: 25,
                });
            })

        </script>
    </x-slot>


    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">All Applicant's name</div>
            </div>


            <div class="ibox-body">
                <table id="example-table" class="table table-striped table-bordered table-hover" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Applicant's name</th>
                            <th>Options</th>
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
                                    <a href="{{ route('employer.jobseeker.infos', $data->jobseeker->id) }}"
                                        class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>

                                    <a href="{{ route('employer.jobseeker.downloadcv', $data->jobseeker->id) }}"
                                        target="_blank" class="btn btn-primary btn-sm"> View CV </a>
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

    <x-slot name="styles">
        <link href="{{ asset('/assets/admin/vendors/DataTables/datatables.min.css') }}" rel="stylesheet" />

        <style media="screen">
            .adjust-delete-button {
                margin-top: -28px;
                margin-left: 37px;
            }

        </style>
    </x-slot>

</x-employer-layout>
