<!-- 'ダッシュボード'レイアウト -->

<!-- 共通レイアウト読み込み -->
@extends('layouts.layout')

<!-- ページタイトル -->
@section('title', 'ダッシュボード')
<!-- CSS -->
@section('pageCSS')
<link href="./css/index.css" rel="stylesheet">
@endsection

<!-- メイン -->
@section('content')
<!-- ナビゲーション項目アクティブ -->
<script>
    const nav = document.getElementById('js-nav-1').classList.add("active");
</script>

<!-- メニュー -->
<div class="menu-field">
    <!-- 記録をつける(スタンダード) -->
    <div class="col-md">
        <a href="{{ route('uploadrecords.view') }}">
            <div class="card h-100">
                <img class="d-none d-md-block card-img-top" src="./img/uploadRecordsImage.png" alt="記録をつける">
                <div class="card-body">
                    <h5 class="card-title">記録をつける</h5>
                    <p class="card-text">今日１日のトレーニングメニュー、摂取カロリーを記録しましょう。継続することが大切です！</p>
                </div>
            </div>
        </a>
    </div>
    <!-- 記録をみる -->
    <div class="col-md">
        <a href="{{ route('viewrecords.view') }}">
            <div class="card h-100">
                <img class="d-none d-md-block card-img-top" src="./img/viewRecordsImage.png" alt="記録をみる">
                <div class="card-body">
                    <h5 class="card-title">記録をみる</h5>
                    <p class="card-text">過去の記録を可視化します。定期的に記録をみて、目標達成に近づいているか確認しましょう！</p>
                </div>
            </div>
        </a>
    </div>
    <!-- 目標設定 -->
    <div class="col-md">
        <a href="{{ route('goal.view') }}">
            <div class="card h-100">
                <img class="d-none d-md-block card-img-top" src="./img/settingsGoalsImage.png" alt="目標設定">
                <div class="card-body">
                    <h5 class="card-title">目標設定</h5>
                    <p class="card-text">まずは目標を決めることから。一歩ずつ自分の理想を目指して頑張りましょう！</p>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- ステータス -->
