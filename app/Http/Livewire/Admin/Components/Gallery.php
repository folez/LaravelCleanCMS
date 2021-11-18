<?php

namespace App\Http\Livewire\Admin\Components;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;
use function PHPUnit\Framework\directoryExists;

/**
 *
 */
class Gallery extends Component
{
    use WithFileUploads;

    /**
     * @var mixed
     * @description property uploading images
     */
    public $images;

    /**
     * @var Collection|null
     * @description return Collection items
     */
    public Collection|null $items = null;

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

    public function mount( string $modelType, ?int $modelId = null ):void
    {
        $this->modelTyping = $modelType;

        if(!\Storage::exists('public/gallery')){
            \Storage::makeDirectory('public/gallery');
        }

        $this->isEditMode = $modelId != null;

        if(!$this->isEditMode) $this->temp_id = uniqid();
        else $this->items = \App\Models\Gallery::findbyModelType($this->modelTyping);
    }

    /**
     * @param $galleryIds
     */
    public function updateGalleryPriority( $galleryIds ): void
    {
        foreach ($galleryIds as $item) {
            $img = \App\Models\Gallery::find($item['value']);
            $img->priority = $item['order'];
            $img->save();
        }

        $this->items = \App\Models\Gallery::findbyModelType($this->modelTyping);
    }


    public function updatedImages(): void
    {
        foreach ($this->images as $key => $item){
            $image = new \App\Models\Gallery();
            $image->model_type = $this->modelTyping;
            if(!$this->isEditMode)
                $image->temp_id = $this->temp_id;
            else
                $image->model_id = $this->modelId;

            $fileName = uniqid().".".$item->extension();
            $item->storeAs('/public/gallery', $fileName);

            $image->filename = $fileName;
            $image->priority = $key;

            $image->save();
        }

        if(!$this->isEditMode)
            $this->items = \App\Models\Gallery::findByModelTypeAndTempId($this->modelTyping, $this->temp_id);
        else
            $this->items = \App\Models\Gallery::findByModelTypeAndModelId($this->modelTyping, $this->modelId);

        $this->emit('galleryUploaded');
    }

    /**
     * @param int $galleryKey
     */
    public function deleteGalleryItem( int $galleryKey )
    {
        $itm = \App\Models\Gallery::find($galleryKey);

        \Storage::delete('public/gallery/'.$itm->filename);
        \Storage::delete('public/gallery_cache/admin_'.$itm->filename);

        $itm->forceDelete();

        if(!$this->isEditMode)
            $this->items = \App\Models\Gallery::findByModelTypeAndTempId($this->modelTyping, $this->temp_id);
        else
            $this->items = \App\Models\Gallery::findByModelTypeAndModelId($this->modelTyping, $this->modelId);
    }

	public function render()
	{
		return view( 'livewire.admin.components.gallery' );
	}
}
