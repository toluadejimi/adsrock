
<div class="account-form-wrapper__tab">
    <ul class="nav nav-pills custom--tab account-tab">
        <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('publisher.register'))  active @endif" href="{{ route('publisher.register') }}">
                @lang('Publisher')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link  @if(request()->routeIs('advertiser.register'))  active @endif" href="{{ route('advertiser.register') }}">
                @lang('Advertisers')
            </a>
        </li>
    </ul>
</div>
