<a href="{{$href}}" class="@if($active) active @endif {{$class}}">
    @if(!$activeMarkup)
        {{$slot}}
    @else
        @if($active)
            {{$activeMarkup}}
        @else
            {{$slot}}
        @endif
    @endif
</a>
