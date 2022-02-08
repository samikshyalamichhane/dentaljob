@push('styles')
<style>
    .help-block {
        display: block;
        font-size: 13px;
        margin-bottom: 0;
        margin-top: 2px;
        color: #e74c3c;
    }
</style>
<style>
    #seo_title{
        
    }
    .seo_title_accept{
        color:green
    }

    .seo_title_short{
        color:red
    }
</style>

@endpush

<x-admin-layout title="Site Setting">

    <x-slot name="scripts">
        <script>
            loadImage();


        </script>
    </x-slot>

    <div class="page-content fade-in-up">
        <!-- <form method="post" id="form" action="{{ route('emailsetting.update', $detail->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Site Setting --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Email Setting</div>
                        </div>
                        <div class="ibox-body" style="">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>Activation Email Body</label>
                                        <textarea name="email_desc" id="email_desc" 
                                    class="form-control" rows="10" placeholder="Enter Description"
                                    cols="100">{{ $detail->email_desc  }} </textarea>
                                </div>

                            </div>
                            <div class="check-list">
                                <label class="ui-checkbox ui-checkbox-primary">
                                    <input name="publish" type="checkbox"
                                        {{ $detail->publish == 1 ? 'checked' : '' }}>
                                    <span class="input-span"></span>Publish</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form> -->
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Mails</th>
      
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Jobseeker Account Activation Email</th>
      <td><a href="#" class="editButton btn btn-success btn-sm"><i class="fa fa-edit"></i></a></td>
    </tr>
    <tr>
      <th scope="row">Employer Account Activation Email</th>
      <td><a href="#" class="employereditButton btn btn-success btn-sm"><i class="fa fa-edit"></i></a></td>
    </tr>
    <tr>
      <th scope="row">Job Application Email</th>
      <td><a href="#" class="jobButton btn btn-success btn-sm"><i class="fa fa-edit"></i></a></td>
    </tr>
    <tr>
      <th scope="row">Job Application Reply</th>
      <td colspan="2"><a href="#" class="jobreplyButton btn btn-success btn-sm"><i class="fa fa-edit"></i></a></td>
    </tr>
  </tbody>
