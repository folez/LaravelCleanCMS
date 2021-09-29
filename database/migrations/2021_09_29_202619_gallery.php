<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Gallery extends Migration
{
	public function up()
	{
		Schema::create( 'gallery', function ( Blueprint $table ) {
			$table->bigIncrements( 'id' );

			$table->string('filename');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string('temp_id')->nullable();
            $table->integer('priority')->default(0);

			$table->timestamps();
		} );
	}

	public function down()
	{
		Schema::dropIfExists( 'gallery' );
	}
}
