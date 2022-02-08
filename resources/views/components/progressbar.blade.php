<div class="d-progress-bar">
    @if (isset($profile_progres))
        <h6><strong>{{ $profile_progres }}%</strong></h6>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $profile_progres }}%" aria-valuenow="25"
                aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    @endif
</div>
