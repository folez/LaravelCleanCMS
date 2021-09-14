<x-components.markup.collapse class="button-unstyled nav-link w-100">
    <x-slot name="head">
        <div class="px-3 py-2 w-100">
            <div class="row flex-nowrap">
                @if($titleIcon??false)
                <div class="col-2 link-icon d-flex justify-content-center align-items-center">
                    {{$titleIcon}}
                </div>
                @endif
                <div class="col-10 link-title">
                    <div class="row flex-nowrap">
                        <div class="col-10 text-start">
                            <span>{{$title}}</span>
                        </div>
                        <div class="col-2">
                            <i class="far fa-chevron-right  rotate-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    {{$slot}}
</x-components.markup.collapse>
