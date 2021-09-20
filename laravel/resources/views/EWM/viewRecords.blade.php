<!-- '記録をみる'ページ -->

<!-- 共通レイアウト読み込み -->
@extends('layouts.layout')

<!-- ページタイトル -->
@section('title', '記録をみる')
<!-- CSS -->
@section('pageCSS')
<link href="./css/view_records.css" rel="stylesheet">
@endsection

<!-- メイン -->
@section('content')

<!-- ナビゲーション項目アクティブ -->
<script>
    const nav = document.getElementById('js-nav-3').classList.add('active');
</script>

<!-- 返却メッセージ -->
@if (session('rmessage'))
    @if (session('rmessage') == "記録しました。")
        <div class="alert alert-success sticky-top r-message" id="js-r-message">
            {{ session('rmessage') }}
        </div>
    @else
        <div class="alert alert-danger sticky-top r-message" id="js-r-message">
            {{ session('rmessage') }}
        </div>
    @endif
    <script>
        // 4秒表示後削除
        setTimeout(function(){document.getElementById('js-r-message').remove();}, 4000);
    </script>
@endif

<h3>記録をみる</h3>
<hr>

<!-- 表示フィルタ -->
<div class="field account-field" id="getfilter">
    <div class="card card-main h-100 filter-field">
        <div class="card-header bg-secondary text-white filter-field-header">表示フィルタ</div>
        <div class="card-body card-body filter-field-body">
            <form method="POST" action="{{ route('records.get') }}">
                @csrf
                <div class="row row-cols-auto filter-field-in">
                    <!-- 表示期間・日数 -->
                    <div class="card col-md-auto">
                        <div class="card-header filter-field-in-header">
                            表示期間・日数
                        </div>
                        <div class="card-body">
                            <!-- 表示期間 -->
                            <div class="form-group row">
                                <label class="col-form-label col-auto text-md-right" for="filter-date-from">表示期間</label>
                                <div class="col-auto">
                                    <input class="form-control @error('filter_date_from') is-invalid @enderror" id="filter-date-from" type="date" value="{{ old('filter_date_from') }}" name="filter_date_from" autocomplete="filter-date-from">
                                    <!-- エラーメッセージ -->
                                    @error('filter_date_from')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <p class="col-form-label col-auto text-md-center" for="filter-date-until">～</p>
                                <div class="col-auto">
                                    <input class="form-control @error('filter_date_until') is-invalid @enderror" id="filter-date-until" type="date" value="{{ old('filter_date_until') }}" name="filter_date_until" autocomplete="filter-date-until">
                                    <!-- エラーメッセージ -->
                                    @error('filter_date_until')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <p class="col-form-label col-auto text-md-right">or</p>
                            <!-- 表示日数 -->
                            <div class="form-group row">
                                <label class="col-form-label col-auto text-md-right" for="filter-date-num">表示日数</label>
                                <div class="col-auto">
                                    <input class="form-control @error('filter_date_num') is-invalid @enderror" id="filter-date-num" type="number" value="{{ old('filter_date_num') }}" min="1" name="filter_date_num" autocomplete="filter-date-num">
                                    <!-- エラーメッセージ -->
                                    @error('filter_date_num')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span class="col-form-label col-auto">日分</span>
                            </div>
                        </div>
                    </div>

                    <!-- 並び順 -->
                    <div class="card col-sm-auto">
                        <div class="card-header filter-field-in-header">
                            並び順
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input @error('filter_sort') is-invalid @enderror" id="filter-sort-new" type="radio" name="filter_sort" value="sort_new" checked>
                                <label class="form-check-label" for="filter-sort-new">
                                    新しい順
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('filter_sort') is-invalid @enderror" id="filter-sort-old" type="radio" name="filter_sort" value="sort_old">
                                <label class="form-check-label" for="filter-sort-old">
                                    古い順
                                </label>
                            </div>
                            <!-- エラーメッセージ -->
                            @error('filter_sort')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- 表示項目 -->
                    <div class="card col-sm-auto">
                        <div class="card-header filter-field-in-header">
                            表示項目
                        </div>
                        <div class="card-body">
                            <!-- トレーニングメニュー記録表示/非表示 -->
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="filter-view-tm" name="filter_view_tm" checked>
                                <label class="form-check-label" for="filter-view-tm">トレーニングメニュー記録</label>
                            </div>
                            <!-- エラーメッセージ -->
                            @error('filter_view_tm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!-- 摂取カロリー記録表示/非表示 -->
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="filter-view-cl" name="filter_view_cl" checked>
                                <label class="form-check-label" for="filter-view-cl">摂取カロリー記録</label>
                            </div>
                            <!-- エラーメッセージ -->
                            @error('filter_view_cl')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!-- 画像記録表示/非表示 -->
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="filter-view-pi" name="filter_view_pi" checked>
                                <label class="form-check-label" for="filter-view-pi">画像記録</label>
                            </div>
                            <!-- エラーメッセージ -->
                            @error('filter_view_pi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!-- 身体情報記録表示/非表示 -->
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="filter-view-bi" name="filter_view_bi" checked>
                                <label class="form-check-label" for="filter-view-bi">身体情報記録</label>
                            </div>
                            <!-- エラーメッセージ -->
                            @error('filter_view_bi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- 設定submit -->
                    <div class="d-grid gap-2 d-md-block submit-btn">
                        <button class="btn btn-secondary btn-lg" type="submit">適用</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- トレーニングメニュー記録 -->
<div class="trainingmenu" id="trainingmenu">
    <h4>トレーニングメニュー記録</h4>
    <hr>

    <div id="tr-records-field">
        @if (count($trainingmenu) > 0)
            <div>
                <details class="tr-records-list">
                    <summary class="tr-record-label">{{ $trainingmenu[0]->record_date }}</summary>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ $trpreset->header1 }}</th>
                                <th>{{ $trpreset->header2 }}</th>
                                <th>{{ $trpreset->header3 }}</th>
                                <th>{{ $trpreset->header4 }}</th>
                                <th>{{ $trpreset->header5 }}</th>
                            </tr>
                        </thead>
                        <tbody id="cl-records-list">
                        @foreach ($trainingmenu as $t)
                            <tr>
                                <td>{{ $t->item1 }}</td>
                                <td>{{ $t->item2 }}</td>
                                <td>{{ $t->item3 }}</td>
                                <td>{{ $t->item4 }}</td>
                                <td>{{ $t->item5 }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </details>
            </div>
        @else
        <div>
            NO DATA
        </div>
        @endif
    </div>
</div>

<!-- 摂取カロリー記録 -->
<div id="calorie">
    <h4>摂取カロリー記録</h4>
    <hr>

    <div id="cl-records-field">
        @if (count($calorie) > 0)
            <div>
                <details class="cl-records-list">
                    <summary class="cl-record-label">{{ $calorie[0]->record_date }}</summary>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>食品名</th>
                                <th>カロリー</th>
                                <th>たんぱく質</th>
                                <th>脂質</th>
                                <th>炭水化物</th>
                                <th>糖質</th>
                                <th>自由記述</th>
                            </tr>
                        </thead>
                        <tbody id="cl-records-list">
                        @foreach ($calorie as $c)
                            <tr>
                                <td>{{ $c->foodname }}</td>
                                <td>{{ $c->energy }}</td>
                                <td>{{ $c->protein }}</td>
                                <td>{{ $c->fat }}</td>
                                <td>{{ $c->carbohydrates }}</td>
                                <td>{{ $c->sugar }}</td>
                                <td>{{ $c->free }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </details>
            </div>
        @else
        <div>
            NO DATA
        </div>
        @endif
    </div>
</div>

<!-- 画像記録 -->
<div id="picture">
    <h4>画像記録</h4>
    <hr>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>画像</th>
                <th>ファイル名</th>
                <th>記録日</th>
                <th>編集</th>
            </tr>
        </thead>
        <tbody id="pi-records-list">
        </tbody>
    </table>
</div>

<!-- 身体情報記録 -->
<div id="bodyinfo">
    <h4>身体情報記録</h4>
    <hr>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>体重</th>
                <th>BMI</th>
                <th>体脂肪率</th>
                <th>筋肉量</th>
                <th>記録日</th>
            </tr>
        </thead>
        <tbody id="bi-records-list">
        </tbody>
    </table>
</div>

<!-- javascript -->
<script>



</script>
@endsection
