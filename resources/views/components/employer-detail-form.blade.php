<div class="row">
    <div class="col-md-6">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Contact Details</div>
            </div>
            <div class="ibox-body">

                <div class="form-group">
                    <label>Organization mobile number</label>
                    <input class="form-control" type="number" name="mobile_number"
                        value="{{ $employer->mobile_number }}" placeholder="Organization mobile number">
                </div>

                <div class="form-group">
                    <label>Organization address</label>
                    <input class="form-control" type="text" name="address" value="{{ $employer->address }}"
                        placeholder="Enter Organization address">
                </div>

                <div class="form-group">
                    <label>Employer Name</label>
                    <input class="form-control" type="text" value="{{ $employer->employer_name }}" name="employer_name"
                        placeholder="Enter Employer Name">
                </div>

                <div class="form-group">
                    <label>Employer designation</label>
                    <input class="form-control" type="text" value="{{ $employer->employer_designation }}"
                        name="employer_designation" placeholder="Enter Employer designation">
                </div>

                <div class="form-group">
                    <label>employer contact number</label>
                    <input class="form-control" type="text" value="{{ $employer->employer_contact_number }}"
                        name="employer_contact_number" placeholder="Enter employer contact number">
                </div>

                <div class="form-group">
                    <label>employer email</label>
                    <input class="form-control" type="text" value="{{ $employer->employer_email }}"
                        name="employer_email" placeholder="Enter employer email">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Social Media Links</div>

            </div>
            <div class="ibox-body">
                <div class="row">
                    <div class="col-12 form-group">
                        <label>Facebook Link</label>
                        <input class="form-control" type="text" value="{{ $employer->facebook }}" name="facebook"
                            placeholder="Enter facebook link">
                    </div>
                    <div class="col-12 form-group">
                        <label>Twitter Link</label>
                        <input class="form-control" type="text" value="{{ $employer->twitter }}" name="twitter"
                            placeholder="Enter twitter link">
                    </div>

                    <div class="col-12 form-group">
                        <label>instagram Link</label>
                        <input class="form-control" type="text" value="{{ $employer->instagram }}" name="instagram"
                            placeholder="Enter instagram link">
                    </div>

                    <div class="col-12 form-group">
                        <label>linked Link</label>
                        <input class="form-control" type="text" value="{{ $employer->linkedin }}" name="linkedin"
                            placeholder="Enter linked Link">
                    </div>

                    <div class="col-12 form-group">
                        <label>youtube Link</label>
                        <input class="form-control" type="text" value="{{ $employer->youtube }}" name="youtube"
                            placeholder="Enter youtube Link">
                    </div>
                    <div class="col-12 form-group">
                        <label>whatsapp Link</label>
                        <input class="form-control" type="text" value="{{ $employer->whatsapp }}" name="whatsapp"
                            placeholder="Enter whatsapp Link">
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Employer Other Details</div>
            </div>
            <div class="ibox-body">
                <div class="row">

                    <div class="col-md-12 form-group">
                        <label>Organization Summary</label>
                        <textarea class="form-control" name="organization_summary" cols="30"
                            rows="10">{{ $employer->organization_summary }}</textarea>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Organization Employee Size</label>
                        <select name="organization_employee_size" class="form-control">
                            <option value>-- Organization Employee Size --</option>
                            @forelse ($dashboard_employees_size as $size)
                                <option {{ $employer->organization_employee_size == $size ? 'selected' : null }}
                                    value="{{ $size }}">{{ $size }}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Profile image</label>
                        <input type="file" name="profile_image" value="{{ $employer->profile_image }}"
                            class="form-control fileUpload">
                        <div class="mt-2 wrapper">
                            <div class="image-holder">
                                @if ($employer->profile_image)
                                    <img src="{{ asset('images/main/' . $employer->profile_image) }}" alt=""
                                        class="thumb-image w-50 my-2">
                                @endif

                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Publish</div>
            </div>
            <div class="ibox-body">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <div class="check-list">
                            <label class="ui-checkbox ui-checkbox-primary">
                                <input name="publish" type="checkbox" {{ $employer->publish == 1 ? 'checked' : null }}>
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
