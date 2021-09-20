<?php
//* '記録をみる'コントローラ */
/*
 * Route:       
 *  Method:         GET|HEAD
 *  Name - Action:  viewrecords.view - App\Http\Controllers\VRecordsController@viewRecordsView
 * Controller:      app\Http\Controllers\VRecordsController.php
 * View:            resources\views\EWM\viewRecords.blade.php
*/


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\records\TbUsersTrainingmenu; // トレーニングメニュー記録テーブル操作モジュール
use App\Models\records\TbUsersCalorie; // 摂取カロリー記録テーブル操作モジュール
use App\Models\records\TbUsersPicture;  // 画像記録テーブル操作モジュール
use App\Models\records\TbUsersBodyinfo; // 身体情報テーブル操作モジュール

class VRecordsController extends Controller
{
    // '記録をみる'ページ表示
    public function viewRecordsView() {
        $user = Auth::user(); // ユーザ情報取得

        $trainingmenu = TbUsersTrainingmenu::getRecentTrainingmenu($user['id']); // トレーニングメニュー記録(直近)
        $trpreset = TbUsersTrainingmenu::getNumPreset($user['id'], $trainingmenu[0]->preset_id); // プリセット
        $calorie = TbUsersCalorie::getRecentCalorie($user['id']);  // 摂取カロリー記録(直近)
        $bodyinfo = TbUsersBodyinfo::getRecentBodyinfo($user['id']);// 身体情報

        return view('EWM.viewRecords', compact('trainingmenu', 'trpreset', 'calorie'));
    }

    public function recordsGet() {
        
    }
}
