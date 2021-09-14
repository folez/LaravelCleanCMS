<a class="{{$class}} dropdown-toggle" href="#" id="dropdown-{{$id}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
	{{$head}}
</a>
<ul class="dropdown-menu {{$bodyClass}}" aria-labelledby="dropdown-{{$id}}">
    {{$slot}}
</ul>
