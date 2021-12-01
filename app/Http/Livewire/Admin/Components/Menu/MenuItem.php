<?php

namespace App\Http\Livewire\Admin\Components\Menu;

use App\Http\Livewire\Admin\Pages\MenuList;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Livewire\Component;

class MenuItem extends Component
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

        $item->forceDelete();
    }

    public function mount(): void
    {
        if(method_exists($this?->item,'hasChildren') ){
            $this->hasChildren = $this?->item?->hasChildren();
            if($this->hasChildren){
                $this->children = $this->item->items();
            }
        }
    }

    public function setItem()
    {
        $this->item = Menu::findByLanguageCodeAndId($this->item->id);
        $this->emitTo(MenuList::class, 'setItem', $this->item->id);
    }

	public function render()
	{
		return view( 'livewire.admin.components.menu.menu-item' );
	}
}