</table>

 
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Email Activation Message</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('emailsetting.update', $detail->id) }}" method="post">
          @method('PUT')
            {{csrf_field()}}
            <div class="form-group">
              <label>Email From Name</label>
              <input type="text" name="activation_email_from_name" id="activation_email_from_name" value="{{$detail->activation_email_from_name}}"/>
            </div>
            <div class="form-group">
              <label>Activation Email Subject</label>
              <input type="text" name="activation_email_subject" id="activation_email_subject" value="{{$detail->activation_email_subject}}"/>
            </div>
            <div class="form-group">
            
                
                    <label>Activation Email Body</label>
                        <textarea name="email_desc" id="email_desc" 
                    class="form-control" rows="10" placeholder="Enter Description"
                    cols="100">{{ $detail->email_desc  }} </textarea>
                

                            
            </div>
            

            <div class="form-group">
              <input type="submit" name="submit" value="submit" class="btn btn-success mt-3">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

   <!--Emplyer Activation  Modal -->
   <div class="modal fade" id="employerModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Email Activation Message</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('emailsetting.update', $detail->id) }}" method="post">
          @method('PUT')
            {{csrf_field()}}
            <div class="form-group">
              <label>Email From Name</label>
              <input type="text" name="employer_email_from_name" id="employer_email_from_name" value="{{$detail->employer_email_from_name}}"/>
            </div>
            <div class="form-group">
              <label>Activation Email Subject</label>
              <input type="text" name="employer_activation_email_subject" id="employer_activation_email_subject" value="{{$detail->employer_activation_email_subject}}"/>
            </div>
            <div class="form-group">
            
                
                    <label>Activation Email Body</label>
                        <textarea name="employer_activation_email_body" id="employer_activation_email_body" 
                    class="form-control" rows="10" placeholder="Enter Description"
                    cols="100">{{ $detail->employer_activation_email_body  }} </textarea>
                

                            
            </div>
            

            <div class="form-group">
              <input type="submit" name="submit" value="submit" class="btn btn-success mt-3">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

   <!-- Job Modal -->
   <div class="modal fade" id="jobModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Email Activation Message</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('emailsetting.update', $detail->id) }}" method="post">
          @method('PUT')
            {{csrf_field()}}

            <div class="form-group">
              <label>Email From Name</label>
              <input type="text" name="job_email_from_name" id="job_email_from_name" value="{{$detail->job_email_from_name}}"/>
            </div>
            
            <div class="form-group">
              <label>Job Application Email Subject</label>
              <input type="text" name="job_app_subject" id="product_name" value="{{@$detail->job_app_subject}}"/>
            </div>
            <div class="form-group">
            
                
                    <label>Activation Email Body</label>
                        <textarea name="job_app" id="job_app" 
                    class="form-control" rows="10" placeholder="Enter Description"
                    cols="100">{{ $detail->job_app  }} </textarea>
                

                            
            </div>
            

            <div class="form-group">
              <input type="submit" name="submit" value="submit" class="btn btn-success mt-3">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <!-- Job Reply Modal -->
  <div class="modal fade" id="jobreplyModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Email Activation Message</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('emailsetting.update', $detail->id) }}" method="post">
          @method('PUT')
            {{csrf_field()}}

            <div class="form-group">
              <label>Email From Name</label>
              <input type="text" name="job_reply_email_from_name" id="job_reply_email_from_name" value="{{$detail->job_reply_email_from_name}}"/>
            </div>
            
            <div class="form-group">
              <label>Job Application Email Subject</label>
              <input type="text" name="job_app_reply_subject" id="product_name" value="{{@$detail->job_app_reply_subject}}"/>
            </div>
            <div class="form-group">
            
                
                    <label>Activation Email Body</label>
                        <textarea name="job_app_reply" id="job_app_reply" 
                    class="form-control" rows="10" placeholder="Enter Description"
                    cols="100">{{ $detail->job_app_reply  }} </textarea>
                

                            
            </div>
            

            <div class="form-group">
              <input type="submit" name="submit" value="submit" class="btn btn-success mt-3">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
    <script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script src="{{ asset('assets/admin/vendors/jquery-validation/dist/jquery.validate.min.js') }}"
        type="text/javascript"></script>

        <script>
            var options = {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
            };
        
            CKEDITOR.replace('email_desc', options);
            CKEDITOR.config.height = 200;
            CKEDITOR.config.colorButton_colors = 'CF5D4E,454545,FFF,CCC,DDD,CCEAEE,66AB16';
            CKEDITOR.config.colorButton_enableMore = true;
            CKEDITOR.config.floatpanel = true;
            CKEDITOR.config.removeButtons =
                'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,CreateDiv,BidiLtr,BidiRtl,Language,PageBreak,Styles,Format,Maximize,ShowBlocks,About';
        
                CKEDITOR.replace('job_app', options);
            CKEDITOR.config.height = 200;
            CKEDITOR.config.colorButton_colors = 'CF5D4E,454545,FFF,CCC,DDD,CCEAEE,66AB16';
            CKEDITOR.config.colorButton_enableMore = true;
            CKEDITOR.config.floatpanel = true;
            CKEDITOR.config.removeButtons =
                'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,CreateDiv,BidiLtr,BidiRtl,Language,PageBreak,Styles,Format,Maximize,ShowBlocks,About';
        
                CKEDITOR.replace('job_app_reply', options);
            CKEDITOR.config.height = 200;
            CKEDITOR.config.colorButton_colors = 'CF5D4E,454545,FFF,CCC,DDD,CCEAEE,66AB16';
            CKEDITOR.config.colorButton_enableMore = true;
            CKEDITOR.config.floatpanel = true;
            CKEDITOR.config.removeButtons =
                'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,CreateDiv,BidiLtr,BidiRtl,Language,PageBreak,Styles,Format,Maximize,ShowBlocks,About';
        
                
                CKEDITOR.replace('employer_activation_email_body', options);
            CKEDITOR.config.height = 200;
            CKEDITOR.config.colorButton_colors = 'CF5D4E,454545,FFF,CCC,DDD,CCEAEE,66AB16';
            CKEDITOR.config.colorButton_enableMore = true;
            CKEDITOR.config.floatpanel = true;
            CKEDITOR.config.removeButtons =
                'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,CreateDiv,BidiLtr,BidiRtl,Language,PageBreak,Styles,Format,Maximize,ShowBlocks,About';
        
        </script>

        <script> 
            var edit = $('.editButton');
            $(edit).on('click', function() {
                $('#myModal').modal('show');
            });
            
            $('.jobButton').on('click', function() {
                $('#jobModal').modal('show');
            });

            $('.jobreplyButton').on('click', function() {
                $('#jobreplyModal').modal('show');
            });

            $('.employereditButton').on('click', function() {
                $('#employerModal').modal('show');
            });

        </script>

    

</x-admin-layout>
