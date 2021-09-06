<?php
//* userテーブルにカラムを追加するマイグレーション */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUserTable extends Migration
{
    /* マイグレーション適用時処理 */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender');
            $table->date('birthday');
        });
    }

    /* マイグレーション適用外処理 */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
