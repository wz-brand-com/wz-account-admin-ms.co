        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="../assets/images/users/profile.png" alt="user" />
                        <!-- this is blinking heartbit-->
                        <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5>Markarn Doe</h5>
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>
                        <!-- Logout button -->
                        <a href="{{ route('logout') }}" class="" data-toggle="tooltip" title="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="mdi mdi-power"></i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             {!! @csrf_field() !!}
                        </form>
                        <!-- Logout button -->
                        <div class="dropdown-menu animated flipInY">
                            <!-- text-->
                            <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                            <!-- text-->
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{route('admin.dashboard')}}">Minimal </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">System Setting</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="#">Task Types</a></li>
                                <li><a href="#">Roles</a></li>
                                <li><a href="#">Users</a></li>
                                <li><a href="#">Notifications</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Project Onboarding</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="#">Projects</a></li>
                                <li><a href="#">Add URL</a></li>
                                <li><a href="#">Keywords</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Ranks & Ratings </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="#">Team Rating</a></li>
                                <li><a href="ui-user-card.html">Website Ranking</a></li>
                                <li><a href="ui-buttons.html">Page Ranking</a></li>
                                <li><a href="ui-modals.html">Social Ranking</a></li>
                            </ul>
                        </li>
                        
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">SEO Assets</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="form-basic.html">Websites & Access</a></li>
                                <li><a href="form-layout.html">Emails & Access</a></li>
                                <li><a href="form-addons.html">Phone Numbers</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-file-chart"></i><span class="hide-menu">Task Managers</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="table-basic.html">Tasks Board</a></li>
                                <li><a href="table-layout.html">Interval Task</a></li>
                                
                            </ul>
                        </li>

                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        