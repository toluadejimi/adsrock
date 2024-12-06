
<div class="account-form-wrapper__tab">
    <ul class="nav nav-pills custom--tab account-tab">
        <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('publisher.login'))  active @endif" href="{{ route('publisher.login') }}">
                @lang('Publisher')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link  @if(request()->routeIs('advertiser.login'))  active @endif" href="{{ route('advertiser.login') }}">
                @lang('Advertisers')
            </a>
        </li>
    </ul>
</div>
