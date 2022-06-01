<?php

namespace App\Helpers;


class Helper
{
    const ERROR_MESSAGE = [
        'cris_no.required'                     => '必須項目です。入力をお願いします。',
        'cris_no.numeric'                      => '半角数字で入力してください。',
        'cris_no.unique'                       => 'すでに存在している番号です。',

        'address.required'                     => '必須項目です。入力をお願いします。',

        'name.required'                        => '必須項目です。入力をお願いします。',
        'name.max'                             => '入力桁数が多すぎます',

        'mail.required'                        => '必須項目です。入力をお願いします。',
        'mail.email'                           => 'メールアドレス形式で指定してください。',

        'check_code.required'                  => '必須項目です。入力をお願いします。',
        'check_code.max'                       => '入力桁数が多すぎます',
        'check_code.regex'                     => '半角英数字のみで入力をお願いします',

        'invoice_day.required'                 => '必須項目です。入力をお願いします。',
        'invoice_day.after'                    => '10年以内の範囲で入力してください。',
        'invoice_day.before'                   => '10年以内の範囲で入力してください。',

        'invoice_no.required'                  => '必須項目です。入力をお願いします。',
        'invoice_no.max'                       => '入力桁数が多すぎます',
        'invoice_no.same'                      => 'Cris Noと一致しません。',

        'invoice_amount.required'              => '必須項目です。入力をお願いします。',
        'invoice_amount.digits_between'        => '半角数字11桁以内で入力をお願いします。',

        'invoice_mail_info.required'           => '必須項目です。入力をお願いします。',

        'estimate_no.required'                 => '必須項目です。入力をお願いします。',
        'estimate_no.max'                      => '入力桁数が多すぎます',
        'estimate_no.regex'                    => '半角英数字のみで入力をお願いします',
        'estimate_day.after'                   => '10年以内の範囲で入力してください。',
        'estimate_day.before'                  => '10年以内の範囲で入力してください。',
        'estimate_amount.digits_between'       => '半角数字11桁以内で入力をお願いします。',

        'contact_day.after'                    => '10年以内の範囲で入力してください。',
        'contact_day.before'                   => '10年以内の範囲で入力してください。',

        'fix_day.after'                    => '10年以内の範囲で入力してください。',
        'fix_day.before'                   => '10年以内の範囲で入力してください。',

        'pay_day.after'                    => '10年以内の範囲で入力してください。',
        'pay_day.before'                   => '10年以内の範囲で入力してください。',
        'pay_amount.digits_between'            => '半角数字11桁以内で入力をお願いします。',

        'customFile.required'=>'必須項目です。入力をお願いします。'
    ];
}
