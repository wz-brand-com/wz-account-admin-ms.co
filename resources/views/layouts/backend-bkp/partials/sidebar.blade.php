        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img">
                        @if(Auth::user()->file_pic == NULL)
                        <img src="{{url('assets/images/users/default.png')}}" class="img-circle profile-pic" width="150">
                        @else
                            <img src="{{url('storage/images/',Auth::user()->file_pic) }}" class="img-circle" width="150" height="67">
                        @endif
                        <!-- this is blinking heartbit-->
                        <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5>{{Auth::user()->name}}</h5>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <!-- {{-- admin sidebar starts --}} -->
                    <ul id="sidebarnav">     
                        <li class="nav-devider"></li>
                        <li> <a class="" href="{{url('')}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Organization Setting</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class=""><a href="{{route('managerwithslug',['slug' =>$slug])}}">Invite Member</a></li>
                                <li class=""><a href="{{route('taskwithslug',[ 'slug' => $slug])}}">Task Types</a></li>
                                <li class=""><a href="{{route('usermanagerwithslug',['slug' =>$slug])}}">Users Manager</a></li>
                            </ul>
                        </li>
                      
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-widgets"></i><span class="hide-menu">Project Onboarding</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class=""><a href="{{route('projectwithslug',[ 'slug' => $slug])}}">  Projects</a></li>
                                <li class=""><a href="{{route('addurlwithslug',[ 'slug' => $slug])}}">   Add URL</a></li>
                                <li class=""><a href="{{route('keywordwithslug',[ 'slug' => $slug])}}">  Keywords</a></li>
                            </ul>
                        </li>
                        <!-- Project Onboarding End -->
                        <!-- Rank and Ratings Start -->
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Rank & Ratings</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class=""><a href="{{route('teamratingwithslug',[ 'slug' => $slug])}}"> Team Rating</a></li>
                                <li class=""><a href="{{route('webrankwithslug',['slug' => $slug])}}">  Website Ranking</a></li>
                                <li class=""><a href="{{route('pagerankwithslug',['slug'=> $slug])}}">Page Ranking</a></li>
                                <li class=""><a href="{{route('socialrankwithslug', ['slug' => $slug])}}">Social Ranking</a></li>
                            </ul>
                        </li>
                        <!-- Rank and Ratings End -->
                        <!-- Seoassets start -->
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">SEO Assets</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class=""><a href="{{route('webaccesswithslug',['slug' =>$slug])}}">Websites & Access</a></li>
                                <li class=""><a href="{{route('emailwithslug',['slug' => $slug])}}">Emails & Access</a></li>
                                <li class=""><a href="{{route('phonenumberwithslug',['slug' =>$slug])}}">Phone Numbers</a></li>
                            </ul>
                        </li>
                        <!-- Seoassets end -->
                        <!-- task managers section start -->
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Task Managers</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class=""><a href="{{route('taskboardwithslug', ['slug' => $slug])}}">Task Board</a></li>
                                <li class=""><a href="{{route('intervaltask')}}">Interval Task</a></li>
                            </ul>
                        </li>
                        <!-- task managers section end -->
                        <li> <a class="waves-effect waves-dark" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="mdi mdi-power text-danger"></i><span class="text-danger hide-menu">Logout</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             {!! @csrf_field() !!}
                        </form>
                        </li>
                        
                   



            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
