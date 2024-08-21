<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
        <div class="nav-toggle">
            <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
            </button>
            <div class="h1 text-start">
                <h4 class="card-title">
                    Hello, {{ ucfirst($userData->username) }}!
                </h4>
            </div>
        </div>
        </div>
        <!-- End Logo Header -->
    </div>
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid d-flex align-items-center position-relative">
            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form p-0 d-none d-lg-flex">
            </nav>
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center w-100">
                <li class="nav-item topbar-user dropdown hidden-caret w-100">
                    <div class="w-50">
                        <div class="h1 text-start">
                            <h4 class="card-title">
                                Hello, {{ ucfirst($userData->username) }}!
                            </h4>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- End Navbar -->
</div>
