<?php
//* カレンダー作成 */

namespace App\Libraries;

class Calendar
{
    // カレンダー作成
    public function create() {
        date_default_timezone_set("Asia/Tokyo");

        // 現在の年月取得
        $year = date("Y");
        $month = date("n");
        // 月末日取得
        $last_day = date("j", mktime(0, 0, 0, $month + 1, 0, $year));
        
        $calendar = array();
        $j = 0;
        
        // 月末日までループ
        for ($i = 1; $i < $last_day + 1; $i++) {
            // 曜日取得
            $week = date("w", mktime(0, 0, 0, $month, $i, $year));

            // 1日の場合
            if ($i == 1) {
                // 1日目の曜日までをループ
                for ($s = 1; $s <= $week; $s++) {
                    // 前半に空文字をセット
                    $calendar[$j]['day'] = '';
                    $j++;
                }
            }
        
            // 配列に日付をセット
            $calendar[$j]['day'] = $i;
            $j++;
        
            // 月末日の場合
            if ($i == $last_day) {
                // 月末日から残りをループ
                for ($e = 1; $e <= 6 - $week; $e++) {
                    // 後半に空文字をセット
                    $calendar[$j]['day'] = '';
                    $j++;
                }
            }
        }

        $r = array($year, $month, $calendar);
        return $r;
    }
}
