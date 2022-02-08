<x-admin-layout title="All employment salary types">
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
                <div class="ibox-title">All employment salary types</div>
                <div>
                    <a class="btn btn-info btn-md" href="{{ route('employmentsalarytype.create') }}">Add employment
                        salary type</a>
                </div>
            </div>

            <div class="ibox-body">
                <table id="example-table" class="table table-striped table-bordered table-hover" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($details as $key => $data)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $data->title }}</td>
                            <td>{{ ucfirst($data->type) }}</td>
                            <td>
                                <a href="{{ route('employmentsalarytype.edit', $data->id) }}"
                                    class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

                                <form class="adjust-delete-button"
                                    action="{{ route('employmentsalarytype.destroy', $data->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm" type="submit" name="button"
                                        style="border-radius:50%"
                                        onclick="return confirm('Are you sure you want to delete this user?')"><i
                                            class="fa fa-trash"></i></button>
                                </form>
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