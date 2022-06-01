<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Matters;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Error_mail;

class TimeUpCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'timeup:update';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'timeup update_status';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    //請求書送信済みから10日で期限切れエラー
    $date = new Carbon();
    $Matters = Matters::where('status', Matters::STATUS_INVOICE_SENT)->where('updated_at', '<=', $date->subDay(10) )->get();
    foreach($Matters as $Matter)
    {
      $Matter->status = Matters::STATUS_PROCESS_EXPIRED;
      //TODO案内メール
    }

    //入力待ち（ペイジェント画面まで進んでから）60分経ったらエラーにする
    $date = new Carbon();
    $Matters = Matters::where('status', Matters::STATUS_WAITING_PAYMENT)->where('updated_at', '<=', $date->subMinutes(60) )->get();
    foreach($Matters as $Matter)
    {
      $Matter->status = Matters::STATUS_PAYMENT_ERROR;
      $Matter->save();
      $to_address = $Matter['mail'];
      Mail::to($to_address)->send(new Error_mail($Matter));
    }

    $date = new Carbon();
    $Matters = Matters::where('status', Matters::STATUS_PAYMENT_ERROR)->where('updated_at', '<=', $date->subDay(2) )->get();
    foreach($Matters as $Matter)
    {
      $Matter->status = Matters::STATUS_PAYMENT_EXPIRED;
      $Matter->save();
      //こっから先は担当者のマニュアル作業
    }
  }
}
