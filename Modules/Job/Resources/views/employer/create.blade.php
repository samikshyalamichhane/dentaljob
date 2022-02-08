<x-employer-layout title="Create job">
    <x-slot name="scripts">
        @include('include.ckeditorsetting')
        <script>
            loadImage();

        </script>
    </x-slot>

    <div class="page-content fade-in-up">
        <form method="post" action="{{ route('employer.job.store') }}" enctype="multipart/form-data">
            @csrf
            <x-job-create :jobCategories="$jobCategories">
                <x-slot name="title">
                    <div class="ibox-title">Create Job</div>
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
