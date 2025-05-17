<nav class="navbar navbar-expand-lg navbar-bg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">DISPARBUD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fas fa-bars" style="color:#fff; font-size:28px;"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link me-3 font-weight-bolder {{ Request::is('/') ? 'active' : '' }}"
                        aria-current="page" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-3 font-weight-bolder {{ Request::is('profil') ? 'active' : '' }}"
                        href="/profil">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-3 font-weight-bolder {{ Route::is('wisata*') ? 'active' : '' }}"
                        href="/wisata">Wisata</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-3 font-weight-bolder {{ Route::is('hotel*') ? 'active' : '' }}"
                        href="/hotel">Hotel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-3 font-weight-bolder {{ Route::is('kontak*') ? 'active' : '' }}"
                        href="/kontak">Kontak</a>
                </li>
                @auth
                    @if (auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link me-3 font-weight-bolder" href="/dashboard">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="nav-link me-3 font-weight-bolder"
                                    style="border: none; background: none; padding: 0;">Logout</button>
                            </form>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link me-3 font-weight-bolder {{ Request::is('login') ? 'active' : '' }}"
                            href="/login">Login</a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>


<script>
    window.addEventListener('DOMContentLoaded', function() {
        var navbar = document.querySelector('.navbar');
        var navLinks = document.querySelectorAll('.nav-link');
        var navBrand = document.querySelector('.navbar-brand');

        // Function to add 'active' class to clicked link and remove from others
        function setActiveLink(clickedLink) {
            navLinks.forEach(function(link) {
                link.classList.remove('active');
            });
            clickedLink.classList.add('active');
        }

        // Function to toggle classes
        function toggleClasses(element, className, add) {
            if (add) {
                element.classList.add(className);
            } else {
                element.classList.remove(className);
            }
        }

        // Add click event listener to each navigation link
        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                setActiveLink(this); // Set the clicked link as active
            });
        });

        // Scroll event listener
        window.addEventListener('scroll', function() {
            if (window.scrollY > 0) {
                toggleClasses(navbar, 'navbar-bg-dark', true);
                toggleClasses(navBrand, 'color-brand', true);
                navLinks.forEach(function(link) {
                    toggleClasses(link, 'fontColor', true);
                });
            } else {
                toggleClasses(navbar, 'navbar-bg-dark', false);
                toggleClasses(navBrand, 'color-brand', false);
                navLinks.forEach(function(link) {
                    toggleClasses(link, 'fontColor', false);
                });
            }
        });
    });
</script>
