<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;

trait WithGallery
{
    public function gallery(): Collection
    {
        return \App\Models\Gallery::findByModelTypeAndModelId(get_class($this->getModel()), $this->id);
    }
}
