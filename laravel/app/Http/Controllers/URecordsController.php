<?php
//* '記録をつける'コントローラ */
/*
 * Route:       
 *  Method:         GET|HEAD
 *  Name - Action:  uploadrecords.view - App\Http\Controllers\URecordsController@uploadRecordsView
 *  Method:         GET|HEAD
 *  Name - Action:  ultrainingmenu.view - App\Http\Controllers\URecordsController@ulTrainingmenuView
 *  Method:         GET|HEAD
 *  Name - Action:  ulcalorie.view - App\Http\Controllers\EWMConURecordsControllertroller@ulCalorieView
 *  Method:         GET|HEAD
 *  Name - Action:  ulpicture.view - App\Http\Controllers\URecordsController@ulPictureView
 *  Method:         GET|HEAD
 *  Name - Action:  ulbodyinfo.view - App\Http\Controllers\URecordsController@ulBodyinfoView
 *  Method:         POST
 *  Name - Action:  records.upload - App\Http\Controllers\URecordsController@recordsUpload
 * Controller:      app\Http\Controllers\URecordsController.php
 * View:            resources\views\EWM\uploadRecords.blade.php
*/

// ! ----------------------------------------------------------------
// !                     要修正 lv.4 - uc001
// ! 更新日: 2021/09/17
// ! 概要: Amazon S3 PHP実装
// ! ----------------------------------------------------------------


namespace App\Http\Controllers;

use Illuminate\Http\Request; // HTTPリクエストモジュール
use Illuminate\Support\Facades\Auth; // 認証モジュール
use Illuminate\Support\Facades\Validator; // バリデーター

use App\Models\TbUsers; // ユーザテーブル操作モジュール
use App\Models\records\TbUsersTrainingmenu; // トレーニングメニュー記録テーブル操作モジュール
use App\Models\records\TbUsersCalorie; // 摂取カロリー記録テーブル操作モジュール
use App\Models\records\TbUsersPicture; // 画像記録テーブル操作モジュール
use App\Models\records\TbUsersBodyinfo; // 身体情報テーブル操作モジュール
use App\Models\TbUsersGoals; // 目標テーブル操作モジュール


class URecordsController extends Controller
{
    //* '記録をつける(スタンダード)'表示
    public function uploadRecordsView() {
        return view('EWM.uploadRecords');
    }

    //* '記録をつける(トレーニングメニュー記録)'表示
    public function ulTrainingmenuView(){
        return view('EWM.uploadRecords');
    }

    //* '記録をつける(摂取カロリー記録)'表示
    public function ulCalorieView(){
        return view('EWM.uploadRecords');
    }

    //* '記録をつける(画像記録)'表示
    public function ulPictureView(){
        return view('EWM.uploadRecords');
    }

    //* '記録をつける(身体情報記録)'表示
    public function ulBodyinfoView(){
        return view('EWM.uploadRecords');
    }

    // ! ----------------------------------------------------------------
    // !                      要修正 lv.4 - uc081
    // ! 更新日: 2021/09/16
    // ! 概要: 摂取カロリー記録 required
    // ! メモ: DB側はNOT NULL
    // ! ----------------------------------------------------------------
    // ! ----------------------------------------------------------------
    // !                      要修正 lv.4 - uc082
    // ! 更新日: 2021/09/16
    // ! 概要: 摂取カロリー記録 栄養成分量初期化
    // ! メモ: 各栄養成分量 = 0.00(入力フォーム未入力時の対応)
    // ! ----------------------------------------------------------------
    // ! ----------------------------------------------------------------
    // !                      要修正 lv.4 - uc108
    // ! 更新日: 2021/09/16
    // ! 概要: old()動作異常
    // ! メモ: 異常入力値検出後の返却で摂取カロリーの入力値が身体情報の
    // ! 　　　入力フォームに入ってしまう
    // ! ----------------------------------------------------------------


