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
        <form method="post" id="form" action="{{ route('setting.update', $detail->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- SEO and Social Media --}}
            <div class="row">
                <div class="col-md-5">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">SEO Details</div>
                        </div>
                        <div class="ibox-body">

                            {{-- <div class="form-group">
                                <label>Page Title</label>
                                <input class="form-control" type="text" name="page_title"
                                    value="{{ $detail->page_title }}" placeholder="Enter Page Title">
                            </div> --}}

                            <div class="form-group">
                                <label>Meta Title</label>
                                <input class="form-control" type="text" name="meta_title" id="meta_title" 
                                    value="{{ $detail->meta_title }}" placeholder="Enter Meta Title">
                                    <div id="seo_title"></div>
                            </div>

                            <div class="form-group">
                                <label>Meta Description</label>

                                <textarea name="meta_description" id="meta_description" 
                                    class="form-control" rows="4" placeholder="Enter Meta Description"
                                    cols="80">{{ $detail->meta_description  }} </textarea>

                                    <div id="seo_desc"></div>

                            </div>

                            <div class="form-group">
                                <label>Meta phrase</label>
                                <input class="form-control" type="text" value="{{ $detail->meta_phrase }}"
                                    name="meta_phrase" placeholder="Enter Meta phrase">
                            </div>

                            <div class="form-group">
                                <label>Keywords</label>
                                <input class="form-control" type="text" value="{{ $detail->keyword }}" name="keyword"
                                    placeholder="Enter Keywords">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Social Media Links</div>

                        </div>
                        <div class="ibox-body">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label>Facebook Link</label>
                                    <input class="form-control" type="text" value="{{ $detail->facebook }}"
                                        name="facebook" placeholder="Enter facebook link">
                                </div>
                                <div class="col-12 form-group">
                                    <label>Twitter Link</label>
                                    <input class="form-control" type="text" value="{{ $detail->twitter }}"
                                        name="twitter" placeholder="Enter twitter link">
                                </div>

                                <div class="col-12 form-group">
                                    <label>instagram Link</label>
                                    <input class="form-control" type="text" value="{{ $detail->instagram }}"
                                        name="instagram" placeholder="Enter instagram link">
                                </div>

                                <div class="col-12 form-group">
                                    <label>linked Link</label>
                                    <input class="form-control" type="text" value="{{ $detail->linkedin }}"
                                        name="linkedin" placeholder="Enter linked Link">
                                </div>

                                <div class="col-12 form-group">
                                    <label>youtube Link</label>
                                    <input class="form-control" type="text" value="{{ $detail->youtube }}"
                                        name="youtube" placeholder="Enter youtube Link">
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Site Setting --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Site Setting</div>
                        </div>
                        <div class="ibox-body" style="">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>Page Title</label>
                                    <input class="form-control" type="text" name="site_name"
                                        value="{{ $detail->site_name }}" placeholder="Enter Site name">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Site Images --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Site Images</div>
                        </div>
                        <div class="ibox-body" style="">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>Logo Left</label>
                                    <input type="file" name="logo_left" value="{{ $detail->logo_left }}"
                                        class="form-control fileUpload">
                                    <div class="mt-2 wrapper">
                                        <div class="image-holder">
                                            @if ($detail->logo_left)
                                            <img src="{{ asset('images/main/' . $detail->logo_left) }}" alt=""
                                                class="thumb-image w-50 my-2">
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 form-group">
                                    <label>Logo right</label>
                                    <input type="file" name="logo_right" value="{{ $detail->logo_right }}"
                                        class="form-control fileUpload">
                                    <div class="mt-2 wrapper">
                                        <div class="image-holder">
                                            @if ($detail->logo_right)
                                            <img src="{{ asset('images/main/' . $detail->logo_right) }}" alt=""
                                                class="thumb-image w-50 my-2">
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 form-group">
                                    <label>Link1 </label>
                                    <input type="url" name="link1" value="{{ $detail->link1 }}"
                                        class="form-control ">
                                </div>

                                <div class="col-sm-6 form-group">
                                    <label>Link2</label>
                                    <input type="url" name="link2" value="{{ $detail->link2 }}"
                                        class="form-control ">
                                </div>

                                <div class="col-sm-6 form-group">
                                    <label>Fav Icon</label>
                                    <input type="file" name="favicon" value="{{ $detail->favicon }}"
                                        class="form-control fileUpload">
                                    <div class="mt-2 wrapper">
                                        <div class="image-holder">
                                            @if ($detail->favicon)
                                            <img src="{{ asset('images/main/' . $detail->favicon) }}" alt=""
                                                class="thumb-image w-50 my-2">
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <script src="{{ asset('assets/admin/vendors/jquery-validation/dist/jquery.validate.min.js') }}"
        type="text/javascript"></script>

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
                    required: true,
                    // minlength: 50,
                    // maxlength: 70
                },
                keywords: {
                    required: true,
                },
                meta_description: {
                    required: true,
                    // minlength: 150,
                    // maxlength: 160
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

    <x-slot name="styles">
        <style>
            .image-holder img {
                border: 1px solid #ccc;
                padding: 13px;
                border-radius: 10px;
            }
        </style>
    </x-slot>

</x-admin-layout>