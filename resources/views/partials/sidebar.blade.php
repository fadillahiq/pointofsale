<div class="logo-box"><a href="#" class="logo-text">Connect</a><a href="#" id="sidebar-close"><i class="material-icons">close</i></a> <a href="#" id="sidebar-state"><i class="material-icons">adjust</i><i class="material-icons compact-sidebar-icon">panorama_fish_eye</i></a></div>
                <div class="page-sidebar-inner slimscroll">
                    <ul class="accordion-menu">
                        <li class="sidebar-title">
                            Apps
                        </li>
                        <li class="{{ request()->is('dashboard') ? 'active-page' : '' }}">
                            <a href="{{ route('dashboard') }}" class="active"><i class="material-icons-outlined">dashboard</i>Dashboard</a>
                        </li>
                        <li class="sidebar-title">
                            Master Data
                        </li>
                        <li class="{{ request()->is('menu/category') ? 'active-page' : '' }}">
                            <a href="{{ route('category') }}"><i class="material-icons">bookmark_border</i>Category</a>
                        </li>
                        <li class="{{ request()->is('menu/product') ? 'active-page' : '' }}">
                            <a href="{{ route('product') }}"><i class="material-icons">inventory</i>Product</a>
                        </li>
                        <li class="sidebar-title">
                            Menu
                        </li>
                        <li class="{{ request()->is('menu/transaction') ? 'active-page' : '' }}">
                            <a href="{{ route('transaction') }}"><i class="material-icons">shopping_cart</i>Transaction</a>
                        </li>
                    </ul>
                </div>