    //* 記録
    public function recordsUpload(Request $request) {
        $user = Auth::user(); // ユーザ情報取得

        /* $session_rules = [];
        $session_validator = Validator::make(json_decode($request->input('inputfield'), true), $session_rules); // バリデーション
        if ($session_validator->fails()) { // セッションデータ改ざん発覚
            return back()->withInput()->withErrors($session_validator);
        }
        $session_data = $session_validator->validated();
        session()->put('str', 'Hello world'); */

        //* バリデーション
        // バリデーションルール
        $rules = [
            // 記録日
            'record_date' => ['required', 'date', 'before_or_equal:'.date('Y/m/d'), 'after_or_equal:'.str_replace("-", "/", $user['birthday'])],
            // トレーニングメニュー記録
            'trdata.tm_add_preset' => ['nullable', 'in:true'],
            'trdata.tm_preset_name' => ['required_if:trdata.tm_add_preset,true', 'nullable', 'string'],
            'trdata.tm_item_name_h.*' => ['nullable', 'string'],
            'trdata.tm_item_name.*' => ['nullable', 'string'],
            // 摂取カロリー記録
            'cldata.cl_item_name1.*' => ['nullable', 'string'],
            'cldata.cl_item_name2.*' => ['nullable', 'numeric', 'min:0', 'regex:/\A\d+(\.\d{1,2})?\z/'],
            // 画像記録
            'pidata.upload_file.*' => ['nullable', 'string', 'regex:/https:\/\/ewms3\.s3\.amazonaws\.com\/[a-zA-Zぁ-んァ-ヶ一-龠々0-9０-９!~\'\(\)\._%-]+\.(jpeg|jpg|png)$/'],
            // 身体情報記録
            'bidata.stature' => ['nullable', 'numeric', 'between:1,999.99', 'regex:/\A\d{1,3}(\.\d{1,2})?\z/'],
            'bidata.weight' => ['nullable', 'numeric', 'between:1,999.99', 'regex:/\A\d{1,3}(\.\d{1,2})?\z/'],
            'bidata.bodyfat' => ['nullable', 'numeric', 'between:1,999.99', 'regex:/\A\d{1,3}(\.\d{1,2})?\z/'],
            'bidata.muscle' => ['nullable', 'numeric','between:1,999.99', 'regex:/\A\d{1,3}(\.\d{1,2})?\z/']
        ];
        $validator = Validator::make(json_decode($request->input('recorddata'), true), $rules); // バリデーション
        if ($validator->fails()) { // 入力値異常
            return back()->withInput()->withErrors($validator);
        }
        $items = $validator->validated();

        //* トレーニングメニュー記録
        if (!empty($items['trdata']['tm_preset_name']))
        {
            $r = $this->trainingmenuFunc($user['id'], $items['record_date'], $items['trdata']);
            if (!$r) { // 失敗
                return redirect(route('ultrainingmenu.view'))->with('rmessage', "問題が発生しました。"); // 失敗
            } 
        }

        //* 摂取カロリー記録
        if (!empty($items['cldata']['cl_item_name1']['cl_item_name1_1']))
        {
            $r = $this->calorieFunc($user['id'], $items['record_date'], $items['cldata']);
            if (!$r) {
                return redirect(route('ulcalorie.view'))->with('rmessage', "問題が発生しました。"); // 失敗
            }
        }

        //* 画像記録
        if (!empty($items['pidata']['upload_file']))
        {
            $r = $this->pictureFunc($user['id'], $items['record_date'], $items['pidata']);
            if (!$r) {
                return redirect(route('ulpicture.view'))->with('rmessage', "問題が発生しました。"); // 失敗
            }
        }
        

        //* 身体情報記録
        if (!(empty($items['bidata']['stature']) && empty($items['bidata']['weight']) &&
                empty($items['bidata']['bodyfat']) && empty($items['bidata']['muscle'])))
        {
            $r = $this->bodyinfoFunc($user, $items['record_date'], $items['bidata']);
            if (!$r) {
                return redirect(route('ulbodyinfo.view'))->with('rmessage', "問題が発生しました。"); // 失敗
            }
        }

        //* ユーザ情報更新
        $r = TbUsersBodyinfo::getRecentBodyinfo($user['id']);
        $data = [
            'age' => $r->age,
            'stature' => $r->stature,
            'weight' => $r->weight,
            'updated_at' => date("Y/m/d H:i:s")
        ];
        $r = TbUsers::updateUser($user['id'], $data); // ユーザ情報更新
        if ($r === 0) {
            return redirect(route('uploadrecords.view'))->with('rmessage', "問題が発生しました。"); // 失敗
        }

        return redirect(route('uploadrecords.view'))->with('rmessage', "記録しました。");
    }

