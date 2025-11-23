<div class="vs-menu-wrapper">
    <div class="vs-menu-area text-center">
        <button class="vs-menu-toggle"><i class="fa fa-times"></i></button>
        <div class="mobile-logo">
            <a href="index.html"><img src="{{ asset('home/img/logo.png') }}" alt="Marino"></a>
        </div>
        <div class="vs-mobile-menu">
            <ul>
                <li>
                    <a href="contact.html">Home</a>
                </li>
                <li><a href="about.html">About Us</a></li>
                <li class="menu-item-has-children">
                    <a href="shop.html">Shop</a>
                    <ul class="sub-menu">
                        <li><a href="shop.html">Shop</a></li>
                        <li><a href="shop-with-sidebar.html">Shop With Sidebar</a></li>
                        <li><a href="shop-details.html">Shop Details</a></li>
                        <li><a href="cart.html">Cart</a></li>
                        <li><a href="checkout.html">Check Out</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="service.html">Service</a>
                    <ul class="sub-menu">
                        <li><a href="service.html">Service One</a></li>
                        <li><a href="service-2.html">Service Two</a></li>
                        <li><a href="service-details.html">Service Details</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children">
                    <a href="blog.html">Blog</a>
                    <ul class="sub-menu">
                        <li><a href="blog-1.html">Blog Grid</a></li>
                        <li><a href="blog.html">Blog Grid Sidebar</a></li>
                        <li><a href="blog-list.html">Blog List</a></li>
                        <li><a href="blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="error.html">Error Page</a></li>
                <li>
                    <a href="contact.html">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--==============================
     Preloader
    ==============================-->
<div class="preloader">
    <button class="vs-btn preloaderCls">Cancel Preloader </button>
    <div class="preloader-inner text-center">
        <img src="{{ asset('home/img/logo.png') }}" alt="Marino">
        <span class="loader"></span>
    </div>
</div>
<!--==============================
    Sidemenu
    ============================== -->
<div class="sidemenu-wrapper d-none d-lg-block">
    <div class="sidemenu-content">
        <button class="closeButton sideMenuCls"><i class="fa fa-times"></i></button>
        <div class="widget  ">
            <div class="vs-widget-about">
                <div class="footer-logo">
                    <a href="index.html"><img src="{{ asset('home/img/logo.png') }}" alt="Marino"></a>
                </div>
                <p class="footer-text">Ut tellus dolor, dapibus eget, elementum ifend cursus eleifend, elit. Aenea
                    ifen dn tor wisi Aliquam er at volutpat. Dui ac tui end cursus eleifendrpis.</p>
                <div class="info-social style3">
                    <a href="#"><i class="fa fa-facebook-f"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin-in"></i></a>
                    <a href="#"><i class="fa fa-google"></i></a>
                </div>
            </div>
        </div>
        <div class="widget  ">
            <h3 class="widget_title">Recent Articles</h3>
            <div class="recent-post-wrap">
                <div class="recent-post">
                    <div class="media-img">
                        <a href="blog-details.html"><img src="{{ asset('') }}home/img/blog/recent-post-1-1.jpg"
                                alt="Blog Image"></a>
                    </div>
                    <div class="media-body">
                        <div class="recent-post-meta">
                            <a href="blog.html"><i class="fa fa-calendar-alt"></i>December 15, 2022</a>
                        </div>
                        <h4 class="post-title"><a class="text-inherit" href="blog-details.html">Expanding The Solar
                                Supply Chain Finance</a></h4>
                    </div>
                </div>
                <div class="recent-post">
                    <div class="media-img">
                        <a href="blog-details.html"><img src="{{ asset('') }}home/img/blog/recent-post-1-2.jpg"
                                alt="Blog Image"></a>
                    </div>
                    <div class="media-body">
                        <div class="recent-post-meta">
                            <a href="blog.html"><i class="fa fa-calendar-alt"></i>March 13, 2022</a>
                        </div>
                        <h4 class="post-title"><a class="text-inherit" href="blog-details.html">Surviving
                                sustainably solar energy 2022</a></h4>
                    </div>
                </div>
                <div class="recent-post">
                    <div class="media-img">
                        <a href="blog-details.html"><img src="{{ asset('') }}home/img/blog/recent-post-1-3.jpg"
                                alt="Blog Image"></a>
                    </div>
                    <div class="media-body">
                        <div class="recent-post-meta">
                            <a href="blog.html"><i class="fa fa-calendar-alt"></i>Augest 23, 2022</a>
                        </div>
                        <h4 class="post-title"><a class="text-inherit" href="blog-details.html">Future Solar Energy
                                Innovation Challenges</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--==============================
    Cart Side bar
    ============================== -->
