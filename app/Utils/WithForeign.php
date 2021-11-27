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
     * @param bool      $nullable
     */
    public static function column( Blueprint $table, string $modelClass, string $foreignId, string $modelPrimaryId, bool $nullable = false ): void
    {
        $tableName = new $modelClass;
        if(!$nullable){
            $table->foreignIdFor( $modelClass, $foreignId )->references( $modelPrimaryId )->on( $tableName->getTable() )->cascadeOnDelete();
        } else {
            $table->foreignIdFor( $modelClass, $foreignId )->nullable()->references( $modelPrimaryId )->on( $tableName->getTable() )->cascadeOnDelete();
        }
    }
}
