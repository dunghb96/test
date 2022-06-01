<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'user';

    protected $fillable = [
        'name',
        'email',
        'pass',
        'auth'
    ];

    const MANAGER_USER = 1;
    const NORMAL_USER = 2;

    const AUTH_LIST = [
        self::MANAGER_USER => '管理ユーザー',
        self::NORMAL_USER  => '通常ユーザー'
    ];

    public function getAll() {
        return self::select('*')->paginate(config('const.page.user_list'));
    }
}
