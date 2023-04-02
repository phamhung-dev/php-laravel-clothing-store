<!-- LEFT MAIN SIDEBAR -->
<div class="ec-left-sidebar ec-bg-sidebar" >
    <div id="sidebar" class="sidebar ec-sidebar-footer">

        <div class="ec-brand">
            <a href="/admin/dashboard">
                <img class="ec-brand-icon"
                    src="https://andit.co/projects/html/andshop/andshop-dashboard/assets/img/logo/favicon.png" alt="">
                <span class="ec-brand-name text-truncate">ANDSHOP</span>
            </a>
        </div>

        <!-- begin sidebar scrollbar -->
        <div class="ec-navigation" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-ec-content-wrapper" style="height: 100%; overflow: hidden;">
                            <div class="simplebar-content" style="padding: 0px;">
                                <!-- sidebar menu -->
                                <ul class="nav sidebar-inner" id="sidebar-menu">
                                    <!-- Dashboard -->
                                    <li class="active">
                                        <a class="sidenav-item-link" href="/admin/dashboard">
                                            <i class="mdi mdi-view-dashboard-outline"></i>
                                            <span class="nav-text">Dashboard</span>
                                        </a>
                                        <hr>
                                    </li>
                                    <!-- Roles -->
                                    <li class="has-sub">
                                        <a class="sidenav-item-link" href="javascript:void(0)">
                                            <i class="mdi mdi-receipt"></i>
                                            <span class="nav-text">Roles</span> <b class="caret"></b>
                                        </a>
                                        <div class="collapse">
                                            <ul class="sub-menu" id="users" data-parent="#sidebar-menu">
                                                <li class="">
                                                    <a class="sidenav-item-link" href="/admin/role/">
                                                        <span class="nav-text">Roles List</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a class="sidenav-item-link" href="/admin/role/create">
                                                        <span class="nav-text">Add new</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <hr>
                                    </li>

                                    <!-- Admin Users -->
                                    <li class="has-sub">
                                        <a class="sidenav-item-link" href="javascript:void(0)">
                                            <i class="mdi mdi-account-multiple-outline"></i>
                                            <span class="nav-text">Admin user</span> <b class="caret"></b>
                                        </a>
                                        <div class="collapse">
                                            <ul class="sub-menu" id="users" data-parent="#sidebar-menu">
                                                <li class="">
                                                    <a class="sidenav-item-link" href="/admin/admin-user">
                                                        <span class="nav-text">Admin list</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a class="sidenav-item-link" href="/admin/admin-user/create">
                                                        <span class="nav-text">Add new</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <hr>
                                    </li>
                                    <!-- Users -->
                                    <li class="has-sub">
                                        <a class="sidenav-item-link" href="javascript:void(0)">
                                            <i class="mdi mdi-account-multiple-outline"></i>
                                            <span class="nav-text">Customers</span> <b class="caret"></b>
                                        </a>
                                        <div class="collapse">
                                            <ul class="sub-menu" id="users" data-parent="#sidebar-menu">
                                                <li class="">
                                                    <a class="sidenav-item-link" href="/admin/user">
                                                        <span class="nav-text">User List</span>
                                                    </a>
                                                </li> 
                                            </ul>
                                        </div>
                                        <hr>
                                    </li>
                                    <!-- Coupon -->
                                    <li class="has-sub">
                                        <a class="sidenav-item-link" href="javascript:void(0)">
                                            <i class="mdi mdi-shape"></i>
                                            <span class="nav-text">Coupon</span> <b class="caret"></b>
                                        </a>
                                        <div class="collapse">
                                            <ul class="sub-menu" id="coupon" data-parent="#sidebar-menu">
                                                <li class="">
                                                    <a class="sidenav-item-link" href="{{ route('admin.coupon') }}" >
                                                        <span class="nav-text">All coupon</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a class="sidenav-item-link" href="{{ route('admin.coupon.create') }}">
                                                        <span class="nav-text">Add coupon</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <!-- Products -->
                                    <li class="has-sub">
                                        <a class="sidenav-item-link" href="javascript:void(0)">
                                            <!-- <i class="mdi mdi-palette-advanced"></i> -->
                                            <i class="mdi mdi-package-variant-closed"></i>
                                            <span class="nav-text">Products</span> <b class="caret"></b>
                                        </a>
                                        <div class="collapse">
                                            <ul class="sub-menu" id="products" data-parent="#sidebar-menu">
                                                <li class="">
                                                    <a class="sidenav-item-link" href="/admin/product/create">
                                                        <span class="nav-text">Add Product</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a class="sidenav-item-link" href="{{ route('admin.product') }}">
                                                        <span class="nav-text">List Product</span>
                                                    </a>
                                                </li>                                        
                                            </ul>
                                        </div>
                                    </li>
                                    <!-- Products inventory-->
                                    <li class="has-sub">
                                        <a class="sidenav-item-link" href="javascript:void(0)">
                                            <!-- <i class="mdi mdi-palette-advanced"></i> -->
                                            <i class="mdi mdi-package-variant-closed"></i>
                                            <span class="nav-text">Inventory</span> <b class="caret"></b>
                                        </a>
                                        <div class="collapse">
                                            <ul class="sub-menu" id="productInventory" data-parent="#sidebar-menu">
                                                <li class="">
                                                    <a class="sidenav-item-link" href="/admin/inventory/create">
                                                        <span class="nav-text">Add Product inventory</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a class="sidenav-item-link" href="{{ route('admin.inventory') }}">
                                                        <span class="nav-text">List Product inventory</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <!-- Orders -->
                                    <li class="has-sub">
                                        <a class="sidenav-item-link" href="javascript:void(0)">
                                            <i class="mdi mdi-cart-outline"></i>
                                            <span class="nav-text">Orders</span> <b class="caret"></b>
                                        </a>
                                        <div class="collapse">
                                            <ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
                                                <li class="">
                                                    <a class="sidenav-item-link" href="{{ route('admin.order') }}">
                                                        <span class="nav-text">Order list</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>                     
                                    <!-- Logout -->
                                    <li>
                                        <a class="sidenav-item-link" href="/logout">
                                            <i class="mdi mdi-login-variant"></i>
                                            <span class="nav-text">Logout</span>
                                        </a>
                                    </li>             
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: auto; height: 739px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
            </div>
        </div>
    </div>
</div>