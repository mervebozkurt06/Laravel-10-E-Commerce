<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-divider">
                            Menu
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category') }}"><i class="far fa-clone"></i>Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product') }}"><i class="fab fa-product-hunt"></i>Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('shopcart') }}"><i class="fas fa-shopping-cart"></i>ShopCart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('myOrders') }}"><i class="fas fa-shopping-cart"></i>My
                                Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('signout') }}"><i class="far fa-hand-point-right"></i>Logout</a>
                            <small>Signed <b>{{Auth::user()->name}} ({{Auth::user()->role->name}}) </b></small>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- ============================================================== -->
<!-- end left sidebar -->
