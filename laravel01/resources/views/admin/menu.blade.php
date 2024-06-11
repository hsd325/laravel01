<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="/admin/logout" class="nav-link">
                <i class="far fa-sign-out-alt"></i>
                <p>
                    登出
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin/menu/list" class="nav-link{{ Request::is('admin/menu/*') ? ' active' : '' }}">
                <i class="far fa-image nav-icon"></i>
                <p>
                    選單管理
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin/banner/list" class="nav-link{{ Request::is('admin/banner/*') ? ' active' : '' }}">
                <i class="far fa-image nav-icon"></i>
                <p>
                    Banner管理
                </p>
            </a>
        </li>

        <li class="nav-item{{ Request::is('admin/layer1/*', 'admin/product/*') ? ' menu-open' : '' }}">
            <a href="#" class="nav-link{{ Request::is('admin/layer1/*', 'admin/product/*') ? ' active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    商品管理
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/layer1/list" class="nav-link{{ Request::is('admin/layer1/*') ? ' active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>類別管理</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/product/list" class="nav-link{{ Request::is('admin/product/*') ? ' active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>商品管理</p>
                    </a>
                </li>                
            </ul>
        </li>
        <li class="nav-item{{ Request::is('shop/*') ? ' menu-open' : '' }}">
            <a href="#" class="nav-link{{ Request::is('shop/*') ? ' active' : '' }}">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    商店管理
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">6</span>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/shop/list" class="nav-link{{ Request::is('shop/*') ? ' active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>商店列表</p>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item{{ Request::is('admin/about/*') ? ' menu-open' : '' }}">
            <a href="#" class="nav-link{{ Request::is('admin/about/*') ? ' active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    關於我們
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/about/content/list" class="nav-link{{ Request::is('admin/about/content/*') ? ' active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>內容管理</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/about/about/list" class="nav-link{{ Request::is('admin/about/about/*') ? ' active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>關於我們</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/about/note/list" class="nav-link{{ Request::is('admin/about/note/*') ? ' active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>記事管理</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/about/advance/list" class="nav-link{{ Request::is('admin/about/advance/*') ? ' active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>優勢管理</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="/admin/label/list" class="nav-link{{ Request::is('admin/label/*') ? ' active' : '' }}">
                <i class="nav-icon far fa-sticky-note"></i>
                <p>標籤管理</p>
            </a>
        </li>

        <li class="nav-item{{ Request::is('admin/news/*') ? ' menu-open' : '' }}">
            <a href="#" class="nav-link{{ Request::is('admin/news/*') ? ' active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>最新消息管理 <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/news/type/list" class="nav-link{{ Request::is('admin/news/type/*') ? ' active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>類別管理</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/news/list" class="nav-link{{ Request::is('admin/news/list', 'admin/news/add', 'admin/news/edit') ? ' active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>最新消息</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>