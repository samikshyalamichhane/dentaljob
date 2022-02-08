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
    input[type="file"] {
      display: block;
    }
    .imageThumb {
      max-height: 450px;
      border: 2px solid;
      padding: 1px;
      cursor: pointer;
    }
    .pip {
      display: inline-block;
      margin: 10px 10px 0 0;
    }
    .remove {
      display: block;
      background: #444;
      border: 1px solid black;
      color: white;
      text-align: center;
      cursor: pointer;
    }
    .remove:hover {
      background: white;
      color: black;
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
<x-admin-layout title="Edit page">
    <x-slot name="scripts">
        @include('include.ckeditorsetting')
        <script>
            loadImage();

        </script>
    </x-slot>

    <div class="page-content fade-in-up">
        <form method="post" id="form" action="{{ route('page.update', $detail->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Edit page</div>

                        </div>

                        <div class="ibox-body" style="">

                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label>Title</label>
                                    <input class="form-control" id="title" name="title" value="{{ $detail->title }}" type="text"
                                        placeholder="Enter page Title">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Slug</label>
                                    <input class="form-control" name="slug" value="{{ $detail->slug }}" type="text"
                                        placeholder="Enter page Slug"
                                        {{ in_array($detail->slug, $readonlyslug) ? 'readonly' : '' }}>
                                </div>

                            </div>

                            <div class="form-group">
                                <label>Short Description</label>
                                <textarea name="short_description" class="form-control" rows="8"
                                    cols="80">{{ $detail->short_description }}</textarea>
                            </div>


                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="8"
                                    cols="80">{{ $detail->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Banner Image (width: 1110px, height:300px)</label>
                                <input id="files" class="form-control fileUpload" name="image" type="file">
                                @if ($detail->image)
                                <span class="pip">
                                    <img id="Image1" class="imageThumb" src="{{ asset('images/thumbnail/' . $detail->image) }}" >
                                    <a href="{{route('remove',$detail->id)}}"> Remove </a>
                                    </span>
                                    @endif
                                {{-- <div class="mt-2 wrapper">
                                    <div class="image-holder">
                                        @if ($detail->image)
                                            <img src="{{ asset('images/thumbnail/' . $detail->image) }}"
                                                style="margin-top:12px; margin-bottom:12px;" width="120px" alt=""> <br>
                                        <a href="{{route('remove',$detail->id)}}"> Remove </a>

                                        @endif
                                    </div>
                                </div> --}}
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="ibox">
                                        <div class="ibox-head">
                                            <div class="ibox-title">SEO Details</div>
                                        </div>
                                        <div class="ibox-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Meta Title</label>
                                                    <input class="form-control" type="text" id="meta_title" maxlength="70" name="meta_title"
                                                        value="{{$detail->meta_title }}" placeholder="Enter Meta Title">
                                                        <div id="seo_title"></div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Keywords</label>
                                                    <input class="form-control" type="text" value="{{$detail->keyword }}"
                                                        name="keyword" placeholder="Enter Keywords">
                                                </div>
                                                {{-- <div class="form-group col-md-6">
                                                    <label>Meta Tag</label>
                                                    <input class="form-control" type="text" name="meta_phrase"
                                                        value="{{ $detail->meta_phrase ?? old('meta_phrase') }}" placeholder="Enter Meta Phrase">
                                            </div> --}}
                                            <div class="form-group col-md-6">
                                                <label>Meta Description</label>
                                                <textarea name="meta_description" id="meta_description" maxlength="160" class="form-control" rows="8" placeholder="Enter Meta Description"
                                                    cols="80">{{$detail->meta_description }} </textarea>
                                                    <div id="seo_desc"></div>
                                            </div>
                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="check-list">
                                        <label class="ui-checkbox ui-checkbox-primary">
                                            <input name="publish" type="checkbox"
                                                {{ $detail->publish == 1 ? 'checked' : '' }}>
                                            <span class="input-span"></span>Publish</label>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-default" type="submit">Submit</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>

    <x-slot name="styles">
        <style></style>
    </x-slot>

</x-admin-layout>
<script src="{{ asset('assets/admin/vendors/jquery-validation/dist/jquery.validate.min.js') }}"
type="text/javascript"></script>
<script> 
    $(document).ready(function(){
        $("#title").keyup(function(){
       $("#meta_title").val($(this).val());
    });
    });
    </script>
<script> 

    $(document).ready(function() {
      
        $("#files").on("change", function(e) {
        $('#Image1').hide();
        $('.imageThumb').hide();
        $('.remove').hide();
          var files = e.target.files,
            filesLength = files.length;
          for (var i = 0; i < filesLength; i++) {
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
              var file = e.target;
              $("<span class=\"pip\">" +
                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                "<br/> <br/> <span class=\"remove\">Remove image</span>" +
                "</span>").insertAfter("#files");
                $(".remove").click(function(){
            $(this).parent(".pip").remove();
            $('#files').val("");
          });
            });
            fileReader.readAsDataURL(f);
          }
        });
    });
    </script>
<script>
    $(document).ready(function() {
        var maxLength = 160;
$('#meta_description').keyup(function() {
  var textlen = maxLength - $(this).val().length;
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
  console.log($(this).val().length)
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

