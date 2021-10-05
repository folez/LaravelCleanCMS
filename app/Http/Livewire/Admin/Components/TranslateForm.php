<?php

namespace App\Http\Livewire\Admin\Components;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class TranslateForm extends Component
{
    public array $attributeMapping = [];

    public array $inputTypes;

    public int $languageId = 0;

    public Model $modelClass;

    public Language $lang;

    protected array $rules;

    protected $listeners = [
        'saveTranslate'
    ];

    protected function rules():array
    {
        $rules = [
            'attributeMapping.language_id' => 'integer'
        ];

        foreach ( $this->modelClass->mappedFillable as $inputType => $inputArray ) {

            foreach( $inputArray as $input => $rule ) {
                $rules["attributeMapping.{$input}"] = $rule;
            }

        }

        return $rules;
    }

    public function mount( $model )
    {
        $this->modelClass = new $model;
        foreach ( $this->modelClass->mappedFillable as $inputType => $inputArray ) {

            foreach( $inputArray as $input => $rule ) {
                $this->rules["attributeMapping.{$input}"] = $rule;
                $this->inputTypes[$input] = $inputType;
                $this->attributeMapping[$input] = '';
            }

        }

        $this->attributeMapping['language_id']  = $this->languageId;

        $this->lang = Language::find($this->languageId);
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
