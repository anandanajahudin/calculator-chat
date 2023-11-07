<header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

    <div class="container">
        <div class="row align-items-center">

            <div class="col-11 col-xl-2">
                <h1 class="mb-0 site-logo"><a href="index.html" class="mb-0">
                        Strategy<span class="text-primary">.</span></a>
                </h1>
            </div>
            <div class="col-12 col-md-10 d-none d-xl-block">
                <nav class="site-navigation position-relative text-right" role="navigation">

                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                        <li><a href="#home-section" class="nav-link">Home</a></li>
                        <li><a href="#work-section" class="nav-link">Work</a></li>
                        <li>
                            <a href="#services-section" class="nav-link">Services</a>
                        </li>
                        <li class="has-children">
                            <a href="#about-section" class="nav-link">About</a>
                            <ul class="dropdown">
                                <li><a href="#about-section">Specialties</a></li>
                                <li><a href="#team-section">Our Team</a></li>
                            </ul>
                        </li>
                        <li><a href="#blog-section" class="nav-link">Blog</a></li>
                        <li><a href="#contact-section" class="nav-link">Contact</a></li>
                        @guest
                            <li><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        @else
                            <li class="has-children">
                                <a href="#" class="nav-link">{{ Auth::user()->fname }}</a>
                                <ul class="dropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Log
                                            Out</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </nav>
            </div>

            <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a
                    href="#" class="site-menu-toggle js-menu-toggle text-black"><span
                        class="icon-menu h3"></span></a></div>

        </div>
    </div>

</header>
