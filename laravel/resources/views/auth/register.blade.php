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
            <div class="card-header bg-secondary text-white">アカウント登録</div>
            <div class="card-body card-body-main">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- ユーザID -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="name">ユーザID (英数字)<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input class="form-control @error('name') is-invalid @enderror" id="name" type="text"  name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            <!-- エラーメッセージ -->
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- 性別 -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="gender">性別<span class="required">*</span></label>
                        <div class="col-md-6" style="padding-top: 8px">
                            <input class="@error('gender') is-invalid @enderror" id="gender-m" type="radio" name="gender" value="male" checked>
                            <label for="gender-m">男性</label>
                            <input class="@error('gender') is-invalid @enderror" id="gender-f" type="radio" name="gender" value="female">
                            <label for="gender-f">女性</label>
                            <!-- エラーメッセージ -->
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- 生年月日 -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="birthday">生年月日<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input class="form-control @error('birthday') is-invalid @enderror" id="birthday" type="date" name="birthday" value="{{ old('birthday') }}" required>
                            <!-- エラーメッセージ -->
                            @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- 身長 -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="stature">身長(cm)<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input class="form-control @error('stature') is-invalid @enderror" id="stature" type="number" name="stature" value="{{ old('stature') }}" step="0.01" min="1" max="999.99" required autocomplete="stature">
                            <!-- エラーメッセージ -->
                            @error('stature')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- 体重 -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="weight">体重(kg)<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input class="form-control @error('weight') is-invalid @enderror" id="weight" type="number" name="weight" value="{{ old('weight') }}" step="0.01" min="1" max="999.99" required autocomplete="weight">
                            <!-- エラーメッセージ -->
                            @error('weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- メールアドレス -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="email">メールアドレス<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                            <!-- エラーメッセージ -->
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- パスワード -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="password">パスワード (8文字以上)<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="new-password">
                            <!-- エラーメッセージ -->
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- パスワード(確認) -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="password-confirm">パスワード (確認)<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                            <!-- エラーメッセージ -->
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <p class="required">* 回答必須項目</p>

                    <!-- 登録submit -->
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <!-- 登録submit -->
                            <button class="btn btn-secondary" type="submit">
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
