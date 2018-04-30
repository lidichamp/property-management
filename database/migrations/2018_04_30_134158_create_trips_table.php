<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->uuid('id');
			$table->uuid('from_jetty');
			$table->uuid('to_jetty');
			$table->uuid('boat_id');
			$table->enum('depature_type')->('Till_Full','Exact_Depature_time');
			$table->time('depature_time');
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
        Schema::dropIfExists('trips');
    }
}