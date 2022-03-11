<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms', function (Blueprint $table) {
            $table->string('vehicles_header')->nullable()->after('ads_background');
            $table->string('motorbikes_header')->nullable()->after('ads_background');
            $table->string('auto_parts_header')->nullable()->after('ads_background');
            $table->string('general_header')->nullable()->after('ads_background');
            $table->string('handy_man_header')->nullable()->after('ads_background');
            $table->string('junk_cars_header')->nullable()->after('ads_background');
            $table->string('local_rent_header')->nullable()->after('ads_background');
            $table->string('coming_soon_header')->nullable()->after('ads_background');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms', function (Blueprint $table) {
            //
        });
    }
}
