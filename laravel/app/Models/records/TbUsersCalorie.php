<?php
//* 摂取カロリー記録テーブル操作モジュール */

namespace App\Models\records;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TbUsersCalorie extends Model
{
    //* 摂取カロリー(直近)取得
    public static function getRecentCalorie($user_id){
        $table = "tb_user".sprintf("%05d", $user_id)."_calorie";
        
        $r = DB::table($table)->where('record_date', function ($query) use ($table) {
                                        $query->select('record_date')
                                            ->from($table)
                                            ->orderByDesc('record_date')
                                            ->limit(1);
                                        })->get();
        return $r;
    }

    //* 摂取カロリー(取得数選択)取得
    public static function getNumCalorie($user_id, $num){
        $table = "tb_user".sprintf("%05d", $user_id)."_calorie";

        return $r;
    }

    //* 摂取カロリー(全て)取得
    public static function getAllCalorie($user_id){
        $table = "tb_user".sprintf("%05d", $user_id)."_calorie";
        

        return $r;
    }

    //* 摂取カロリー記録
    public static function insertCalorie($user_id, $data){
        $table = "tb_user".sprintf("%05d", $user_id)."_calorie";

        $r = DB::table($table)->insert($data);
        return $r;
    }
}
