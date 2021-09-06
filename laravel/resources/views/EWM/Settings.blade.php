<!-- 設定ページ -->

<!-- 共通レイアウト読み込み -->
@extends('layouts.layout')

<!-- ページタイトル -->
@section('title', '設定')
<!-- CSS -->
@section('pageCSS')
    <link href="./css/settings.css" rel="stylesheet">
@endsection

<!-- メイン -->
@section('content')
    <h3>設定</h3>
    <hr>

    <!-- 身体 -->
    <div id="body" class="field account-field">
        <div class="card card-main h-100">
            <!-- 身体情報 -->
            <div class="card-header bg-secondary text-white">身体情報</div>
            <div class="card-body card-body-main">
                <p>ステータス</p>
            </div>

            <!-- 身体設定 -->
            <div class="card-header bg-secondary text-white">身体情報設定</div>
            <div class="card-body card-body-sub">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- 身長 -->
                    <div class="form-group row">
                        <label for="goals_stature" class="col-md-4 col-form-label text-md-right">身長(cm)</label>
                        <div class="col-md-6">
                            <input id="goals_stature" type="number" class="form-control @error('stature') is-invalid @enderror" name="stature" required autocomplete="stature">
                            <!-- 不正な身長入力時の処理 -->
                            @error('stature')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- 体重 -->
                    <div class="form-group row">
                        <label for="goals_weight" class="col-md-4 col-form-label text-md-right">体重(kg)</label>
                        <div class="col-md-6">
                            <input id="goals_weight" type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" required autocomplete="weight">
                            <!-- 不正な体重入力時の処理 -->
                            @error('weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- 体脂肪率 -->
                    <div class="form-group row">
                        <label for="goals_bodyfat" class="col-md-4 col-form-label text-md-right">体脂肪率(%)</label>
                        <div class="col-md-6">
                            <input id="goals_bodyfat" type="number" class="form-control @error('bodyfat') is-invalid @enderror" name="bodyfat" autocomplete="bodyfat">
                            <!-- 不正な体脂肪率入力時の処理 -->
                            @error('bodyfat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- 筋肉量 -->
                    <div class="form-group row">
                        <label for="goals_muscle" class="col-md-4 col-form-label text-md-right">筋肉量(kg)</label>
                        <div class="col-md-6">
                            <input id="goals_muscle" type="number" class="form-control @error('muscle') is-invalid @enderror" name="muscle" autocomplete="muscle">
                            <!-- 不正な筋肉量入力時の処理 -->
                            @error('muscle')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- 設定submit -->
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-secondary">設定</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 目標 -->
    <div id="goals" class="field account-field">
        <div class="card card-main h-100">
            <!-- 現在の目標 -->
            <div class="card-header bg-secondary text-white">現在の目標</div>
            <div class="card-body card-body-main">
                <p>ステータス</p>
            </div>

            <!-- 目標設定 -->
            <div class="card-header bg-secondary text-white">目標設定</div>
            <div class="card-body card-body-sub">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- 体重 -->
                    <div class="form-group row">
                        <label for="goals_weight" class="col-md-4 col-form-label text-md-right">体重(kg)</label>
                        <div class="col-md-6">
                            <input id="goals_weight" type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" autocomplete="weight">
                            <!-- 不正な体重入力時の処理 -->
                            @error('weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- BMI -->
                    <div class="form-group row">
                        <label for="goals_bmi" class="col-md-4 col-form-label text-md-right">BMI</label>
                        <div class="col-md-6">
                            <input id="goals_bmi" type="number" class="form-control @error('bmi') is-invalid @enderror" name="bmi" autocomplete="bmi">
                            <!-- 不正なBMI入力時の処理 -->
                            @error('bmi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- 体脂肪率 -->
                    <div class="form-group row">
                        <label for="goals_bodyfat" class="col-md-4 col-form-label text-md-right">体脂肪率(%)</label>
                        <div class="col-md-6">
                            <input id="goals_bodyfat" type="number" class="form-control @error('bodyfat') is-invalid @enderror" name="bodyfat" autocomplete="bodyfat">
                            <!-- 不正な体脂肪率入力時の処理 -->
                            @error('bodyfat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- 筋肉量 -->
                    <div class="form-group row">
                        <label for="goals_muscle" class="col-md-4 col-form-label text-md-right">筋肉量(kg)</label>
                        <div class="col-md-6">
                            <input id="goals_muscle" type="number" class="form-control @error('muscle') is-invalid @enderror" name="muscle" autocomplete="muscle">
                            <!-- 不正な筋肉量入力時の処理 -->
                            @error('muscle')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- 設定submit -->
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-secondary">設定</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- アカウント情報 -->
    <div id="account" class="field account-field">
        <div class="card card-main h-100">
            <!-- アカウント情報 -->
            <div class="card-header bg-secondary text-white">アカウント情報</div>
            <div class="card-body card-body-main">
                <!-- 情報表示 -->
                <dl>
                    <dt>ユーザID</dt><dd><?php echo $user["name"]; ?></dd>
                    <dt>性別</dt>
                    <dd><?php
                        echo ($user["gender"] == "male") ? str_replace("male", "男性", $user["gender"]) : str_replace("female", "女性", $user["gender"]);
                    ?></dd>
                    <dt>生年月日</dt><dd><?php echo str_replace("-", "/", $user["birthday"]); ?></dd>
                    <dt>メールアドレス</dt><dd><?php echo $user["email"]; ?></dd>
                    <dt>パスワード</dt>
                    <dd>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                パスワード変更
                            </a>
                        @endif
                    </dd>
                </dl>
                <!-- ログアウト -->
                <a class="btn btn-outline-secondary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                    ログアウト
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
            </div>

            <!-- アカウント削除 -->
            <div class="card-header bg-danger text-white">アカウント削除</div>
            <div class="card-body card-body-sub">
                <p>ワークアウト記録やアカウント情報は完全に削除され、元に戻すことはできません。必ずご確認ください。</p>
                @if (Route::has('password.request'))
                    <a class="btn btn-danger" href="{{ route('password.request') }}">
                        アカウント削除
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection