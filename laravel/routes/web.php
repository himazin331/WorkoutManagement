<?php
//* ルーティング設定 */

use Illuminate\Support\Facades\Route;

//* 'ダッシュボード'ページ */
Route::get('/', 'App\Http\Controllers\EWMController@index')->name('index');

//* '記録をつける'ページ */
// スタンダード
Route::get('/uploadRecords', 'App\Http\Controllers\URecordsController@uploadRecordsView')->middleware('auth')->name('uploadrecords.view');
// トレーニングメニュー記録
Route::get('/uploadRecords#trainingmenu', 'App\Http\Controllers\URecordsController@ulTrainingmenuView')->name('ultrainingmenu.view');
// 摂取カロリー記録
Route::get('/uploadRecords#calorie', 'App\Http\Controllers\URecordsController@ulCalorieView')->name('ulcalorie.view');
// 画像記録
Route::get('/uploadRecords#picture', 'App\Http\Controllers\URecordsController@ulPictureView')->name('ulpicture.view');
// 身体情報記録
Route::get('/uploadRecords#bodyinfo', 'App\Http\Controllers\URecordsController@ulBodyinfoView')->name('ulbodyinfo.view');
Route::post('/uploadRecords/recordsupload', 'App\Http\Controllers\URecordsController@recordsUpload')->name('records.upload'); // 記録アップロード

//* 記録を見る */
Route::get('/viewRecords', 'App\Http\Controllers\VRecordsController@viewRecordsView')->middleware('auth')->name('viewrecords.view');
Route::post('/viewRecords/recordsget', 'App\Http\Controllers\VRecordsController@recordsGet')->name('records.get'); // 記録取得

//* '設定'ページ */
// 設定
Route::get('/Settings', 'App\Http\Controllers\SettingsController@settingsView')->middleware('auth')->name('settings.view');
// 身体情報
Route::get('/Settings#bodyinfo', 'App\Http\Controllers\SettingsController@bodyinfoView')->name('bodyinfo.view');
// 目標設定
Route::get('/Settings#goal', 'App\Http\Controllers\SettingsController@goalView')->name('goal.view');
Route::post('/Settings/goal', 'App\Http\Controllers\SettingsController@goalUpload')->name('goal.upload'); // 目標設定
// アカウント情報
Route::get('/Settings#account', 'App\Http\Controllers\SettingsController@accountView')->name('account.view');

//* ログイン認証 */
Auth::routes();