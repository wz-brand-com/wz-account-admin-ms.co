        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile"> 
                    <!-- User profile image -->
                    <div class="profile-img">
                        <img src="{{url('/storage/images',Auth::user()->profile_pic)}}" class="img-circle" width="150" />

                        @if(Auth::user()->profile_pic)
                            <img src="{{url('/storage/images',Auth::user()->profile_pic)}}" class="profile-pic"  class="img-circle" width="150">
                        @else
                            <img src="/assets/images/users/1.jpg" class="img-circle" width="150">
                        @endif
                        <!-- this is blinking heartbit-->
                        <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5>{{Auth::user()->name}} <br><br> <span class="badge badge-primary"></span></h5>
                        <!-- <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a> -->
                        <!-- Logout button -->
                        <a href="{{ route('logout') }}" class="" data-toggle="tooltip" title="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="mdi mdi-power"></i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             {!! @csrf_field() !!}
                        </form>
                        <!-- Logout button -->
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    {{-- admin sidebar starts --}}
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li> <a class="" href="{{route('accountadmin.dashboard')}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <!-- <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">View</span></a>
                            <ul aria-expanded="false" class="collapse">
                             
                            </ul>
                        </li> -->
                        <!-- System setting start -->
                        <!-- <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">System Setting</span></a>
                            <ul aria-expanded="false" class="collapse">

                             <li class=""><a href="#">Task Types</a></li>
                            
                                <li class=""><a href="#">Users Manager</a></li>
                                
                            </ul>
                        </li> -->
                        <!-- System setting end -->
                        <!-- Project Onboarding Start -->
                        <!-- <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-widgets"></i><span class="hide-menu">Project Onboarding</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class=""><a href="#">Projects</a></li>
                                <li class=""><a href="#">Add URL</a></li>
                                <li class=""><a href="#">Keywords</a></li> 
                            </ul>
                        </li> -->
                        <!-- Project Onboarding End -->




            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
