<x-admin-layout title="Edit Job">
    <x-slot name="scripts">
        @include('include.ckeditorsetting')
        <script>
            loadImage();

        </script>
    </x-slot>
    <div class="page-content fade-in-up">
        <form method="POST" action="{{ route('job.update', $detail->id) }}" id="form" enctype="multipart/form-data">
            <input type="hidden" name='_token' value="{{ csrf_token() }}">
            <input type="hidden" name="id" value={{ $detail->id }}>
            <input type="hidden" name="_method" value="PUT">

            {{-- <x-job-create :jobCategories="$jobCategories" :detail="$detail"> --}}
            <x-job-create :jobCategories="$jobCategories" :detail="$detail" :pubDate="$pubDate" :deadDate="$deadDate">
                <x-slot name="title">
                    <div class="ibox-title">Edit Job</div>
                </x-slot>
                <div class="form-group col-md-6">
                    <label>Select Employer:</label>
                    <select type="text" class="form-control" name="employer_id" id="employer_id">
                        <option value="" selected disabled>Choose employer</option>
                        @foreach ($employers as $employer)
                            <option {{ $detail->employer_id == $employer->id ? 'selected' : null }}
                                value="{{ $employer->id }}">{{ $employer->employer_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </x-job-create>

        </form>
    </div>

    

    <x-slot name="styles">
        <style></style>
    </x-slot>

</x-admin-layout>
<script> 
    $(document).ready(function(){
        $("#title").keyup(function(){
       $("#meta_title").val($(this).val());
    });
    });
    </script>

<script>
         $(document).ready(function() {
       var maxLength = 160;
$('#meta_description').keyup(function() {
  var textlen = maxLength - $(this).val().length;
//   console.log($(this).val().length)
  if($(this).val().length < 150){
    $('#seo_desc').empty()
$('#seo_desc').append('<strong class="seo_title_short">Your meta description length <b style="color:red">('+$(this).val().length +') </b> is short! </strong>')
  }
  if($(this).val().length >= 150 && $(this).val().length < 159 ){
    $('#seo_desc').empty()
$('#seo_desc').append('<strong class="seo_title_accept">Your meta description length <b style="color:green">('+$(this).val().length +') </b> is acceptable! </strong>')
  }
  if($(this).val().length == 160 ){
    $('#seo_desc').empty()
$('#seo_desc').append('<strong class="seo_title_short">You reached maximum length <b style="color:red">('+$(this).val().length +') </b>! </strong>')
  }
});
var maxlength = 70;
$('#meta_title').keyup(function() {
    // debugger
  var titlelen = maxlength - $(this).val().length;
//   console.log($(this).val().length)
  if($(this).val().length < 50){
    $('#seo_title').empty()
    $('#seo_title').append('<strong class="seo_title_short">Your meta title length <b style="color:red">('+$(this).val().length +')</b> is too short.</strong>');
  }
  else if($(this).val().length >= 50 && $(this).val().length < 69){
    $('#seo_title').empty()
    $('#seo_title').append('<strong class="seo_title_accept">Your meta title length <b style="color:green">('+$(this).val().length +')</b> is acceptable.</strong>');

  }
  else if($(this).val().length == 70) {
    $('#seo_title').empty()
    $('#seo_title').append('<strong class="seo_title_short">Your reached maxium length <b style="color:red">('+$(this).val().length +')</b>.</strong>');

  }
});
$(function() {
        $('#form').validate({
            errorClass: "help-block",
            rules: {
                meta_title: {
                    // required: true,
                    // minlength: 50,
                    maxlength: 70
                },
                keywords: {
                    // required: true,
                },
                meta_description: {
                    // required: true,
                    // minlength: 150,
                    maxlength: 160
                }
            },
            highlight: function(e) {
                $(e).closest(".form-group").addClass("has-error")
            },
            unhighlight: function(e) {
                $(e).closest(".form-group").removeClass("has-error")
            },
        });
    });
});
</script>
