<!-- 共通レイアウト -->

<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>@yield('title') | {{ config('app.name') }}</title>
        <meta charset="UTF-8">
        <meta name="description" content="シンプルで自由なカスタマイズが可能なワークアウト管理アプリ">

        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="format-detection" content="email=no,telephone=no,address=no">
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <!-- Original CSS -->
        <link href="/css/layout.css" rel="stylesheet">
        @yield('pageCSS')
    </head>
    <body>
        <!-- ヘッダー -->
        <header class="sticky-top bg-dark" id="top">
            <!-- ナビゲーション -->
            <nav class="navbar navbar-dark">
                <!-- ヘッダーロゴ -->
                <a class="navbar-brand text-dark" href="{{ route('index') }}">
                    <img class="col navbar-brand-img" src="/img/logo_large.png" width="300" height="50" alt="EasyWorkoutManagement">
                </a>

                <!-- ユーザ情報 ウィンドウサイズ768px以上 -->
                <div class="d-none d-md-block dropdown dropdown-normal">
                    <button class="btn btn-outline-secondary dropdown-toggle text-white float-right" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="account-info-img" src="/img/account_circle_white_36dp.svg" width="36" height="36" alt="アカウント情報">

                        <!-- ログイン済み -->
                        @auth
                        <?php echo $user['name']; // ユーザーID表示 ?>
                        @endauth
                        <!-- 未ログイン -->
                        @guest
                        <span>ログイン</span>
                        @endguest

                    </button>
                    <ul class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">

                        <!-- 未ログイン -->
                        @guest
                        <li class="dropdown-list"><a class="dropdown-item bg-dark" href="{{ route('login') }}">ログイン</a></li>
                        @endguest
                        <li class="dropdown-list"><a class="dropdown-item bg-dark" href="{{ route('account.view') }}">アカウント情報</a></li>
                        <!-- ログイン済み -->
                        @auth
                        <li class="dropdown-list">
                            <a class="dropdown-item bg-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('js-logout-form').submit();">
                                ログアウト
                            </a>
                            <form class="d-none" id="js-logout-form" method="POST" action="{{ route('logout') }}">@csrf</form>
                        </li>
                        @endauth

                    </ul>
                </div>

                <!-- ナビゲーショントグル -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- ナビゲーションアイテム -->
                <div class="collapse navbar-collapse justify-content-end" id="navbar">
                    <div class="navbar-nav mr-auto">
                        <!-- ユーザ情報 ウィンドウサイズ768px以下 -->
                        <div class="d-md-none dropdown dropdown-small">
                            <button class="btn btn-outline-secondary dropdown-toggle text-white" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="account-info-img" src="/img/account_circle_white_36dp.svg" width="36" height="36" alt="アカウント情報">

                                <!-- ログイン済み -->
                                @auth
                                <?php echo $user['name']; // ユーザーID表示 ?>
                                @endauth
                                <!-- 未ログイン -->
                                @guest
                                <span>ログイン</span>
                                @endguest

                            </button>
                            <ul class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">

                                <!-- 未ログイン -->
                                @guest
                                <li class="dropdown-list"><a class="dropdown-item bg-dark" href="{{ route('login') }}">ログイン</a></li>
                                @endguest
                                <li class="dropdown-list"><a class="dropdown-item bg-dark" href="{{ route('account.view') }}">アカウント情報</a></li>
                                <!-- ログイン済み -->
                                @auth
                                <li class="dropdown-list">
                                    <a class="dropdown-item bg-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('js-logout-form').submit();">
                                        ログアウト
                                    </a>
                                    <form class="d-none" id="js-logout-form" method="POST" action="{{ route('logout') }}">@csrf</form>
                                </li>
                                @endauth

                            </ul>
                        </div>
                        <!-- 各ページリンク -->
                        <a class="nav-item nav-link" id="js-nav-1" href="{{ route('index') }}">ダッシュボード</a>
                        <ul class="navbar-nav nav-createlog">
                            <span class="nav-item-nest-content" id="js-nav-2">記録をつける
                                <li class="nav-item nav-item-nest"><a class="nav-link" id="js-nav-2-1" href="{{ route('uploadrecords.view') }}">スタンダード</a></li>
                                <li class="nav-item nav-item-nest"><a class="nav-link" id="js-nav-2-2" href="{{ route('ultrainingmenu.view') }}">トレーニングメニュー記録</a></li>
                                <li class="nav-item nav-item-nest"><a class="nav-link" id="js-nav-2-3" href="{{ route('ulcalorie.view') }}">摂取カロリー記録</a></li>
                                <li class="nav-item nav-item-nest"><a class="nav-link" id="js-nav-2-4" href="{{ route('ulpicture.view') }}">画像記録</a></li>
                                <li class="nav-item nav-item-nest"><a class="nav-link" id="js-nav-2-5" href="{{ route('ulbodyinfo.view') }}">身体情報記録</a></li>
                            </span>
                        </ul>
                        <a class="nav-item nav-link" id="js-nav-3" href="{{ route('viewrecords.view') }}">記録をみる</a>
                        <a class="nav-item nav-link" id="js-nav-4" href="{{ route('settings.view') }}">設定</a>
                    </div>
                </div>
            </nav>
        </header>

        <!-- メイン -->
        <div class="wrapper">
            <div class="container" id="container">
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