<div class="sidebar" id="sidebar">
    <div class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-arrow-left"></i>
    </div>
    <div class="sidebar-content">
        <div class="sidebar-content" id="smfull">
            <div class="sidebar-logo">
                <div class="bg-logo" style="background-image: url({{asset('/images/loremipsum-logo.jpg')}});">
                </div>
            </div>
            <div class="nav-sidebar">
                <ul class="menu-vertical menu-sidebar">
                @foreach($menu as $item)
                    <li class="menu-item {{ $item['site_url'] == Request::path() ? 'active' : '' }}">
                        <a href="{{url($item['site_url'])}}">
                            <div class="item-title">
                                <span style="display: block; width: 35px; height: 45px; float: left;">{!!load_icon($item['icon'])!!}</span>
                                <span style="display: block; float: left;">{{$item['display_name']}}</span>
                            </div>
                        </a>
                    @if(!empty($item['submenu']))
                        <ul class="submenu">
                        @foreach($item['submenu'] as $subitem)
                            <li class="menu-item">
                                    
                                <a href="{{url($subitem['site_url'])}}">
                                    <div class="item-title">
                                        {{$subitem['display_name']}}
                                    </div>
                                </a>
                            </li>
                        @endforeach
                        </ul>
                    @endif
                    </li>
                @endforeach
                </ul>
            </div>
        </div>



        <div class="sidebar-menu" id="smsmall">
            <div class="sidebar-logo">
            </div>
            <div class="nav-sidebar">
                <ul class="menu-vertical menu-sidebar">
                @foreach($menu as $item)
                    <li class="menu-item {{ $item['site_url'] == Request::path() ? 'active' : '' }}">
                        <a href="{{url($item['site_url'])}}">
                            <div class="item-title">
                                {!! load_icon($item['icon']) !!}
                            </div>
                        </a>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
