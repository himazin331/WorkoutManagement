<?php
//* ユーザ毎テーブル作成モジュール */

namespace App\Models;

// テーブル作成モジュール
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class CreateTbUser extends Model
{
    //* テーブル作成
    public static function createTrainingTb($user_id)
    {
        // プリセットテーブル作成
        $trpreset_table_name = "tb_user".sprintf("%05d", $user_id)."_trpreset";
        Schema::create($trpreset_table_name, function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('preset_name')->nullable();
            $table->text('header1')->nullable();
            $table->text('header2')->nullable();
            $table->text('header3')->nullable();
            $table->text('header4')->nullable();
            $table->text('header5')->nullable();
            $table->boolean('default_flg');
            $table->timestamps();
        });

        // トレーニングメニューテーブル作成
        $table_name = "tb_user".sprintf("%05d", $user_id)."_trainingmenu";
        Schema::create($table_name, function (Blueprint $table) use ($trpreset_table_name) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('preset_id')->constrained($trpreset_table_name)->onDelete('cascade');
            $table->text('item1')->nullable();
            $table->text('item2')->nullable();
            $table->text('item3')->nullable();
            $table->text('item4')->nullable();
            $table->text('item5')->nullable();
            $table->date('record_date');
            $table->timestamps();
        });

        // 目標テーブル作成
        $goals_table_name = "tb_user".sprintf("%05d", $user_id)."_goals";
        Schema::create($goals_table_name, function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->float('weight', 5, 2)->nullable();
            $table->float('bmi', 5, 2)->nullable();
            $table->float('bodyfat', 5, 2)->nullable();
            $table->float('muscle', 5, 2)->nullable();
            $table->boolean('goal_flg');
            $table->timestamps();
        });

        // 身体情報テーブル作成
        $bodyinfo_table_name = "tb_user".sprintf("%05d", $user_id)."_bodyinfo";
        Schema::create($bodyinfo_table_name, function (Blueprint $table) use ($goals_table_name) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('goals_id')->nullable()->constrained($goals_table_name)->onDelete('cascade');
            $table->integer('age');
            $table->float('stature', 5, 2);
            $table->float('weight', 5, 2);
            $table->float('weight_diff', 5, 2)->nullable();
            $table->float('weight_per', 5, 2)->nullable();
            $table->float('bmi', 5, 2);
            $table->float('bmi_diff', 5, 2)->nullable();
            $table->float('bmi_per', 5, 2)->nullable();
            $table->float('bodyfat', 5, 2)->nullable();
            $table->float('bodyfat_diff', 5, 2)->nullable();
            $table->float('bodyfat_per', 5, 2)->nullable();
            $table->float('muscle', 5, 2)->nullable();
            $table->float('muscle_diff', 5, 2)->nullable();
            $table->float('muscle_per', 5, 2)->nullable();
            $table->timestamps();
        });

        // カロリーテーブル作成
        $table_name = "tb_user".sprintf("%05d", $user_id)."_calorie";
        Schema::create($table_name, function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('foodname');
            $table->float('energy', 10, 2)->nullable();
            $table->float('protein', 10, 2)->nullable();
            $table->float('fat', 10, 2)->nullable();
            $table->float('carbohydrates', 10, 2)->nullable();
            $table->float('sugar', 10, 2)->nullable();
            $table->text('free')->nullable();
            $table->date('record_date');
            $table->timestamps();
        });

        // 画像テーブル作成
        $table_name = "tb_user".sprintf("%05d", $user_id)."_picture";
        Schema::create($table_name, function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('data');
            $table->date('record_date');
            $table->timestamps();
        });
    }
}