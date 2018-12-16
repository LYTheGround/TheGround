<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Principale</li>
                <li class="{{ (request()->is('admin/company') || request()->is('admin/company/*')) ? 'active' : '' }}">
                    <a href="{{ route('company.index') }}"><i class="fa fa-building-o"></i> Companies</a>
                </li>
                <li class="{{ (request()->is('admin/admin') || request()->is('admin/admin/*')) ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}"><i class="fa fa-users"></i> Admins</a>
                </li>
            </ul>
        </div>
    </div>
</div>
