@forelse ($paused_jobs as $paused_job)
    <div class="similar-job mt-2">
        <div class="row">
            <div class="col-4 col-md-3 ">
                <div class="similar-job-logo">
                    <a href="{{ route('jobInner', $paused_job->slug) }}"> <img src="/assets/front/images/logo3.png"
                            alt="dental"></a>
                </div>
            </div>
            <div class="col-8 col-md-9 no-gutters">
                <h6 class="text-blue poppin-bold"><a
                        href="{{ route('jobInner', $paused_job->slug) }}">{{ $paused_job->job_title }}</a>
                </h6>
                <p><strong>Employer:</strong> {{ $paused_job->employer->employer_name ?? '' }}</p>
                <p><strong>Apply before:</strong>
                    {{ $paused_job->deadline_date ? $paused_job->deadline_date->format(' jS \\ F Y ') : null }}
                </p>
            </div>
        </div>
    </div>
@empty
@endforelse
