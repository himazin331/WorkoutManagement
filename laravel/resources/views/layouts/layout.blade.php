<!-- 共通 -->
<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>@yield('title') | {{ config('app.name') }}</title>
        <meta charset="UTF-8" />
        <meta name="description" content="シンプルで自由なカスタマイズが可能なワークアウト管理アプリ"/>

        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="format-detection" content="email=no,telephone=no,address=no" />
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <!-- Original CSS -->
        <link href="/css/style.css" rel="stylesheet">
        @yield('pageCSS')
    </head>
    <body>
        <!-- ヘッダー -->
        <header class="sticky-top bg-dark" id="top">
            <!-- ナビゲーション -->
            <nav class="navbar navbar-dark">
                <!-- ナビゲーショントグル -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- ヘッダーロゴ -->
                <div class="mx-auto">
                    <a class="navbar-brand mx-auto text-dark" href="/index.php">
                        <img class="col" src="/img/logo-large.png" width="300" height="50" alt="EasyWorkoutManagement">
                    </a>
                </div>
                <!-- ユーザ情報 -->
                <div class="mr-auto">
                    <a class="account-info-link text-white" href="/Settings.php#account" title="アカウント情報">
                        <div class="account-info">
                            <img class="account-info-img" src="/img/account_circle_white_36dp.svg" alt="アカウント情報" width="36" height="36">
                                <!-- ログイン済み -->
                                @auth
                                    <?php echo $user["name"]; ?>
                                @endauth
                                <!-- 未ログイン -->
                                @guest
                                    <span>ログイン</span>
                                @endguest
                        </div>
                    </a>
                </div>
                <!-- ナビゲーションアイテム -->
                <div class="collapse navbar-collapse" id="navbar">
                    <div class="navbar-nav mr-auto">
                        <a class="nav-item nav-link" id="nav_1" href="/index.php">ダッシュボード</a>
                        <ul class="navbar-nav nav-createlog">
                            <span class="nav-item-nest-content" id="nav_2">記録をつける
                                <li class="nav-item nav-item-nest"><a class="nav-link" href="/trainingRecords.php#standards">スタンダード</a></li>
                                <li class="nav-item nav-item-nest"><a class="nav-link" href="/trainingRecords.php#trainingmenu">トレーニングメニュー記録</a></li>
                                <li class="nav-item nav-item-nest"><a class="nav-link" href="/trainingRecords.php#calorie">摂取カロリー記録</a></li>
                                <li class="nav-item nav-item-nest"><a class="nav-link" href="/trainingRecords.php#picture">画像記録</a></li>
                            </span>
                        </ul>
                        <a class="nav-item nav-link" id="nav_3" href="/viewRecords.php">記録をみる</a>
                        <a class="nav-item nav-link" id="nav_4" href="/Settings.php">設定</a>
                    </div>
                </div>
            </nav>
        </header>

        <!-- メイン -->
        <div class="wrapper">
            <div class="container">
                @yield('content')
            </div>
        </div>

        <!-- フッター -->
        <footer>
            <span>Copyright © 2021 Shion Yoshida. All Rights Reserved.</span>
        </footer>

        <!-- Bootstrap JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>
</html>