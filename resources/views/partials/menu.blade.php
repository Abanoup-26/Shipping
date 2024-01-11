<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show bg-dark bg-gradient">

    <div class="c-sidebar-brand d-md-down-none ">
        <a class="c-sidebar-brand-full h3 text-center text-warning" href="#">
            {{ trans('panel.site_title') }}
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="img-fluid">
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.home') }}" class="c-sidebar-nav-link text-bold ">
                <i class="c-sidebar-nav-icon text-warning fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is('admin/permissions*') ? 'c-show' : '' }} {{ request()->is('admin/roles*') ? 'c-show' : '' }} {{ request()->is('admin/users*') ? 'c-show' : '' }} {{ request()->is('admin/audit-logs*') ? 'c-show' : '' }}">
                <a class="c-sidebar-nav-dropdown-toggle text-bold " href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon text-warning">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    {{-- @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan --}}
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.users.index') }}"
                                class="c-sidebar-nav-link text-bold {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon text-warning">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.audit-logs.index') }}"
                                class="c-sidebar-nav-link text-bold {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon text-warning">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('client_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.clients.index') }}"
                    class="c-sidebar-nav-link  text-bold {{ request()->is('admin/clients') || request()->is('admin/clients/*') ? 'c-active' : '' }}">
                    <i class="fa-fw fas fa-user-friends c-sidebar-nav-icon text-warning">

                    </i>
                    {{ trans('cruds.client.title') }}
                </a>
            </li>
        @endcan
        @can('client_financial_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.client-financials.index') }}"
                    class="c-sidebar-nav-link  text-bold {{ request()->is('admin/client-financials') || request()->is('admin/client-financials/*') ? 'c-active' : '' }}">
                    <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon text-warning">

                    </i>
                    {{ trans('cruds.clientFinancial.title') }}
                </a>
            </li>
        @endcan
        @can('order_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.orders.index') }}"
                    class="c-sidebar-nav-link text-bold {{ request()->is('admin/orders') || request()->is('admin/orders/*') ? 'c-active' : '' }}">
                    <i class="fa-fw fas fa-truck c-sidebar-nav-icon text-warning">

                    </i>
                    {{ trans('cruds.order.title') }}
                </a>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.user-alerts.index') }}"
                    class="c-sidebar-nav-link text-bold {{ request()->is('admin/user-alerts') || request()->is('admin/user-alerts/*') ? 'c-active' : '' }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon text-warning">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        @php($unread = \App\Models\QaTopic::unreadCount())
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.messenger.index') }}"
                class="{{ request()->is('admin/messenger') || request()->is('admin/messenger/*') ? 'c-active' : '' }} c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fa-fw fa fa-envelope text-warning">

                </i>
                <span>{{ trans('global.messages') }}</span>
                @if ($unread > 0)
                    <strong>( {{ $unread }} )</strong>
                @endif

            </a>
        </li>
        @if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link text-bold {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}"
                        href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon text-warning">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link text-bold"
                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt text-warning">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
