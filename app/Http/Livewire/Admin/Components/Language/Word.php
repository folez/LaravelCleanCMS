<?php

namespace App\Http\Livewire\Admin\Components\Language;

use App\Models\LanguageWord;
use Livewire\Component;

class Word extends Component
{
    public LanguageWord $word;

    protected function rules(): array
    {
        return [
            'word.word_custom'  => 'string'
        ];
    }

    public function updatedWordWordCustom( $value )
    {
        $this->word->word_custom = $value;

        $this->word->save();

        $this->dispatchBrowserEvent('wordUpdated', []);
    }

	public function render()
	{
		return view( 'livewire.admin.components.language.word' );
	}
}
