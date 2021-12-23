<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait WithTree
{
    /**
     * @var string|null
     */
    protected ?string $childModel = null;

    /**
     * @param string $childModel
     */
    public function setChildModel( string $childModel ): void
    {
        $this->childModel = $childModel;
    }

    /**
     * @return bool
     */
    public function isCatalog(): bool
    {
        return $this->isCatalog;
    }

    /**
     * @var bool
     */
    protected bool $isCatalog = false;

    /**
     * @param bool $isCatalog
     */
    public function setIsCatalog( bool $isCatalog ): void
    {
        $this->isCatalog = $isCatalog;
    }

    /**
     * @param string $childItemsModel
     */
    public function setChildItemsModel( string $childItemsModel ): void
    {
        $this->childItemsModel = $childItemsModel;
    }

    /**
     * @return string|null
     */
    public function getChildModel(): ?string
    {
        return $this->childModel;
    }

    /**
     * @return string|null
     */
    public function getChildItemsModel(): ?string
    {
        return $this->childItemsModel;
    }

    /**
     * @return string
     */
    public function getChildItemsForeignId(): string
    {
        return $this->childItemsForeignId;
    }

    /**
     * @return string
     */
    public function getChildForeignId(): string
    {
        return $this->childForeignId;
    }

    /**
     * @return array
     */
    public function getRouteNames(): array
    {
        return $this->routeNames;
    }

    /**
     * @return bool
     */
    public function isShowEditLink(): bool
    {
        return $this->showEditLink;
    }

    /**
     * @return bool
     */
    public function isShowCreateLink(): bool
    {
        return $this->showCreateLink;
    }

    /**
     * @param string $childItemsForeignId
     */
    public function setChildItemsForeignId( string $childItemsForeignId ): void
    {
        $this->childItemsForeignId = $childItemsForeignId;
    }

    /**
     * @param string $childForeignId
     */
    public function setChildForeignId( string $childForeignId ): void
    {
        $this->childForeignId = $childForeignId;
    }

    /**
     * @param bool $showEditLink
     */
    public function setShowEditLink( bool $showEditLink ): void
    {
        $this->showEditLink = $showEditLink;
    }

    /**
     * @param bool $showCreateLink
     */
    public function setShowCreateLink( bool $showCreateLink ): void
    {
        $this->showCreateLink = $showCreateLink;
    }

    /**
     * @var string|null
     */
    protected ?string $childItemsModel = null;

    /**
     * @var string
     */
    protected string $childItemsForeignId;

    /**
     * @var string
     */
    protected string $childForeignId;

    /**
     * @var array
     */
    public array $routeNames = [];

    /**
     * @var bool
     */
    protected bool $showEditLink = true;
    /**
     * @var bool
     */
    protected bool $showCreateLink = true;

    /**
     * @param array $routeNames
     */
    public function setRouteNames( array $routeNames ): void
    {
        $this->routeNames = $routeNames;
    }


    /**
     * @return int
     */
    public function hasChildren(): int
    {
        /** @var HasRelationships $this  */
        if($this->childModel)
            return $this->hasMany($this->childModel, $this->childForeignId, $this->primaryKey)->count();
    }

    /**
     * @return int
     */
    public function hasChildrenItems(): int
    {
        /** @var HasRelationships $this  */
        if($this->childItemsModel)
            return $this->hasMany($this->childItemsModel, $this->childItemsForeignId, $this->primaryKey)->count();
        return 0;
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
     * @return string|null
     */
    public function getChildEditLink(): ?string
    {
        return $this->showEditLink ? route($this->routeNames['child_edit'], ['id' => $this->id]) : null;
    }

    /**
     * @return string|null
     */
    public function getChildCreateLink(): ?string
    {
        return $this->showCreateLink ? ( @$this->routeNames['child_create'] ? route( $this->routeNames['child_create'] ).'?selectedCategory='.$this->id : null ) : null;
    }

    /**
     * @return HasMany
     */
    public function items()
    {
        /** @var HasRelationships $this  */
        if($this->childModel)
            return $this->childModel::where($this->childForeignId, $this->id)->LanguageCode()->orderBy('priority', 'asc');
        //            return $this->hasMany($this->childModel, $this->childForeignId, $this->primaryKey);
    }

    /**
    //     * @return
     */
    public function getChildrenItems()
    {
        /** @var HasRelationships $this  */
        //        dd($this->childItemsModel::where($this->childItemsForeignId, $this->id)->LanguageCode()->orderBy('priority', 'asc')->dd());
        if($this->childItemsModel)
            return $this->childItemsModel::where($this->childItemsForeignId, $this->id)->LanguageCode()->orderBy('priority', 'asc');
    }
}
