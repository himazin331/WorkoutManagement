<?php
//* 画像記録テーブル操作モジュール */

namespace App\Models\records;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TbUsersPicture extends Model
{
    // TODO ----------------------------------------------------------------
    // TODO                         未実装 lv.3 - tupp017
    // TODO 更新日: 2021/09/16
    // TODO 概要: n日数分取得(1件ではない)
    // TODO ----------------------------------------------------------------

    //* 画像(直近)取得
    public static function getRecentPicture($user_id){
        $table = 'tb_user'.sprintf('%05d', $user_id).'_picture';
        
        $r = DB::table($table)->where('record_date', function ($query) use ($table) {
            $query->select('record_date')
                ->from($table)
                ->orderByDesc('record_date')
                ->limit(1);
            })->get();
        return $r;
    }
    /*
    //* 画像(取得数選択)取得
    public static function getNumPicture($user_id, $num){
        $table = 'tb_user'.sprintf('%05d', $user_id).'_picture';

        return $r;
    }

    //* 画像(全て)取得
    public static function getAllPicture($user_id){
        $table = 'tb_user'.sprintf('%05d', $user_id).'_picture';
        

        return $r;
    }
 */
    //* 画像登録
    public static function insertPicture($user_id, $data){
        $table = 'tb_user'.sprintf('%05d', $user_id).'_picture';

        $r = DB::table($table)->insert($data);
        return $r;
    }
}
