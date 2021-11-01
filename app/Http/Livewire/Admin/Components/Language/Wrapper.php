<?php

namespace App\Http\Livewire\Admin\Components\Language;

use Livewire\Component;

class Wrapper extends Component
{
    public string $model;
    public ?int $modelId = null;
    public string|null $parentComponent;
    public ?string $primaryKey = null;

    protected $listeners = [ 'savedTranslate' ];

    public function savedTranslate()
    {
        $this->emitUp('savedTranslate');
    }

    public function render()
    {
        return view( 'livewire.admin.components.language.wrapper' );
    }
}
