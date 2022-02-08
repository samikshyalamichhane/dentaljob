   <!-- searchbox -->
   <section class="inner-search-form">
       <div class="container">
           <div class="form justify-content-center">
               <form action="{{ route('search') }}" method="get" class="row ">

                   <div class="from-group col-sm-5 mt-2 mt-lg-0">
                    <select class="js-example-basic-single  form-control job-input" id="job_title" name="title">
                        @forelse ($categories as $item)
                                <option  value="{{$item->title}}" >{{ ucfirst($item->title) }}</option>
                                
    
                            @empty
    
                            @endforelse
                        </select>
                       {{-- <input type="text" class="form-control" name="title" id="job_title"
                           placeholder="What: Job Title Keywords, Company" autocomplete="off" />
                       <div class="searched_title_options"> --}}

                       {{-- </div> --}}
                   </div>
                   <div class="from-group col-sm-5 mt-2 mt-lg-0">
                    <select class="js-example-basic-multiple  form-control location-input" id="job_location" name="location">
                        @forelse ($locations->unique('town_city') as $item)
                                <option  value="{{$item->town_city}}">{{ ucfirst(str_replace('-', ' ', $item->town_city)) }}</option>
                            @empty
                            @endforelse
                        </select>
                       {{-- <input type="text" class="form-control" name="location" id="job_location"
                           placeholder="Where: City, Country" autocomplete="off">
                       <div class="searched_locations_options"> --}}

                       {{-- </div> --}}
                   </div>
                   <div class="from-group col-sm-2 mt-2 mt-lg-0">
                       <button class="d-btn bg-green" id="searchSubmit" type="submit"><i class="fa fa-search"></i>
                           <span class="search-button-span">search</span>
                       </button>
                   </div>
               </form>
           </div>
       </div>
   </section>
   <!-- search ends -->
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
       crossorigin="anonymous"></script>
   <script>
       if ($('#job_title').val() == 0 && $('#job_location').val() == 0) {
           //    $('#searchSubmit').appendClass('disable')
           $('#searchSubmit').prop('disabled', true);
       }

       $('#job_title').on('keyup', function() {
           $('#searchSubmit').prop('disabled', false);
       })

       $('#job_location').on('keyup', function() {
           $('#searchSubmit').prop('disabled', false);
       })

       $('#job_title').keyup(function() {
           var keyword = $("#search").val();
           var dataString = 'keyword=' + keyword;
       })

   </script>


   <script type="application/javascript">
       $(document).ready(function() {

           $('#job_title , #job_location').on('keyup', function() {
               var title = $('#job_title').val();
               var location = $('#job_location').val();
               if (title.length >= 2 || location.length >= 2) {
                   $.ajax({
                       type: "GET",
                       url: '/search-on-key-up',
                       data: {
                           title: title,
                           location: location
                       },
                       success: function(response) {
                           $('.searched_title_options').empty()
                           $('.searched_locations_options').empty()
                           $.each(response.data, function(key, job) {
                               $('.searched_title_options').append(
                                   `<a href="/job-detail/${job.slug}" target="_blank">${job.job_title}</a> <br/>`
                               )
                               $('.searched_locations_options').append(
                                   `<a href="/job-detail/${job.slug}" target="_blank">${job.town_city}</a> <br/> `
                               )

                           });

                       }
                   });
               }

           });

       });

   </script>
