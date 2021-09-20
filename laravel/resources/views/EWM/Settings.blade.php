<!-- '設定'レイアウト -->

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
<!-- ナビゲーション項目アクティブ -->
<script>
    const nav = document.getElementById('js-nav-4').classList.add('active');
</script>

<!-- 返却メッセージ -->
@if (session('rmessage'))
    @if (session('rmessage') == "目標を設定しました。")
        <div class="alert alert-success sticky-top r-message" id="js-r-message">
            {{ session('rmessage') }}
        </div>
    @else
        <div class="alert alert-danger sticky-top r-message" id="js-r-message">
            {{ session('rmessage') }}
        </div>
    @endif
    <script>
        // 表示後削除
        setTimeout(function(){document.getElementById('js-r-message').remove();}, 4000);
    </script>
@endif

<h3>設定</h3>
<hr>

<!-- 身体情報 -->
<div class="field account-field" id="bodyinfo" >
    <div class="card card-main h-100">
        <!-- 身体情報表示 -->
        <div class="card-header bg-secondary text-white">身体情報</div>
        <div class="card-body card-body-main">
            <?php 
                if ($bodyinfo == ""){
                    $text = "<p>未設定</p>";
                } else {
                    $text = "<dl>
                                <dt>年齢</dt><dd>".$age." 歳</dd>
                                <dt>身長</dt><dd>".$bodyinfo->stature." cm</dd>
                                <dt>体重</dt><dd>".$bodyinfo->weight." kg</dd>
                                <dt>BMI</dt><dd>".$bodyinfo->bmi."</dd>
                                <dt>体脂肪率</dt><dd>".(($bodyinfo->bodyfat!=null)?$bodyinfo->bodyfat." %":"未設定")."</dd>
                                <dt>筋肉量</dt><dd>".(($bodyinfo->muscle!=null)?$bodyinfo->muscle." kg":"未設定")."</dd>
                                <dt>記録日時</dt><dd>".str_replace("-", "/", $bodyinfo->created_at)."</dd>
                            </dl>";
                }
                echo $text;
            ?>
        </div>
    </div>
</div>

<!-- 目標 -->
<div class="field account-field" id="goal">
    <div class="card card-main h-100">
        <!-- 現在の目標 -->
        <div class="card-header bg-secondary text-white">現在の目標</div>
        <div class="card-body card-body-main">
            <?php 
                if ($goal == ""){
                    $text = "<p>未設定</p>";
                } else {
                    $text = "<dl>
                                <dt>体重</dt><dd>".(($goal->weight!=null)?$goal->weight." kg":"未設定")."</dd>
                                <dt>BMI</dt><dd>".(($goal->bmi!=null)?$goal->bmi:"未設定")."</dd>
                                <dt>体脂肪率</dt><dd>".(($goal->bodyfat!=null)?$goal->bodyfat." %":"未設定")."</dd>
                                <dt>筋肉量</dt><dd>".(($goal->muscle!=null)?$goal->muscle." kg":"未設定")."</dd>
                                <dt>設定日時</dt><dd>".str_replace("-", "/", $goal->created_at)."</dd>
                            </dl>";
                }
                echo $text;
            ?>
        </div>

        <!-- 目標設定 -->
        <div class="card-header bg-secondary text-white">目標設定</div>
        <div class="card-body card-body-sub">
            <form method="POST" action="{{ route('goal.upload') }}">
                @csrf
                <!-- 体重 -->
                <div class="form-group row">
                    <label class="col-form-label col-md-4 text-md-right" for="goal-weight">体重(kg)</label>
                    <div class="col-md-6">
                        <input class="form-control @error('weightg') is-invalid @enderror" id="goal-weight" type="number" value="{{ old('weightg') }}" name="weightg" step="0.01" min="1" max="999.99" autocomplete="weightg">
                        <!-- エラーメッセージ -->
                        @error('weightg')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- BMI -->
                <div class="form-group row">
                    <label class="col-form-label col-md-4 text-md-right" for="goal-bmi">BMI</label>
                    <div class="col-md-6">
                        <input class="form-control @error('bmig') is-invalid @enderror" id="goal-bmi" type="number" value="{{ old('bmig') }}" name="bmig" step="0.01" min="1" max="999.99" autocomplete="bmig">
                        <!-- エラーメッセージ -->
                        @error('bmig')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- 体脂肪率 -->
                <div class="form-group row">
                    <label class="col-form-label col-md-4 text-md-right" for="goal-bodyfat">体脂肪率(%)</label>
                    <div class="col-md-6">
                        <input class="form-control @error('bodyfatg') is-invalid @enderror" id="goal-bodyfat" type="number" value="{{ old('bodyfatg') }}" name="bodyfatg" step="0.01" min="1" max="999.99" autocomplete="bodyfatg">
                        <!-- エラーメッセージ -->
                        @error('bodyfatg')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- 筋肉量 -->
                <div class="form-group row">
                    <label class="col-form-label col-md-4 text-md-right" for="goal-muscle">筋肉量(kg)</label>
                    <div class="col-md-6">
                        <input class="form-control @error('muscleg') is-invalid @enderror" id="goal-muscle" type="number" value="{{ old('muscleg') }}" name="muscleg" step="0.01" min="1" max="999.99" autocomplete="muscleg">
                        <!-- エラーメッセージ -->
                        @error('muscleg')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- 設定submit -->
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button class="btn btn-secondary" type="submit">設定</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?
// TODO ----------------------------------------------------------------
// TODO                      未実装 lv.3 - sbp181
// TODO 更新日: 2021/09/16
// TODO 概要: パスワード変更ページ遷移
// TODO メモ: 現在はパスワード再設定ページ
// TODO ----------------------------------------------------------------
?>

<!-- アカウント情報 -->
<div class="field account-field" id="account">
    <div class="card card-main h-100">
        <!-- アカウント情報 -->
        <div class="card-header bg-secondary text-white">アカウント情報</div>
        <div class="card-body card-body-main">
            <!-- 情報表示 -->
            <dl>
                <dt>ユーザID</dt><dd><?php echo $user['name']; ?></dd>
                <dt>性別</dt>
                <dd>
                    <?php echo ($user['gender'] == "male") ? str_replace("male", "男性", $user['gender']) : str_replace("female", "女性", $user['gender']); ?>
                </dd>
                <dt>生年月日</dt><dd><?php echo str_replace("-", "/", $user['birthday']); ?></dd>
                <dt>メールアドレス</dt><dd><?php echo $user['email']; ?></dd>
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
                                            document.getElementById('js-logout-form').submit();">
                ログアウト
            </a>
            <form class="d-none" id="js-logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
            </form>
        </div>

        <?
        // TODO ----------------------------------------------------------------
        // TODO                      未実装 lv.3 - sbp191
        // TODO 更新日: 2021/09/16
        // TODO 概要: アカウント削除ページ遷移
        // TODO ----------------------------------------------------------------
        ?>
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