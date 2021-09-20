<?php
//* ユーザテーブル操作モジュール */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TBUsers extends Model
{
    //* ユーザ更新
    public static function updateUser($user_id, $data){
        $r = DB::table('users')->where('id', $user_id)->update($data);
        return $r;
    }
}