<?php
//* アカウント登録コントローラ */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; // バリデーター

use Illuminate\Support\Facades\DB; // データベース操作

use App\Models\User; // ユーザテーブルモジュール
use App\Models\records\TbUsersBodyinfo; // 身体情報テーブルモジュール
use App\Models\CreateTbUser;

class RegisterController extends Controller
{
    use RegistersUsers;

    //* 登録後リダイレクト先
    protected $redirectTo = RouteServiceProvider::HOME;

    //* アクセス時 認証不要
    public function __construct()
    {
        $this->middleware('guest');
    }

    //* バリデーションチェック
    protected function validator(array $data)
    {
        $today = date("Y/m/d"); // 今日の日付
        $under_day = date("Y/m/d", strtotime('-120 year')); // 今日から120年前の日付

        return Validator::make($data, [
            // ユーザID (入力必須、文字列、20文字以内、英数字のみ、ユニーク)
            'name' => ['required', 'string', 'max:20', 'regex:/^[a-zA-Z0-9]+$/', 'unique:users'],
            // 性別 (入力必須、male|femaleのみ)
            'gender' => ['required', 'in:male,female'],
            // 生年月日 (入力必須、date型、120年前～今日までの日付)
            'birthday' => ['required', 'date', 'before_or_equal:'.$today, 'after_or_equal:'.$under_day],
            // 身長
            'stature' => ['required', 'numeric', 'between:1,999.99', 'regex:/\A\d{1,3}(\.\d{1,2})?\z/'],
            // 体重
            'weight' => ['required', 'numeric', 'between:1,999.99', 'regex:/\A\d{1,3}(\.\d{1,2})?\z/'],
            // メールアドレス (入力必須、文字列、メアド形式、255文字以内、ユニーク)
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // パスワード (入力必須、文字列、8文字以上)
            'password' => ['required', 'string', 'min:8'],
            // パスワード(確認) (入力必須、文字列、passwordと同じ値)
            'password_confirmation' => ['required', 'string', 'same:password']
        ]);
    }

    //* ユーザ情報登録
    protected function create(array $data)
    {
        // ユーザ登録
        $r = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'birthday' => $data['birthday'],
            'age' => floor((date("Ymd") - str_replace("-", "", $data['birthday'])) / 10000),
            'stature' => $data['stature'],
            'weight' => $data['weight'],
            'password' => Hash::make($data['password']),
            'created_at' => date("Y/m/d H:i:s")
        ]);
        $user = DB::table('users')->orderBy('id', 'desc')->first(); // ユーザ情報取得

        CreateTbUser::createTrainingTb($user->id); // 各テーブル作成

        $stature = $user->stature; // 身長
        $weight = $user->weight; // 体重
        // BMI計算
        $bmi = floatval($weight) / ((floatval($stature)/100) * (floatval($stature)/100));
        $bmi = ($bmi > 999.99) ? 999.99:$bmi; // 有効数値排出

        $data = [
            'user_id' => $user->id,
            'age' => floor((date("Ymd") - str_replace("-", "", $user->birthday)) / 10000),
            'stature' => $stature,
            'weight' => $weight,
            'bmi' => $bmi,
            'created_at' => date("Y/m/d H:i:s")
        ];
        TbUsersBodyinfo::insertBodyinfo($user->id, $data); // 身体情報挿入

        return $r;
    }
}
