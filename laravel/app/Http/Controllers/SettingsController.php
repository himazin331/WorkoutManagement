<?php
//* '設定'コントローラ */
/*
 * Route:       
 *  Method:         GET|HEAD
 *  Name - Action:  settings.view  - App\Http\Controllers\SettingsController@settingsView
 *  Method:         GET|HEAD
 *  Name - Action:  bodyinfo.view  - App\Http\Controllers\SettingsController@bodyinfoView
 *  Method:         GET|HEAD
 *  Name - Action:  goal.view  - App\Http\Controllers\SettingsController@goalView
 *  Method:         GET|HEAD
 *  Name - Action:  account.view  - App\Http\Controllers\SettingsController@accountView
 *  Method:         POST
 *  Name - Action:  goal.upload  - App\Http\Controllers\SettingsController@goalUpload
 * Controller:      app\Http\Controllers\SettingsController.php
 * View:            resources\views\EWM\settings.blade.php
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request; // HTTPリクエストモジュール
use Illuminate\Support\Facades\Auth;     // 認証モジュール
use App\Models\records\TbUsersBodyinfo; // 身体情報テーブル操作モジュール
use App\Models\TbUsersGoals;    // 目標テーブル操作モジュール

class SettingsController extends Controller
{
    //* '設定'表示
    public function settingsView() {
        $user = Auth::user(); // ユーザ情報取得
        $age = floor((date("Ymd") - str_replace("-", "", $user['birthday'])) / 10000); // 年齢計算

        // 直近身体情報・目標取得
        $bodyinfo = TbUsersBodyinfo::getRecentBodyinfo($user['id']);
        $goal = TbUsersGoals::getRecentGoal($user['id']);

        return view('EWM.settings', compact('age', 'bodyinfo', 'goal'));
    }
    //* '身体情報'表示
    public function bodyinfoView(){
        return view('bodyinfo.view');
    }
    //* '目標'表示
    public function goalView(){
        return view('goal.view');
    }
    //* 'アカウント情報'表示
    public function accountView(){
        return view('account.view');
    }

    //* '目標'設定
    public function goalUpload(Request $request){
        // バリデーション
        $item = $request->validate([
            'weightg' => ['nullable', 'numeric', 'between:1,999.99', 'regex:/\A\d{1,3}(\.\d{1,2})?\z/'],
            'bmig' => ['nullable', 'numeric', 'between:1,999.99', 'regex:/\A\d{1,3}(\.\d{1,2})?\z/'],
            'bodyfatg' => ['nullable', 'numeric', 'between:1,999.99', 'regex:/\A\d{1,3}(\.\d{1,2})?\z/'],
            'muscleg' => ['nullable', 'numeric','between:1,999.99', 'regex:/\A\d{1,3}(\.\d{1,2})?\z/']
        ]);
        $user = Auth::user(); // ユーザ情報取得

        $data = [
            'user_id' => $user['id'],
            'weight' => $item['weightg'],
            'bmi' => $item['bmig'],
            'bodyfat' => $item['bodyfatg'],
            'muscle' => $item['muscleg'],
            'goal_flg' => False,
            'created_at' => date("Y/m/d H:i:s")
        ];
        $r = TbUsersGoals::insertGoal($user['id'], $data); // アップロード

        if ($r) {
            return redirect(route('goal.view'))->with('rmessage', "目標を設定しました。"); // 成功
        } else {
            return redirect(route('goal.view'))->with('rmessage', "問題が発生しました。"); // 失敗
        }
    }
}
