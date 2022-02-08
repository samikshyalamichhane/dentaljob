<table class="table table-bordered">
    <thead>
      <tr>
        <th>Job</th>
        <th>Details</th>
      </tr>
    </thead>
    <tbody>
      <tr class="success">
        <td>Job Title</td>
        <td>{{$detail->job_title}}</td>
      </tr>
      <tr class="success">
        <td>Employer Name</td>
        <td>{{$detail->employer->user->name}}</td>
      </tr>
      <tr class="success">
        <td>Published Date</td>
        <td>{{ isset($detail->published_date) ? $detail->published_date->format(' jS \\ F Y ') : null }}</td>
      </tr>
      <tr class="success">
        <td>Deadline Date</td>
        <td>{{ isset($detail->deadline_date) ? $detail->deadline_date->format(' jS \\ F Y ') : null }}</td>
      </tr>
      <tr class="danger">
        <td>Job Reference ID</td>
        <td>{{$detail->job_reference_id}}</td>
      </tr>
      <tr class="success">
        <td>Country</td>
        <td>{{$detail->country}}</td>
      </tr>
      <tr class="danger">
        <td>Town City/County:</td>
        <td>{{ ucfirst(str_replace('-', ' ', $detail->town_city)) }}</td>
      </tr>
      <tr class="warning">
        <td>Street</td>
        <td>{{$detail->street_address}}</td>
      </tr>
      <tr class="success">
        <td>Postal Code</td>
        <td>{{$detail->post_code}}</td>
      </tr>
       <tr class="danger"> 
        <td>Number of Hires</td>
        <td>{{$detail->number_of_vacancy}}</td>
      </tr>  
     <tr class="warning">
        <td> Type of Employment</td>
        <td>{{ $detail->employementSalaryType != null ? $detail->employementSalaryType->title : '' }}</td>
      </tr>  
      <tr class="warning">
        <td>Salary</td>
        <td>@if ($detail->offerred_salary_type == 'negotiable')
            <p> {{ ucfirst($detail->offerred_salary_type) }}</p>
        @elseif($detail->offerred_salary_type == 'fixed')
            <p>
                {{ ($detail->currencies == 'american_dollar' ? '$' : $detail->currencies == 'euro') ? '€' : '£' }}
                {{ number_format($detail->fixed_salary) }}
            </p>
            <p> {{ ucfirst($detail->time_period) }} </p>
        @elseif($detail->offerred_salary_type == 'range')
            <p>
                {{ ($detail->currencies == 'american_dollar' ? '$' : $detail->currencies == 'euro') ? '€' : '£' }}
                {{ number_format($detail->minimum_salary) }}
            </p> -
            <p>
                {{ number_format($detail->maximum_salary) }}
            </p>
            <p> {{ ucfirst($detail->time_period) }} </p>
        @endif</td>
      </tr> 
       <tr class="warning">
        <td>Send Application/Contact Via</td>
        <td>@if ($detail->application_receive == 'email_ok,phone_not_ok')
                                <p> Email </p>
                            @elseif($detail->application_receive == 'email_not_ok,phone_ok')
                                <p> Phone </p>
                            @elseif($detail->application_receive == 'email_ok,phone_ok')
                                <p> Email and Phone Both</p>
                            @endif</td>
      </tr> 
      <tr class="danger">
        <td>Job Description</td>
        <td>{!! $detail->job_description !!}</td>
      </tr> 
      <tr class="success">
        <td>Benefits</td>
        <td>{!! $detail->benefits !!}</td>
      </tr> 
      @if($detail->notes)
      <tr class="danger">
        <td>Notes</td>
        <td>{{ $detail->notes }}</td>
      </tr> 
      @endif 
    </tbody>
  </table>