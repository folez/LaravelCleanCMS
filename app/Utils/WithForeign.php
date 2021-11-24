<?php

namespace App\Utils;

use Illuminate\Database\Schema\Blueprint;

class WithForeign
{
    /**
     * @param Blueprint $table
     * @param string    $modelClass
     * @param string    $foreignId
     * @param string    $modelPrimaryId
     */
    public static function column( Blueprint $table, string $modelClass, string $foreignId, string $modelPrimaryId ): void
    {
        $tableName = new $modelClass;
        $table
            ->foreignIdFor( $modelClass,$foreignId)
            ->references($modelPrimaryId)
            ->on($tableName->getTable())
            ->cascadeOnDelete();
    }
}
