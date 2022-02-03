<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFiledInBussinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businesses', function (Blueprint $table) {
            //
            $table->string('google_analytic')->nullable()->after('meta_description');
            $table->string('fbpixel_code')->nullable()->after('google_analytic');
            $table->text('customjs')->nullable()->after('fbpixel_code');
        });

        Schema::table('appointment_deatails', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
        });
        Schema::table('plans', function (Blueprint $table) {
            $table->integer('business')->default(0)->after('themes');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businesses', function (Blueprint $table) {
            
        });
    }
}
