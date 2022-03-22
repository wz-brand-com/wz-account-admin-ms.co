        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">
                        <!-- Logo icon -->
                        <b>
                            <img src="{{ url('assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="{{ url('assets/images/logo-light-icon.png')}}" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <span>
                            <!-- dark Logo text -->
                            <img src="{{ url('assets/images/seodaily.png')}}" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="{{ url('assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <!-- if conditon open -->
                               @if(Auth::user()->file_pic == NULL)
                                <img src="{{url('assets/images/users/default.png')}}" class="img-circle profile-pic" width="150">
                                @else
                                <img src="{{url('storage/images/',Auth::user()->file_pic) }}"class="profile-pic"/>
                                @endif
                            <!-- if conditon close -->
                            </a>

                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img">
                                                @if(Auth::user()->file_pic == NULL)
                                                <img src="{{url('assets/images/users/default.png')}}" class="img-circle profile-pic" width="150">
                                                @else
                                                <img src="{{url('storage/images/',Auth::user()->file_pic) }}"class="profile-pic"/>
                                                @endif
                                            </div>
                                            <div class="u-text">
                                                <h4>{{Auth::user()->name}}</h4>
                                                <p class="text-muted"> {{Auth::user()->email}}</p>
                                                <!-- view profile open and profile pic update open -->
                                                <a href="{{route('viewprofilewithslug', ['org_slug' =>$org_slug])}}" class="btn btn-rounded btn-danger btn-sm"> View Profile</a>
                                                <!-- view profile open and profile pic update close -->
                                            </div>
                                        </div>
                                    </li>

                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                         {!! @csrf_field() !!}
                                    </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
