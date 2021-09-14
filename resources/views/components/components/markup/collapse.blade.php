<button class="{{$class??''}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$id}}">
    {{$head}}
</button>
<div class="collapse {{$bodyClass??''}}" id="collapse-{{$id}}">
    {{$slot}}
</div>
