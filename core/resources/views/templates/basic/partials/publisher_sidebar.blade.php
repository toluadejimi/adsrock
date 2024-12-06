<div class="sidebar-menu flex-between">
    <div class="sidebar-menu__inner">
        <span class="sidebar-menu__close d-lg-none d-block"><i class="fas fa-times"></i></span>
        <div class="sidebar-logo">
            <a href="{{ route('publisher.dashboard') }}" class="sidebar-logo__link"><img src="{{ siteLogo('dark') }}"
                    alt="image"></a>
        </div>
        <ul class="sidebar-menu-list sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <li class=" sidebar-menu-list__item sidebar-menu-list__item {{ menuActive('publisher.dashboard') }} ">
                <a href="{{ route('publisher.dashboard') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fa-solid fa-qrcode"></i></span>
                    <span class="text menu-title">@lang('Dashboard')</span>
                </a>
            </li>
            <li
                class=" sidebar-menu-list__item sidebar-menu-list__item {{ menuActive(['publisher.domain.all', 'publisher.domain.verify.action']) }}">
                <a href="{{ route('publisher.domain.all') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fa-solid fa-globe"></i></span>
                    <span class="text menu-title">@lang('Manage Domain')</span>
                </a>
            </li>

            <li class=" sidebar-menu-list__item sidebar-menu-list__item {{ menuActive('publisher.advertises') }}">
                <a href="{{ route('publisher.advertises') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fa-solid fa-bullhorn"></i></span>
                    <span class="text menu-title">@lang('Advertisement')</span>
                </a>
            </li>
            <li
                class=" sidebar-menu-list__item sidebar-menu-list__item {{ menuActive(['publisher.published.ad', 'publisher.published.ad*']) }}">
                <a href="{{ route('publisher.published.ad') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fa-solid fa-chart-column"></i></span>
                    <span class="text menu-title">@lang("Published Ad")</span>
                </a>
            </li>

       

            <li class=" sidebar-menu-list__item sidebar-menu-list__item {{ menuActive('publisher.report.ad') }}">
                <a href="{{ route('publisher.report.ad') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fas fa-calendar-week"></i></span>
                    <span class="text menu-title">@lang('Per Day Ad') </span>
                </a>
            </li>

            <li class=" sidebar-menu-list__item sidebar-menu-list__item {{ menuActive('publisher.report.perDay') }}">
                <a href="{{ route('publisher.report.perDay') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fa-solid fa-comment-dollar"></i></span>
                    <span class="text menu-title">@lang('Per Day Earning ')</span>
                </a>
            </li>
            <li class=" sidebar-menu-list__item sidebar-menu-list__item {{ menuActive('publisher.withdraw.*') }} ">
                <a href="{{ route('publisher.withdraw.money') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fas fa-arrow-up"></i></span>
                    <span class="text menu-title">@lang('Withdraw Money')</span>
                </a>
            </li>

            <li class=" sidebar-menu-list__item sidebar-menu-list__item {{ menuActive('publisher.profile.setting') }}">
                <a href="{{ route('publisher.profile.setting') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fa-solid fa-gear"></i></span>
                    <span class="text menu-title">@lang('Profile Setting')</span>
                </a>
            </li>
            <li class=" sidebar-menu-list__item sidebar-menu-list__item {{ menuActive('publisher.change.password') }}">
                <a href="{{ route('publisher.change.password') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fas fa-key"></i></span>
                    <span class="text menu-title">@lang('Change Password')</span>
                </a>
            </li>
            <li class=" sidebar-menu-list__item sidebar-menu-list__item {{ menuActive('publisher.twofactor') }}">
                <a href="{{ route('publisher.twofactor') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fa-solid fa-fingerprint"></i></span>
                    <span class="text menu-title">@lang('2FA Setting')</span>
                </a>
            </li>

            <li class=" sidebar-menu-list__item sidebar-menu-list__item {{ menuActive('ticket.*') }}">
                <a href="{{ route('ticket.index') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fa-solid fa-ticket"></i></span>
                    <span class="text ">@lang('Support Ticket')</span>
                </a>
            </li>
            <li class=" sidebar-menu-list__item sidebar-menu-list__item">
                <a href="{{ route('publisher.logout') }}" class="sidebar-menu-list__link nav-link">
                    <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                    <span class="text menu-title">@lang('Log Out')</span>
                </a>
            </li>
        </ul>
    </div>
</div>
