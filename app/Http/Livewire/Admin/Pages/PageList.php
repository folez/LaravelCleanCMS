<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;

class PageList extends Component
{
    use WithPagination;

    public int $itemPerPage = 20;

    public function deleteItem( $id )
    {
        $pageItem = Page::find($id);
        $pageItem->forceDelete();
    }

    public function confirmDelete( $page )
    {
        $this->dispatchBrowserEvent('swal:confirm', $page);
    }

    public function render()
    {
        $pages = Page::languageCode('ru')->paginate($this->itemPerPage);
        return view( 'livewire.admin.pages.page-list',[
            'pages' => $pages
        ] )->layout('components.layouts.admin.authorized');
    }
}
