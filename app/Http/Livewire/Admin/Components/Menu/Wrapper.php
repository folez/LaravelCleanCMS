<?php

namespace App\Http\Livewire\Admin\Components\Menu;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Wrapper extends Component
{
    public ?string $className = null;

    /**
     * @var Collection
     */
    public Collection $elements;

    /**
     * @var int
     */
    public int $itemKey = 0;

    /**
     * @var string|null|Model
     */
    public ?string $modelClass = null;

    /**
     * @param array $array
     */
    public function updatePriority( array $array ):void
    {
        $itm = $array[0];
        $itemId = $itm['itemId'];
        $itemPriority   = $itm['priority'];
        $itemParent   = $itm['parentId'];

        $item = Menu::find($itemId);
        $item->priority = $itemPriority;
        $item->parent_id = $itemParent ? $itemParent : null;
        $item->save();
    }

	public function render()
	{
		return view( 'livewire.admin.components.menu.wrapper' );
	}
}
