<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExpirationOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::table('operators', function (Blueprint $table) {
    $table->date('expiration');
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          $table->dropColumn('expiration');
    }
}
