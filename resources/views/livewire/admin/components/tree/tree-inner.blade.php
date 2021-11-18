<div class="tree-inner" wire:ignore id="tree-{{$itemKey}}" wire:key="{{$itemKey}}">
    @foreach($elements as $item)
        <livewire:admin.components.tree.tree-item :item="$item" wire:key="{{$item->id}}" />
    @endforeach
    @once('scripts')
        <script src="{{asset('shared/assets/Sortable-1.14.0/Sortable.min.js')}}"></script>
    @endonce
    <script>
        let element = document.querySelector('#tree-{{$itemKey}}')
        new Sortable(element, {
            draggable: '[wire\\:sortable\\.item]',
            animation: 150,
            handle: element.querySelector('[wire\\:sortable\\.handle]') ? '[wire\\:sortable\\.handle]' : null,
            sort: true,
            dataIdAttr: 'wire:sortable.item',
            store: {
                set: function (sortable) {
                    let items = sortable.toArray().map((value, index) => {
                        return {
                            priority: index,
                            itemId: value,
                        };
                    });

                    @this.updatePriority(items);
                    // console.log(items)
                },
            },
        });
    </script>
</div>
