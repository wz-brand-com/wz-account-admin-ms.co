
<style>
  .sidebar-toggler{
    display: none;
  }
</style>

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
      
    <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
      <div class="menu-button-container menu-profile d-none d-md-block">
      <button class="mdc-button mdc-menu-button">
          <span class="d-flex align-items-center">
            
            <span class="user-name circle">{{Auth::user()->name}}</span>
          </span>
          
        </button>
      </span>
        <div class="mdc-menu mdc-menu-surface" tabindex="-1">
          <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
            
            <li class="mdc-list-item" role="menuitem">
              
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