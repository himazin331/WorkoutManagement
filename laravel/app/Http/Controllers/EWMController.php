<?php
//* Webアプリコントローラ */

namespace App\Http\Controllers;

use App\Libraries\Calendar;
use resources\views\auth\passwords;

class EWMController
{
    // ダッシュボード
    public function index() {
        // カレンダー作成
        $cl = new Calendar();
        $r = $cl->create();
        $year = $r[0];
        $month = $r[1];
        $calendar = $r[2];

        return view('EWM.index', compact('year','month','calendar'));
    }

    // 記録をつける
    public function trainingRecords() {
        return view('EWM.trainingRecords');
    }

    // 記録を見る
    public function viewRecords() {
        return view('EWM.viewRecords');
    }

    // 設定
    public function Settings() {
        return view('EWM.Settings');
    }

}
