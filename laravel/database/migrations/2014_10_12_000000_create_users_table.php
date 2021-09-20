<?php
//* usersテーブル作成 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    // マイグレーション実行
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('gender');
            $table->date('birthday');
            $table->unsignedTinyInteger('age');
            $table->unsignedSmallInteger('stature');
            $table->unsignedSmallInteger('weight');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    // マイグレーションロールバック
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
