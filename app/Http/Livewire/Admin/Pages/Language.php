<?php

namespace App\Http\Livewire\Admin\Pages;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Language extends Component
{

    public \App\Models\Language $language;

    protected array $rules = [
        'language.code'    => 'required|string|max:15',
        'language.name'    => 'required|string|max:25',
    ];

    public function mount()
    {
        $this->language = new \App\Models\Language();
    }

    public function updated( $propertyName )
    {
        $this->validateOnly($propertyName);
    }

    public function saveLanguage()
    {
        $this->language->code = strtolower($this->language->code);
        $this->language->save();
        $this->language = new \App\Models\Language();
    }

    public function changeDefault( int $languageId )
    {
        $currentDefault = \App\Models\Language::getDefaultLanguage();
        $currentDefault->is_default = 0;
        $currentDefault->save();

        $newDefault = \App\Models\Language::find($languageId);
        $newDefault->is_default = 1;
        $newDefault->save();
    }

	public function render()
	{
        $languages = \App\Models\Language::all();
		return view( 'livewire.admin.pages.language', [ 'languages' => $languages ] )->layout('components.layouts.admin.authorized');
	}
}
