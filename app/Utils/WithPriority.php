<?php

namespace App\Utils;

use Illuminate\Database\Schema\Blueprint;

class WithPriority
{
    /**
     * @param Blueprint $table
     */
    public static function column( Blueprint $table ): void
    {
        $table->integer('priority')->default(0);
    }
}
