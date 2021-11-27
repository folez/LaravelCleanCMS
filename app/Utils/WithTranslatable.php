<?php

namespace App\Utils;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use App\Models\Language;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use JetBrains\PhpStorm\NoReturn;
use function Livewire\str;

class WithTranslatable
{

    private static string $baseClassNamespace;
    private static string $model;
    private static string $baseClassPath;
    private static string $modelClass;
    private static string $componentClass;
    private static array $directories;
    private static array $fillable;
    private static string $tableName;

    public static function create( string $modelClass, string $foreignTranslateId, array $modelFields, string $modelPrimaryId = 'id' )
    {
        foreach ($modelFields as $field) {
            self::$fillable[] = "'".self::getFieldTypeAndName($field)[1]."'";
        }

        $translatableModel = "{$modelClass}Translation";

        self::$baseClassNamespace = "App\\Models";

        $classPath = static::generatePathFromNamespace(self::$baseClassNamespace);

        self::$baseClassPath = rtrim($classPath, DIRECTORY_SEPARATOR).'/';

        $directories = preg_split('/[.\/(\\\\)]+/', $translatableModel);

        $camelCase = str(array_pop($directories))->camel();

        self::$directories = array_map([Str::class, 'studly'], $directories);

        //        $camelCase = str(array_pop($directories))->camel();
        $kebabCase = str($camelCase)->kebab();
        self::$componentClass = str($kebabCase)->studly();

        $modelClassName = explode('\\', $modelClass);
        $modelClassName = end($modelClassName);
        $translatableTableName = $modelClass::TABLE_NAME."_translation";

        self::$tableName = $translatableTableName;

        self::generateModel($modelClassName);


        Schema::create( $translatableTableName, function ( Blueprint $table ) use ( $foreignTranslateId, $modelClass, $modelFields, $modelPrimaryId ) {
            $table->bigIncrements( 't_id' );
            foreach ($modelFields as $field) {
                $fieldType = self::getFieldTypeAndName( $field )[0];
                $fieldName = self::getFieldTypeAndName( $field )[1];
                $table->{$fieldType}($fieldName)->nullable();
            }

            WithForeign::column($table, $modelClass, $foreignTranslateId, 'id');
            WithForeign::column($table, Language::class, 'language_id', $modelPrimaryId);

            $table->unique(['language_id', $foreignTranslateId]);
        } );
    }

    #[NoReturn] private static function generateModel( $modelName ): void
    {
        $file = new Filesystem();
        $classPath = self::classPath();

        $fileOrigin = base_path('/stubs/model-translatable.stub');
        $explodedPath = explode('.',$modelName);
        $createdClassPath = explode('/', $classPath);
        $createdClassPathUnsetIndex = count($createdClassPath) - 1;
        unset($createdClassPath[$createdClassPathUnsetIndex]);

        $fileDestination = base_path('app/Models/'.implode('/',explode('.',$modelName)).'Translation.php');

        $fileOriginalString = $file->get($fileOrigin);

        $replaceFileOriginalString = Str::replace('[namespace]', self::classNamespace(), $fileOriginalString);
        $replaceFileOriginalString = Str::replace('[class]', $modelName, $replaceFileOriginalString);
        $replaceFileOriginalString = Str::replace('[tableName]', self::$tableName, $replaceFileOriginalString);
        $replaceFileOriginalString = Str::replace('[fillable]', "[".implode(',',self::$fillable)."]", $replaceFileOriginalString);

        File::put($fileDestination,$replaceFileOriginalString);
    }

    private static function generatePathFromNamespace($namespace)
    {
        $name = str($namespace)->finish('\\')->replaceFirst(app()->getNamespace(), '');
        return app('path').'/'.str_replace('\\', '/', $name);
    }

    private static function classNamespace()
    {
        return self::$baseClassNamespace;
    }

    private static function classPath()
    {
        return self::$baseClassPath.collect()
                ->concat(self::$directories)
                ->push(self::classFile())
                ->implode('/');
    }

    private static function classFile()
    {
        return self::$componentClass.'.php';
    }

    private static function className()
    {
        return self::$componentClass;
    }

    private static function getFieldTypeAndName( array $array )
    {
        $fieldType = array_keys($array)[0];
        $fieldName = array_values($array)[0];
        return [ $fieldType, $fieldName ];
    }
}
