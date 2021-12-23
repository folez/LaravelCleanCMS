<?php

namespace App\Http\Livewire\Admin\Components\Attributes;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Wrapper extends Component
{
    /**
     * @var Collection|null
     * @description return Collection items
     */
    public Collection|null $attributes = null;

    /**
     * @var string|null
     * @description return a model type after initialized
     */
    public string|null $modelTyping = null;

    /**
     * @var string|null
     * @description Temporary id for create new record
     */
    public string|null $temp_id = null;

    /**
     * @var bool $isEditMode
     * @description return edit mode status
     */
    public bool $isEditMode = false;

    /**
     * @var int|null $modelId
     */
    public int|null $modelId = null;

    public Attribute $option;

    protected $listeners = [
        'successDelete'
    ];

    protected function rules(): array
    {
        return [
            'option.attribute_name'    => 'required',
            'option.attribute_value'   => 'string',
        ];
    }

    public function successDelete()
    {
        if(!$this->isEditMode)
            $this->attributes = \App\Models\Attribute::findByModelTypeAndTempId($this->modelTyping, $this->temp_id);
        else
            $this->attributes = \App\Models\Attribute::findByModelTypeAndModelId($this->modelTyping, $this->modelId);
    }

    public function mount(string $modelType, ?int $modelId = null, ?string $tname, bool $isEdit = false ):void
    {
        $this->option = new Attribute();
        $this->modelTyping = $modelType;
        $this->isEditMode = $isEdit;

        $this->temp_id = $tname;

        if(!$this->isEditMode)
            $this->attributes = \App\Models\Attribute::findByModelTypeAndTempId($this->modelTyping, $this->temp_id);
        else
            $this->attributes = \App\Models\Attribute::findByModelTypeAndModelId($this->modelTyping, $this->modelId);
    }

    public function addOption()
    {
        if(!is_string($this->option->attribute_name))
        {
            $this->addError('option.attribute_name', 'Пустое значение!');
            return;
        }


        if(!is_string($this->option->attribute_value))
        {
            $this->resetErrorBag('option.attribute_name');
            $this->addError('option.attribute_value', 'Пустое значение!');
            return;
        }

        $this->resetErrorBag('option.attribute_name');
        $this->resetErrorBag('option.attribute_value');
        $this->option->attributes_type = $this->modelTyping;

        if($this->isEditMode){
            $this->option->attributes_id = $this->modelId;
        }else{
            $this->option->temp_id = $this->temp_id;
        }

        $this->option->save();
        $this->option = new Attribute();

        if(!$this->isEditMode)
            $this->attributes = \App\Models\Attribute::findByModelTypeAndTempId($this->modelTyping, $this->temp_id);
        else
            $this->attributes = \App\Models\Attribute::findByModelTypeAndModelId($this->modelTyping, $this->modelId);
    }

	public function render()
	{
		return view( 'livewire.admin.components.attributes.wrapper' );
	}
}
