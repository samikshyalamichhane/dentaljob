<x-admin-layout title="Edit advertisement">
    <x-slot name="scripts">
        @include('include.ckeditorsetting')
        <script>
            loadImage();

        </script>
    </x-slot>

    <div class="page-content fade-in-up">
        <form method="post" action="{{ route('advertisement.update', $detail->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
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
                                    <input class="form-control" name="title" value="{{ $detail->title }}" type="text"
                                        placeholder="Enter advertisement Title">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Image </label>
                                    <input class="form-control fileUpload" value="{{ old('image') }}" name="image"
                                        type="file">
                                    <div class="mt-2 wrapper">
                                        <div class="image-holder">
                                            @if ($detail->image)
                                                <img src="{{ asset('images/thumbnail/' . $detail->image) }}"
                                                    style="margin-top:12px; margin-bottom:12px;" width="120px" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Published Date</label>
                                    <input class="form-control" name="published_date"
                                        value="{{ $detail->published_date ?? $dt }}" type="date">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Expire Date</label>
                                    <input class="form-control" name="expire_date" value="{{ $detail->expire_date }}"
                                        type="date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Placement</label>
                                    <select name="place" class="form-control">
                                        <option value="" selected disabled>--Please Select Type</option>
                                        <option value="top_navbar" @if ($detail->place == 'top_navbar') {{ 'selected' }} @endif>Top Navbar</option>
                                        <option value="main" @if ($detail->place == 'main') {{ 'selected' }} @endif>Main</option>
                                        <option value="left_sidebar" @if ($detail->place == 'left_sidebar') {{ 'selected' }} @endif>Left Sidebar</option>
                                        <option value="others" @if ($detail->place == 'others') {{ 'selected' }} @endif>Others</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Link</label>
                                    <input type="url" name="link" value="{{ $detail->link }}"
                                        class="form-control ">
                                </div>
                            </div>
                            <div class="check-list">
                                <label class="ui-checkbox ui-checkbox-primary">
                                    <input name="publish" type="checkbox"
                                        {{ $detail->publish == 1 ? 'checked' : '' }}>
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
