<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sales Inventory</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}" />
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/toastify.min.css') }}" rel="stylesheet" />


    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css') }}"
        rel="stylesheet" />

    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    
    <script src="{{ asset('js/toastify-js.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
  
</head>

<body>

    <div id="loader" class="LoadingOverlay d-none">
        <div class="Line-Progress">
            <div class="indeterminate"></div>
        </div>
    </div>

    <nav class="navbar fixed-top px-0 shadow-sm bg-white mb-5">
        <div class="container-fluid">

            <a class="navbar-brand" href="#">
                <span class="icon-nav m-0 h5" onclick="MenuBarClickHandler()">
                    <img class="nav-logo-sm mx-2" src="{{ asset('images/menu.svg') }}" alt="logo" />
                </span>
                {{-- <img class="nav-logo  mx-2"  src="{{asset('images/logo.png')}}" alt="logo"/> --}}
                <svg width="200" height="50" viewBox="0 0 200 50" xmlns="http://www.w3.org/2000/svg">
                    <!-- Orange dot with pulsing effect -->
                    <circle cx="20" cy="25" r="5" fill="#FF6A00">
                        <animate attributeName="r" values="5;8;5" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="fill-opacity" values="1;0.5;1" dur="1s"
                            repeatCount="indefinite" />
                    </circle>

                    <!-- .X text with sliding animation -->
                    <text x="35" y="30" font-family="Arial, sans-serif" font-size="24" fill="#002855">
                        <tspan>.E-</tspan>
                    </text>

                    <!-- Shop text with horizontal movement -->
                    <text x="65" y="30" font-family="Arial, sans-serif" font-size="24" fill="#002855">
                        <tspan>
                            <animate attributeName="x" values="65; 75; 65" dur="1.5s" repeatCount="indefinite" />
                            Shop
                        </tspan>
                    </text>
                </svg>
            </a>

            <div class="float-right h-auto d-flex">
                <div class="user-dropdown">
                    <img class="icon-nav-img" src="{{ asset('images/user.webp') }}" alt="" />
                    <div class="user-dropdown-content ">
                        <div class="mt-4 text-center">
                            <img class="icon-nav-img" src="{{ asset('images/user.webp') }}" alt="" />
                            <h6>User Name</h6>
                            <hr class="user-dropdown-divider  p-0" />
                        </div>
                        <a href="{{ url('/userProfile') }}" class="side-bar-item">
                            <span class="side-bar-item-caption">Profile</span>
                        </a>
                        <a href="{{ url('/logout') }}" class="side-bar-item">
                            <span class="side-bar-item-caption">Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div id="sideNavRef" class="side-nav-open bg-info text-white">

        <a href="{{ url('/dashboard') }}" class="side-bar-item">
            <i class="bi bi-graph-up bg-gradient-success shadow"></i>
            <span class="side-bar-item-caption text-white">Dashboard</span>
        </a>


        <a href="{{ url('/categoryPage') }}" class="side-bar-item">
            <i class="bi bi-list-nested bg-gradient-success shadow "></i>
            <span class="side-bar-item-caption text-white">Category</span>
        </a>

        <a href="{{ url('/productPage') }}" class="side-bar-item">
            <i class="bi bi-bag bg-gradient-success shadow "></i>
            <span class="side-bar-item-caption text-white">Product</span>
        </a>

        <a href="{{ url('/salePage') }}" class="side-bar-item">
            <i class="bi bi-currency-dollar bg-gradient-success shadow "></i>
            <span class="side-bar-item-caption text-white">Create Sale</span>
        </a>
        <a href="{{ url('/customerpage') }}" class="side-bar-item">
            <i class="bi bi-people bg-gradient-success shadow "></i>
            <span class="side-bar-item-caption text-white">Customer</span>
        </a>
        <a href="{{ url('/invoicePage') }}" class="side-bar-item">
            <i class="bi bi-receipt bg-gradient-success shadow "></i>
            <span class="side-bar-item-caption text-white">Invoice</span>
        </a>

        <a href="{{ url('/reportPage') }}" class="side-bar-item">
            <i class="bi bi-file-earmark-bar-graph bg-gradient-success shadow "></i>
            <span class="side-bar-item-caption text-white">Report</span>
        </a>


    </div>


    <div id="contentRef" class="content">
        @yield('content')
    </div>

    <script>
        function MenuBarClickHandler() {
            let sideNav = document.getElementById('sideNavRef');
            let content = document.getElementById('contentRef');
            if (sideNav.classList.contains("side-nav-open")) {
                sideNav.classList.add("side-nav-close");
                sideNav.classList.remove("side-nav-open");
                content.classList.add("content-expand");
                content.classList.remove("content");
            } else {
                sideNav.classList.remove("side-nav-close");
                sideNav.classList.add("side-nav-open");
                content.classList.remove("content-expand");
                content.classList.add("content");
            }
        }

    </script>

    
</body>

</html>
