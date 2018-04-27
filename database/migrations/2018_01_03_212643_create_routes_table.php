<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->uuid('id')->primary('id');
            $table->uuid('from_jetty')->nullable();
            $table->uuid('to_jetty')->nullable();
            $table->string('ref');
            $table->float('km_estimate')->nullable();
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        //add road and route
        //.idea/misc.xml
        //build.gradle
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
