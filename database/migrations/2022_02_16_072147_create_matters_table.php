<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMattersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matters', function (Blueprint $table) {

            if (App::environment('production')){
                $table->id()->from(200000);
                 
            }elseif(App::environment('staging')){
                $table->id()->from(100000);

            }elseif(App::environment('develop')){
                $table->id()->from(50000);

            }elseif(App::environment('local')){
                $table->id();
            }
                
            $table->integer('cris_no');
            $table->string('address');
            $table->string('name');
            $table->string('mail');
            $table->integer('check_code');
            $table->dateTime('invoice_day');
            $table->integer('invoice_no');
            $table->integer('invoice_amount');
            $table->text('invoice_mail_info');
            $table->string('invoice_pdf')->nullable();
            $table->dateTime('estimate_day');
            $table->integer('estimate_no');
            $table->integer('estimate_amount');
            $table->dateTime('contact_day');
            $table->string('contact_answer',20)->nullable();
            $table->dateTime('fix_day');
            $table->text('fix_info');
            $table->dateTime('pay_day');
            $table->integer('pay_amount');
            $table->string('pay_to',20)->nullable();
            $table->string('status',20)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matters');
    }
}
