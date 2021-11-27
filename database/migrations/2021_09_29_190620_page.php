<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Page extends Migration
{
	public function up()
	{
		Schema::create( 'page', function ( Blueprint $table ) {
			$table->bigIncrements( 'id' );

			$table->string('slug')->nullable();

			$table->timestamps();
		} );
	}

	public function down()
	{
		Schema::dropIfExists( 'page' );
	}
}
