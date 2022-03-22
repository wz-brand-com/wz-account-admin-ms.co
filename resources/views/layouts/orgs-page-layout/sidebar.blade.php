<aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open" style="margin-top: -81px">
    <div class="mdc-drawer__header">

        <br><br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Orgs</a></li>

            </ol>
        </nav>
    </div>

    <div class="mdc-drawer__content">
        <div class="mdc-list-group">
            <nav class="mdc-list mdc-drawer-menu">
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="" data-bs-toggle="modal"
                    data-bs-target="#exampleModalurl">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                            aria-hidden="true">home</i>
                        Dashboard
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="" data-bs-toggle="modal"
                        data-bs-target="#exampleModalurl">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon">dashboard</i>
                            Organization&nbsp;&nbsp;Setting
                            <i class="mdc-drawer-arrow material-icons">chevron_right</i>
                        </i> 
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="" data-bs-toggle="modal"
                        data-bs-target="#exampleModalurl">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon">dashboard</i>
                            Project&nbsp;&nbsp;Onboarding
                            <i class="mdc-drawer-arrow material-icons">chevron_right</i>
                        </i> 
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="" data-bs-toggle="modal"
                        data-bs-target="#exampleModalurl">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon">dashboard</i>
                            Rank &&nbsp;&nbsp;Rating
                            <i class="mdc-drawer-arrow material-icons">chevron_right</i>
                        </i> 
                    </a>
                </div>

                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="" data-bs-toggle="modal"
                        data-bs-target="#exampleModalurl">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon">dashboard</i>
                            SEO Assets
                            <i class="mdc-drawer-arrow material-icons">chevron_right</i>
                        </i> 
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="" data-bs-toggle="modal"
                        data-bs-target="#exampleModalurl">
                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon">dashboard</i>
                            Task Manager
                            <i class="mdc-drawer-arrow material-icons">chevron_right</i>
                        </i> 
                    </a>
                </div>
            </nav>
        </div>
        <div style="margin-left: 46px">
            <a href="{{ route('logout') }}" style="color: white"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out" style="font-size: 18px" style="margin-right: -43px"
                    aria-hidden="true"></i>&nbsp;Logout
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
            <a href="https://www.wizbrand.com/tutorials/">
                <span class="mdc-button mdc-button--raised mdc-button--white">WizBrand Blog</span>
            </a>
        </div>
    </div>
</aside>
