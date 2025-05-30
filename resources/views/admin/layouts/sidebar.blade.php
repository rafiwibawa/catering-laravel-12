@php
    $segment = Request::segment(2); 
@endphp
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Rumah Makan Anni</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item @if($segment == 'dashboard') {{'active'}} @endif">
                <a class="nav-link" href="/admin/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Transaksi
            </div>
 
            <!-- Nav Item - Tables -->
            <li class="nav-item @if($segment == 'order') {{'active'}} @endif">
                <a class="nav-link" href="/admin/order">
                    <i class="fas fa-fw fa-cart-plus"></i>
                    <span>Order</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data Master
            </div>
 
            <!-- Nav Item - Tables -->
            <li class="nav-item @if($segment == 'categories') {{'active'}} @endif">
                <a class="nav-link" href="/admin/categories">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Category</span></a>
            </li>
            
            <!-- Nav Item - Charts -->
            <li class="nav-item @if($segment == 'menus') {{'active'}} @endif">
                <a class="nav-link" href="/admin/menus">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Menu</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item @if($segment == 'customers') {{'active'}} @endif">
                <a class="nav-link" href="/admin/customers">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Customer</span></a>
            </li>

            <li class="nav-item @if($segment == 'users') {{'active'}} @endif">
                <a class="nav-link" href="/admin/users">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Admin</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block"> 

            <!-- Heading -->
            <div class="sidebar-heading">
                Off
            </div>

            <li class="nav-item @if($segment == 'logout') {{'active'}} @endif">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Keluar</span></a>
            </li>


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="{{ asset('cms/img/undraw_rocket.svg') }}" alt="...">
                <p class="text-center mb-2"><strong>Rumah Makan Anni</strong> menghadirkan layanan katering terbaik dengan menu lezat dan pelayanan profesional!</p>
            </div>

        </ul>
        <!-- End of Sidebar -->