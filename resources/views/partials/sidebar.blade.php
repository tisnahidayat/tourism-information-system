<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">SIPARKAR</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html"><img src="{{ asset('/img/logo.png') }}" alt="" width="35%"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Data</li>
            <li class="nav-item {{ Request::is('dashboard/wisata*') ? 'active' : '' }}">
                <a href="/dashboard/wisata" class="nav-link"><i class="fas fa-map-marker-alt"></i>
                    <span>Wisata</span></a>
            </li>
            <li class="nav-item {{ Request::is('dashboard/kategori*') ? 'active' : '' }}">
                <a href="/dashboard/kategori" class="nav-link"><i class="fas fa-th-large"></i>
                    <span>Kategori</span></a>
            </li>
            <li class="nav-item {{ Request::is('dashboard/hotel*') ? 'active' : '' }}">
                <a href="/dashboard/hotel" class="nav-link"><i class="fas fa-hotel"></i>
                    <span>Hotel</span></a>
            </li>
            <li class="nav-item {{ Request::is('dashboard/pengguna*') ? 'active' : '' }}">
                <a href="/dashboard/pengguna" class="nav-link"><i class="fas fa-user"></i>
                    <span>Pengguna</span></a>
            </li>
            <li class="menu-header">Navigasi</li>
            </li>
            <li class="nav-item {{ Request::is('dashboard/senibudaya*') ? 'active' : '' }}">
                <a href="/dashboard/senibudaya" class="nav-link"><i class="fas fa-theater-masks"></i>
                    <span>Seni dan Budaya</span></a>
            </li>
            <li class="nav-item {{ Request::is('dashboard/kuliner*') ? 'active' : '' }}">
                <a href="/dashboard/kuliner" class="nav-link"><i class="fas fa-hamburger"></i>
                    <span>Kuliner</span></a>
            </li>
            <li class="nav-item {{ Request::is('dashboard/posting*') ? 'active' : '' }}">
                <a href="/dashboard/posting" class="nav-link"><i class="fas fa-newspaper"></i>
                    <span>Blog Wisata</span></a>
            </li>
            <li class="menu-header">Kontak</li>
            <li class="nav-item {{ Request::is('dashboard/kontak*') ? 'active' : '' }}">
                <a href="/dashboard/kontak" class="nav-link"><i class="fas fa-file-contract"></i>
                    <span>Kritik dan Saran</span></a>
            </li>
        </ul>
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ Route('beranda') }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Website
            </a>
        </div>
    </aside>
</div>
{{-- 
<li
    class="nav-item dropdown {{ Request::is('blog') || Request::is('dashboard/posting*') || Request::is('dashboard/katpost*') ? 'active' : '' }}">
    <a href="/blog" class="nav-link has-dropdown"><i class="fas fa-newspaper"></i>
        <span>Blog Wisata</span></a>
    <ul class="dropdown-menu">
        <li
            class="nav-item {{ Request::is('dashboard/posting*') && !Request::is('dashboard/katpost*') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard/posting">Postingan</a>
        </li>
        <li
            class="nav-item {{ Request::is('dashboard/katpost*') && !Request::is('dashboard/posting*') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard/katpost">Kategori</a>
        </li>
    </ul>
</li> --}}
