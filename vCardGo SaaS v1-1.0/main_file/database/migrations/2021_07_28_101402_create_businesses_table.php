<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('slug')->nullable();
            $table->text('title')->nullable();
            $table->string('designation')->nullable();
            $table->text('sub_title')->nullable();
            $table->text('description')->nullable();
            $table->text('banner')->nullable();
            $table->text('logo')->nullable();
            $table->string('card_theme')->nullable();
            $table->string('theme_color')->nullable();
            $table->text('links')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
