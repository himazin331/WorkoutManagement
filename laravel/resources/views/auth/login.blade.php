<!-- ログインページ -->

<!-- 共通レイアウト読み込み -->
@extends('layouts.layout')

<!-- ページタイトル -->
@section('title', 'ログイン')
<!-- CSS -->
@section('pageCSS')
    <link href="./css/login_register.css" rel="stylesheet">
@endsection

<!-- メイン -->
@section('content')
<!-- ログインフォーム -->
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-main">
            <div class="card-header bg-secondary text-white">{{ __('ログイン認証') }}</div>
            <div class="card-body card-body-main">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- ユーザID -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="name">ユーザID</label>
                        <div class="col-md-6">
                            <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            <!-- エラーメッセージ -->
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- パスワード -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="password">{{ __('パスワード') }}</label>
                        <div class="col-md-6">
                            <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="current-password">
                            <!-- エラーメッセージ -->
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- 自動ログイン機能 -->
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input {{ old('remember') ? 'checked' : '' }}" id="remember" type="checkbox" name="remember">
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <!-- ログインsubmit -->
                            <button class="btn btn-secondary" type="submit">
                                {{ __('ログイン') }}
                            </button>
                            <!-- パスワード再設定 -->
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('パスワードを忘れた') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- アカウント登録ページへ -->
        <div class="card">
            <div class="card-body">
                初めてご利用ですか？
                <a class="btn btn-link" href="{{ route('register') }}">
                    新規登録はこちら
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
