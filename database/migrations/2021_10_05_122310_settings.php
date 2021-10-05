<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Settings extends Migration
{
	public function up()
	{
		Schema::create( 'setting', function ( Blueprint $table ) {
			$table->bigIncrements( 'id' );

			$table->string('setting_name')->nullable();
			$table->string('setting_key')->nullable();
			$table->enum('setting_type', [ 'input', 'textarea', 'file' ])->default('input');
			$table->mediumText('setting_value')->nullable();

			$table->timestamps();
		} );
	}

	public function down()
	{
		Schema::dropIfExists( 'Setting' );
	}
}
