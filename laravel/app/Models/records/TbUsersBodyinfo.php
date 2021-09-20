<?php
//* 身体情報テーブル操作モジュール */

namespace App\Models\records;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TbUsersBodyinfo extends Model
{
    //* 身体情報(直近)取得
    public static function getRecentBodyinfo($user_id){
        $table = "tb_user".sprintf("%05d", $user_id)."_bodyinfo";
        
        $r = DB::table($table)->orderByDesc('created_at')->first();
        return $r;
    }

    //* 身体情報(取得数選択)取得
    public static function getNumBodyinfo($user_id, $sort, $num){
        $table = "tb_user".sprintf("%05d", $user_id)."_bodyinfo";
        
        $r = DB::table($table)->orderByDesc('created_at')->limit($num)->get();
        return $r;
    }

    //* 身体情報(全て)取得
    public static function getAllBodyinfo($user_id){
        $table = "tb_user".sprintf("%05d", $user_id)."_bodyinfo";
        
        $r = DB::table($table)->get();
        return $r;
    }

    //* 身体情報(目標スタート)取得
    public static function getStdBodyinfo($user_id, $goal_id){
        $table = "tb_user".sprintf("%05d", $user_id)."_bodyinfo";
        
        $r = DB::table($table)->where('goals_id', $goal_id)->orderByDesc('created_at')->first();
        return $r;
    }

    //* 身体情報記録
    public static function insertBodyinfo($user_id, $data){
        $table = "tb_user".sprintf("%05d", $user_id)."_bodyinfo";

        $r = DB::table($table)->insert($data);
        return $r;
    }

    //* 身体情報更新(*_diff, *_per, updated_at)
    public static function updateBodyinfo($user_id, $data){
        $table = "tb_user".sprintf("%05d", $user_id)."_bodyinfo";

        $r = DB::table($table)->update($data);
        return $r;
    }
}
