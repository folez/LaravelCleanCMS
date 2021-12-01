<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Language;

class PageTranslation extends Migration
{
	public function up()
	{
		Schema::create( \App\Models\PageTranslation::TABLE_NAME, function ( Blueprint $table ) {
            $table->bigIncrements( 'p_id' );
			$table->string('title');
			$table->string('name');
			$table->mediumText('description');
			$table->mediumText('keywords');
            $table->longText('body');

            $table
                ->foreignIdFor(\App\Models\Page::class,'page_id')
                ->nullable()
                ->references('id')
                ->on('page')
                ->cascadeOnDelete();

            $table
                ->foreignIdFor( Language::class,'language_id')
                ->references('id')
                ->on( Language::TABLE_NAME)
                ->cascadeOnDelete();

            $table->unique(['language_id', 'page_id']);
		} );
	}

	public function down()
	{
		Schema::dropIfExists( 'page_translation' );
	}
}