<div class="sideCart-wrapper offcanvas-wrapper d-none d-lg-block">
    <div class="sidemenu-content">
        <button class="closeButton border-theme bg-theme-hover sideMenuCls2"><i class="fa fa-times"></i></button>
        <div class="widget widget_shopping_cart">
            <h3 class="widget_title">Shopping cart</h3>
            <div class="widget_shopping_cart_content">
                <ul class="cart_list">
                    <li class="mini_cart_item">
                        <a href="shop.html" class="remove"><i class="fa fa-trash-alt"></i></a> <a
                            href="shop.html"><img src="{{ asset('') }}home/img/cart/cart-img-1.png"
                                alt="Cart Image" />Fishing Reels Spin</a>
                        <span class="quantity">
                            1 × <span class="amount"><span>$</span>100.00</span>
                        </span>
                    </li>
                    <li class="mini_cart_item">
                        <a href="shop.html" class="remove"><i class="fa fa-trash-alt"></i></a> <a
                            href="shop.html"><img src="{{ asset('') }}home/img/cart/cart-img-2.png"
                                alt="Cart Image" />Spoon lure tackle Baits</a>
                        <span class="quantity">
                            1 × <span class="amount"><span>$</span>19.00</span>
                        </span>
                    </li>
                    <li class="mini_cart_item">
                        <a href="shop.html" class="remove"><i class="fa fa-trash-alt"></i></a> <a
                            href="shop.html"><img src="{{ asset('') }}home/img/cart/cart-img-3.png"
                                alt="Cart Image" />Fishing Reels Globeride</a>
                        <span class="quantity">
                            1 × <span class="amount"><span>$</span>10.00</span>
                        </span>
                    </li>
                </ul>
                <div class="total">
                    <strong>Subtotal:</strong> <span class="amount"><span>$</span>129.00</span>
                </div>
                <div class="buttons">
                    <a href="cart.html" class="vs-btn style4">View cart</a>
                    <a href="checkout.html" class="vs-btn style4">Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--==============================
    Header Area
    ==============================-->
<header class="vs-header">
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-xl-between justify-content-md-center align-items-center gx-50">
                <div class="col d-none d-xl-block">
                    <div class="header-links">
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-map-marker-alt"></i> 121 King St. Melbourne VIC
                                    3000, Australia </a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-envelope"></i> example@marino.com </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-auto d-flex align-items-center text-center">
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-globe"></i> English
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
                            <li><a class="dropdown-item" href="#">English</a></li>
                            <li><a class="dropdown-item" href="#">Bangla</a></li>
                        </ul>
                    </div>
                    <div class="social-media">
                        <a href="#"><i class="fa fa-facebook-f"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin-in"></i></a>
                        <a href="#"><i class="fa fa-pinterest-p"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="vs-container1">
        <div class="sticky-wrapper">
            <div class="sticky-active">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="vs-logo">
                                <a href="index.html"><img src="{{ asset('home/img/logo.png') }}" alt="logo"></a>
                                <a href="index.html" class="sticky-logo"><img src="{{ asset('home/img/logo.png') }}"
                                        alt="logo"></a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row gx-50 align-items-center ">
                                <div class="col">
                                    <nav class="main-menu d-none d-lg-block">
                                        <ul>
                                            <li>
                                                <a href="contact.html">Home</a>
                                            </li>
                                            <li>
                                                <a href="contact.html">Products</a>
                                            </li>
                                            <li>
                                                <a href="contact.html">About Us</a>
                                            </li>
                                            <li>
                                                <a href="contact.html">Wrokflow</a>
                                            </li>
                                            <li>
                                                <a href="contact.html">Pricing Request</a>
                                            </li>
                                            <li>
                                                <a href="contact.html">Contact Us</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="col-auto d-lg-none">
                                    <button class="vs-menu-toggle d-inline-block">
                                        <i class="fa-solid fa-bars"></i> </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto d-none d-xl-block">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="header-info">
                                        <div class="icon-btn">
                                            <i class="fa fa-phone-alt"></i>
                                        </div>
                                        <div class="media-body">
                                            <span class="header-info_label">Call Now</span>
                                            <div class="header-info_link">
                                                <a href="tel:+26921562148">(+269) 2156 2148</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-auto">
                                    <button class="icon-btn sideCartToggler has-badge" type="button">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="badge">0</span>
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <button class="bar-btn sideMenuToggler d-none d-xl-block">
                                        <i class="fa-solid fa-bars"></i>
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