<div class="status-field">
    <div class="card h-100">
        <div class="card-body">
            <!-- 現在のステータス -->
            <h5 class="card-title">現在のステータス</h5>
            <p class="card-text">

                <!-- ログイン済み -->
                @auth
                <?php 
                $text = "<dl>
                            <dt>体重</dt><dd>".(($bodyinfo[0]->weight!=null)?$bodyinfo[0]->weight." kg":"未設定")."</dd>
                            <dt>BMI</dt><dd>".(($bodyinfo[0]->bmi!=null)?$bodyinfo[0]->bmi:"未設定")."</dd>
                            <dt>体脂肪率</dt><dd>".(($bodyinfo[0]->bodyfat!=null)?$bodyinfo[0]->bodyfat." %":"未設定")."</dd>
                            <dt>筋肉量</dt><dd>".(($bodyinfo[0]->muscle!=null)?$bodyinfo[0]->muscle." kg":"未設定")."</dd>
                            <dt>設定日時</dt><dd>".(($bodyinfo[0]->created_at!=null)?str_replace("-", "/", $bodyinfo[0]->created_at):"未設定")."</dd>
                        </dl>";
                echo $text;
                ?>
                @endauth
                <!-- 未ログイン -->
                @guest
                <?php echo $bodyinfo; // ログインボタン表示 ?>
                @endguest

            </p>

            <hr>

            <!-- 目標 -->
            <h5 class="card-title">あなたの目標</h5>
            <p class="card-text">

                <!-- ログイン済み -->
                @auth
                <?php 
                if ($goal == ""){ // 目標未設定
                    $text = "<a href='".route('goal.view')."'>目標設定</a>";
                } else { // 目標設定済み
                    $text = "<dl>
                                <dt>体重</dt><dd>".(($goal->weight!=null)?$goal->weight." kg":"未設定")."</dd>
                                <dt>BMI</dt><dd>".(($goal->bmi!=null)?$goal->bmi:"未設定")."</dd>
                                <dt>体脂肪率</dt><dd>".(($goal->bodyfat!=null)?$goal->bodyfat." %":"未設定")."</dd>
                                <dt>筋肉量</dt><dd>".(($goal->muscle!=null)?$goal->muscle." kg":"未設定")."</dd>
                                <dt>設定日時</dt><dd>".(($goal->created_at!=null)?str_replace("-", "/", $goal->created_at):"未設定")."</dd>
                            </dl>";
                }
                echo $text;
                ?>
                @endauth
                <!-- 未ログイン -->
                @guest
                <?php echo $goal; // ログインボタン表示 ?>
                @endguest

            </p>

            <hr>

            <!-- 目標との差分 -->
            <h5 class="card-title">目標との差分</h5>
            <p class="card-text">

                @auth
                <?php

                // ! --------------------------------------------------------------------
                // !                          要修正 lv.4 - ibp128
                // ! 更新日: 2021/09/15
                // ! 概要: 動作検証が不十分
                // ! メモ: 目標達成により*_diff=0のとき、未設定と表示される
                // ! --------------------------------------------------------------------
                $goal_diff = ""; // ? 暫定処置

                if ($goal_diff == ""){ // 差分計算不可
                    $text = "<p>NO DATA</p>";
                } else { // 差分計算済み
                    // TODO [未実装]差分出力 ここから
                    $text = "<dl>
                                <div class='item'>
                                    <dt>体重</dt>
                                    <dd>".(($goal_diff["weight_diff"]!=null)?$goal_diff["weight_diff"]." kg":"未設定").
                                        "<div class='progress'>
                                            <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                                                aria-valuenow='".$goal_diff["weight_per"]."' aria-valuemin='0' aria-valuemax='100'
                                                style='width:".$goal_diff["weight_per"]."%'>".$goal_diff["weight_per"]."%</div>
                                        </div>
                                    </dd>
                                </div>
                                <div class='item'>
                                    <dt>BMI</dt>
                                    <dd>".(($goal_diff["bmi_diff"]!=null)?$goal_diff["bmi_diff"]:"未設定").
                                        "<div class='progress'>
                                            <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                                                aria-valuenow='".$goal_diff["bmi_per"]."' aria-valuemin='0' aria-valuemax='100'
                                                style='width:".$goal_diff["bmi_per"]."%'>".$goal_diff["bmi_per"]."%</div>
                                        </div>
                                    </dd>
                                </div>
                                <div class='item'>
                                    <dt>体脂肪率</dt>
                                    <dd>".(($goal_diff["bodyfat_diff"]!=null)?$goal_diff["bodyfat_diff"]." %":"未設定").
                                        "<div class='progress'>
                                            <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                                                aria-valuenow='".$goal_diff["bodyfat_per"]."' aria-valuemin='0' aria-valuemax='100'
                                                style='width:".$goal_diff["bodyfat_per"]."%'>".$goal_diff["bodyfat_per"]."%</div>
                                        </div>
                                    </dd>
                                </div>
                                <div class='item'>
                                    <dt>筋肉量</dt>
                                    <dd>".(($goal_diff["muscle_diff"]!=null)?$goal_diff["muscle_diff"]." kg":"未設定").
                                        "<div class='progress'>
                                            <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                                                aria-valuenow='".$goal_diff["muscle_per"]."' aria-valuemin='0' aria-valuemax='100'
                                                style='width:".$goal_diff["muscle_per"]."%'>".$goal_diff["muscle_per"]."%</div>
                                        </div>
                                    </dd>
                                </div>
                            </dl>";
                    // TODO [未実装]差分出力 ここまで
                }
                echo $text;
                ?>
                @endauth
                <!-- 未ログイン -->
                @guest
                <?php echo $goal_diff; ?>
                @endguest

            </p>
        </div>
    </div>
</div>

<!-- カレンダー -->
<div class="calendar-field">
    <div class="card h-100">
        <div class="card-body">
            <h5 class="card-title"><?php echo $year."年".$month."月"?></h5>
            <table>
                <tr>
                    <th>日</th>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th>土</th>
                </tr>
                <tr>
                    <?php
                    // 日付表示
                    $cnt = 0; 
                    foreach ($calendar as $key => $value):
                        if ($value['day'] == date('d')):
                            echo "<td class='today'>";
                        else:
                            echo "<td>";
                        endif;
                        echo $value['day'];
                        echo "</td>";
                        $cnt++;

                        if ($cnt == 7):
                            echo "</tr><tr>";
                            $cnt = 0;
                        endif;
                    endforeach;
                    ?>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection