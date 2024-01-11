<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show bg-dark bg-gradient">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4 text-warning" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route('client.home') }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon text-warning  fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>

        <!--client_financial -->
        <li class="c-sidebar-nav-item">
            <a href="{{ route('client.client-financials.index') }}" class="c-sidebar-nav-link">
                <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon text-warning">
                </i>
                {{ trans('cruds.clientFinancial.title_singular') }}
            </a>
        </li>

        <!--order_access-->
        <li class="c-sidebar-nav-item">
            <a href="{{ route('client.orders.index') }}" class="c-sidebar-nav-link">
                <i class="fa-fw fas fa-truck c-sidebar-nav-icon text-warning">

                </i>
                {{ trans('cruds.order.title') }}
            </a>
        </li>

        <!--logout-->
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link"
                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon text-warning fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
