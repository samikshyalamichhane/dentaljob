<x-admin-layout title="Dashboard">
    <x-slot name="scripts">
        <script>
            const bgColors = ['bg-success', 'bg-orange', 'bg-primary', 'bg-danger', 'bg-purple', ]

            function changeBg() {
                let cards = [...document.querySelectorAll('.ibox.widget-stat')]
                let count = 0
                cards.forEach(card => {
                    $(card).addClass(bgColors[count])
                    count++;
                    if (count == bgColors.length) {
                        count = 0
                    }
                })
            }

        </script>

        <script>
            changeBg()

        </script>
    </x-slot>
    <div class="page-heading">
        <h1 class="page-title">Dashboard</h1>
    </div>
    <div class="page-content fade-in-up">
        <div class="row mt-2">
            <div class="col-lg-3 col-md-6">
                <a href="" class="text-white">
                    <div class="ibox color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong"> {{ count($total_categories) }}</h2>
                            <div class="m-b-5 text-uppercase">Total categories</div>

                            <div>
                                <small><a class="text-white" href="{{ url('admin/jobcategory') }}">View
                                        More</a></small><i class="fa fa-arrow-circle-o-right m-l-5"></i>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="" class="text-white">
                    <div class="ibox color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong"> {{ count($total_jobseekers) }}</h2>
                            <div class="m-b-5 text-uppercase">Total Jobseekers</div>

                            <div>
                                <small><a class="text-white" href="{{ url('admin/jobseeker/list') }}">View
                                        More</a></small><i class="fa fa-arrow-circle-o-right m-l-5"></i>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="" class="text-white">
                    <div class="ibox color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong"> {{ count($total_employers) }}</h2>
                            <div class="m-b-5 text-uppercase">Total Employers</div>

                            <div>
                                <small><a class="text-white" href="{{ url('admin/employer') }}">View
                                        More</a></small><i class="fa fa-arrow-circle-o-right m-l-5"></i>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="" class="text-white">
                    <div class="ibox color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong"> {{ count($total_users) }}</h2>
                            <div class="m-b-5 text-uppercase">Total Users</div>

                            <div>
                                <small><a class="text-white" href="{{ url('admin/user') }}">View More</a></small><i
                                    class="fa fa-arrow-circle-o-right m-l-5"></i>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="" class="text-white">
                    <div class="ibox color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong"> {{ count($total_jobs) }}</h2>
                            <div class="m-b-5 text-uppercase">Total Jobs</div>

                            <div>
                                <small><a class="text-white" href="{{ url('admin/job') }}">View More</a></small><i
                                    class="fa fa-arrow-circle-o-right m-l-5"></i>
                            </div>
                        </div>
                    </div>

                </a>
            </div>

            <div class="container">
                <canvas id="myChart"> </canvas>
            </div>

        </div>
    </div>

@push('scripts')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"> </script>

<script>
     
    $.ajax({
    type: "GET",
    url: '/get-post-chart-data', 
    
}).done(function( msg ) {
    console.log(msg[0].months)
    console.log(msg[0].post_count_data)
    console.log(msg[1].months)
    console.log(msg[1].post_count_data)
 
  var myChart = document.getElementById('myChart').getContext('2d');
let barchart = new Chart(myChart, {
  type:'bar',
  data:{
    labels: msg[0].months,
    datasets:[
        {
      label:'Jobseekers Count',
      data:msg[0].post_count_data,
      
      backgroundColor:[
            'rgba(255, 99, 132, 0.6)',
          ],
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000'
        },
        
        {
      label:'Employers Count',
      data:msg[1].post_count_data,
    fill:'start',

      backgroundColor:[
        'rgba(54, 162, 235, 0.6)',
          ],
    // backgroundColor: 'rgba(255, 206, 86, 0.2)',
    //             borderColor: 'rgba(255, 206, 86, 1)',
          type:'line',
          borderWidth:1,
          borderColor:'blue',
          hoverBorderWidth:3,
          hoverBorderColor:'#000'
        }
        ]
      },
      options:{
        title:{
          display:true,
          text:'Number of Jobseekers',
          fontSize:25
        },
        legend:{
          display:true,
          position:'right',
          labels:{
            fontColor:'#000'
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:0
          }
        },
        tooltips:{
          enabled:true
        }
      }
    });
});


  </script>
 
  @endpush



    <x-slot name="styles">
        <style>
            .form-group label {
                text-transform: capitalize;
            }

            .ibox.widget-stat {
                border-radius: 6px;
                box-shadow: 0px 0px 30px #297dd473;
            }

        </style>
    </x-slot>

</x-admin-layout>
