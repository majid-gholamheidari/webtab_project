<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">

            <a href="#" class="nav-link" style="direction: rtl">{{ now()->format('l, d M Y') }}</a>
        </li>
    </ul>
    <!-- Right navbar links Y %B d, l -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">welcome
                    <strong>{{ Auth::guard('admin')->user()->name }}</strong></span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"
                    onclick="document.getElementById('logout-form').submit()">sign out</a>
                <form action="{{ route('dashboard.logout') }}" method="POST" style="display: none" id="logout-form">
                    @csrf
                </form>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
