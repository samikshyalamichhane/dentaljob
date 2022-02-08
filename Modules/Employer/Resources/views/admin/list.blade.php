<x-admin-layout title="All employers">
    <x-slot name="scripts">
        <script src="{{ asset('/assets/admin/vendors/DataTables/datatables.min.js') }}" type="text/javascript"></script>
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
                <div class="ibox-title">All employers</div>
            </div>

            <div class="ibox-body">
                <table id="example-table" class="table table-striped table-bordered table-hover" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>User</th>
                            <th>Employer name</th>
                            <th>Employer contact number</th>
                            <th>Employer designation</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($details as $key => $data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $data->user->name ?? '' }}</td>
                                <td>{{ $data->employer_name }}</td>
                                <td>{{ $data->employer_contact_number }}</td>
                                <td>{{ $data->employer_designation }}</td>
                                <td>{{ $data->publish == 1 ? 'Published' : 'Not Published' }}</td>
                                <td>
                                    <a href="{{ route('admin.employer.edit', $data->id) }}"
                                        class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
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

</x-admin-layout>
