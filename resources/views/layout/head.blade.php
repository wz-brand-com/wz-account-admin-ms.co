<header class="mdc-top-app-bar">
  <div class="mdc-top-app-bar__row">
    <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
      
      <div style="margin-left: 230px">
      <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu</button>
      <span class="mdc-top-app-bar__title"></span>
    </div>
      <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon search-text-field d-none d-md-flex">
        <i class="material-icons mdc-text-field__icon">search</i>
        <input class="mdc-text-field__input" id="text-field-hero-input">
        <div class="mdc-notched-outline">
          <div class="mdc-notched-outline__leading"></div>
          <div class="mdc-notched-outline__notch">
            <label for="text-field-hero-input" class="mdc-floating-label">Search..</label>
          </div>
          <div class="mdc-notched-outline__trailing"></div>
        </div>
      </div>
    </div>
      <!-- testing by amit open -->
      <!-- {{-- add here profile label start --}} -->
         
            @if ($getting_roll_id ==1)
            <span style="margin-left: 44px;">
            <button type="button" class="btn btn-light mt-2" style=""><i class="fa fa-shield" aria-hidden="true">&nbsp;&nbsp;
              Admin</span>
            </i> &nbsp;&nbsp;
            </button>
         
          @elseif ($getting_roll_id ==2)
          <span style="margin-left: 44px;">
            <button type="button" class="btn btn-info mt-2" style=""><i class="fa fa-shield" aria-hidden="true">&nbsp;&nbsp;
              Manager</span>
            </i> &nbsp;&nbsp;
            </button>
          @else
          <span style="margin-left: 44px;">
            <button type="button" class="btn btn-light mt-2" style=""><i class="fa fa-shield" aria-hidden="true">&nbsp;&nbsp;
              User</span>
            </i> &nbsp;&nbsp;
            </button>
          @endif
      <!-- {{-- add here profile label end  --}} -->
      <!-- testing by amit close -->
    <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
      <div class="menu-button-container menu-profile d-none d-md-block">
      <button class="mdc-button mdc-menu-button">
          <span class="d-flex align-items-center">
            <span class="figure">

            @if(Auth::user()->file_pic == NULL)
              <img src="{{url('assets/images/users/default.png')}}" class="navbar-brand">
            @else
            <img src="{{url('storage/images/',Auth::user()->file_pic) }}"
                  class="rounded-circle ml-2 border border-primary" style="width: 31px" width="45px"alt="">
            @endif
            </span>
            <span class="user-name">{{Auth::user()->name}}</span>
          </span>
          
        </button>
      </span>
        <div class="mdc-menu mdc-menu-surface" tabindex="-1">
          <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon-only">
                <i class="mdi mdi-account-edit-outline text-primary"></i>
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <a class="item-subject font-weight-normal" href="{{route('viewprofilewithslug', ['org_slug' =>$org_slug])}}" target="_blank">Edit profile</a>
              </div>
            </li>
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon-only">
                <i class="mdi mdi-settings-outline text-primary"></i>                      
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                
                <a class="item-subject font-weight-normal" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {!! @csrf_field() !!}
              </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="divider d-none d-md-block"></div>
      <div class="menu-button-container d-none d-md-block">
      </div>
      <div class="menu-button-container">
        <button class="mdc-button mdc-menu-button">
          <i class="mdi mdi-bell"></i>
        </button>
        <div class="mdc-menu mdc-menu-surface" tabindex="-1">
          <h6 class="title"> <i class="mdi mdi-bell-outline mr-2 tx-16"></i> Notifications</h6>
          <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon">
                <i class="mdi mdi-email-outline"></i>
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="item-subject font-weight-normal">You received a new message</h6>
                <small class="text-muted"> 6 min ago </small>
              </div>
            </li>
            
          </ul>
        </div>
      </div>
      <div class="menu-button-container">
        <button class="mdc-button mdc-menu-button">
          <i class="mdi mdi-email"></i>
          <span class="count-indicator">
            <span class="count">3</span>
            
          </span>
        </button>
        <div class="mdc-menu mdc-menu-surface" tabindex="-1">
          <h6 class="title"><i class="mdi mdi-email-outline mr-2 tx-16"></i> Messages</h6>
          <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail">
                <img src="new-assets/images/faces/face4.jpg" alt="user">
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="item-subject font-weight-normal">Mark send you a message</h6>
                <small class="text-muted"> 1 Minutes ago </small>
              </div>
            </li>
                           
          </ul>
        </div>
      </div>
      <div class="menu-button-container d-none d-md-block">
        <button class="mdc-button mdc-menu-button">
          <i class="mdi mdi-arrow-down-bold-box"></i>
        </button>
        <div class="mdc-menu mdc-menu-surface" tabindex="-1">
          <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
            {{-- <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon-only">
                <i class="mdi mdi-lock-outline text-primary"></i>
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="item-subject font-weight-normal">Lock screen</h6>
              </div>
            </li> --}}
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon-only">
                <i class="mdi mdi-logout-variant text-primary"></i>                      
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                {{-- <h6 class="item-subject font-weight-normal">Logout</h6> --}}
                <a class="item-subject font-weight-normal" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {!! @csrf_field() !!}
              </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>