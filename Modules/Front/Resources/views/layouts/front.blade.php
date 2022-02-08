<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

     <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TJ3FVL7');</script>
    <!-- End Google Tag Manager -->

    <!-- meta tags for seo -->
    <title>{{$og['title']}}</title>
    <meta name="description" content="{{$og['description']}}">
    <meta name="keywords" content="{{$og['keywords']}}">
    <meta name="author" content="name name">
    <!-- <meta http-equiv="refresh" content="50"> -->
    <link rel="canonical" href="https://dentaljobs.com">
    <!-- meta tags for seo ends -->
    <!-- meta tags for job seo -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:title" content="{{$og['title']}}">
    <meta property="og:description" content="{{$og['description']}}">
    <meta property="og:image" content="{{ asset('images/main/' . ($og['image'] == null ? 'logo1.png' : $og['image'])) }} ">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- compatiblity -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- favicon -->
    <link rel="icon" href="{{ asset('images/logo1.png') }}" type="image/jpg" sizes="16x16">
    {{-- <!-- title -->
    <title>{{@$dashboard_composer->site_name}}</title> --}}
    <!-- font awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- style sheet -->
   
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
    @stack('styles')

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TJ3FVL7"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <header class="mt-3">
        <div class="mobile-view">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-md-2 py-2">
                        <img src="/images/logo.png" alt="dental-logo">
                    </div>

                    <div class="col-6 col-md-2  py-2">
                        <img src="/images/logo1.png" alt="dental-logo">
                    </div>
                    <div class="col-sm-12 col-md-8  py-2">
                        <div class="ads-box">
                            <img src="{{ asset('images/banner- ads.png') }}" alt="dental-logo">

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="desktop-view">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-2 py-2">
                        <a href="{{@$dashboard_composer->link1}}"><img src="{{ asset('images/main/' . @$dashboard_composer->logo_left) }}" alt="dental-logo"> </a>
                    </div>
                    <div class="col-sm-12 col-md-8  py-2">
                        <div class="ads-box">
                            <a href="{{@$advertisement->link}}" target="_blank"><img src="{{ asset('images/main/' . ($advertisement == null ? 'banner-ads.png' : $advertisement->image)) }}"
                                alt="{{ $advertisement->title ?? 'advertisement-test' }}"></a>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2  py-2">
                        <a href="{{@$dashboard_composer->link1}}"><img src="{{ asset('images/main/' . @$dashboard_composer->logo_right) }}" alt="dental-logo"> </a>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar   navbar-expand-lg  nav-bar navbar-light bg-green">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}"><span class="fa fa-home"></span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <span class="close-nav-btn" role="button">x</span>
                        @php
                            $user = Auth::user();
                            if ($user) {
                                $jobseeker = Modules\Jobseeker\Entities\Jobseeker::where('user_id', $user->id)->first();
                            }
                        @endphp
                        @if ($user && $user->role == 'jobseeker')
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('overview') }}">Overview</a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('profileInfo', $user->username) }}">My
                                    Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('editProfile', $user->username) }}">Edit
                                    Profile</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle  default-btn login-signup-btn" type="button"
                                    id="dropdownMenuButtonone" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </a>

                                <div class="dropdown-menu drop-form" aria-labelledby="dropdownMenuButtonOne">
                                    <div class="row">
                                        <div class="col-4 col-md-4 ">
                                            <div class="d-profile-image">
                                                @if (!$jobseeker->profile_image)
                                                    <img src="{{ asset('/images/man1.png') }}" alt="Alex image">
                                                @endif
                                                <img src="{{ asset('images/thumbnail/' . $jobseeker->profile_image) }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="col-8 col-md-8 no-gutters">
                                            <h6 class="poppin-REGULAR">{{ $user->name }}</h6>
                                            <p><i class="fa fa-envelope-o"></i><a
                                                    href="mailto:{{ $user->email }}">{{ $user->email }}</a> </p>
                                            <p><i class="fa fa-phone"></i> <a
                                                    href="tel:{{ $jobseeker->mobile }}">{{ $jobseeker->mobile }}</a>
                                            </p>
                                            <p><i class="fa fa-graduation-cap"
                                                    aria-hidden="true"></i>{{ $jobseeker->profession }}
                                            </p>
                                        </div>
                                    </div>
                                    <ul class="mt-2 pt-3 border-top">
                                        <li><a href="{{ route('appliedJobs', $user->username) }}"><i
                                                    class="fa fa-file-o" aria-hidden="true"></i>Applied Jobs</a>
                                        </li>
                                        <li><a href="{{ route('changePasswordForm') }}"><i class="fa fa-lock"
                                                    aria-hidden="true"></i>Change Password</a> </li>
                                        <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"
                                                    aria-hidden="true"></i>Logout</a></li>
                                    </ul>
                                </div>
                            </li>

                        @elseif (auth()->user() && auth()->user()->role == 'employer')

                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('employer.getEmployerOverview', auth()->user()->username) }}">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('employer.getCompanyProfile', auth()->user()->username) }}">Company
                                    Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('employer.getProfile', auth()->user()->employer->id) }}">Edit
                                    Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('employer.job.index') }}">Manage Job</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle  default-btn login-signup-btn" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu drop-form" aria-labelledby="dropdownMenuButton">
                                    <div class="row">
                                        <div class="col-4 col-md-4 ">
                                            @if (auth()->user()->employer->profile_image)
                                                <div class="d-profile-image">
                                                    <img src="/images/main/{{ auth()->user()->employer->profile_image }}"
                                                        alt="Alex image">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-8 col-md-8 no-gutters ">
                                            <h6 class="poppin-REGULAR">
                                                {{ auth()->user()->name ?? '' }}
                                            </h6>
                                            <p><i class="fa fa-envelope-o"></i>
                                                <a
                                                    href="mailto:{{ auth()->user()->email ?? '' }}">{{ auth()->user()->email ?? '' }}</a>
                                            </p>
                                            @if (auth()->user()->employer->employer_contact_number)
                                                <p><i class="fa fa-phone"></i><a
                                                        href="tel:{{ auth()->user()->employer->employer_contact_number }}">{{ auth()->user()->employer->employer_contact_number }}</a>
                                                </p>
                                            @endif
                                            @if (auth()->user()->employer->address)
                                                <p><i class="fa fa-map-marker"
                                                        aria-hidden="true"></i>{{ auth()->user()->employer->address }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <ul class="mt-2 pt-3 border-top">
                                        <li><a href="{{ route('employer.job.index') }}"><i class="fa fa-file-o"
                                                    aria-hidden="true"></i>Posted Jobs</a>
                                        </li>
                                        <li><a href="{{ route('changePasswordForm') }}"><i class="fa fa-lock"
                                                    aria-hidden="true"></i>Change Password</a> </li>
                                        <li><a href="{{ route('employer.employerLogout') }}"><i
                                                    class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
                                    </ul>
                                </div>
                            </li>
                            <button class="btn bg-blue">
                                <a href="{{ route('employer.job.create') }}" class="bg-blue">Post Job</a>
                            </button>
                        </ul>
                        @else
                         <div class="form">
                            <form action="{{ route('findAll') }}" method="get">
                                <div class="from-group form-input">
                                    <input type="text" class="form-control" name="title" id="title"
                                        placeholder="What: Job Title Keywords, Company" />
                                    <div class="searched_title_options">

                                    </div>
                                </div>
                                <div class="from-group form-btn ">
                                    <button class="btn-search" id="searchSubmit" type="submit"><i class="fa fa-search"></i>
                                        Search
                                    </button>
                                </div>
                            </form>
                        </div>
                        <button class="browse-btn"> <a href="{{route('getAllJobs')}}" >Browse all Jobs</a></button>
                        
                  
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ route('jobseeker.login') }}">login</a></li>
                            <li class="nav-item"><a class="nav-link"
                                    href="{{ route('jobseeker.register') }}">Register</a>
                            </li>
                        </ul>
                        @endif
                </div>
            </div>
        </nav>
    </header>
    <!-- header -->
    @yield('content')
    <!-- footer -->
    <footer class="mt-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <h5>categories</h5>
                    <ul class="link-list">
                        @forelse ($footer_categories as $item)
                            <li> <a href="{{ route('jobByCategories', $item->slug) }}">{{ ucfirst($item->title) }}</a>
                            </li>

                        @empty

                        @endforelse
                        <li> <a href="{{ route('allCategories') }}">See More</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-3">
                    <h5>location</h5>
                    <ul class="link-list">

                        @forelse ($footer_locations->unique('town_city') as $item)
                            <li>

                                <a
                                    href="{{ route('city.locations', $item->town_city ? $item->town_city : 'united-kingdom') }}">{{ ucfirst(str_replace('-', ' ', $item->town_city)) }}</a>
                            </li>
                        @empty

                        @endforelse
                        <li> <a href="{{ route('allLocations') }}">See More</a>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-3">
                    <h5>Information</h5>
                    <ul class="link-list" style="color:#fff">
                        <li> <a href="{{ route('getPages', 'about-us') }}" target="_blank">About Us </a></li>
                        <li> <a href="{{ route('getPages', 'privacy-policy') }}" target="_blank">Privacy Policy </a></li>
                        <li> <a href="{{ route('getPages', 'terms-and-condition') }}" target="_blank">Terms and Condition </a></li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-3">
                    <h5>Follow Us</h5>
                    <ul class="social-list mt-3">
                        <li> <a href="{{ @$dashboard_composer->facebook }}" target="_blank"><span class="icon-facebook"></span></a>
                        </li>
                        <li> <a href="{{ @$dashboard_composer->twitter }}" target="_blank"><span class="icon-twitter"></span></a>
                        </li>
                        <li> <a href="{{ @$dashboard_composer->instagram }}" target="_blank"><span class="icon-instagram"></span></a>
                        </li>
                        <li> <a href="{{ @$dashboard_composer->linkedin }}" target="_blank"><span class="fa fa-linkedin"></span></a>
                        </li>
                        <li> <a href="{{ @$dashboard_composer->youtube }}" target="_blank"><span
                                    class="fa fa-youtube-play"></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            @php
                use Carbon\Carbon;
                $date = Carbon::now();
                $current_year = Carbon::now()->format('Y');;
            @endphp
        
    </div>
    <div class="copyright-box py-3">
        <div class="container">
            <div class="row border_top_footer">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <p>
                        <span class="copyrights-text font_13">© {{$current_year}} Copyrights Reserved at {{@$dashboard_composer->site_name}}</span>
                    </p>

                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 webhouse_nepal">
                    <p>
                        <span class="copyrights-text font_13">
                Designed & Developed by: <a href="https://webhousenepal.com" title="https://webhousenepal.com" target="_blank">webhousenepal.com</a>
                        </span>
                    </p>
                </div>
        </div>
        </div>
    </div>
    </footer>
    <!-- <div href="#" id="back-to-top"> <span class="icon-caret-up"></span> </div> -->
    <!-- script  url -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
 

    <script src="{{ asset('js/custom.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

    $('.js-example-basic-single').select2();
    
    $(".js-example-basic-multiple").select2();
