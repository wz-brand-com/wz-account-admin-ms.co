<aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open" style="margin-top: -81px">
  <div class="mdc-drawer__header">
    {{-- <a href="" class="brand-logo">
    <img src="{{asset('assets/images/wizbrand-sidebar-logo.png')}}" alt="logo">
  </a> --}}
  <br><br>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/organisation')}}">Orgs</a></li>
      <li class="breadcrumb-item active" aria-current="page">
      {{ \Illuminate\Support\Str::limit($org_slug, 5) }}  
     </li>
    </ol>
  </nav>
</div>
<!-- {{-- <br> --}} -->
<div class="mdc-drawer__content">
  <div class="mdc-list-group">
    <nav class="mdc-list mdc-drawer-menu">
      <div class="mdc-list-item mdc-drawer-item">
        <a class="mdc-drawer-link" href="{{route('slugdashboard',['org_slug' =>$org_slug])}}">
          <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
          Dashboard
        </a>
      </div>
      <div class="mdc-list-item mdc-drawer-item">
        <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui-sub-menuu">
          <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">dashboard</i>
          Organization&nbsp;&nbsp;Setting
          <i class="mdc-drawer-arrow material-icons">chevron_right</i>
        </a>
        <div class="mdc-expansion-panel" id="ui-sub-menuu">
          <nav class="mdc-list mdc-drawer-submenu">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('managerwithslug',['org_slug' =>$org_slug])}}">
                Invite Member
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{url('orgs')}}">
                Organization List
              </a>
            </div>
          </nav>
        </div>
      </div>
      <div class="mdc-list-item mdc-drawer-item">
        <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui-sub-menuui">
          <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">dashboard</i>
          Project Onboarding
          <i class="mdc-drawer-arrow material-icons">chevron_right</i>
        </a>
        <div class="mdc-expansion-panel" id="ui-sub-menuui">
          <nav class="mdc-list mdc-drawer-submenu">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('projectwithslug',[ 'org_slug' => $org_slug])}}">
                Projects
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('keywordwithslug',[ 'org_slug' => $org_slug])}}">
                Keyword
              </a>
            </div>
          </nav>
        </div>
      </div>
      <div class="mdc-list-item mdc-drawer-item">
        <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui-sub-menuuo">
          <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">dashboard</i>
          Rank & Ratings
          <i class="mdc-drawer-arrow material-icons">chevron_right</i>
        </a>
        <div class="mdc-expansion-panel" id="ui-sub-menuuo">
          <nav class="mdc-list mdc-drawer-submenu">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('teamratingwithslug',[ 'org_slug' => $org_slug])}}">
                Team Rating
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('webrankwithslug',['org_slug' => $org_slug])}}">
                Website Ranking
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('pagerankwithslug',['org_slug'=> $org_slug])}}">
                Page Ranking
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('socialrankwithslug', ['org_slug' => $org_slug])}}">
                Social Ranking
              </a>
            </div>
          </nav>
        </div>
      </div>
      <div class="mdc-list-item mdc-drawer-item">
        <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui-sub-menuup">
          <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">dashboard</i>
          SEO Assets
          <i class="mdc-drawer-arrow material-icons">chevron_right</i>
        </a>
        <div class="mdc-expansion-panel" id="ui-sub-menuup">
          <nav class="mdc-list mdc-drawer-submenu">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('webaccesswithslug',['org_slug' =>$org_slug])}}">
                Website & Access
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('emailwithslug',['org_slug' => $org_slug])}}">
                Email & Access
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('phonenumberwithslug',['org_slug' =>$org_slug])}}">
                Phone Numbers
              </a>
            </div>
          </nav>
        </div>
      </div>
      <div class="mdc-list-item mdc-drawer-item">
        <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui-sub-menuuq">
          <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">dashboard</i>
          Task Managers
          <i class="mdc-drawer-arrow material-icons">chevron_right</i>
        </a>
        <div class="mdc-expansion-panel" id="ui-sub-menuuq">
          <nav class="mdc-list mdc-drawer-submenu">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('taskboardwithslug', ['org_slug' => $org_slug])}}">
                Task Board
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('intervaltask',['org_slug' => $org_slug])}}">
                Interval Task
              </a>
            </div>
          </nav>
        </div>
      </div>
    </nav>
  </div>
  <div style="margin-left: 46px">
    <a href="{{ route('logout') }}" style="color: white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="fa fa-sign-out" style="font-size: 18px" style="margin-right: -43px" aria-hidden="true"></i>&nbsp;Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {!! @csrf_field() !!}
 </form>
  </div>
  <div class="mdc-card premium-card">
    <div class="d-flex align-items-center">
      <div class="mdc-card icon-card box-shadow-0">
        <i class="mdi mdi-shield-outline"></i>
      </div>
      <div>
        <p class="mt-0 mb-1 ml-2 font-weight-bold tx-12">WizBrand</p>
        <p class="mt-0 mb-0 ml-2 tx-10">Digital Marketing Software</p>
      </div>
    </div>
    <p class="tx-8 mt-3 mb-1">Get free Software with More Leads</p>
    <p class="tx-8 mb-3">Starting from free</p>
    <a href="https://www.wizbrand.com/tutorials/" target="_blank">
      <span class="mdc-button mdc-button--raised mdc-button--white">WizBrand Blog</span>
    </a>
  </div>
</div>
</aside>  