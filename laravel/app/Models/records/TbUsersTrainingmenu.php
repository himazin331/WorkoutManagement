<?php
//* トレーニングメニュー記録テーブル操作モジュール */

namespace App\Models\records;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TbUsersTrainingmenu extends Model
{
    //* トレーニングメニュー

    //* トレーニングメニュー(直近)取得
    public static function getRecentTrainingmenu($user_id){
        $table = "tb_user".sprintf("%05d", $user_id)."_trainingmenu";
        
        $r = DB::table($table)->where('record_date', function ($query) use ($table) {
                                        $query->select('record_date')
                                            ->from($table)
                                            ->orderByDesc('record_date')
                                            ->limit(1);
                                        })->get();
        return $r;
    }

    //* トレーニングメニュー(取得数選択)取得
    public static function getNumTrainingmenu($user_id, $sort, $num){
        $table = "tb_user".sprintf("%05d", $user_id)."_trainingmenu";
        
        $r = DB::table($table)->orderBy('id', $sort)->limit($num)->get();
        return $r;
    }

    //* トレーニングメニュー(全て)取得
    public static function getAllTrainingmenu($user_id){
        $table = "tb_user".sprintf("%05d", $user_id)."_trainingmenu";
        
        $r = DB::table($table)->get();
        return $r;
    }

    //* トレーニングメニュー記録
    public static function insertTrainingmenu($user_id, $data){
        $table = "tb_user".sprintf("%05d", $user_id)."_trainingmenu";

        $r = DB::table($table)->insert($data);
        return $r;
    }

    //* プリセット

    //* プリセット(デフォルト)取得
    public static function getDefaultPreset($user_id){
        $table = "tb_user".sprintf("%05d", $user_id)."_trpreset";
        
        $r = DB::table($table)->where('default_flg', true)->first();
        return $r;
    }

    //* プリセット(指定)取得
    public static function getNumPreset($user_id, $id){
        $table = "tb_user".sprintf("%05d", $user_id)."_trpreset";
        
        $r = DB::table($table)->where('id', $id)->first();
        return $r;
    }

    //* プリセット(全て)取得
    public static function getAllPreset($user_id){
        $table = "tb_user".sprintf("%05d", $user_id)."_trpreset";

        $r = DB::table($table)->get();
        return $r;
    }

    //* プリセット登録
    public static function insertPreset($user_id, $data){
        $table = "tb_user".sprintf("%05d", $user_id)."_trpreset";

        $r = DB::table($table)->insert($data);
        return $r;
    }

    //* プリセット更新(default_flg, updated_at)
    public static function updatePreset($user_id, $id, $data){
        $table = "tb_user".sprintf("%05d", $user_id)."_trpreset";

        $r = DB::table($table)->where('id', $id)
                    ->update($data);
        return $r;
    }
}