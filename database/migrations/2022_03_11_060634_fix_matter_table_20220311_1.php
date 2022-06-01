<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixMatterTable202203111 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `matters` CHANGE  `estimate_no` `estimate_no` VARCHAR(256)  NULL DEFAULT NULL');
        DB::statement('ALTER TABLE `matters` CHANGE  `invoice_no` `invoice_no` integer  NULL DEFAULT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FixEstimateNoAndInvoiceNo');
    }
}
