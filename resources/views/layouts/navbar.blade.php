<div class="header">
    <div class="header-left">
        <a href="/" class="logo">
            <img src="{{ asset((app()->isLocale('ar')) ? 'img/logo_.png':'img/logo_.png') }}" style="margin-top: -8px" width="70" height="70"
                 alt="logo" title="LY The Ground">
        </a>
    </div>
    <div class="page-title-box pull-left">
        <h3>LY The Ground</h3>
    </div>
    @auth
        <a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars"
                                                                           aria-hidden="true"></i></a>
    @endauth
    <ul class="nav navbar-nav navbar-right user-menu pull-right">
        <li class="dropdown hidden-xs">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img style="padding-bottom: 3px;"
                     src="{{ asset((app()->isLocale('ar')) ? 'img/flags/ar.png':'img/flags/fr.png') }}"
                     width="20"
                     alt="">
                <span
                    style="padding-left: 8px;">{{(app()->isLocale('ar'))  ? 'AR':'FR'}}</span>
                <i class="caret"></i>
            </a>
            <ul class="dropdown-menu" id="lang-switcher">
                @if((\Illuminate\Support\Facades\App::isLocale('ar')))
                    <li><a href="#" data-lang="fr">FR</a></li>
                @else
                    <li><a href="#" data-lang="ar">AR</a></li>
                @endif
            </ul>
        </li>
        <form id="language" method="POST"
              style="display: none;">
            {{ csrf_field() }}
        </form>
        @auth
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span
                        class="badge bg-primary pull-right">3</span></a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span>Notifications</span>
                    </div>
                    <div class="drop-scroll">
                        <ul class="media-list">
                            <li class="media notification-message">
                                <a href="#">
                                    <div class="media-left">
                                        <span class="avatar">V</span>
                                    </div>
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added
                                            new task <span class="noti-title">Private chat module</span></p>
                                        <p class="noti-time"><span class="notification-time">2 days ago</span></p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="#">View all Notifications</a>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle user-link" data-toggle="dropdown"
                   title="{{ auth()->user()->member->name }}">
                    <span class="user-img">
                        <img class="img-circle" src="{{ asset((auth()->user()->member->info->face) ? 'storage/' . auth()->user()->member->info->face : 'img/user.jpg') }}" width="40"
                             alt="{{ auth()->user()->member->name }}">
                        <span class="status online"></span>
                    </span>
                    <span>{{ auth()->user()->member->name }}</span>
                    <i class="caret"></i>
                </a>
                <ul class="dropdown-menu">
                    <li class="text-left">
                        <a href="{{ route('member.show',['member' => auth()->user()->member]) }}"
                           class="user-link">
                            <span>{{ __('pages.rh.user.profile') }}</span>
                        </a>
                    </li>
                    <li class="text-left">
                        <a href="{{ route('member.params') }}">{{ __('pages.rh.user.params') }}</a>
                    </li>
                    <li class="text-left">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('pages.auth.logout') }}
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
    <div class="dropdown mobile-user-menu pull-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                class="fa fa-ellipsis-v"></i></a>
        <ul class="dropdown-menu pull-right">
            @auth
                <li class="text-left">
                    <a href="{{ route('member.show',['member' => auth()->user()->member]) }}" class="user-link">
                        <span>{{ __('pages.rh.user.profile') }}</span>
                    </a>
                </li>
                <li class="text-left"><a href="#">{{ __('pages.rh.user.params') }}</a></li>
                <li class="text-left btn-mobil"><a href="#">{{ __('Notifications') }}</a></li>
                <li class="text-left">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('pages.auth.logout') }}</a>
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
