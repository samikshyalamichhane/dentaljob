 <!-- update profile section-->
 <section class="d-complete-profile mt-3">
     <div class="container">
         <div class="complete-profile-box">
             <div class="row">
                 <div class="col-sm-12 col-md-3 text-center">
                     <x-progressbar></x-progressbar>
                 </div>
                 @if ($profile_progres != 100)
                     <div class="col-sm-12 col-md-6">
                         <div class="complete-text-box">
                             <h6 class="poppin-regular"><i class="fa fa-user"></i>Profile Completeness</h6>
                             <p>Please complete your profile to 100% to increase the chance of getting right job
                                 matching
                                 with your Profile. </p>
                         </div>
                     </div>

                     <div class="col-sm-12 col-md-3  d-flex justify-content-center align-items-center ">
                         <button class="btn bg-green"><a
                                 href="{{ route('editProfile', Auth::user()->username) }}">Update
                                 Your
                                 Profile</a></button>
                         <div class="close-btn">
                             x
                         </div>
                     </div>
                 @else
                     <div class="col-sm-12 col-md-6">
                         <div class="complete-text-box">
                             <h6 class="poppin-regular"></i>Congratulations!!!</h6>

                         </div>

                         <div class="close-btn">
                             x
                         </div>

                     </div>
                 @endif
             </div>
         </div>
     </div>

 </section>
 <!-- update profile section ends -->
