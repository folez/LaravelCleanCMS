<ol class="{{$className}}" data-role="nested-sortable" data-id="{{$itemKey}}" id="menu_{{$itemKey}}">
    @foreach($elements as $item)
        <livewire:admin.components.menu.menu-item :item="$item" />
    @endforeach
</ol>
