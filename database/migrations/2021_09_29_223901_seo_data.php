<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeoData extends Migration
{
    public function up()
    {
        Schema::create( 'seo_data', function ( Blueprint $table ) {
            $table->bigIncrements( 'id' );

            $table->mediumText( 'title' );
            $table->mediumText( 'description' );
            $table->mediumText( 'keywords' );

            $table->mediumText( 'ogg_title' );
            $table->mediumText( 'ogg_description' );

            $table->mediumText( 'image_url' )->nullable();
            $table->string( 'ogg_image' )->nullable();

            $table->string( 'model_type' );
            $table->unsignedBigInteger( 'model_id' )->nullable();
            $table->mediumText( 'sysname' );

            $table->timestamps();
        } );
    }

    public function down()
    {
        Schema::dropIfExists( 'seo_data' );
    }
}
