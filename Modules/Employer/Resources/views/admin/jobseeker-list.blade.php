<x-admin-layout title="All jobseekers">
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
                <div class="ibox-title">All jobseekers</div>
            </div>

            <div class="ibox-body">
                <table id="example-table" class="table table-striped table-bordered table-hover" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Jobseeker name</th>
                            <th>Jobseeker contact number</th>
                            <th>Jobseeker Email</th>
                            <th> Country</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($jobseeker as $key => $data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $data->first_name }} {{ $data->middle_name }} {{ $data->last_name }}</td>
                                <td>{{ $data->mobile }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->country }}</td>

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

</x-admin-layout>