    //* トレーニングメニュー記録
    public function trainingmenuFunc($user_id, $record_date, $items) {
        // プリセット登録
        if ($items['tm_add_preset']) {
            $defalut_preset = TbUsersTrainingmenu::getDefaultPreset($user_id); // デフォルトプリセットID
            if ($defalut_preset !== null) // 存在するのであれば、更新
            {
                $update_data = ['default_flg' => False, 'updated_at' => date("Y/m/d H:i:s")];
                $r = TbUsersTrainingmenu::updatePreset($user_id, $defalut_preset->id, $update_data);
                if ($r === 0) { // 失敗
                    return false;
                }
            }

            $preset_data = [
                'user_id' => $user_id,
                'preset_name' => $items['tm_preset_name'],
                'header1' => $items['tm_item_name_h']['tm_item_name_h1'],
                'header2' => $items['tm_item_name_h']['tm_item_name_h2'],
                'header3' => $items['tm_item_name_h']['tm_item_name_h3'],
                'header4' => $items['tm_item_name_h']['tm_item_name_h4'],
                'header5' => $items['tm_item_name_h']['tm_item_name_h5'],
                'default_flg' => True,
                'created_at' => date("Y/m/d H:i:s")
            ];

            $r = TbUsersTrainingmenu::insertPreset($user_id, $preset_data); // 登録
            if (!$r) { // 失敗
                return false;
            }
        }

        // トレーニングメニュー記録
        $defalut_preset = TbUsersTrainingmenu::getDefaultPreset($user_id); // デフォルトプリセットID
        // 各入力フィールド記録
        for($i = 1; $i < count($items['tm_item_name'])/5+1; $i++)
        {
            $data = [
                'user_id' => $user_id,
                'preset_id' => $defalut_preset->id,
                'item1' => $items['tm_item_name']['tm_item_name'.$i.'_1'],
                'item2' => $items['tm_item_name']['tm_item_name'.$i.'_2'],
                'item3' => $items['tm_item_name']['tm_item_name'.$i.'_3'],
                'item4' => $items['tm_item_name']['tm_item_name'.$i.'_4'],
                'item5' => $items['tm_item_name']['tm_item_name'.$i.'_5'],
                'record_date' => $record_date,
                'created_at' => date("Y/m/d H:i:s")
            ];
            $r = TbUsersTrainingmenu::insertTrainingmenu($user_id, $data); // 記録
            if (!$r) { // 失敗
                return false;
            }
        }
        
        return true; // 成功
    }

    //* 摂取カロリー記録
    public function calorieFunc($user_id, $record_date, $items) {
        // 摂取カロリー記録
        // 各入力フィールド記録
        for($i = 1; $i < (count($items['cl_item_name1'])+count($items['cl_item_name2']))/7+1; $i++)
        {
            $data = [
                'user_id' => $user_id,
                'foodname' => $items['cl_item_name1']['cl_item_name'.$i.'_1'],
                'energy' => $items['cl_item_name2']['cl_item_name'.$i.'_2'],
                'protein' => $items['cl_item_name2']['cl_item_name'.$i.'_3'],
                'fat' => $items['cl_item_name2']['cl_item_name'.$i.'_4'],
                'carbohydrates' => $items['cl_item_name2']['cl_item_name'.$i.'_5'],
                'sugar' => $items['cl_item_name2']['cl_item_name'.$i.'_6'],
                'free' => $items['cl_item_name1']['cl_item_name'.$i.'_7'],
                'record_date' => $record_date,
                'created_at' => date("Y/m/d H:i:s")
            ];
            $r = TbUsersCalorie::insertCalorie($user_id, $data); // 記録
            if (!$r) { // 失敗
                return false;
            }
        }
        
        return true; // 成功
    }

    //* 画像データ記録
    public function pictureFunc($user_id, $record_date, $items) {
        for($i = 1; $i < count($items['upload_file'])+1; $i++)
        {
            $data = [
                'user_id' => $user_id,
                'data' => $items['upload_file']['image_'.$i],
                'record_date' => $record_date,
                'created_at' => date("Y/m/d H:i:s")
            ];
            $r = TbUsersPicture::insertPicture($user_id, $data); // 記録
            if (!$r) { // 失敗
                return false;
            }
        }

        return true;
    }

