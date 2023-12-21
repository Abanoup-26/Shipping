<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route('client.home') }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>

        <!--client_financial -->
        <li class="c-sidebar-nav-item">
            <a href="{{ route('client.client-financials.index') }}" class="c-sidebar-nav-link">
                <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon">
                </i>
                {{ trans('cruds.clientFinancial.title') }}
            </a>
        </li>

        <!--order_access-->
        <li class="c-sidebar-nav-item">
            <a href="{{ route('client.orders.index') }}" class="c-sidebar-nav-link">
                <i class="fa-fw fas fa-truck c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <!-- Messages -->
        @php($unread = \App\Models\QaTopic::unreadCount())
        <li class="c-sidebar-nav-item">
            <a href="{{ route('client.messenger.index') }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                </i>
                <span>{{ trans('global.messages') }}</span>
                @if ($unread > 0)
                    <strong>( {{ $unread }} )</strong>
                @endif

            </a>
        </li>
        <!--logout-->
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link"
                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
