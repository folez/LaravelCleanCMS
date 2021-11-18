<?php

namespace App\Http\Livewire\Admin\Components\Tree;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Livewire\Component;

class TreeItem extends Component
{
    /**
     * @var Model
     */
    public Model $item;

    /**
     * @var bool
     */
    public bool $hasChildren = false;

    /**
     * @var bool
     */
    public bool $showChildren = false;

    /**
     * @var string|null
     */
    public ?string $editLink = null;
    /**
     * @var string|null
     */
    public ?string $createLink = null;

    /**
     * @var Collection|null
     */
    public ?Collection $children = null;


    public function toggleShowChildren(): void
    {
        $this->showChildren = !$this->showChildren;
        $this->children = $this->showChildren ? $this->item->items : null;
    }

    /**
     * @param $item
     */
    public function deleteConfirm($item): void
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'item' => $item,
        ]);
    }

    /**
     * @param $itemId
     * @param $modelClass
     */
    public function deleteItem($itemId, $modelClass):void
    {
        $item = $modelClass::find($itemId);

        if(is_array($item->imagesPath)){
            foreach ($item->imagesPath as $attributeName => $attributePath ) {
                $fileName = explode('/', $item->$attributeName);
                $fileName = end($fileName);

                \Storage::delete('/app/public/'.$attributePath.'/'.$fileName);
                \Storage::delete('/app/public/'.$attributePath.'_cache/'.$fileName);
            }
        }

        $item->forceDelete();
    }

    public function mount(): void
    {
        if(method_exists($this?->item,'hasChildren') ){
            $this->hasChildren = $this?->item?->hasChildren();
        }

        if(method_exists($this?->item,'getEditLink') ){
            $this->editLink = $this?->item?->getEditLink();
        }

        if(method_exists($this?->item,'getCreateLink') ){
            $this->createLink = $this?->item?->getCreateLink();
        }
    }

    /**
     * @return View|Factory
     */
    public function render(): View|Factory
    {
        return view( 'livewire.admin.components.tree.tree-item' );
    }
}