    //* 身体情報データ記録
    public function bodyinfoFunc($user, $record_date, $items) {
        $recent_bodyinfo = TbUsersBodyinfo::getRecentBodyinfo($user['id']); // 直近身体情報

        // 身長
        if ($items['stature'] === "") { // 身長未入力 -> 直近情報
            $stature = $user['stature'];
        } else {
            $stature = $items['stature'];
        } 
        // 体重
        if ($items['weight'] === "") { // 身長未入力 -> 直近情報
            $weight = $recent_bodyinfo->weight;
        } else {
            $weight = $items['weight'];
        }
        // 体脂肪
        if ($items['bodyfat'] === "") {
            $bodyfat = $recent_bodyinfo->bodyfat; // 体脂肪未入力 -> 直近情報
        } else {
            $bodyfat = $items['bodyfat'];
        }
        // 筋肉量
        if ($items['muscle'] === "") {
            $muscle = $recent_bodyinfo->muscle; // 筋肉量未入力 -> 直近情報
        } else {
            $muscle = $items['muscle'];
        }
        
        // BMI計算
        $bmi = floatval($weight) / ((floatval($stature)/100) * (floatval($stature)/100));
        $bmi = ($bmi > 999.99) ? 999.99:$bmi; // 有効数値排出
        // 年齢算出
        $age = floor((date("Ymd") - str_replace("-", "", $user['birthday'])) / 10000);

        $recent_goal = TbUsersGoals::getNotAchievedRecentGoal($user['id']); // 直近に設定された目標
        if (!empty($recent_goal)) // 未達成目標が存在すれば
        {
            $diff_w = null;
            $diff_b = null;
            $diff_bf = null;
            $diff_m = null;
            $per_w = null;
            $per_b = null;
            $per_bf = null;
            $per_m = null;

            // ! ----------------------------------------------------------------
            // !                      要修正 lv.4 - urcp305
            // ! 更新日: 2021/09/16
            // ! 概要: 目標差分の計算がおかしい。
            // ! ----------------------------------------------------------------

            // 基準身体情報(設定された目標が初めて適用された身体情報)
            $std_bodyinfo = TBUsersBodyinfo::getStdBodyInfo($user['id'], $recent_goal->id);

            // 目標との差分算出
            // 体重
            if (!empty($std_bodyinfo->weight)&&!empty($recent_goal->weight))
            {
                $diff_w = $recent_goal->weight - $weight;
                $init_w = ($recent_goal->weight - $std_bodyinfo->weight)*0.01;
                $per_w = 100 - (($recent_goal->weight - $weight) / $init_w);
            }
            // BMI
            if (!empty($std_bodyinfo->bmi)&&!empty($recent_goal->bmi))
            {
                $diff_b = $recent_goal->bmi - $bmi;
                $init_b = ($recent_goal->bmi - $std_bodyinfo->bmi)*0.01;
                $per_b = 100 - (($recent_goal->bmi - $bmi) / $init_b);
            }
            // 体脂肪率
            if (!empty($std_bodyinfo->bodyfat)&&!empty($recent_goal->bodyfat))
            {
                $diff_bf = $recent_goal->bodyfat - $bodyfat;
                $init_bf = ($recent_goal->bodyfat - $std_bodyinfo->bodyfat)*0.01;
                $per_bf = 100 - (($recent_goal->bodyfat - $bodyfat) / $init_bf);
            }
            // 筋肉量
            if (!empty($std_bodyinfo->muscle)&&!empty($recent_goal->muscle))
            {
                $diff_m = $recent_goal->muscle - $muscle;
                $init_m = ($recent_goal->muscle - $std_bodyinfo->muscle)*0.01;
                $per_m = 100 - (($recent_goal->muscle - $muscle) / $init_m);
            }

            // 設定した項目全ての目標を達成 -> 目標テーブル更新
            if ((($per_w > 95 && $per_w < 105) || $per_w === null) && (($per_b > 95 && $per_b < 105) || $per_b === null) &&
                    (($per_bf > 95 && $per_bf < 105) || $per_bf === null) && (($per_m > 95 && $per_m < 105) || $per_m === null))
            {
                // goal_flg更新
                $r = TbUsersGoals::updateGoal($user['id'], ['goal_flg' => True, 'updated_at' => date("Y/m/d H:i:s")]);
                if ($r === 0){
                    return false; // 失敗
                }
            }

            $data = [
                'user_id' => $user['id'],
                'goals_id' => $recent_goal->id,
                'age' => $age,
                'stature' => $stature,
                'weight' => $weight,
                'weight_diff' => $diff_w,
                'weight_per' => $per_w,
                'bmi' => $bmi,
                'bmi_diff' => $diff_b,
                'bmi_per' => $per_b,
                'bodyfat' => $bodyfat,
                'bodyfat_diff' => $diff_bf,
                'bodyfat_per' => $per_bf,
                'muscle' => $muscle,
                'muscle_diff' => $diff_m,
                'muscle_per' => $per_m,
                'created_at' => date("Y/m/d H:i:s")
            ];
        } else {
            $data = [
                'user_id' => $user['id'],
                'age' => $age,
                'stature' => $stature,
                'weight' => $weight,
                'bmi' => $bmi,
                'bodyfat' => $bodyfat,
                'muscle' => $muscle,
                'created_at' => date("Y/m/d H:i:s")
            ];
        }

        $r = TbUsersBodyinfo::insertBodyinfo($user['id'], $data); // 身体情報アップロード
        if (!$r) {
            return false; // 失敗
        }

        return true;
    }
}
