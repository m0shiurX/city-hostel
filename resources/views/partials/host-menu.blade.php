<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("host.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('hostel_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("host.hostels.index") }}" class="c-sidebar-nav-link {{ request()->is("host/hostels") || request()->is("host/hostels/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-home c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.hostel.title') }}
                </a>
            </li>
        @endcan
        @can('room_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("host.rooms.index") }}" class="c-sidebar-nav-link {{ request()->is("host/rooms") || request()->is("host/rooms/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bed c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.room.title') }}
                </a>
            </li>
        @endcan
        @can('reservation_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("host.reservations.index") }}" class="c-sidebar-nav-link {{ request()->is("host/reservations") || request()->is("host/reservations/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-calendar-check c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.reservation.title') }}
                </a>
            </li>
        @endcan
        @can('tag_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("host.tags.index") }}" class="c-sidebar-nav-link {{ request()->is("host/tags") || request()->is("host/tags/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.tag.title') }}
                </a>
            </li>
        @endcan
        @can('payment_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("host.payments.index") }}" class="c-sidebar-nav-link {{ request()->is("host/payments") || request()->is("host/payments/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-money-bill-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.payment.title') }}
                </a>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("host.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("host/user-alerts") || request()->is("host/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        {{-- @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("host.messenger.index") }}" class="{{ request()->is("host/messenger") || request()->is("host/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li> --}}
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                    <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                    </i>
                    {{ trans('global.change_password') }}
                </a>
            </li>
            @endcan
        @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>
