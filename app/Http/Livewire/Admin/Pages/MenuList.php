<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Http\Livewire\Admin\Components\Language\Content;
use App\Models\Menu;
use App\Models\MenuTranslation;
use App\Models\PageTranslation;
use Livewire\Component;

class MenuList extends Component
{
    protected $listeners = ['savedTranslate', 'callBackSave','setItem' => 'setEditItem', 'updateItem' => '$refresh'];

    public ?Menu $item = null;
    public bool $isEditMode = false;

    public function updatePriority( array $sortableArray )
    {
        $positions = array();
        foreach ($sortableArray as $item) {
            if(!@$item['id']) continue;
            $itemId = $item['id'];
            $parentId = $item['parent_id'];
            if ( !isset( $positions[ $parentId ] ) )
            {
                $positions[ $parentId ] = 1;
            }

            $save = array(
                'priority' => $positions[ $parentId ]++,
                'parent_id'   => NULL
            );

            if ( $parentId != 'null' || $parentId != null )
            {

                $save['parent_id'] = $parentId;
            }

            Menu::where('id', $itemId)->update($save);
        }
    }

    public function setEditItem( int $itemId )
    {
        $this->item = null;
        $this->item = Menu::findByLanguageCodeAndId($itemId);
        $this->isEditMode = true;
        if($this->item->type == 'page')
            $this->dispatchBrowserEvent('isPage', []);
    }

    public function updatedItemType($value)
    {
        if($value == 'page')
            $this->dispatchBrowserEvent('isPage', []);
    }

    protected function rules(): array
    {
        return [
            'item.type'     => 'required',
            'item.link'     => 'nullable|required_if:item.type,link|string',
            'item.page_id'  => 'int|required_if:item.type,page|nullable'
        ];
    }

    protected function messages(): array
    {
        return [
            'item.link.required_if'     => 'Вы не указали ссылку пункта меню!',
            'item.page_id.required_if'  => 'Вы не выбрали страницу для меню!',
        ];
    }

    public function savedTranslate()
    {
        $this->dispatchBrowserEvent('savedMenu', []);
        $this->emitSelf('updateItem', []);
    }

    public function saveMenu()
    {
        $this->validate();
        if(!$this->isEditMode)
            $this->item->priority = Menu::getLastPriority($this->item->priority);
        $this->item->save();
        $this->emitTo(Content::class, 'saveTranslate', $this->item->id);
        $this->emitSelf('updateItem', []);
    }

    public function callBackSave( array $data ): void
    {
        $modelId = $data['modelId'];
        $languageId = $data['languageId'];
        $transModelId = $data['transModelId'];
        $page = PageTranslation::where('page_id', $this->item->page_id)->where('language_id', $languageId)->first();

        $menuTrans = new MenuTranslation();
        if($this->isEditMode) {
            $menuTrans = MenuTranslation::find($transModelId);
        }

        $menuTrans->menu_id = $modelId;
        $menuTrans->name = $page->name;
        $menuTrans->language_id = $languageId;
        $menuTrans->save();

        $this->dispatchBrowserEvent('savedMenu', []);
    }

    public function cancel()
    {
        $this->item = null;
        $this->isEditMode = false;
    }

    public function newMenu()
    {
        $this->item = new Menu();
        $this->item->type = 'link';
    }

	public function render()
	{
        $items = Menu::where('parent_id',null)->orderBy('priority','asc')->languageCode()->get();
        $tempItem = $this->item;
		return view( 'livewire.admin.pages.menu-list', compact('items', 'tempItem') )->layout('components.layouts.admin.authorized');
	}
}
