<table class="table table-borderless table-responsive">
    <thead>
        <tr class="text-green">
            <th>Position</th>
            <th colspan="2">Hospital</th>
            <th>Published On</th>
            <th>Apply Before</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($jobs as $job)
            <tr>
                <td>
                    <h6 class="text-blue"><i class="fa fa-id-badge" aria-hidden="true"></i>
                        {{ $job->job_title }}
                    </h6>
                </td>
                <td colspan="2">
                    <div class="media">
                        <div class="d-hospital-logo">
                            <img src="{{ asset('images/logo3.png') }}" alt="">
                        </div>
                        <div class="media-body mt-1">
                            {{ $job->employer_name }}
                        </div>
                    </div>
                </td>
                <td>{{ $job->published_date ? $job->published_date->format(' jS \\ F Y ') : null }}
                </td>
                <td>{{ $job->deadline_date ? $job->deadline_date->format(' jS \\ F Y ') : null }}
                </td>
                <td>
                    <a href="{{ route('jobInner', $job->slug) }}"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('employer.job.edit', $job->id) }}"><i class="fa fa-edit"></i></a>

                    <form class="d-inline-flex" action="{{ route('employer.job.destroy', $job->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-transparent btn-sm" type="submit"
                            onclick="return confirm('Are you sure you want to delete this job?')"><i
                                class="fa fa-trash-o text-primary" aria-hidden="true"></i></button>
                    </form>

                    @if ($job->applications_count > 0)
                        <a href="{{ route('employer.applications', $job->id) }}" class="btn btn-primary text-white btn-sm">
                            Applications <span class="badge badge-light text-dark">{{ $job->applications_count }}</span>
                        </a>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td>
                    <span class="color:red">No Job Found!!</span>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
