<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Menu extends Migration
{
	public function up()
	{
		Schema::create( \App\Models\Menu::TABLE_NAME, function ( Blueprint $table ) {
			$table->bigIncrements( 'id' );

			$table->string('link')->nullable();

            $table->enum('type', [ 'link', 'page', 'dropdown' ])->default('link');
            $table->boolean('is_hide')->default(false);

            \App\Utils\WithForeign::column($table,\App\Models\Page::class, 'page_id', 'id', true);
            \App\Utils\WithForeign::column($table,\App\Models\Menu::class, 'parent_id', 'id', true);
            \App\Utils\WithPriority::column($table);

//			$table->timestamps();
		} );

        $inputs = [
            ['string' => 'name']
        ];

        \App\Utils\WithTranslatable::create(\App\Models\Menu::class, 'menu_id', $inputs, 'id');
	}

	public function down()
	{
		Schema::dropIfExists( 'menu' );
	}
}
