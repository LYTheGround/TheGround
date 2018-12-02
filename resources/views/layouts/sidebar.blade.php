<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Principale</li>
                <li class="active">
                    <a href="#"><i class="fa fa-home"></i> Company</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Tableau de bord</a>
                </li>
                <li class="submenu">
                    <a href="#">
                        <i class="fa fa-cog" aria-hidden="true"></i> <span> Premiums</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('token.index') }}">Tokens</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#">
                        <i class="fa fa-user" aria-hidden="true"></i> <span> Employees</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('member.list') }}">Members</a></li>
                        <li><a href="{{ route('position.index') }}">positions</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#">
                        <i class="fa fa-building-o" aria-hidden="true"></i> <span> Store</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('product.index') }}">Products</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#">
                        <i class="fa fa-handshake-o" aria-hidden="true"></i> <span> Deals</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('provider.index') }}">Providers</a></li>
                        <li><a href="{{ route('Client.index') }}">Clients</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#">
                        <i class="fa fa-object-group" aria-hidden="true"></i> <span> Trades</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('trade') }}">Trade</a></li>
                        <li><a href="{{ route('buy.index') }}">Buy</a></li>
                        <li><a href="{{ route('sale.index') }}">Sale</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#">
                        <i class="fa fa-money" aria-hidden="true"></i> <span> Money</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="#">Finance</a></li>
                        <li><a href="{{ route('accounting.index') }}">Accounting</a></li>
                        <li><a href="#">unload</a></li>
                        <li><a href="#">Wags</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
