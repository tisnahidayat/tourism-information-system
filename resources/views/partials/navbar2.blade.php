<div class="navbar-bg-dashboard"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i>
            </li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->username }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                {{-- <a href="features-profile.html" class="dropdown-item has-icon">
                    <i class="far fa-user me-3"></i> Profile
                </a> --}}
                <form action="/logout" method="POST" class="dropdown-item">
                    @csrf
                    <button type="submit" class="btn d-flex align-items-center p-0"
                        style="border: none; background: none;">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        <span class="ml-1 font-weight-bold">Logout</span>
                    </button>
                </form>
            </div>

        </li>
    </ul>
</nav>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#logoutLink').on('click', function(event) {
                event.preventDefault(); // Menghentikan tindakan bawaan tautan
                $('#logoutForm').submit(); // Mengirim formulir POST
            });
        });
    </script>
@endpush
