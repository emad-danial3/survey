<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EditAllTables extends Migration
{

    public function up()
    {
        if (
            Schema::hasTable('locations') &&
            !Schema::hasColumn("locations","location_type")
        ){
           DB::statement("ALTER TABLE `locations` ADD `location_type` ENUM('general','special') NOT NULL DEFAULT 'special' AFTER `updated_at`, ADD `area` ENUM('opera','other') NOT NULL DEFAULT 'other' AFTER `location_type`");
        }
    }


    public function down()
    {
        //
    }
}
