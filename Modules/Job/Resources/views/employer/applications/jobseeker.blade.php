<x-employer-layout title="Jobseeker">
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
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Applicant's Info</div>

                        <div class="ibox-tools">

                        </div>
                    </div>

                    <!-- <h3>Blog Details</h3> -->
                    <div class="ibox-body" style="">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Heading</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="info">
                                    <td>Name</td>
                                    <td>{{ $detail->first_name }} {{ $detail->middle_name }} {{ $detail->last_name }}
                                    </td>
                                </tr>
                                <tr class="success">
                                    <td>Mobile</td>
                                    <td>{{ $detail->mobile }} </td>
                                </tr>
                                <tr class="primary">
                                    <td>Email</td>
                                    <td>{{ $detail->email }} </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
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
