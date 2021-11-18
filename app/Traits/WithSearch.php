<?php

namespace App\Traits;

trait WithSearch
{
    public ?string $search = null;
    protected string $MATCH_RULE = 'like';
}
