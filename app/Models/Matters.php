<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Matters extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'matters';
    protected $guarded = [];

    const STATUS_DRAFT = 0;
    const STATUS_INVOICE_SENT = 1;
    const STATUS_UNDER_REVIEW = 2;
    const STATUS_REVIEW_IMPOSSIBLE = 3;
    const STATUS_WAITING_PAYMENT = 4;
    const STATUS_PAYMENT_CONFIRMED = 5;
    const STATUS_CANCEL = 6;
    const STATUS_PAYMENT_ERROR = 7;
    const STATUS_PAYMENT_EXPIRED = 9;
    const STATUS_PROCESS_EXPIRED = 10;
    const STATUS_COMPLETED = 8;

    const LIST_STATUS = [
        self::STATUS_DRAFT             => '登録中',
        self::STATUS_INVOICE_SENT      => '請求書送信済み',
        self::STATUS_UNDER_REVIEW      => '審査中',
        self::STATUS_REVIEW_IMPOSSIBLE => '審査結果_不可',
        self::STATUS_WAITING_PAYMENT   => '入金待ち',
        self::STATUS_PAYMENT_CONFIRMED => '入金確認済み',
        self::STATUS_CANCEL            => 'キャンセル',
        self::STATUS_PAYMENT_ERROR     => '決済NG',
        self::STATUS_PAYMENT_EXPIRED   => '入金期限切れ',
        self::STATUS_PROCESS_EXPIRED   => '手続き期限切れ',
        self::STATUS_COMPLETED => '完了',
    ];

    const LIST_STATUS_HEADER = [
        self::STATUS_DRAFT             => '登録中',
        self::STATUS_INVOICE_SENT      => '請求書送信済み',
        self::STATUS_UNDER_REVIEW      => '審査中',
        self::STATUS_REVIEW_IMPOSSIBLE => '審査結果_不可',
        self::STATUS_WAITING_PAYMENT   => '入金待ち',
        self::STATUS_PAYMENT_CONFIRMED => '入金処理済み',
        self::STATUS_CANCEL            => 'キャンセル',
        self::STATUS_PAYMENT_ERROR     => '決済NG',
        self::STATUS_PAYMENT_EXPIRED   => '入金期限切れ',
        self::STATUS_PROCESS_EXPIRED   => '手続き期限切れ',
        self::STATUS_COMPLETED => '完了',
    ];

    const TEXT_STATUS_COLORS = [
        self::STATUS_DRAFT             => 'text-dark',
        self::STATUS_INVOICE_SENT      => 'text-primary',
        self::STATUS_UNDER_REVIEW      => 'text-primary',
        self::STATUS_REVIEW_IMPOSSIBLE => 'text-danger',
        self::STATUS_WAITING_PAYMENT   => 'text-primary',
        self::STATUS_PAYMENT_CONFIRMED => 'text-success',
        self::STATUS_CANCEL            => 'text-danger',
        self::STATUS_PAYMENT_ERROR     => 'text-danger',
        self::STATUS_PAYMENT_EXPIRED   => 'text-danger',
        self::STATUS_PROCESS_EXPIRED   => 'text-danger',
        self::STATUS_COMPLETED         => 'text-success',
    ];

    const LIST_ANSWER = [
        '可',
        '否'
    ];

    public function getAll($params) {
        $query = self::select(['*']);

        if (isset($params['status']) && trim($params['status']) != '') {
            $query->where('status', $params['status']);
        }
        if (isset($params['keyword']) && trim($params['keyword']) != '') {
            $query->where('name', 'like', '%' . $params['keyword'] . '%');
            $query->orWhere('cris_no',$params['keyword']);
        }
        if (isset($params['id']) && trim($params['id']) != '') {
            $query->where('id', '>=', $params['id']);
        }
        if (isset($params['id_2']) && trim($params['id_2']) != '') {
            $query->where('id', '<=', $params['id_2']);
        }
        return $query->orderByDesc('id')
            ->paginate(config('const.page.limit'));
    }

    public function getStatusCounts()
    {
        $status =self::select([
            'status',
            DB::raw('count(id) as count')
        ])
            ->groupBy('status')
            ->get();
        return $status;
    }
}
