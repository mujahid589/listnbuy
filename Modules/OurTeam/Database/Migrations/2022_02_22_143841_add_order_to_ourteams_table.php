<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderToOurteamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ourteams', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('image');
            $table->enum('type', ['director', 'staff'])->default('director')->after('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ourteams', function (Blueprint $table) {

        });
    }
}
