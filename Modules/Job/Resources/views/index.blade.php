<x-admin-layout title="All Jobs">
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
                            <th>Title</th>
                            <th>Employer Name</th>
                            <th>Published</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($details as $key => $data)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $data->job_title}}</td>
                            <td>{{ $data->employer->user->name }}</td>
                            <td>{{ $data->publish == 1 ? 'Published' : 'Not Published' }}</td>
                            <td>
                                <a href=""  class="btn btn-success btn-sm view" data-id="{{$data->id}}"><i
                                    class="fa fa-eye"></i></a>
                                <a href="{{ route('job.edit', $data->id) }}" class="btn btn-success btn-sm"><i
                                        class="fa fa-edit"></i></a>

                                @if ($data->applications_count > 0)
                                <a href="{{ route('admin.applications', $data->id) }}" class="btn btn-primary">
                                    Applications <span
                                        class="badge badge-light text-dark">{{ $data->applications_count }}</span>
                                </a>
                                @endif

                                <form action="{{ route('job.destroy', $data->id) }}" method="post">
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
      <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Job Details</h4>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  
  
  @push('scripts')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script> 
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});</script>
<script>
$(document).ready(function(){
    $(".view").click(function(e) {
        e.preventDefault();
        id=$(this).data('id');
        $.ajax({
            method:"post",
            url:"{{route('viewJob')}}",
            data:{id:id},
            success:function(data){
                console.log(data);
                $('#myModal .modal-body').html(data);
                $('#myModal').modal('show');
            }
        });
    });
});
</script>
@endpush
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
