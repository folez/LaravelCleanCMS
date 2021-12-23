<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Attributes extends Migration
{
	public function up()
	{
		Schema::create( 'attributes', function ( Blueprint $table ) {
			$table->bigIncrements( 'id' );

            $table->string('attribute_name')->nullable();
            $table->string('attribute_value')->nullable();
            $table->morphs('attributes');
            $table->string('temp_id')->nullable();
		} );
	}

	public function down()
	{
		Schema::dropIfExists( 'attributes' );
	}
}
