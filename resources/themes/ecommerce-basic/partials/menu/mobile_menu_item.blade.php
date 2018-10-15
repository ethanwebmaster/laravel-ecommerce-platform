@foreach($menus as $menu)
  @if($menu->hasChildren('active') && $menu->isRoot() && $menu->user_can_access)
      <li class="{{ \Request::is(explode(',',$menu->active_menu_url))?'active':'' }} {{ $menu->isRoot()?'':'has-children' }}">
          <span>
          <a href="{{ url($menu->url) }}">
              <span>@if($menu->icon)<i class="{{ $menu->icon }} fa-fw"></i>@endif {{ $menu->name }}</span>
          </a>
              <span class="sub-menu-toggle"></span>
          </span>
          <ul class="offcanvas-submenu">
               @include('partials.menu.menu_item', ['menus' => $menu->getChildren('active')])
          </ul>
      </li>
  @elseif($menu->user_can_access)
      <li class="{{ \Request::is(explode(',',$menu->active_menu_url))?'active':'' }}">
          <a href="{{ url($menu->url) }}" target="{{ $menu->target??'_self' }}">
              <span>@if($menu->icon)<i class="{{ $menu->icon }} fa-fw"></i>@endif {{ $menu->name }}</span>
          </a>
      </li>
  @endif
@endforeach

//Sign In Menu ###

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
           aria-expanded="false">
            <i class="lni-user"></i>
            @auth
                {{ user()->name }}
            @else
                @lang('corals-classified::auth.my_account')
            @endauth
        </a>
        <div class="dropdown-menu">
            @auth
                <a class="dropdown-item" href="{{url('classified/user/products')}}">
                    <i class="fa fa-cube fa-fw"></i>
                    @lang('corals-classified::labels.product.my')
                </a>
                <a class="dropdown-item" href="{{ url('classified/user/dashboard') }}">
                    <i class="fa fa-fw fa-dashboard"></i>@lang('corals-classified::auth.dashboard')
                </a>

                <a class="dropdown-item" href="{{ url('profile') }}">
                    <i class="fa fa-fw fa-user-o"></i>@lang('corals-classified::auth.profile')
                </a>

                <a class="dropdown-item" href="{{ route('logout') }}" data-action="logout">
                    <i class="fa fa-fw fa-sign-out"></i> @lang('corals-classified::auth.logout')
                </a>
            @endauth
            @guest
                <a class="dropdown-item" href="{{ route('login') }}"><i
                            class="lni-lock"></i>@lang('corals-classified::auth.login')</a>
                <a class="dropdown-item" href="{{ route('register') }}"><i
                            class="lni-user"></i>@lang('corals-classified::auth.register')</a>
            @endguest
        </div>
    </li>