</script>
   <script>
       $('#dropdownMenuButtonOne').click(function(){
           $('.dropdown').toggleClass('d-block');
           $('.drop-form').toggleClass('d-block');
       });
       $('#dropdownMenuButton').click(function(){
           $('.dropdown').toggleClass('d-block');
           $('.drop-form').toggleClass('d-block');
       });
   </script>

   <script>
    if ($('#title').val() == 0 ) {
           //    $('#searchSubmit').appendClass('disable')
           $('#searchSubmit').prop('disabled', true);
       }
       $('#title').on('keyup', function() {
           $('#searchSubmit').prop('disabled', false);
       })
        </script>
        <script type="application/javascript">
            $(document).ready(function() {
     
                $('#title').on('keyup', function() {
                    var title = $('#title').val();
                    if (title.length >= 2) {
                        $.ajax({
                            type: "GET",
                            url: '/search-on-key-up',
                            data: {
                                title: title,
                            },
                            success: function(response) {
                                $('.searched_title_options').empty()
                                $.each(response.data, function(key, job) {
                                    $('.searched_title_options').append(
                                        `<a href="/job-detail/${job.slug}" target="_blank">${job.job_title}</a> <br/>`
                                    )
                                });
     
                            }
                        });
                    }
     
                });
     
            });
     
        </script>
    @stack('scripts')
</body>

</html>
