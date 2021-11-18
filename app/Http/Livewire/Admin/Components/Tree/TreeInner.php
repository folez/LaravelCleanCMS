<?php

namespace App\Http\Livewire\Admin\Components\Tree;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class TreeInner extends Component
{
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
        collect($array)->map(function ($item){
            $itemId         = $item['itemId'];
            $itemPriority   = $item['priority'];

            $item = $this->modelClass::find($itemId);
            if($item){
                //                dd($itemPriority);
                $item->priority = $itemPriority;
                $item->save();
            }
        });
    }

    /**
     * @return View|Factory
     */
    public function render(): View|Factory
    {
        return view( 'livewire.admin.components.tree.tree-inner' );
    }
}
