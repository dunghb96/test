<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class invoice_mail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $address = 'repair-ess@nichicon.com'; #←ここに送信元のアドレスを書く
        $subject = 'ニチコン蓄電システム　修理費用お支払方法お申込方法について'; #←ここに件名を書く
        $name    = 'ニチコン蓄電システムサービス部'; #←ここに送信元の名前を書く

        $maildata = $this->data;

        $pref           = $maildata['address'];
        $customer_name  = $maildata['name'];
        $url            = url('/');
        $info           = @$maildata['invoice_mail_info'];
        $cris_no        = $maildata['cris_no'];
        $pdf_path       = 'app/pdf/'.$maildata['invoice_pdf'];
        $img_path       = 'https://chart.googleapis.com/chart?cht=qr&chs=100x100&chl='.$url.'?authuser=0&choe=UTF-8';
        

        return $this->view('mails.invoice')
                    ->from($address, $name)
                    ->subject($subject)
                    ->attach(storage_path($pdf_path))
                    ->with([ 
                        'type'          => 'mail',
                        'pref'          => $pref,
                        'customer_name' => $customer_name,
                        'url'           => $url,
                        'info'          => $info,
                        'cris_no'       => $cris_no,
                        'img_path'      => $img_path,
                        ]);
    }
}
