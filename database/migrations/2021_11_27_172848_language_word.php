<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LanguageWord extends Migration
{
	public function up()
	{
		Schema::create( \App\Models\LanguageWord::TABLE_NAME, function ( Blueprint $table ) {
			$table->bigIncrements( 'word_id' );

            \App\Utils\WithForeign::column($table, \App\Models\Language::class, 'language_id', 'id');

            $table->string('word_name')->nullable();
            $table->string('word_key')->nullable();
            $table->mediumText('word_default')->nullable();
            $table->mediumText('word_custom')->nullable();

            $table->index( [ 'word_key', 'language_id' ] );
		} );
	}

	public function down()
	{
		Schema::dropIfExists( 'language_word' );
	}
}
