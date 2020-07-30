<!-- Sidebar Menu -->
<ul class="nav sidebar-menu">
    <?php
    $menus = \Modules\Permissions\Services\CommonMenu::$menu;
    $current = \Route::currentRouteName();
    echo $current;
    ?>
    @foreach($menus as $menu)
        @if(isset($menu['child']) && sizeof($menu['child']) > 0 )
            <?php
                $class = 'has_sub';
                $isChildPermit = false;
                foreach ($menu['child'] as $child) {
                    $controller_now = explode(".", $current);
                    $controller_menu = explode(".", $child['route']);

                    if ($child['route'] == $current || $controller_now[0] == $controller_menu[0]) {
                        $class = 'has_sub active nav-active1';

                    }
                    if (in_array($child['route'], $permissions)) {
                        $isChildPermit = true;
                    }
                }
            ?>
            @if($isChildPermit || in_array("*",$permissions))
                <li class="{{$class}}"><a class="{{$menu['class']}}" href="javascript:void(0)"> <i
                                class="{{$menu['icon']}}"></i><span>{{$menu['text']}}</span><i class="menu-expand"></i></a>
                    <ul class="submenu" {{$class != '' ? 'style="display:block;"':''}}>
                        @foreach($menu['child'] as $child)
                            <?php
                            $controller_now = explode(".", $current);
                            $controller_menu = explode(".", $child['route']);
                            $check = false;
                            ?>
                            @if(in_array($child['route'],$permissions) || in_array("*",$permissions))
                                <?php $check = true; ?>
                                <li class="{{(($child['route'] == $current || $controller_now[0] == $controller_menu[0]) && $check == false) ? 'active':''}}">
                                    <a class="{{$menu['class']}}" href="{{route($child['route'])}}">
                                        <i class="{{$child['icon']}}"></i><span class="menu-text">{{$child['text']}}</span></a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endif
        @else
            @if(in_array($menu['route'],$permissions) || in_array("*",$permissions))
                @if($menu['route'] == $current )
                    <li class="active"><a class="{{$menu['class']}}" href="{{route($menu['route'])}}">
                            <i class="{{$menu['icon']}}"></i><span class="menu-text">{{$menu['text']}}</span></a>
                    </li>
                @else
                    <li><a class="{{$menu['class']}}" href="{{route($menu['route'])}}">
                            <i class="{{$menu['icon']}}"></i><span class="menu-text">{{$menu['text']}}</span></a>
                    </li>
                @endif
            @endif
        @endif
    @endforeach
</ul>
<!-- /Sidebar Menu -->