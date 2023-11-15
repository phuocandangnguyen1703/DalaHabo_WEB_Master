<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="/template/admin/dist/img/logo.png" alt="DalaHabo Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light" style="font-size: 32px;"><b>DalaHabo</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <!--  nav-legacy text-sm nav-child-indent-->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent nav-legacy flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/admin" class="nav-link {{ (request()->is('admin')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Tổng quan
                        </p>
                    </a>
                </li>

                <!-- Mở thì thêm class menu-open -->
                <li class="nav-item  {{ (request()->is('admin/sliders/*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            Slider
                            <i class="fas fa-angle-right right pr-1"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/sliders/all" class="nav-link {{ (request()->is('admin/sliders/all')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sliders/create" class="nav-link {{ (request()->is('admin/sliders/create')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm slider</p>
                            </a>
                        </li>
                    </ul>
                </li>
               
                <li class="nav-header">KHÁM PHÁ</li>
                <li class="nav-item {{ (request()->is('admin/categories/*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-swatchbook"></i>
                        <p>
                            Danh mục
                            <i class="fas fa-angle-right right pr-1"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/categories/all" class="nav-link {{ (request()->is('admin/categories/all')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/categories/create" class="nav-link {{ (request()->is('admin/categories/create')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm danh mục</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ (request()->is('admin/places/*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>
                            Địa điểm
                            <i class="fas fa-angle-right right pr-1"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/places/all" class="nav-link {{ (request()->is('admin/places/all')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách địa điểm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/places/create" class="nav-link {{ (request()->is('admin/places/create')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm địa điểm</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">DỊCH VỤ</li>
                <li class="nav-item {{ (request()->is('admin/tourguides/*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>
                            Hướng dẫn viên
                            <i class="fas fa-angle-right right pr-1"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/tourguides/all" class="nav-link {{ (request()->is('admin/tourguides/all')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách hướng dẫn viên</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/tourguides/create" class="nav-link {{ (request()->is('admin/tourguides/create')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm hướng dẫn viên</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ (request()->is('admin/customers/all')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Khách hàng
                            <i class="fas"></i>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ (request()->is('admin/orders/all')) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Yêu cầu
                            <i class="fas"></i>
                        </p>
                    </a>
                </li>
                
                <li class="nav-header">BLOGS</li>
                <li class="nav-item {{ (request()->is('admin/blogs/*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-blog"></i>
                        <p>
                            Bài viết và bình luận
                            <i class="fas fa-angle-right right pr-1"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/blogs/all" class="nav-link {{ (request()->is('admin/blogs/all')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách bài viết</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/blogs/create" class="nav-link {{ (request()->is('admin/blogs/create')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm bài viết</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @can('is-admin')
                <li class="nav-header">QUẢN LÝ NGƯỜI DÙNG</li>
                <li class="nav-item {{ (request()->is('admin/users/*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            Tài khoản
                            <i class="fas fa-angle-right right pr-1"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/users/all" class="nav-link {{ (request()->is('admin/users/all')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách tài khoản</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/users/create" class="nav-link {{ (request()->is('admin/users/create')) ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm tài khoản</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                <!-- /.sidebar-menu -->
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>