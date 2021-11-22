<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait WithTree
{
    /**
     * @var string
     */
    protected string $childModel;
    /**
     * @var string
     */
    protected string $childForeignId;

    /**
     * @var array
     */
    protected array $routeNames;

    /**
     * @var bool
     */
    protected bool $showEditLink = true;
    /**
     * @var bool
     */
    protected bool $showCreateLink = true;

    /**
     * @return int
     */
    public function hasChildren(): int
    {
        /** @var HasRelationships $this  */
        return $this->hasMany($this->childModel, $this->childForeignId, $this->primaryKey)->count();
    }

    /**
     * @return string|null
     */
    public function getEditLink(): ?string
    {
        return $this->showEditLink ? route($this->routeNames['edit'], ['id' => $this->id]) : null;
    }

    /**
     * @return string|null
     */
    public function getCreateLink(): ?string
    {
        return $this->showCreateLink ? route( $this->routeNames['create'] ).'?selectedCategory='.$this->id : null;
    }

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        /** @var HasRelationships $this  */
        return $this->hasMany($this->childModel, $this->childForeignId, $this->primaryKey);
    }
}
