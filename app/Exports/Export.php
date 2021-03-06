<?php

namespace App\Exports;

use App\Models\Matters;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class Export implements FromCollection, WithHeadings
{
    use Exportable;
    protected $dataExport;
    protected $searchData;


    public function __construct($dataExport, $searchData)
    {
        $this->dataExport = $dataExport;
        $this->searchData = $searchData;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $bills = [];
        foreach ($this->dataExport as $row) {
            $bills[] = array(
                $row->id ?? '',
                $row->cris_no ?? '',
                $row->address ?? '',
                $row->name ?? '',
                $row->mail ?? '',
                $row->check_code ?? '',
                isset($row->estimate_day) ? Carbon::parse($row->estimate_day)->format('Y.m.d') : '' ,
                $row->estimate_no ?? '',
                empty(number_format($row->estimate_amount)) ? 0  : number_format($row->estimate_amount),
                isset($row->contact_day) ? Carbon::parse($row->contact_day)->format('Y.m.d') : '' ,
                $row->contact_answer ?? '',
                isset($row->fix_day) ? Carbon::parse( $row->fix_day)->format('Y.m.d') : '' ,
                $row->fix_info ?? '',
                isset($row->invoice_day) ? Carbon::parse($row->invoice_day )->format('Y.m.d') : '',
                $row->invoice_no ?? '',
                empty(number_format($row->invoice_amount)) ? 0 : number_format($row->invoice_amount),
                isset($row->invoice_pdf) ? $row->invoice_pdf : '',
                $row->pay_to ?? '',
                isset($row->status) ? Matters::LIST_STATUS[$row->status] : '',
                isset($row->pay_day) ? Carbon::parse( $row->pay_day)->format('Y.m.d') : '' ,
                empty(number_format($row->pay_amount)) ? 0  : number_format($row->pay_amount),
                '',
                '',
                '',
                $row->invoice_mail_info ?? ''
            );
        }
        return (collect($bills));
    }

    /**
     * Set header columns
     *
     * @return array
     */
    public function headings(): array
    {
        $heading = [
            [
                __('DB??????'),
                __('CRIS No.'),
                __('????????????'),
                __(''),
                __(''),
                __(''),
                __('?????????'),
                __(''),
                __(''),
                __('????????????'),
                __(''),
                __('??????'),
                __(''),
                __('?????????'),
                __(''),
                __(''),
                __(''),
                __(''),
                __(''),
                __('??????'),
                __(''),
                __('????????????'),
                __('?????????'),
                __('??????'),
                __('????????????')
            ],
            [
                __('DB??????'),
                __('CRIS No.'),
                __('????????????'),
                __('??????/?????????'),
                __('?????????????????????'),
                __('??????????????????'),
                __('?????????'),
                __('No.'),
                __('??????'),
                __('?????????'),
                __('??????'),
                __('?????????'),
                __('??????'),
                __('?????????'),
                __('No.'),
                __('??????'),
                __('PDF???????????????'),
                __('?????????????????????'),
                __('???????????????'),
                __('?????????'),
                __('??????'),
                __('????????????'),
                __('?????????'),
                __('??????'),
                __('????????????')
            ]
        ];


        if (isset($this->searchData) && !empty($this->searchData)) {
            foreach($this->searchData as $key => $value) {
                $dataHeader[] = [$value];
            }
            $dataHeader = array_merge($dataHeader,$heading);
        }else {
            $dataHeader = $heading;
        }
        return $dataHeader;
    }
}
