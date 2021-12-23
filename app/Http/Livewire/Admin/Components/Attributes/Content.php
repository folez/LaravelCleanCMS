<?php

namespace App\Http\Livewire\Admin\Components\Attributes;

use App\Models\Attribute;
use Livewire\Component;

class Content extends Component
{
    public ?Attribute $attribute = null;
    public ?string $temp = null;

    protected function rules(): array
    {
        return [
            'attribute.attribute_name' => 'string',
            'attribute.attribute_value' => 'string',
        ];
    }

    public function mount(?int $id = null, ?string $temp_id = null)
    {
        $this->attribute = Attribute::find($id);
    }

    public function save()
    {
        $this->attribute->save();
        $this->dispatchBrowserEvent('savedItem');
    }

    public function delete()
    {
        $this->attribute->delete();
        $this->emitUp('successDelete');
        $this->dispatchBrowserEvent('deleteItem');
    }

	public function render()
	{
		return view( 'livewire.admin.components.attributes.content' );
	}
}
