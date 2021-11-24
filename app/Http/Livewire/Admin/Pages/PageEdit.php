<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Http\Livewire\Admin\Components\Language\Content;
use App\Models\Page;
use App\Models\PageTranslation;
use Illuminate\Support\Str;
use Livewire\Component;

class PageEdit extends Component
{
    public bool $isEditMode;
    public Page $page;
    //    public PageTranslation $pageTranslation;

    /*protected $rules = [
        'pageTranslation.title' => 'string'
    ];*/

    protected $listeners = ['savedTranslate'];

    public function savedTranslate()
    {
        $slug = Str::slug(Page::findByLanguageCodeAndId($this->page->id)->name);
        $this->page->slug = $slug;
        $this->page->save();

        return redirect()->route('admin.pages.list');
    }

    public function save()
    {
        $this->page->save();
        $this->emitTo(Content::class, 'saveTranslate', $this->page->id);
    }

    public function mount( ?int $id = null )
    {
        $this->isEditMode = $id != null;
        $this->page = $this->isEditMode ? Page::findByLanguageCodeAndId($id) : new Page();
        //        $this->pageTranslation = PageTranslation::where('page_id', $this->page->id)->where('language_id', '=', 1)->first();
    }

    public function render()
    {
        return view( 'livewire.admin.pages.page-edit' )->layout('components.layouts.admin.authorized');
    }
}
