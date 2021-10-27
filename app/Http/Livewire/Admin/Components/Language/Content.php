<?php

namespace App\Http\Livewire\Admin\Components\Language;

use App\Http\Livewire\Admin\Pages\Language;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Content extends Component
{
    public array $mappedRule = [];
    public array $mappedInputsType = [];
    public array $mappedInputsTitle = [];

    public Model $modelInstance;
    public ?int $modelId = null;
    public Language $language;

    public ?string $primaryKey = null;

    public bool $isEditMode = false;

    protected $listeners = [
        'saveTranslate'
    ];

    public function saveTranslate( $modelId )
    {
        if(!$this->isEditMode){
            $pKey = $this->primaryKey;
            $this->modelInstance->$pKey = $modelId;
            $this->modelInstance->language_id = $this->language->id;
        }
        $this->modelInstance->save();
        $this->emitUp('savedTranslate');
    }

    protected function rules() : array
    {
        return $this->mappedRule;
    }

    public function mount( string $model,  ?string $pKey = null, ?int $id = null )
    {
        $this->isEditMode = $id != null;
        $this->primaryKey = $pKey;
        $this->modelInstance = $this->isEditMode ? $model::where('language_id', $this->language->id)->where($this->primaryKey, $id)->first() : new $model;
        $this->mapingRule($this->modelInstance->mapFillable);
    }

    private function mapingRule( $attributes )
    {
        foreach ($attributes as $inputName => $attribute) {
            $this->mappedRule['modelInstance.'.$inputName] = $attribute['rule'];
            $this->mappedInputsType[$inputName] = $attribute['type'];
            $this->mappedInputsTitle[$inputName] = $attribute['name'];
        }
    }

    public function render()
    {
        return view( 'livewire.admin.components.language.content' );
    }
}
