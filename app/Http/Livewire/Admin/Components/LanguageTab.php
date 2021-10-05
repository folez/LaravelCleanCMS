<?php

namespace App\Http\Livewire\Admin\Components;

use Livewire\Component;

class LanguageTab extends Component
{
    public string $modelClass;

    public string $parentComponent;

    public function savedLocale()
    {
        $this->emitTo($this->parentComponent, 'savedLocale');
    }

	public function render()
	{
		return view( 'livewire.admin.components.language-tab' );
	}
}
