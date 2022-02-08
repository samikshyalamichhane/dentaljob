<x-admin-layout title="All pages">
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
                <div class="ibox-title">All pages</div>
                <div>
                    <a class="btn btn-info btn-md" href="{{ route('page.create') }}">Add page</a>
                </div>
            </div>


            <div class="ibox-body">
                <table id="example-table" class="table table-striped table-bordered table-hover" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Published</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($details as $key => $data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->slug }}</td>
                                <td><a href="/images/main/{{ $data->image }}" target="_blank"><img
                                            style="height:120px; width: 120px;"
                                            src="{{ $data->image ? asset('/images/thumbnail/' . $data->image) : '/assets/admin/images/image.jpg' }}"></a>
                                </td>
                                <td>{{ $data->publish == 1 ? 'Published' : 'Not Published' }}</td>

                                <td>
                                    <a href="{{ route('page.edit', $data->id) }}" class="btn btn-success btn-sm"><i
                                            class="fa fa-edit"></i></a>
                                    @if (!in_array($data->slug, $readonlyslug))

                                        <form class="adjust-delete-button" action="{{ route('page.destroy', $data->id) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm" type="submit" name="button"
                                                style="border-radius:50%"
                                                onclick="return confirm('Are you sure you want to delete this page?')"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    @endif

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