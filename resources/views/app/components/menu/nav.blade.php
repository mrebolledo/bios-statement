@foreach($menus as $m)
    <li class="sidenav-item {{$m['class']}}">
        <a href="{{ ($m['route'] != '')?route($m['route']):'javascript:void(0);' }}" class="sidenav-link @if(count($m['children']) > 0)  sidenav-toggle @endif">
            <i class="sidenav-icon fas {{ $m['icon'] }}"></i>&nbsp;
            <div>{{ $m['name'] }}</div>
        </a>
        @if(count($m['children']) > 0)
            <ul class="sidenav-menu">
                @foreach($m['children'] as $child)
                    <li class="sidenav-item {{$child['class']}}">
                        <a href="{{ ($child['route'] != '')?route($child['route']):'javascript:void(0);' }}" class=" sidenav-link  @if(count($child['children']) > 0) sidenav-toggle @endif">
                            <i class="sidenav-icon fas {{ $child['icon'] }}"></i>&nbsp;
                            <div>{{ $child['name'] }}</div>
                        </a>
                        @if(count($child['children']) > 0)
                            <ul class="sidenav-menu">
                                @foreach($child['children'] as $childs)
                                    <li class="sidenav-item {{$childs['class']}}">
                                        <a href="{{ ($childs['route'] != '')?route($childs['route']):'javascript:void(0);' }}" class=" sidenav-link" >
                                            <i class="sidenav-icon fas {{ $childs['icon'] }}"></i>&nbsp;
                                            <div>{{ $childs['name'] }}</div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </li>
@endforeach
