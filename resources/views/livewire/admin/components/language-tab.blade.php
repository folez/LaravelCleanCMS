<div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach(\App\Models\Language::all() as $lang)
            <li class="nav-item" role="presentation" wire:ignore >
                <button @class([ 'nav-link', 'active' => $lang->is_default ]) id="home-tab" data-bs-toggle="tab" data-bs-target="#lang_{{$lang->code}}" type="button" role="tab" aria-controls="home" aria-selected="true">
                {{$lang->name}}</button>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="myTabContent">
        @foreach(\App\Models\Language::all() as $lang)
            <div @class([
            'tab-pane',
            'fade',
            'show' => $lang->is_default,
            'active' => $lang->is_default
            ]) id="lang_{{$lang->code}}" role="tabpanel" aria-labelledby="home-tab" wire:ignore.self>
            <div class="w-100 mt-3">
                <livewire:admin.components.translate-form wire:key="{{$lang->id}}" :model="$modelClass" :language-id="$lang->id"/>
            </div>
    </div>
    @endforeach
</div>
</div>
