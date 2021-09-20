<?php
//* 目標テーブル操作モジュール */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TbUsersGoals extends Model
{
    //* 目標(直近, 不問)取得
    public static function getRecentGoal($user_id){
        $table = "tb_user".sprintf("%05d", $user_id)."_goals";
        
        $r = DB::table($table)->orderBy('id', 'desc')->first();
        return $r;
    }

    //* 目標(直近, 未達成)取得
    public static function getNotAchievedRecentGoal($user_id){
        $table = "tb_user".sprintf("%05d", $user_id)."_goals";

        $r = DB::table($table)->where('goal_flg', False)->orderBy('id', 'desc')->first();
        return $r;
    }

    //* 目標(取得数選択)取得
    public static function getNumGoals($user_id, $sort, $num){
        $table = "tb_user".sprintf("%05d", $user_id)."_goals";
        
        $r = DB::table($table)->orderBy('id', $sort)->limit($num)->get();
        return $r;
    }

    //* 目標(全て)取得
    public static function getAllGoals($user_id){
        $table = "tb_user".sprintf("%05d", $user_id)."_goals";
        
        $r = DB::table($table)->get();
        return $r;
    }

    //* 目標新規登録
    public static function insertGoal($user_id, $data){
        $table = "tb_user".sprintf("%05d", $user_id)."_goals";

        $r = DB::table($table)->insert($data);
        return $r;
    }

    //* 目標更新(goal_flag, updated_at)
    public static function updateGoal($user_id, $data){
        $table = "tb_user".sprintf("%05d", $user_id)."_goals";

        $r = DB::table($table)->update($data);
        return $r;
    }
}
