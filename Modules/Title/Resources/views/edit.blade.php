<x-admin-layout title="Edit title">
    <x-slot name="scripts">
        @include('include.ckeditorsetting')
        <script>
            loadImage();

        </script>
    </x-slot>

    <div class="page-content fade-in-up">
        <form method="post" id="form" action="{{ route('title.update', $detail->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Create Title</div>
                        </div>

                        <div class="ibox-body" style="">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Title</label>
                                    <input class="form-control" id="title" name="title" value="{{ $detail->title }}" type="text"
                                        placeholder="Enter Title">
                                </div>

                                <!-- <div class="form-group col-md-6">
                                    <label>Slug</label>
                                    <input class="form-control" name="slug" value="{{ old('slug') }}" type="text"
                                        placeholder="Enter page Slug">
                                </div> -->
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