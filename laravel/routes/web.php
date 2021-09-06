<?php
//* ルーティング設定 */

use Illuminate\Support\Facades\Route;

// ダッシュボード
Route::get('/', 'App\Http\Controllers\EWMController@index');
// 記録をつける
Route::get('/trainingRecords.php', 'App\Http\Controllers\EWMController@trainingRecords')->middleware('auth');
// 記録を見る
Route::get('/viewRecords.php', 'App\Http\Controllers\EWMController@viewRecords')->middleware('auth');
// 設定
Route::get('/Settings.php', 'App\Http\Controllers\EWMController@Settings')->middleware('auth');

// ログイン認証
Auth::routes();


/* ルーティング
    [GET] / -> /index.php - ダッシュボード
    [GET:guest] /trainingRecords.php -> /login - ログインページ
    [GET:auth] /trainingRecords.php - 記録をつける
    [GET:guest] /viewRecords.php -> /login - ログインページ
    [GET:auth] /viewRecords.php - 記録を見る
    [GET:guest] /Settings.php - -> /login - ログインページ
    [GET:auth] /Settings.php - 設定
    [GET:guest] /login - ログインページ
    [GET:auth] /login -> /index.php - ダッシュボード
    [GET:guest] /register - アカウント登録
    [GET:auth] /register -> /index.php - ダッシュボード
    [GET:guest] /password/confirm -> /login - ログインページ
    [GET:auth] /password/confirm - パスワード確認画面
    [GET:guest] /password/reset - パスワード再設定画面(メール送付)
    [GET:auth] /password/reset - パスワード再設定画面(メール送付)
    [GET:guest] /password/reset/{token} -> パスワード再設定画面
    [GET:auth] /password/reset/{token} -> パスワード再設定画面
    [GET] /sanctum/csrf-cookie -> リダイレクトなし
    [GET:guest] /api/user -> /login - ログインページ
    [GET:auth] /api/user -> /index.php - ダッシュボード 

    [POST] /login
    [POST] /logout
    [POST] /password/email
    [POST] /password/reset
    [POST] /register

    *(未実装) アクセス禁止
    [GET] /logout -> /index.php - ダッシュボード
    [GET] /password/email -> /index.php - ダッシュボード

+--------+----------+------------------------+-----------------------------+------------------------------------------------------------------------+---------------------------------------------+
| Domain | Method   | URI                    | Name                        | Action                                                                 | Middleware                                  |
+--------+----------+------------------------+-----------------------------+------------------------------------------------------------------------+---------------------------------------------+
|        | GET|HEAD | /                      | generated::XXXXXXXXXXXXXXXX | App\Http\Controllers\EWMController@index                               | web                                         |
|        | GET|HEAD | Settings.php           | generated::XXXXXXXXXXXXXXXX | App\Http\Controllers\EWMController@Settings                            | web                                         |
|        |          |                        |                             |                                                                        | App\Http\Middleware\Authenticate            |
|        | GET|HEAD | api/user               | generated::XXXXXXXXXXXXXXXX | Closure                                                                | api                                         |
|        |          |                        |                             |                                                                        | App\Http\Middleware\Authenticate:sanctum    |
|        | GET|HEAD | login                  | login                       | App\Http\Controllers\Auth\LoginController@showLoginForm                | web                                         |
|        |          |                        |                             |                                                                        | App\Http\Middleware\RedirectIfAuthenticated |
|        | POST     | login                  | generated::XXXXXXXXXXXXXXXX | App\Http\Controllers\Auth\LoginController@login                        | web                                         |
|        |          |                        |                             |                                                                        | App\Http\Middleware\RedirectIfAuthenticated |
|        | POST     | logout                 | logout                      | App\Http\Controllers\Auth\LoginController@logout                       | web                                         |
|        | GET|HEAD | password/confirm       | password.confirm            | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm    | web                                         |
|        |          |                        |                             |                                                                        | App\Http\Middleware\Authenticate            |
|        | POST     | password/confirm       | generated::XXXXXXXXXXXXXXXX | App\Http\Controllers\Auth\ConfirmPasswordController@confirm            | web                                         |
|        |          |                        |                             |                                                                        | App\Http\Middleware\Authenticate            |
|        | POST     | password/email         | password.email              | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web                                         |
|        | GET|HEAD | password/reset         | password.request            | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web                                         |
|        | POST     | password/reset         | password.update             | App\Http\Controllers\Auth\ResetPasswordController@reset                | web                                         |
|        | GET|HEAD | password/reset/{token} | password.reset              | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web                                         |
|        | GET|HEAD | register               | register                    | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web                                         |
|        |          |                        |                             |                                                                        | App\Http\Middleware\RedirectIfAuthenticated |
|        | POST     | register               | generated::JMfcvnXImBpC44fO | App\Http\Controllers\Auth\RegisterController@register                  | web                                         |
|        |          |                        |                             |                                                                        | App\Http\Middleware\RedirectIfAuthenticated |
|        | GET|HEAD | sanctum/csrf-cookie    | generated::vowYS7u0KBDn7zyB | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show             | web                                         |
|        | GET|HEAD | trainingRecords.php    | generated::830DkSUgwrSzRXoi | App\Http\Controllers\EWMController@trainingRecords                     | web                                         |
|        |          |                        |                             |                                                                        | App\Http\Middleware\Authenticate            |
|        | GET|HEAD | viewRecords.php        | generated::tGQXFIK9zydcJM1f | App\Http\Controllers\EWMController@viewRecords                         | web                                         |
|        |          |                        |                             |                                                                        | App\Http\Middleware\Authenticate            |
+--------+----------+------------------------+-----------------------------+------------------------------------------------------------------------+---------------------------------------------+
*/