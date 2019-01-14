<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu m-b-30">
            <ul>
                <li class="submenu btn-mobil">
                    <a href="#">
                        <img style="padding-bottom: 3px;"
                             src="{{ asset((app()->isLocale('ar')) ? 'img/flags/ar.png':'img/flags/fr.png') }}"
                             width="20"
                             alt=""> <span> {{__('pages.language.language')}}</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;" id="lang-switcher">
                        <li><a href="#" data-lang="fr">{{ __('pages.language.fr') }}</a></li>
                        <li><a href="#" data-lang="fr">{{ __('pages.language.ar') }}</a></li>
                    </ul>
                </li>
                <li class="menu-title">Company</li>
                <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Tableau </a>
                </li>
                @can('token',auth()->user()->member)
                    <li class="{{ (request()->is('token') || request()->is('token/*')) ? 'active' : '' }}">
                        <a href="{{ route('token.index') }}"><i
                                    class="fa fa-lock"></i> {{ ucfirst(__('validation.attributes.tokens')) }}</a>
                    </li>
                @endcan
                <li class="menu-title">Humans Resource</li>
                <li class="{{ (request()->is('member/*') || request()->is('member')) ? 'active' : '' }}">
                    <a href="{{ route('member.list') }}"><i
                                class="fa fa-user"></i> {{ ucfirst(__('pages.rh.user.members')) }}</a>
                </li>
                <li class="{{ (request()->is('position/*') || request()->is('position')) ? 'active' : '' }}">
                    <a href="{{ route('position.index') }}"><i
                                class="fa fa-user-secret"></i> {{ ucfirst(__('pages.rh.position.position')) }}</a>
                </li>
                <li class="menu-title">Store</li>
                <li class="{{ (request()->is('product/*') || request()->is('product')) ? 'active' : '' }}">
                    <a href="{{ route('product.index') }}"><i
                                class="fa fa-shopping-cart"></i> {{ ucfirst(__('pages.product.index.title'))}}</a>
                </li>
                <li class="menu-title">Deals</li>
                <li class="{{ (request()->is('provider/*') || request()->is('provider')) ? 'active' : '' }}">
                    <a href="{{ route('provider.index') }}"><i
                                class="fa fa-users"></i> {{ ucfirst(__('pages.deal.provider.index.title')) }}</a>
                </li>
                <li class="{{ (request()->is('client/*') || request()->is('client')) ? 'active' : '' }}">
                    <a href="{{ route('client.index') }}"><i
                                class="fa fa-address-card"></i> {{ ucfirst(__('pages.deal.client.index.title')) }}</a>
                </li>
                <li class="menu-title">Trade</li>
                <li class="{{ (request()->is('trade/buy/*') || request()->is('trade/buy')) ? 'active' : '' }}">
                    <a href="{{ route('buy.index') }}"><i
                                class="fa fa-credit-card"></i> {{ ucfirst(__('pages.trade.buy.index.title')) }}</a>
                </li>
                <li class="{{ (request()->is('trade/sale/*') || request()->is('trade/sale')) ? 'active' : '' }}">
                    <a href="{{ route('sale.index') }}"><i
                                class="fa fa-dollar"></i> {{ ucfirst(__('pages.trade.sale.index.title')) }}</a>
                </li>
                <li class="menu-title">Money</li>
                @can('view',\App\Accounting::class)
                    <li class="{{ (request()->is('accounting/*') || request()->is('accounting')) ? 'active' : '' }}">
                        <a href="{{ route('accounting.index') }}"><i
                                    class="fa fa-money"></i> {{ ucfirst(__('validation.attributes.accounting')) }}</a>
                    </li>
                @endcan
                <li class="{{ (request()->is('unload') || request()->is('unload/*')) ? 'active' : '' }}">
                    <a href="{{ route('unload.index') }}"><i
                                class="fa fa-adjust"></i> {{ ucfirst(__('validation.attributes.unload')) }}</a>
                </li>
                @can('view',\App\Echeance::class)
                    <li class="{{ (request()->is('trade/echeance') || request()->is('trade/echeance/*')) ? 'active' : '' }}">
                        <a href="{{ route('echeance.index') }}"><i
                                    class="fa fa-adjust"></i> {{ ucfirst(__('validation.attributes.echeance')) }}</a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
