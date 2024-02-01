<!-- Sidebar -->

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Rizky POS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{$active === 'dashboard' ? 'active' : ''}}">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>
    
    <li class="nav-item {{$active === 'item' ? 'active' : ''}}">
        <a class="nav-link" href="{{route('items.index')}}">
            <i class="fas fa-fw fa-dolly-flatbed"></i>
            <span>Items</span></a>
    </li>

    <li class="nav-item {{$active === 'transactions' ? 'active' : ''}}">
        <a class="nav-link" href="{{route('transactions.index')}}">
            <i class="fas fa-fw fa-exchange-alt"></i>
            <span>Transactions</span></a>
    </li>

    <li class="nav-item {{$active === 'category' ? 'active' : ''}}">
        <a class="nav-link" href="{{route('category.index')}}">
            <i class="fas fa-fw fa-filter"></i>
            <span>Category</span></a>
    </li>

    <li class="nav-item {{$active === 'users' ? 'active' : ''}}">
        <a class="nav-link" href="{{route('customer.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Customer Data</span></a>
    </li>

    <li class="nav-item {{$active === 'report' ? 'active' : ''}}">
        <a class="nav-link" href="{{route('customer.index')}}">
            <i class="fas fa-fw fa-print"></i>
            <span>Generate Reports</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
