<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlertTableMattersChangeColumnCheckCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `matters` CHANGE  `check_code` `check_code` VARCHAR(256)  NULL DEFAULT NULL');
        DB::statement('ALTER TABLE `matters` CHANGE  `invoice_no` `invoice_no` VARCHAR(256)  NULL DEFAULT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
