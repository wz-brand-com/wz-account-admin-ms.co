
<style>
    .navbar-nav li:hover > ul.dropdown-menu {
    display: block;
}
.dropdown-submenu {
    position:relative;
}
.dropdown-submenu>.dropdown-menu {
    top:0;
    left:10%;
    margin-top:-3px;
}

/* rotate caret on hover */
.dropdown-menu > li > a:hover:after {
    text-decoration: underline;
    transform: rotate(-90deg);
}

.logos{
    background-image: url('../../../assets/images/wiz.png');
}

</style>

<nav class="navbar navbar-expand-lg navbar" style="background-color: #0b1320;">
    <div class="container-fluid">
        <a href="/"><img class="logos" src="assets/images/wiz.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <img src="assets/images/toggle.png" alt="">
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <ul class="navbar-nav topnav">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active"
                        href="{{ route('organzations.list.all') }}">Organizations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active"
                        href="{{ route('user-profile') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active"
                        href="{{ route('about')}}">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="https://www.wizbrand.com/tutorials/"
                        target="_blank">Tutorials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="https://www.wizbrand.com/tools/">Tools</a>
                 </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('service')}}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/register')}}">Register</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link active" href="{{ url('/login')}}">Login</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
