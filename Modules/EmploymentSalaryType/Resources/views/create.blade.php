<x-admin-layout title="Add employment salary type">
    <x-slot name="scripts">
        <script></script>
    </x-slot>

    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Create employment salary type</div>

                        <div class="ibox-tools">

                        </div>
                    </div>

                    <div class="ibox-body" style="">
                        <form method="post" action="{{ route('employmentsalarytype.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>title</label>
                                        <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                            placeholder="Enter title">
                                    </div>
                                    <div class="form-group">
                                        <label> Select Type</label>
                                        <select name="type" class="form-control">
                                            <option value>--Please Select Type</option>
                                            <option value="employment">Employment</option>
                                            <option value="salary">Salary</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

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