<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CV</title>
</head>

<body>
    <div id="content"
        style="max-width: 900px; margin:0 auto; padding:0; background:#fff; font-family:sans-serif;position:relative; display:block;border:1px solid #e7e7ff;  font-size: 16px;">
        <div
            style="text-align:center; margin:0; background: #39b54a; border-top:1px solid #000; top:0;position:absolute; display:block;width:100%; height:50px">
            <h4 style="color:#fff;">Curriculum Vitae</h4>
        </div>
        <div style="background:#f7f7f7; display: block; margin-top:50px; padding:60px 15px 30px;">
            <div style="width: 25%; display:inline-block; margin-right:50px">
                <div style="border:1px solid #cecece; padding:5px;">
                    <img src="{{ asset('images/thumbnail/' . @$jobseeker->profile_image) }}" style="width:100%" />
                </div>

            </div>
            <div style="width: 65%;display:inline-block; margin-top:10px; line-height: 1.6; ">
                <p style="margin:0px"><strong style="width:150px; display: inline-block; font-size:14px;">Full
                        Name</strong>: {{ $jobseeker->first_name }} {{ $jobseeker->middle_name }}
                    {{ $jobseeker->last_name }} </p>
                <p style="margin:0px"><strong
                        style="width:150px; display: inline-block; font-size:14px;">Email</strong>:
                    {{ $jobseeker->email }}</p>
                <!-- <p style="margin:0px"><strong style="width:150px; display: inline-block; font-size:14px;">Gender</strong>: </p> -->
                <p style="margin:0px"><strong
                        style="width:150px; display: inline-block; font-size:14px;">Mobile</strong>:
                    {{ $jobseeker->mobile }}</p>
                <p style="margin:0px"><strong style="width:150px; display: inline-block; font-size:14px;">GDC
                        Number</strong>: {{ $jobseeker->gdc_number }}</p>
                <p style="margin:0px"><strong
                        style="width:150px; display: inline-block; font-size:14px;">Country</strong>:
                    {{ $jobseeker->country }}</p>
                <p style="margin:0px"><strong
                        style="width:150px; display: inline-block; font-size:14px;">City/county</strong>:
                    {{ $jobseeker->street }}</p>
            </div>
        </div>
        <div style="background:#f7f7f7; display: block; border-top: 1px solid #e7e7e7; padding:15px">
            @if (count($jobseeker->experiences) > 0)
                <h4 style="border-bottom:1px solid #e7e7e7">Work Experiences</h4>
                @forelse ($jobseeker->experiences as $item)
                    <div style="border-bottom: 1px solid #e7e7e7; margin-top: 20px;">
                        <div style="width: 35%; display:inline-block; margin-right:50px; line-height: 1.6;">
                            <p style="margin:0px"><strong style="width:150px; display: inline-block; font-size:14px;">From -
                                    To </strong></p>
                            <p style="margin:0px"> {{ $item->start_date }} - {{ $item->end_date }}</p>
                        </div>
                        <div style="width: 55%;display:inline-block; margin-top:10px; line-height: 1.6;">
                            <p style="margin:0px"><strong
                                    style="width:150px; display: inline-block; font-size:14px;">Hospital Name</strong>:
                                {{ $item->company_name }}</p>
                            <p style="margin:0px"><strong
                                    style="width:150px; display: inline-block; font-size:14px;">Designation</strong>:
                                {{ $item->job_title }}</p>
                        </div>
                    </div>
                @empty
                    No Jobs Experience Found!!
            @endforelse


            @endif

        </div>
    </div>
</body>

</html>
