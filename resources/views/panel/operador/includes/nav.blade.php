<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('panel.index') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Help</a>
        </li>
    </ul>
    <form action="{{ route('clientes.search') }}" method="GET" class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" name="value" type="search" placeholder="Pesquisar"
                aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-pink elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('panel.index') }}" class="brand-link">
        <img src="{{ asset('assets/site/img/icon.png') }}" alt="" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">
            Entre Amigas
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/admin/img/avatar2.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('panel.index') }}"
                        class="nav-link{{ $activePage == 'panel.index' ? ' active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('caixa.index') }}"
                        class="nav-link{{ $activePage == 'caixa.index' ? ' active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           Caixa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('agenda.index') }}"
                        class="nav-link{{ $activePage == 'agenda.index' ? ' active' : '' }}">
                        <i class="nav-icon fas fa-calendar-alt"></i></i>
                        <p>
                            Agenda
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}"
                        class="nav-link{{ $activePage == 'profile.edit' ? ' active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Perfil
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="nav-link">
                        <i class="nav-icon fa fa-stop-circle"></i>
                        <p>
                            {{ __('Logout') }}
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>