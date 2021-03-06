<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('backend/img/sidebar-1.jpg') }}">
    <div class="logo">
        <a href="{{ route('admin.dashboard') }}" class="simple-text logo-normal">
            Mamma's Kitchen
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/sliders*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('sliders.index') }}">
                    <i class="material-icons">slideshow</i>
                    <p>Sliders</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/categories*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Categories</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/items*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('items.index') }}">
                    <i class="material-icons">library_books</i>
                    <p>Items</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/reservation*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('reservation.index') }}">
                    <i class="material-icons">chrome_reader_mode</i>
                    <p>Reservations</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/contact*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('contacts.index') }}">
                    <i class="material-icons">message</i>
                    <p>Message Contact</p>
                </a>
            </li>
        </ul>
    </div>
</div>
