<x-employer-layout title="Edit employer detail">
    <x-slot name="scripts">
        <script>
            loadImage();

        </script>
    </x-slot>

    <div class="page-content fade-in-up">
        <form action="{{ route('employer.employer.update', $detail->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-employer-detail-form :employer="$detail" />

        </form>

    </div>


    <x-slot name="styles">
        <style></style>
    </x-slot>

</x-employer-layout>
