@extends('admin.layout.master')
@section('content')
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                Pansatlan Admin Page
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="{{ route('categoryListPage') }}" class="text-decoration-none">
                                <i class="fa-solid fa-list"></i>Categories List</a>
                        </li>
                        <li>
                            <a href="{{ route('productListPage') }}" class="text-decoration-none">
                                <i class="fa-solid fa-warehouse"></i>Products lists</a>
                        </li>
                        <li>
                            <a href="{{ route('userListPage', $role = 'admin') }}" class="text-decoration-none">
                                <i class="fa-solid fa-users"></i>Admin lists</a>
                        </li>
                        <li>
                            <a href="{{ route('userListPage', $role = 'user') }}" class="text-decoration-none">
                                <i class="fa-solid fa-users"></i>Customer lists</a>
                        </li>
                        {{-- <li>
                            <a href="" class="text-decoration-none">
                                <i class="fa-solid fa-envelope"></i>Contact lists</a>
                        </li> --}}
                        <li>
                            <a href="{{ route('orderListPage') }}" class="text-decoration-none">
                                <i class="fa-solid fa-gifts"></i>Order lists</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search"
                                    placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <a href="#">
                                                @if (Auth::user()->image == null)
                                                    <img src="{{ asset('storage/default_images/pf/default_pf.png') }}"
                                                        style="max-width: 100%; max-height: 100%; display: block;">
                                                @else
                                                    <img src="{{ asset('storage/profile_images/' . Auth::user()->image) }}"
                                                        style="max-width: 100%; max-height: 100%; display: block;">
                                                @endif`
                                            </a>
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn text-decoration-none"
                                                href="#">{{ Auth::user()->name }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        @if (Auth::user()->image == null)
                                                            <img src="{{ asset('storage/default_images/pf/default_pf.png') }}"
                                                                style="max-width: 100%; max-height: 100%; display: block;">
                                                        @else
                                                            <img src="{{ asset('storage/profile_images/' . Auth::user()->image) }}"
                                                                style="max-width: 100%; max-height: 100%; display: block;">
                                                        @endif`
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"
                                                            class=" text-decoration-none">{{ Auth::user()->name }}</a>
                                                    </h5>
                                                    <span class="email">{{ Auth::user()->email }}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('accEdit') }}" class=" text-decoration-none">
                                                        <i class="fa-solid fa-user"></i></i>Account</a>
                                                    <a href="{{ route('passEdit') }}" class=" text-decoration-none">
                                                        <i class="fa-solid fa-key"></i>Password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer text-center py-3">
                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    <button type="submit"><i
                                                            class="fa-solid fa-right-from-bracket"></i>Logout</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
            @yield('categoryCreatePage')
            @yield('productCreatePage')
            @yield('productListPage')
            @yield('productEditPage')
            @yield('adminListPage')
            @yield('userDetail')
            @yield('mainContent')
            @yield('orderListPage')
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
@endsection
