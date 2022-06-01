<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlertTableMatters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matters', function (Blueprint $table) {

            DB::statement('ALTER TABLE `matters` CHANGE  `address` `address` VARCHAR(256)  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `name` `name` VARCHAR(256)  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `mail` `mail` VARCHAR(256)  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `check_code` `check_code`INT(11)  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `invoice_day` `invoice_day` DATETIME  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `invoice_no` `invoice_no` INT(11)  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `invoice_amount` `invoice_amount` INT(11)  NULL DEFAULT NULL');

            DB::statement('ALTER TABLE `matters` CHANGE  `invoice_mail_info` `invoice_mail_info` TEXT  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `invoice_pdf` `invoice_pdf` VARCHAR(256)  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `estimate_day` `estimate_day` DATETIME  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `estimate_no` `estimate_no` INT(11)  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `estimate_amount` `estimate_amount` INT(11)  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `contact_day` `contact_day` DATETIME  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `contact_answer` `contact_answer` VARCHAR(20)  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `fix_day` `fix_day` DATETIME  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `fix_info` `fix_info` TEXT  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `pay_day` `pay_day` DATETIME  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `pay_amount` `pay_amount` INT(11)  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `pay_to` `pay_to` VARCHAR(20)  NULL DEFAULT NULL');
            DB::statement('ALTER TABLE `matters` CHANGE  `status` `status` VARCHAR(20)  NULL DEFAULT NULL');
        });
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
