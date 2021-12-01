<li wire:sortable.item="{{$item->id}}" data-id="{{$item->id}}" data-itemID="{{$item->id}}" id="menu_{{$item->id}}" data-role='menuNode'>
    <div @class(["MenuManager_leaf", 'is-active' => $selectedEditItem == $item->id]) wire:sortable.handle data-role="menuItem" data-itemid="1" wire:click="setItem">
        <h3 class="MenuManager_leafTitle">{{$item->name}}</h3>
    </div>
    @if($hasChildren)
        <livewire:admin.components.menu.wrapper :model-class="get_class($children[0]->getModel())" :elements="$children" />
    @endif
</li>
