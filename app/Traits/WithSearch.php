<?php

namespace App\Traits;

class WithSearch
{
    public ?string $search = null;
    protected string $MATCH_RULE = 'like';
}
