<!-- '記録をつける'ページ -->

<!-- 共通レイアウト読み込み -->
@extends('layouts.layout')

<!-- ページタイトル -->
@section('title', '記録をつける')
<!-- CSS -->
@section('pageCSS')
<link href="./css/upload_records.css" rel="stylesheet">
@endsection

<!-- メイン -->
@section('content')

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

<h3>記録をつける</h3>
<hr>

<form id="js-form" method="POST" action="{{ route('records.upload') }}" enctype="application/json">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <!-- 記録日 -->
    <div class="card record-date-field">
        <div class="card-header bg-secondary text-white">
            記録日
        </div>
        <div class="card-body">
            <div class="form-group row input-date-field">
                <label class="col-form-label col-md-2 text-md-right" for="js-record-date">記録日 <span class="badge bg-danger">必須</span></label>
                <div class="col-md-3">
                    <input class="form-control" id="js-record-date" type="date" value="{{ old('record_date') }}" required autocomplete="js-record-date">
                    <!-- エラーメッセージ -->
                    @if($errors->has('record_date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>
                                @foreach ($errors->get('record_date') as $error)
                                    {{ $error }}
                                @endforeach
                            </strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="accordion">
        <!-- トレーニングメニュー記録 -->
        <div class="accordion-item trainingmenu" id="trainingmenu">
            <!-- アコーディオンヘッダー -->
            <h2 class="accordion-header bg-secondary text-white" id="trainingmenu-header">
                <button class="accordion-button bg-secondary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#js-trainingmenu-body" aria-expanded="true" aria-controls="js-trainingmenu-body" id="anko">
                    トレーニングメニュー記録
                </button>
            </h2>
            <!-- メイン -->
            <div class="accordion-collapse collapse" id="js-trainingmenu-body" aria-labelledby="trainingmenu-header">
                <div class="accordion-body">
                    <div class="card-body card-body-sub">
                        <div id="js-tr-item-field">  
                            <!-- 項目名ヘッダー未設定時 -->
                            <div class="ifnot-item-name-header">
                                <div class="card border-info">
                                    <div class="card-body">
                                        項目名を設定してください。最大５つまで追加できます。また、設定した項目名はプリセットとして次回以降も適用することができます。
                                    </div>
                                </div>
                            </div>

                            <!-- 項目名ヘッダー -->
                            <div class="item-name-header row">
                                <!-- 新規項目名登録 -->
                                <div id="create-item-name-header">
                                    <!-- プリセット名入力フィールド -->
                                    <div class="tm-preset-field form-group row">
                                        <div class="col-6">
                                            <div class="input-group">
                                                <!-- プリセット登録チェックボックス -->
                                                <div class="input-group-text">
                                                    <label class="tm-add-preset-label" for="js-tm-add-preset">プリセット登録</label> 
                                                    <input id="js-tm-add-preset" type="checkbox" value="true">
                                                </div>
                                                <input class="form-control input-tm-preset-name" id="js-tm-preset-name" type="text" value="{{ old('tm_preset_name') }}" placeholder="プリセット名" autocomplete="js-tm-preset-name">
                                            </div>
                                            <!-- エラーメッセージ -->
                                            @if($errors->has('trdata.tm_add_preset'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>
                                                        {{ $errors->first('trdata.tm_add_preset') }}
                                                    </strong>
                                                </span>
                                            @endif
                                            @if($errors->has('trdata.tm_preset_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>
                                                        {{ $errors->first('trdata.tm_preset_name') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- 項目名入力フィールド -->
                                    <div class="form-group">
                                        <div class="row input-item-name-header">
                                            <div class="col-3">
                                                <input class="form-control js-tm-item-name-h-class" id="js-tm-item-name-h1" type="text" placeholder="項目名1" autocomplete="js-tm-item-name-h1">
                                            </div>
                                            <div class="col-2">
                                                <input class="form-control js-tm-item-name-h-class" id="js-tm-item-name-h2" type="text" placeholder="項目名2" autocomplete="js-tm-item-name-h2">
                                            </div>
                                            <div class="col-2">
                                                <input class="form-control js-tm-item-name-h-class" id="js-tm-item-name-h3" type="text" placeholder="項目名3" autocomplete="js-tm-item-name-h3">
                                            </div>
                                            <div class="col-2">
                                                <input class="form-control js-tm-item-name-h-class" id="js-tm-item-name-h4" type="text" placeholder="項目名4" autocomplete="js-tm-item-name-h4">
                                            </div>
                                            <div class="col-3">
                                                <input class="form-control js-tm-item-name-h-class" id="js-tm-item-name-h5" type="text" placeholder="項目名5" autocomplete="js-tm-item-name-h5">
                                            </div>
                                        </div>

                                        <!-- エラーメッセージ -->
                                        @if($errors->has('trdata.tm_item_name_h.*'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>
                                                    {{ $errors->first('trdata.tm_item_name_h.*') }}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <!-- 項目入力フィールド -->
                            <div class="form-group row row-cols-auto item-field js-tr-item-field-class">
                                <div class="col-3">
                                    <input class="form-control" id="js-tm-item-name1-1" type="text" autocomplete="js-tm-item-name1-1">
                                </div>
                                <div class="col-2">
                                    <input class="form-control" id="js-tm-item-name1-2" type="text" autocomplete="js-tm-item-name1-2">
                                </div>
                                <div class="col-2">
                                    <input class="form-control" id="js-tm-item-name1-3" type="text" autocomplete="js-tm-item-name1-3">
                                </div>
                                <div class="col-2">
                                    <input class="form-control" id="js-tm-item-name1-4" type="text" autocomplete="js-tm-item-name1-4">
                                </div>
                                <div class="col-3">
                                    <input class="form-control" id="js-tm-item-name1-5" type="text" autocomplete="js-tm-item-name1-5">
                                </div>
                            </div>

                            <!-- エラーメッセージ -->
                            @if($errors->has('trdata.tm_item_name.*'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>
                                        {{ $errors->first('trdata.tm_item_name.*') }}
                                    </strong>
                                </span>
                            @endif
                        </div>

                        <!-- 入力フィールド追加 -->
                        <div class="form-group row item-field">
                            <div class="col">
                                <a class="btn btn-outline-light add-btn" onclick="add_tritem_field();"><img src="./img/add_black_24dp.svg"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 摂取カロリー記録 -->
        <div class="accordion-item calorie" id="calorie">
            <!-- アコーディオンヘッダー -->
            <h2 class="accordion-header bg-secondary text-white" id="calorie-header">
                <button class="accordion-button bg-secondary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#js-calorie-body" aria-expanded="false" aria-controls="js-calorie-body">
                    摂取カロリー記録
                </button>
            </h2>
            <!-- メイン -->
            <div class="accordion-collapse collapse" id="js-calorie-body" aria-labelledby="calorie-header">
                <div class="accordion-body">
                    <div class="card-body card-body-sub">
                        <div id="js-cl-item-field">    
                            <!-- 項目名ヘッダー -->
                            <div class="row row-cols-auto calorie-hader item-name-header">
                                <div class="col-3">
                                    食品名
                                </div>
                                <div class="col-1">
                                    エネルギー
                                </div>
                                <div class="col-1">
                                    タンパク質
                                </div>
                                <div class="col-1">
                                    脂質
                                </div>
                                <div class="col-1">
                                    炭水化物
                                </div>
                                <div class="col-1">
                                    糖質
                                </div>
                                <div class="col-4">
                                    自由記述
                                </div>
                            </div>
                            <hr>

                            <!-- 項目入力フィールド -->
                            <div class="form-group row row-cols-auto item-field js-cl-item-field-class">
                                <div class="col-3">
                                    <input class="form-control " id="js-cl-item-name1-1" type="text" autocomplete="js-cl-item-name1-1">
                                </div>
                                <div class="col-1">
                                    <input class="form-control cal-input" id="js-cl-item-name1-2" type="number" step="0.01" min="0" placeholder="kcal" autocomplete="js-cl-item-name1-2">
                                </div>
                                <div class="col-1">
                                    <input class="form-control cal-input" id="js-cl-item-name1-3" type="number" step="0.01" min="0" placeholder="g" autocomplete="js-cl-item-name1-3">
                                </div>
                                <div class="col-1">
                                    <input class="form-control cal-input" id="js-cl-item-name1-4" type="number" step="0.01" min="0" placeholder="g" autocomplete="js-cl-item-name1-4">
                                </div>
                                <div class="col-1">
                                    <input class="form-control cal-input" id="js-cl-item-name1-5" type="number" step="0.01" min="0" placeholder="g" autocomplete="js-cl-item-name1-5">
                                </div>
                                <div class="col-1">
                                    <input class="form-control cal-input" id="js-cl-item-name1-6" type="number" step="0.01" min="0" placeholder="g" autocomplete="js-cl-item-name1-6">
                                </div>
                                <div class="col-4">
                                    <input class="form-control" id="js-cl-item-name1-7" type="text" autocomplete="js-cl-item-name1-7">
                                </div>
                                
                            </div>

                            <!-- エラーメッセージ -->
                            @if($errors->has('cldata.cl_item_name1.*'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>
                                        {{ $errors->first('cldata.cl_item_name1.*') }}
                                    </strong>
                                </span>
                            @endif
                            @if($errors->has('cldata.cl_item_name2.*'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>
                                        {{ $errors->first('cldata.cl_item_name2.*') }}
                                    </strong>
                                </span>
                            @endif
                        </div>

                        <!-- 入力フィールド追加 -->
                        <div class="form-group row item-field">
                            <div class="col">
                                <a class="btn btn-outline-light add-btn" onclick="add_clitem_field();"><img src="./img/add_black_24dp.svg"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 画像記録 -->
        <div class="accordion-item picture" id="picture">
            <!-- ヘッダー -->
            <h2 class="accordion-header bg-secondary text-white" id="picture-header">
                <button class="accordion-button bg-secondary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#js-picture-body" aria-expanded="false" aria-controls="js-picture-body">
                    画像記録
                </button>
            </h2>
            <!-- メイン -->
            <div class="accordion-collapse collapse" id="js-picture-body" aria-labelledby="picture-header">
                <div class="accordion-body">
                    <div class="card-body card-body-sub">
                        <p>※対応形式は.jpeg .jpg .pngのみ。<br>※ファイル名には !%~'()._- 以外の記号や特殊文字を含めないでください。</p>
                        <!-- 画像アップロードフィールド -->
                        <div class="form-group">
                            <div class="card bg-light upload-file-field" id="js-upload-file-field">
                                <div class="card-body">
                                    <!-- ファイル入力フィールド -->
                                    <label class="input-file-field" id="js-input-file-field" for="js-upload-file">
                                        <div class="custom-file">
                                            <input class="form-control custom-file-input" id="js-upload-file" type="file" value="{{ old('upload_file') }}" accept="image/png, image/jpeg" multiple>
                                            <label class="custom-file-label" id="js-custom-file-label" for="js-upload-file">ファイルを選択 または ドラッグ＆ドロップ<br>対応形式： .jpeg .jpg .png</label>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <!-- エラーメッセージ -->
                            @if($errors->has('pidata.upload_file.*'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>
                                        {{ $errors->first('pidata.upload_file.*') }}
                                    </strong>
                                </span>
                            @endif

                            <!-- 選択取り消しボタン -->
                            <button class="btn inputfile-reset-btn" type="button" id="js-inputfile-reset">選択取消</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- 身体情報 -->
        <div class="accordion-item bodyinfo" id="bodyinfo">
            <!-- ヘッダー -->
            <h2 class="accordion-header bg-secondary text-white" id="bodyinfo-header">
                <button class="accordion-button bg-secondary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#js-bodyinfo-body" aria-expanded="false" aria-controls="js-bodyinfo-body">
                    身体情報記録
                </button>
            </h2>
            <!-- メイン -->
            <div class="accordion-collapse collapse" id="js-bodyinfo-body" aria-labelledby="bodyinfo-header">
                <div class="accordion-body">
                    <div class="card-body card-body-sub">
                        <p>※各項目未入力の場合は、前回記録した値がセットされます。<br>※BMIは自動で算出されます。</p>
                        <!-- 身長 -->
                        <div class="form-group row">
                            <label class="col-form-label col-md-4 text-md-right" for="js-bi-stature">身長(cm)</label>
                            <div class="col-md-6">
                                <input class="form-control" id="js-bi-stature" type="number" value="{{ old('stature') }}" step="0.01" min="1" max="999.99" autocomplete="js-bi-stature">
                                <!-- エラーメッセージ -->
                                @if($errors->has('bidata.stature'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>
                                            {{ $errors->first('bidata.stature') }}
                                        </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- 体重 -->
                        <div class="form-group row">
                            <label class="col-form-label col-md-4 text-md-right" for="js-bi-weight">体重(kg)</label>
                            <div class="col-md-6">
                                <input class="form-control" id="js-bi-weight" type="number" value="{{ old('weight') }}" step="0.01" min="1" max="999.99" autocomplete="js-bi-weight">
                                <!-- エラーメッセージ -->
                                @if($errors->has('bidata.weight'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>
                                            {{ $errors->first('bidata.weight') }}
                                        </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- 体脂肪率 -->
                        <div class="form-group row">
                            <label class="col-form-label col-md-4 text-md-right" for="js-bi-bodyfat">体脂肪率(%)</label>
                            <div class="col-md-6">
                                <input class="form-control" id="js-bi-bodyfat" type="number" value="{{ old('bodyfat') }}" step="0.01" min="1" max="999.99" autocomplete="js-bi-bodyfat">
                                <!-- エラーメッセージ -->
                                @if($errors->has('bidata.bodyfat'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>
                                            {{ $errors->first('bidata.bodyfat') }}
                                        </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- 筋肉量 -->
                        <div class="form-group row">
                            <label class="col-form-label col-md-4 text-md-right" for="js-bi-muscle">筋肉量(kg)</label>
                            <div class="col-md-6">
                                <input class="form-control" id="js-bi-muscle" type="number" value="{{ old('muscle') }}" step="0.01" min="1" max="999.99" autocomplete="js-bi-muscle">
                                <!-- エラーメッセージ -->
                                @if($errors->has('bidata.muscle'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>
                                            {{ $errors->first('bidata.muscle') }}
                                        </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 整形後データ -->
    <input id="js-shaping-recorddata" type="hidden" name="recorddata">

    <!-- 記録submit -->
    <div class="form-submit form-group row">
        <div class="col">
            <button class="btn btn-secondary big-btn" type="button" id="js-trigger-btn" onclick="create_datas();">OK</button>
            <button class="btn btn-secondary submit-btn" type="submit" id="js-submit-btn"></button>
        </div>
    </div>
</form>

<!-- ヘッダーナビゲーション アクティブ＆記録外項目非表示 -->
<script>
    /* 残念なコード */
    const nav2 = document.getElementById('js-nav-2').classList.add('white');
    const nav21 = document.getElementById('js-nav-2-1');
    const nav22 = document.getElementById('js-nav-2-2');
    const nav23 = document.getElementById('js-nav-2-3');
    const nav24 = document.getElementById('js-nav-2-4');
    const nav25 = document.getElementById('js-nav-2-5');

    const tb = document.getElementById('js-trainingmenu-body');
    const cb = document.getElementById('js-calorie-body');
    const pb = document.getElementById('js-picture-body');
    const bb = document.getElementById('js-bodyinfo-body');

    //* 再ロード関数郡
    function standard_reload(){
        nav21.addEventListener('click', function(e){location.reload();});
    }
    function trainingmunu_reload(){
        nav22.addEventListener('click', function(e){
            location.href="#trainingmenu";location.reload();
        });
    }
    function calorie_reload(){
        nav23.addEventListener('click', function(e){location.href="#calorie";location.reload();});
    }
    function picture_reload(){
        nav24.addEventListener('click', function(e){location.href="#picture";location.reload();});
    }
    function bodyinfo_reload(){
        nav25.addEventListener('click', function(e){location.href="#bodyinfo";location.reload();});
    }

    if (location.hash == "#trainingmenu") { //* トレーニングメニュー記録へ遷移
        nav22.classList.add('active');
        tb.classList.add('show');

        standard_reload();
        calorie_reload();
        picture_reload();
        bodyinfo_reload();
    } else if (location.hash == "#calorie") { //* 摂取カロリー記録へ遷移
        nav23.classList.add('active');
        cb.classList.add('show');

        standard_reload();
        trainingmunu_reload();
        picture_reload();
        bodyinfo_reload();
    } else if (location.hash == "#picture") { //* 画像記録へ遷移
        nav24.classList.add('active');
        pb.classList.add('show');

        standard_reload();
        trainingmunu_reload();
        calorie_reload();
        bodyinfo_reload();
    } else if (location.hash == "#bodyinfo") { //* 身体情報記録へ遷移
        nav25.classList.add('active');
        bb.classList.add('show');
        
        standard_reload();
        trainingmunu_reload();
        calorie_reload();
        picture_reload();
    } else { //* スタンダードへ遷移
        nav21.classList.add('active');
        tb.classList.add('show');
        cb.classList.add('show');
        pb.classList.add('show');
        bb.classList.add('show'); 
        trainingmunu_reload();
        calorie_reload();
        picture_reload();
        bodyinfo_reload();
    }
</script>

<!-- ファイル入力関係 -->
<script>
    const inputfile = document.getElementById('js-upload-file'); // ファイル入力フィールド
    const label = document.getElementById('js-custom-file-label'); // ラベル
    
    //* ドロップ可能エリアに入った時
    document.getElementById('js-input-file-field').addEventListener('dragenter', function(e){
        document.getElementById('js-upload-file-field').classList.add('overlay');
    });

    //* ドロップ可能エリアを出た時
    document.getElementById('js-input-file-field').addEventListener('dragleave', function(e){
        document.getElementById('js-upload-file-field').classList.remove('overlay');
    });
    
    //* ドラッグ中
    document.getElementById('js-input-file-field').addEventListener('dragover', function(e){
        e.preventDefault();

        document.getElementById('js-upload-file-field').classList.add('overlay');
    });

    //* ドロップ
    document.getElementById('js-input-file-field').addEventListener('drop', function(e){
        e.preventDefault();
        document.getElementById('js-upload-file-field').classList.remove('overlay');

        inputfile.files = e.dataTransfer.files; // ファイル情報

        inputfile.dispatchEvent(new Event('change')); // ファイル情報変更イベント発火
    });
    
    //* ラベル変更
    inputfile.addEventListener('change', function(e){
        if (inputfile.files.length !== 0) // ファイル情報あり
        {
            var label_text = ""; // 書き換えラベル
            for (var i = 0; i < inputfile.files.length; i++)
            {
                if (inputfile.files[i].type == "image/jpeg" || inputfile.files[i].type == "image/png") // MIMEタイプOK
                {
                    label_text += inputfile.files[i].name + ", "
                } else { // MIMEタイプNG
                    label.innerText = "非対応のファイル形式です"; 
                    inputfile.value = "";
                    inputfile.dispatchEvent(new Event('change')); // ファイル情報変更イベント発火
                    return false;
                }
            }
            label_text = label_text.slice(0, -2);

            label.innerText = label_text; 
        }
    });

    //* ファイル選択取り消し処理
    document.getElementById('js-inputfile-reset').addEventListener('click', function(e){
        label.innerHTML = "ファイルを選択 または ドラッグ＆ドロップ<br>対応形式： .jpeg .jpg .png"; 
        inputfile.value = "";
        inputfile.dispatchEvent(new Event('change')); // ファイル情報変更イベント発火
    });
</script>

<!-- 記録関係 -->
<!-- AWS-SDKの読み込み -->
<script src="https://sdk.amazonaws.com/js/aws-sdk-2.857.0.min.js"></script>
<script src="./js/uploadrecord.js"></script>
@endsection