<x-employer-layout title="All Jobs">
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
                <div class="ibox-title">All Jobs</div>
                <div>
                    <a class="btn btn-info btn-md" href="{{ route('job.create') }}">Add job</a>
                </div>
            </div>


            <div class="ibox-body">
                <table id="example-table" class="table table-striped table-bordered table-hover" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Job Category</th>
                            <th>Title</th>

                            <th>Published</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($jobs as $key => $data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    {{ $data->jobcategory->title }}
                                </td>
                                <td>{{ $data->job_title }}</td>


                                <td>{{ $data->publish == 1 ? 'Published' : 'Not Published' }}</td>
                                <td>
                                    <a href="{{ route('employer.job.edit', $data->id) }}" class="btn btn-success btn-sm"><i
                                            class="fa fa-edit"></i></a>
                                    @if ($data->applications_count > 0)
                                        <a href="{{ route('employer.applications', $data->id) }}" class="btn btn-primary">
                                            Applications <span
                                                class="badge badge-light text-dark">{{ $data->applications_count }}</span>
                                        </a>
                                    @endif
                                    <form action="{{ route('employer.job.destroy', $data->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" type="submit" name="button"
                                            style="border-radius:50%"
                                            onclick="return confirm('Are you sure you want to delete this Job?')"><i
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

</x-employer-layout>
