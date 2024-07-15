<div class="col-md-2 sidebar">
    <div class="row">
        <div class="absolute-wrapper"></div>
        <div class="side-menu">
            <nav class="navbar navbar-default" role="navigation">
                <div class="side-menu-container">
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="{{ Request::is('admin/missions*') ? 'active' : '' }}"><a href="/admin/missions">Mission Management</a></li>
                        <li class="{{ Request::is('admin/campaigns*') ? 'active' : '' }}"><a href="/admin/campaigns">Fundraisers Management</a></li>
                        <li class="{{ Request::is('admin/users*') ? 'active' : '' }}"><a href="/admin/users">Users Management</a></li>
                        <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}"><a href="/admin/settings">System Settings</a></li>
                        <li class="{{ Request::is('admin/reports*') ? 'active' : '' }}"><a href="/admin/reports">Analytics and Reports</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
