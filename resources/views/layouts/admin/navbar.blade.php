<div class="header">
    <div class="header-left">
        <a href="/" class="logo">
            <img src="{{ asset('img/logo.png') }}" width="40" height="40" alt="">
        </a>
    </div>
    <div class="page-title-box pull-left">
        <h3>theGround</h3>
    </div>
    @auth
        <a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars"
                                                                           aria-hidden="true"></i></a>
    @endauth
    <ul class="nav navbar-nav navbar-right user-menu pull-right">

        @auth
            <li class="dropdown">
                <a href="#" class="dropdown-toggle user-link" data-toggle="dropdown" title="{{ auth()->user()->member->name }}">
                    <span class="user-img">
                        <img class="img-circle" src="{{ asset('img/user.jpg') }}" width="40"
                             alt="{{ auth()->user()->member->name }}">
                        <span class="status online"></span>
                    </span>
                    <span>{{ auth()->user()->member->name }}</span>
                    <i class="caret"></i>
                </a>
                <ul class="dropdown-menu">
                    <li class="text-center">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            @else
                <li><a href="{{ route('login') }}">{{ __('pages.auth.login.login') }}</a></li>
                <li><a href="{{ route('register') }}">{{ __('pages.auth.register.register') }}</a></li>
                @endauth
    </ul>
    <form id="language" method="POST"
          style="display: none;">
        {{ csrf_field() }}
    </form>
    <div class="dropdown mobile-user-menu pull-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                class="fa fa-ellipsis-v"></i></a>
        <ul class="dropdown-menu pull-right">
            @auth

                <li class="text-left">
                    <a href="#" class="user-link">
                            <span class="user-img m-r-15">
                                <img class="img-circle" src="{{ asset('face.jpg') }}" width="40"
                                     alt="{{ auth()->user()->member->name }}">
                                <span class="status online"></span>
                            </span>
                        <span>{{ auth()->user()->member->name }}</span>
                    </a>
                </li>
                <li class="text-center"><a href="{{ route('member.params') }}">params</a></li>
                <li class="text-center">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @else
                    <li><a href="{{ route('login') }}">{{ __('pages.auth.login.login') }}</a></li>
                    <li><a href="{{ route('register') }}">{{ __('pages.auth.register.register') }}</a></li>
                    @endauth
        </ul>
    </div>
</div>
