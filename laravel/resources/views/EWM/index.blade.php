<!-- ダッシュボード -->

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
        const nav = document.getElementById("nav_1");
        nav.classList.add("active");
    </script>

    <!-- メニュー -->
    <div class="menu-field">
        <!-- 記録をつける(スタンダード) -->
        <div class="col-md">
            <a href="./trainingRecords.php#standards">
                <div class="card h-100">
                    <img src="./img/noimage.jpg" class="card-img-top" alt="記録をつける">
                    <div class="card-body">
                        <h5 class="card-title">記録をつける</h5>
                        <p class="card-text">今日１日のトレーニングメニュー、摂取カロリーを記録しましょう。継続することが大切です！</p>
                    </div>
                </div>
            </a>
        </div>
        <!-- 記録をみる -->
        <div class="col-md">
            <a href="./viewRecords.php">
                <div class="card h-100">
                    <img src="./img/noimage.jpg" class="card-img-top" alt="記録をみる">
                    <div class="card-body">
                        <h5 class="card-title">記録をみる</h5>
                        <p class="card-text">過去の記録を可視化します。定期的に記録をみて、目標達成に近づいているか確認しましょう！</p>
                    </div>
                </div>
            </a>
        </div>
        <!-- 目標設定 -->
        <div class="col-md">
            <a href="./Settings.php#goals">
                <div class="card h-100">
                    <img src="./img/noimage.jpg" class="card-img-top" alt="目標設定">
                    <div class="card-body">
                        <h5 class="card-title">目標設定</h5>
                        <p class="card-text">まずは目標を決めることから。一歩ずつ自分の理想を目指して頑張りましょう！</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- ステータス -->
    <div class="goals-field">
        <div class="card h-100">
            <div class="card-body">
                <!-- 現在のステータス -->
                <h5 class="card-title">現在のステータス</h5>
                <p class="card-text" id=" current_text">
                    <!-- 目標項目に応じて表示 -->
                    <p class="current-weight">体重：XXkg</p>
                    <p class="current-bmi">BMI：XX</p>
                    <!--
                    <p class="current-bodyfat">体脂肪率：XX％</p>
                    <p class="current-muscle">筋肉量：XXkg</p>
                    -->

                </p>
                <hr>
                <!-- 目標 -->
                <h5 class="card-title">あなたの目標</h5>
                <p class="card-text" id="goals_text">
                    <!-- 目標項目選択可能 -->
                    <p class="goals-weight">体重：XXkg</p>
                    <p class="goals-bmi">BMI：XX</p>
                    <!--
                    <p class="goals-bodyfat">体脂肪率：XX％</p>
                    <p class="goals-muscle">筋肉量：XXkg</p>
                    -->
                </p>
                <hr>
                <!-- 目標との差分 -->
                <h5 class="card-title">目標との差分</h5>
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