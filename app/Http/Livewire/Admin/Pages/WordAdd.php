<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\LanguageWord;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use App\Models\Language;

class WordAdd extends Component
{
    public Collection $languages;

    public array $langInputs = [
        'word_name',
        'word_key',
        'word_default',
    ];

    private array $excludedRule = ['word_name','word_key','word_default'];

    protected function rules(): array
    {
        $rules = [

        ];
        foreach ($this->langInputs as $lang => $input) {
            if(in_array($input,$this->excludedRule))
                continue;
            $rules["langInputs.".$lang.".word_custom"] = 'string';
        }
        return $rules;
    }

    public function mount()
    {
        $this->languages = Language::all();

        foreach ($this->languages as $language) {
            $this->langInputs[$language->code]['word_custom'] = '';
        }
    }

    public function save()
    {
        $this->validate();
//        dd($this->langInputs);

        foreach ($this->languages as $language) {
            $word = new LanguageWord();
            $word->language_id = $language->id;
            $word->word_name = $this->langInputs['word_name'];
            $word->word_key = $this->langInputs['word_key'];
            $word->word_default = $this->langInputs['word_default'];
            $word->word_custom = $this->langInputs[$language->code]['word_custom'];
            $word->save();
        }

        return redirect()->route('admin.languages.list');
    }

	public function render()
	{
		return view( 'livewire.admin.pages.word-add' )->layout('components.layouts.admin.authorized');
	}
}
