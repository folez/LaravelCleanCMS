<?php

namespace App\Http\Livewire\Admin\Components;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class TranslateForm extends Component
{
    public array $attributeMapping = [];

    public int $languageId = 0;

    public $modelClass;

    protected $listeners = [
        'saveTranslate'
    ];

    protected function rules():array
    {
        $rules = [
            'attributeMapping.language_id' => 'integer'
        ];

        foreach($this->attributeMapping as $key => $attribute) {
            if($key == 'language_id')
                $rules["attributeMapping.{$key}"] = 'integer';
            else
                $rules["attributeMapping.{$key}"] = 'string';
        }
        return $rules;
    }

    public function mount( $model )
    {
        $this->modelClass = new $model;
        foreach ($this->modelClass->getFillable() as $attribute) {
            if( str_contains($attribute, 'id') ) continue;
            $this->attributeMapping[$attribute] = '';
        }
        $this->attributeMapping['language_id']  = $this->languageId;
    }

    public function saveTranslate( $modelItemId )
    {
        $this->validate();
        foreach ($this->modelClass->getFillable() as $attribute) {
            if( str_contains($attribute, 'id') && $attribute != 'language_id' )
                $this->modelClass->{$attribute} = $modelItemId;
            else
                $this->modelClass->{$attribute} = $this->attributeMapping[$attribute];
        }
        $this->modelClass->save();

        $this->emitUp('savedLocale');
    }

	public function render()
	{
		return view( 'livewire.admin.components.translate-form' );
	}
}
