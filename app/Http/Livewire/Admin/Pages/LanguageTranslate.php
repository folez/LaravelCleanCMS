<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\LanguageWord;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use \App\Models\Language;

class LanguageTranslate extends Component
{
    use WithPagination;

    public int $itemPerPage = 20;
    public ?Language $language = null;

    public function mount( int $id )
    {
        $this->language = Language::find($id);
    }

	public function render(): View
    {
        $words = LanguageWord::getAllByLanguageId($this->language->id)->paginate($this->itemPerPage);
		return view( 'livewire.admin.pages.language-translate', compact('words') )->layout('components.layouts.admin.authorized');
	}
}
