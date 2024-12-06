<!-- ====================== Sidebar menu Start ========================= -->
<div class="sidebar-menu flex-between">
    <div class="sidebar-menu__inner">
        <span class="sidebar-menu__close d-lg-none d-block"><i class="fas fa-times"></i></span>
        <div class="sidebar-logo">
            <a href="{{ route('advertiser.dashboard') }}" class="sidebar-logo__link">
                <img src="{{ siteLogo('dark') }}" alt="site_logo" />
            </a>
        </div>
        <ul class="sidebar-menu-list sidebar__menu-wrapper">
            <li class="sidebar-menu-list__item {{ menuActive('advertiser.dashboard') }}">
                <a href="{{ route('advertiser.dashboard') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fa-solid fa-qrcode"></i></span>
                    <span class="text menu-title">@lang('Dashboard')</span>
                </a>
            </li>
            <li
                class="sidebar-menu-list__item has-dropdown {{ menuActive(['advertiser.ad.index', 'advertiser.ad.create', 'advertiser.ad.create.form', 'advertiser.ad.target.audience', 'advertiser.ad.report', 'advertiser.ad.details', 'advertiser.ad.edit']) }} ">
                <a href="javascript:void(0)" class="sidebar-menu-list__link">
                    <span class="icon"><i class="fa-solid fa-bullhorn"></i></span>
                    <span class="text  menu-title">@lang('Manage Ad')</span>
                </a>
                <div
                    class="sidebar-submenu {{ menuActive(['advertiser.ad.index', 'advertiser.ad.create', 'advertiser.ad.report', 'advertiser.ad.create.form', 'advertiser.ad.target.audience', 'advertiser.ad.details', 'advertiser.ad.edit']) }}">
                    <ul class="sidebar-submenu-list">
                        <li
                            class="sidebar-submenu-list__item sidebar-menu-list__item  {{ menuActive('advertiser.ad.create') }} ">
                            <a href="{{ route('advertiser.ad.create') }}" class="sidebar-submenu-list__link nav-link">
                                <span class="text menu-title">@lang('New Ad')</span>
                            </a>
                        </li>
                        <li
                            class="sidebar-submenu-list__item  sidebar-menu-list__item  {{ menuActive('advertiser.ad.index') }} ">
                            <a href="{{ route('advertiser.ad.index') }}" class="sidebar-submenu-list__link nav-link">
                                <span class="text menu-title">@lang('All Ad')</span>
                            </a>
                        </li>
                        <li
                            class="sidebar-submenu-list__item sidebar-menu-list__item   {{ menuActive('advertiser.ad.report') }} ">
                            <a href="{{ route('advertiser.ad.report') }}" class="sidebar-submenu-list__link nav-link ">
                                <span class="text">@lang('Ad Report')</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-menu-list__item {{ menuActive('advertiser.ad.price.plan') }}">
                <a href="{{ route('advertiser.ad.price.plan') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fa-solid fa-address-card"></i></span>
                    <span class="text menu-title">@lang('Pricing Plan')</span>
                </a>
            </li>

            <li class="sidebar-menu-list__item has-dropdown {{ menuActive('advertiser.deposit*') }}">
                <a href="javascript:void(0)" class="sidebar-menu-list__link">
                    <span class="icon"><i class="fa-solid fa-bars-progress"></i></span>
                    <span class="text menu-title">@lang('Deposits') </span>
                </a>
                <div class="sidebar-submenu {{ menuActive('advertiser.deposit*') }}">
                    <ul class="sidebar-submenu-list">
                        <li
                            class="sidebar-submenu-list__item sidebar-menu-list__item  {{ menuActive('advertiser.deposit.index') }}">
                            <a href="{{ route('advertiser.deposit.index') }}"
                                class="sidebar-submenu-list__link nav-link">
                                <span class="text menu-title">@lang('Deposit')</span>
                            </a>
                        </li>
                        <li
                            class="sidebar-submenu-list__item sidebar-menu-list__item  {{ menuActive('advertiser.deposit.history') }}">
                            <a href="{{ route('advertiser.deposit.history') }}"
                                class="sidebar-submenu-list__link nav-link">
                                <span class="text menu-title">@lang('Deposit history')</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-menu-list__item  {{ menuActive('advertiser.transactions') }}">
                <a href="{{ route('advertiser.transactions') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fa-solid fa-right-left"></i></span>
                    <span class="text menu-title">@lang('Transaction Log')</span>
                </a>
            </li>
            <li class="sidebar-menu-list__item {{ menuActive(['ticket.index', 'ticket.open', 'ticket.view']) }}">
                <a href="{{ route('ticket.index') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fa-solid fa-ticket"></i></span>
                    <span class="text menu-title">@lang('Support Tickets')</span>
                </a>
            </li>
            <li class="sidebar-menu-list__item {{ menuActive(['advertiser.profile.setting']) }}">
                <a href="{{ route('advertiser.profile.setting') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fa-solid fa-gear"></i></span>
                    <span class="text menu-title menu-title">@lang('Profile Setting')</span>
                </a>
            </li>
            <li class="sidebar-menu-list__item {{ menuActive(['advertiser.change.password']) }}">
                <a href="{{ route('advertiser.change.password') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fa fa-lock"></i></span>
                    <span class="text menu-title menu-title">@lang('Change Password')</span>
                </a>
            </li>

            <li class="sidebar-menu-list__item">
                <a href="{{ route('advertiser.logout') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                    <span class="text menu-title">@lang('Log Out')</span>
                </a>
            </li>
        </ul>
        <!-- ========= Sidebar Menu End ================ -->
    </div>
</div>
<!-- ====================== Sidebar menu End ========================= -->
