<div class="header-bar">
    <div class="nav-global">
        <ul class="menu-vertical menu-global">
            <li class="menu-item">
                <a href="{{url('admin/dashboard')}}">
                    <div class="item-title">
                        Platform <i class="fas fa-caret-down"></i>
                    </div>
                </a>
                <ul class="submenu">
                    <li class="menu-item">
                        <a href="{{url('')}}">
                            <div class="item-title">
                                Home
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="user-welcome">
        Welcome {{Auth::user()->name}}
    </div>
</div>
