@foreach($navLinks as $name => $url)
    @if($name === 'dropdown')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $url['title'] }}<span class="caret"></span></a>
            <div class="dropdown-menu">
                @foreach($url['navLinks'] as $dropdownInfo)
                    @if(array_key_exists('type', $dropdownInfo) and $dropdownInfo['type'] === 'span')
                        <span class="{{ $dropdownInfo['class'] }}">{{ $dropdownInfo['name'] }}</span>
                    @else
                        <a href="{{ $dropdownInfo['url'] }}">{{ $dropdownInfo['name'] }}</a>
                    @endif
                @endforeach
            </div>
        </li>
    @else
        <li class="nav-item pull-left">
            <a class="nav-link" href="{{ $url }}">{{ $name }}</a>
        </li>
    @endif
@endforeach