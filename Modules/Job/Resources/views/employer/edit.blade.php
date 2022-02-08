<x-employer-layout title="Edit job">
    <x-slot name="scripts">
        @include('include.ckeditorsetting')
        <script>
            loadImage();

        </script>
    </x-slot>

    <div class="page-content fade-in-up">
        <form method="POST" action="{{ route('employer.job.update', $detail->id) }}" enctype="multipart/form-data">
            <input type="hidden" name='_token' value="{{ csrf_token() }}">
            <input type="hidden" name="id" value={{ $detail->id }}>
            <input type="hidden" name="_method" value="PUT">

            <x-job-create :jobCategories="$jobCategories" :detail="$detail">
                <x-slot name="title">
                    <div class="ibox-title">Edit Job</div>
                </x-slot>
            </x-job-create>

        </form>
    </div>

    <x-slot name="styles">
        <style></style>
    </x-slot>

</x-employer-layout>

<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('job_description', options);
    CKEDITOR.config.height = 200;

</script>
