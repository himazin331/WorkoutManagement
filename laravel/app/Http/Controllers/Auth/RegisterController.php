<?php
//* アカウント登録コントローラ */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /* 登録後リダイレクト先 /index.php */
    protected $redirectTo = RouteServiceProvider::HOME;

    /* アクセス時 認証不要 */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /* バリデーションチェック */
    protected function validator(array $data)
    {
        $today = date("Y/m/d"); // 今日の日付
        $under_day = date("Y/m/d", strtotime("-120 year")); // 今日から120年前の日付

        return Validator::make($data, [
            // ユーザID (入力必須、文字列、20文字以内、英数字のみ、ユニーク)
            'name' => ['required', 'string', 'max:20', 'regex:/^[a-zA-Z0-9]+$/', 'unique:users'],
            // 性別 (入力必須、male|femaleのみ)
            'gender' => ['required', 'in:male,female'],
            // 生年月日 (入力必須、date型、120年前～今日までの日付)
            'birthday' => ['required', 'date', 'before_or_equal:'.$today, 'after_or_equal:'.$under_day],
            // メールアドレス (入力必須、文字列、メアド形式、255文字以内、ユニーク)
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // パスワード (入力必須、文字列、8文字以上)
            'password' => ['required', 'string', 'min:8'],
            // パスワード(確認) (入力必須、文字列、passwordと同じ値)
            'password_confirmation' => ['required', 'string', 'same:password']
        ]);
    }

    /**
     * データベース登録処理
     *
     * @param  array  $data
     * @return to \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'birthday' => $data['birthday'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
