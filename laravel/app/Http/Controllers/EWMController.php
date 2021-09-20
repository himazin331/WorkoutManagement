<?php
//* 'ダッシュボード'コントローラ */
/*
 * Route:       
 *  Method:         GET|HEAD
 *  Name - Action:  index - App\Http\Controllers\EWMController@index
 * Controller:      app\Http\Controllers\EWMController.php
 * View:            resources\views\layouts\index.blade.php
*/

namespace App\Http\Controllers;

use App\Libraries\Calendar;             // カレンダー作成モジュール
use Illuminate\Support\Facades\Auth;    // 認証モジュール
use App\Models\records\TbUsersBodyinfo; // 身体情報テーブル操作モジュール
use App\Models\TbUsersGoals;            // 目標テーブル操作モジュール

class EWMController extends Controller
{
    //* 'ダッシュボード'表示
    public function index() {
        // カレンダー作成
        $cl = new Calendar();
        $r = $cl->create();
        $year = $r[0];
        $month = $r[1];
        $calendar = $r[2];

        $user = Auth::user(); // ユーザ情報取得
        // 身体情報＆目標表示
        if ($user) { // ログイン済み
            $bodyinfo = TbUsersBodyinfo::getRecentBodyinfo($user['id']);// 身体情報
            $goal = TbUsersGoals::getRecentGoal($user['id']); // 目標

            if (empty($goal)) { // 目標未設定
                $goal_diff = "";
            } else { // 目標設定済み
                $goal_diff = array(
                    'weight_diff' => $bodyinfo->weight_diff,
                    'weight_per' => $bodyinfo->weight_per,
                    'bmi_diff' => $bodyinfo->bmi_diff,
                    'bmi_per' => $bodyinfo->bmi_per,
                    'bodyfat_diff' => $bodyinfo->bodyfat_diff,
                    'bodyfat_per' => $bodyinfo->bodyfat_per,
                    'muscle_diff' => $bodyinfo->muscle_diff,
                    'muscle_per' => $bodyinfo->muscle_per
                ); 
            }
        } else { // 未ログイン時
            $bodyinfo = "<a class='btn btn-secondary text-white' href='".route('login')."'>ログイン</a>";
            $goal = "<a class='btn btn-secondary text-white' href='".route('login')."'>ログイン</a>";
            $goal_diff = "<a class='btn btn-secondary text-white' href='".route('login')."'>ログイン</a>";
        }

        return view('EWM.index', compact('year', 'month', 'calendar', 'bodyinfo', 'goal', 'goal_diff'));
    }
}
