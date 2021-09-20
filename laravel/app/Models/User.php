<?php
//* ユーザ認証モジュール */

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // 操作許可カラム
    protected $fillable = [
        'name',
        'gender',
        'birthday',
        'age',
        'stature',
        'weight',
        'email',
        'password',
    ];

    // データ取得しないカラム
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 型変換するカラム
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
