<!-- アカウント登録ページ -->

<!-- 共通レイアウト読み込み -->
@extends('layouts.layout')

<!-- ページタイトル -->
@section('title', 'アカウント登録')
<!-- CSS -->
@section('pageCSS')
    <link href="./css/login_register.css" rel="stylesheet">
@endsection

<!-- メイン -->
@section('content')
<!-- アカウント登録フォーム -->
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-main">
            <div class="card-header bg-secondary text-white">{{ __('アカウント登録') }}</div>
            <div class="card-body card-body-main">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- ユーザID -->
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('ユーザID (英数字)') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            <!-- 不正なユーザID入力時の処理 -->
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- 性別 -->
                    <div class="form-group row">
                        <label for="gender" class="col-md-4 col-form-label text-md-right">性別</label>
                        <div class="col-md-6" style="padding-top: 8px">
                            <input id="gender-m" type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="male" checked>
                            <label for="gender-m">男性</label>
                            <input id="gender-f" type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="female">
                            <label for="gender-f">女性</label>
                            <!-- 不正な性別入力時の処理 -->
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- 生年月日 -->
                    <div class="form-group row">
                        <label for="birthday" class="col-md-4 col-form-label text-md-right">生年月日</label>
                        <div class="col-md-6">
                            <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" required>
                            <!-- 不正な生年月日入力時の処理 -->
                            @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- メールアドレス -->
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            <!-- 不正なメールアドレス入力時の処理 -->
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- パスワード -->
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <!-- 不正なパスワード入力時の処理 -->
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- パスワード(確認) -->
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('パスワード (確認)') }}</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                            <!-- 不正なパスワード(確認)入力時の処理 -->
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- 登録submit -->
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <!-- 登録submit -->
                            <button type="submit" class="btn btn-secondary">
                                {{ __('登録') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- ログインページへ -->
        <div class="card">
            <div class="card-body">
                既にアカウントをお持ちですか？
                <a class="btn btn-link" href="{{ route('login') }}">
                    ログインはこちら
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
