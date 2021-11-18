<?php

namespace App\Http\Livewire\Admin\Components\Language;

use App\Models\Language;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
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

    public function saveTranslate( $modelId ): void
    {
        if(!$this->isEditMode){
            $pKey = $this->primaryKey;
            $this->modelInstance->$pKey = $modelId;

            $this->modelInstance->language_id = $this->language->id;
        }

        $this->modelInstance->save();
        $this->emitUp('savedTranslate');
    }

    public function updated($propName): void
    {
        $this->validateOnly($propName);
    }

    protected function rules(): array
    {
        return $this->mappedRule;
    }

    public function mount( string $model,  ?string $pKey = null, ?int $id = null ): void
    {
        /** @var Builder $model */
        $this->isEditMode = $id != null;
        $this->primaryKey = $pKey;
        $this->modelInstance = $this->isEditMode ? ($model::where('language_id', $this->language->id)->where($this->primaryKey, $id)->first() ?? new $model) : new $model;
        $this->mapingRule($this->modelInstance->mapFillable);
    }

    private function mapingRule( $attributes ): void
    {
        foreach ($attributes as $inputName => $attribute) {
            $this->mappedRule['modelInstance.'.$inputName] = $attribute['rule'];
            $this->mappedInputsType[$inputName] = $attribute['type'];
            $this->mappedInputsTitle[$inputName] = $attribute['name'];
        }
    }

    public function render(): View|Factory
    {
        return view( 'livewire.admin.components.language.content' );
    }
}
