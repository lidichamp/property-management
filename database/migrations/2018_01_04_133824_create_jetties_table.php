<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJettiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jetties', function (Blueprint $table) {
            $table->uuid('id')->primary('id');
			$table->uuid('operator');
			$table->integer('jetty_type');
            $table->string('name');
            $table->string('address')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('jetties');
    }
}
