<!-- Dashboard Header Start -->
<div class="dashboard-header">
  <div class="dashboard-header__inner flex-between">
    <div class="dashboard-header__left">
      <form >
        <div class="form-group header-search-box">
          <input type="search" class="form--control navbar-search-field" id="searchInput"  name="#0" autocomplete="off" placeholder="Search Here" />
          <button type="button" class="button">
            <span class="button-icon"><i class="las la-search"></i></span>
          </button>
        </div>
        <ul class="search-list"></ul>
      </form>
    </div>
    <div class="dashboard-header__right flex-align">
    
      <div class="user-info">
        <button class="user-info__button flex-align">
          <span class="user-info__thumb">
            <img src="{{ getImage(getFilePath('publisherProfile') .'/' . auth()->guard('publisher')->user()?->image) }}" class="fit-image" alt="image" >
          </span>
        {{auth()->guard('publisher')->user()->username}}
        </button>
        <ul class="user-info-dropdown">
          <li class="user-info-dropdown__item">
            <a class="user-info-dropdown__link" href="{{ route('publisher.profile.setting') }}">
              <span class="icon"><i class="fas fa-user"></i></span>
              <span class="text">@lang('Profile')</span>
            </a>
        
          </li>
          <li class="user-info-dropdown__item">
            <a class="user-info-dropdown__link" href="{{ route('publisher.change.password') }}">
              <span class="icon"><i class="fas fa-key"></i></span>
              <span class="text">@lang('Change Password')</span>
            </a>
        
          </li>
          <li class="user-info-dropdown__item">
            <a class="user-info-dropdown__link" href="{{ route('publisher.logout') }}">
              <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
              <span class="text">@lang('log Out')</span>
            </a>
          </li>
        
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Dashboard Header End -->

@push('style-lib')
<link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
    
@endpush

@push('script-lib')
<script src="{{ asset('assets/global/js/select2.min.js') }}"></script>

@endpush