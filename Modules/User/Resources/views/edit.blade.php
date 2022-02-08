<x-admin-layout title="Edit user">
    <x-slot name="scripts">
        <script></script>
    </x-slot>

    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Edit user</div>

                        <div class="ibox-tools">

                        </div>
                    </div>

                    <div class="ibox-body" style="">
                        <form method="post" action="{{ route('roleuser.update', $detail->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <x-create-user :user="$detail"></x-create-user>
                            <br>

                            <div class="form-group">
                                <button class="btn btn-default" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="styles">
        <link rel="stylesheet" href="/assets/common.css">

        <style></style>
    </x-slot>

</x-admin-layout>
