<x-admin-layout title="Add user">
    <x-slot name="scripts">
        <script></script>
    </x-slot>

    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Create user</div>

                        <div class="ibox-tools">

                        </div>
                    </div>

                    <div class="ibox-body" style="">
                        <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="role" value="admin">
                            <div class="row">
                                <div class="col-md-8">

                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                            placeholder="Enter full name">
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                            placeholder="Enter email">
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <div class="d-flex">
                                            <input type="password" class="form-control show__password" name="password"
                                                value="{{ old('password') }}" placeholder="Enter Password">
                                            <i class="fa fa-eye show__eye"></i>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Re-Password</label>
                                        <div class="d-flex">
                                            <input type="password" class="form-control show__password"
                                                name="password_confirmation" value="{{ old('password_confirmation') }}"
                                                placeholder="Enter Password">
                                            <i class="fa fa-eye show__eye"></i>
                                        </div>
                                    </div>

                                    <div class="check-list">
                                        <label class="ui-checkbox ui-checkbox-primary">
                                            <input name="publish" type="checkbox" checked>
                                            <span class="input-span"></span>Publish</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="ibox">
                                        <div class="ibox-head">
                                            <div class="ibox-title">Permissions</div>
                                            <div class="ibox-tools">
                                            </div>
                                        </div>
                                        <div class="ibox-body" style="">
                                            @if (isset($access_options) && count($access_options))
                                                @foreach ($access_options as $key => $option)
                                                    <div class="check-list mb-3">
                                                        <label class="ui-checkbox ui-checkbox-primary">
                                                            <input type="checkbox" value={{ $key }} name="access[]">
                                                            <span class="input-span"></span>{{ $option }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
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
