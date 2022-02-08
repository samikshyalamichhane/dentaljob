<x-admin-layout title="Create advertisement">
    <x-slot name="scripts">
        @include('include.ckeditorsetting')
        <script>
            loadImage();

        </script>
    </x-slot>

    <div class="page-content fade-in-up">
        <form method="post" action="{{ route('advertisement.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Create Advertisement</div>
                        </div>

                        <div class="ibox-body" style="">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Title</label>
                                    <input class="form-control" name="title" value="{{ old('title') }}" type="text"
                                        placeholder="Enter advertisement Title">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Image </label>
                                    <input class="form-control fileUpload" value="{{ old('image') }}" name="image"
                                        type="file">
                                    <div class="mt-2 wrapper">
                                        <div class="image-holder">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            $dt = \Carbon\Carbon::now()->toDateString();
                            ?>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Published Date</label>
                                    <input class="form-control" name="published_date"
                                        value="{{ old('published_date') ?? $dt }}" type="date">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Expire Date</label>
                                    <input class="form-control" name="expire_date" value="{{ old('expire_date') }}"
                                        type="date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Placement</label>
                                    <select name="place" class="form-control">
                                        <option value="" selected disabled>--Please Select Type</option>
                                        <option value="top_navbar">Top NavBar</option>
                                        <option value="main">Main</option>
                                        <option value="left_sidebar">Left Side Bar</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Link</label>
                                    <input type="url" name="link" value="{{ old('link') }}"
                                        class="form-control ">
                                </div>
                            </div>
                            <div class="check-list">
                                <label class="ui-checkbox ui-checkbox-primary">
                                    <input name="publish" type="checkbox" checked>
                                    <span class="input-span"></span>Publish</label>
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
