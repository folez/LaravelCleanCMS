<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Language extends Migration
{
	public function up()
	{
		Schema::create( \App\Models\Language::TABLE_NAME, function ( Blueprint $table ) {
			$table->bigIncrements( 'id' );

            $table->string('code', 15);
            $table->string('name', 25);
            $table->boolean('is_default')->default(false);

			$table->timestamps();
		} );
	}

	public function down()
	{
		Schema::dropIfExists( 'language' );
	}
}
