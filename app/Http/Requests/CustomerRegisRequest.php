<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRegisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $ruleArr = [
            'cris_no'=>[
                'required',
                'numeric',
                Rule::unique('matters')->ignore($this->id)->withoutTrashed()
            ],
            'uploadFile'=> 'mimes:pdf'
        ];

        if ($this->request->get('action') == 'save') {
            $ruleAdds = [
                'address'           =>  'required',
                'name'              =>  'required',
                'mail'              => [
                                        'required',
                                        'email'
                                        ],
                'check_code'        => [
                                        'nullable',
                                        'max:255',
                                        'regex:/^[a-zA-Z0-9]+$/'
                                        ],
                'invoice_day'       =>  'nullable|after:-10 year|before:+10 year',
                'invoice_no'        =>  'required|max:7|same:cris_no',
                'invoice_amount'    =>  'digits_between:1,11',

                'estimate_no'       => [
                                        'nullable',
                                        'max:255',
                                        'regex:/^[a-zA-Z0-9]+$/'
                                        ],
                'estimate_amount'   =>  'nullable|digits_between:1,11',
                'estimate_day'      =>  'nullable|after:-10 year|before:+10 year',
                'pay_amount'        =>  'nullable|digits_between:1,11',
                'contact_day'       =>  'nullable|after:-10 year|before:+10 year',
                'fix_day'           =>  'nullable|after:-10 year|before:+10 year',
                'pay_day'           =>  'nullable|after:-10 year|before:+10 year',
                'customFile'        =>  'required'
            ];
            foreach ($ruleAdds as $field => $rule) {
                $ruleArr[$field] = $rule;
            }
        }

        return $ruleArr;

    }

    public function getValidatorInstance()
    {

        $this->cleanAmount();
        return parent::getValidatorInstance();
    }

    protected function cleanAmount()
    {

        $this->merge([
            'invoice_amount' => str_replace(['-','_',','], '', $this->request->get('invoice_amount')),
            'estimate_amount' => str_replace(['-','_',','], '', $this->request->get('estimate_amount')),
            'pay_amount' => str_replace(['-','_',','], '', $this->request->get('pay_amount')),
        ]);

    }

    public function messages()
    {
        return [
            'cris_no.required'                     => '必須項目です。入力をお願いします。',
            'cris_no.numeric'                      => '半角数字で入力してください。',
            'cris_no.unique'                       => 'すでに存在している番号です。',

            'address.required'                     => '必須項目です。入力をお願いします。',

            'name.required'                        => '必須項目です。入力をお願いします。',

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
            'invoice_no.same'                       => 'Cris Noと一致しません',

            'invoice_amount.required'              => '必須項目です。入力をお願いします。',
            'invoice_amount.digits_between'        => '半角数字11桁以内で入力をお願いします。',

            'estimate_no.required'                 => '必須項目です。入力をお願いします。',
            'estimate_no.max'                      => '入力桁数が多すぎます',
            'estimate_no.regex'                    => '半角英数字のみで入力をお願いします',
            'estimate_day.after'                    => '10年以内の範囲で入力してください。',
            'estimate_day.before'                   => '10年以内の範囲で入力してください。',
            'estimate_amount.digits_between'       => '半角数字11桁以内で入力をお願いします。',

            'contact_day.after'                    => '10年以内の範囲で入力してください。',
            'contact_day.before'                   => '10年以内の範囲で入力してください。',

            'fix_day.after'                         => '10年以内の範囲で入力してください。',
            'fix_day.before'                        => '10年以内の範囲で入力してください。',

            'pay_day.after'                         => '10年以内の範囲で入力してください。',
            'pay_day.before'                        => '10年以内の範囲で入力してください。',
            'pay_amount.digits_between'             => '半角数字11桁以内で入力をお願いします。',

            'customFile.required'                   => '必須項目です。入力をお願いします。',
            'uploadFile.mimes'                      => 'PDFファイル形式を入力してください'
        ];
    }
}
