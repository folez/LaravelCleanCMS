    <x-stateles.navigation.nav-link href="{{$link}}" match="{{$match??'all'}}"
                                    class="nav-link">
    <div class="px-3 py-2 w-100">
        <div class="row flex-nowrap">
            @if($icon??false)
            <div class="col-2 link-icon d-flex justify-content-center align-items-center">
                {{$icon}}
            </div>
            @endif
            <div class="col-10 link-title">
                <span class="">{{$slot}}</span>
            </div>
        </div>
    </div>
    </x-stateles.navigation.nav-link>
