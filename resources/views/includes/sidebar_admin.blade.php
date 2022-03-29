
<ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{route('admin.home')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboards</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span>User Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route("admin.users.index") }}">Users</a></li>
                        <li><a href="{{ route("admin.permissions.index") }}">Permissions</a></li>
                        <li><a href="{{ route("admin.roles.index") }}">Role</a></li>
                    </ul>
                </li>
</ul>


