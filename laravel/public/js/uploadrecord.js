// ! ----------------------------------------------------------------
// !                         要修正 lv.4 - rjs001
// ! 更新日: 2021/09/15
// ! 概要: バリデーションによる異常入力の検知後returnで
// ! 　　　追加分入力フィールドが消滅
// ! メモ: rjs002と関係性高
// ! ----------------------------------------------------------------
// ! ----------------------------------------------------------------
// !                         要修正 lv.4 - rjs006
// ! 更新日: 2021/09/15
// ! 概要: バリデーションによる異常入力の検知後returnでDB登録されないと
// ! 　　　してもS3に画像がアップロードされてしまう
// ! メモ: PHPで行うことを検討
// ! ----------------------------------------------------------------
// TODO ----------------------------------------------------------------
// TODO                      未実装 lv.3 - rjs004
// TODO 更新日: 2021/09/16
// TODO 概要: プリセット機能
// TODO ----------------------------------------------------------------
// TODO ----------------------------------------------------------------
// TODO                      未実装 lv.3 - rjs005
// TODO 更新日: 2021/09/16
// TODO 概要: 摂取カロリー記録->フィールド内に入力が
// TODO　　　　あれば入力必須(フィールド毎)
// TODO ----------------------------------------------------------------
// ? ----------------------------------------------------------------
// ?                       動作改善 lv.2 - rjs002
// ? 更新日: 2021/09/15
// ? 概要: トレーニングメニュー記録, 摂取カロリー記録にold()機能
// ? メモ: js DOM操作でold()不可？
// ? ----------------------------------------------------------------
// ? ----------------------------------------------------------------
// ?                       動作改善 lv.2 - rjs003
// ? 更新日: 2021/09/15
// ? 概要: old()機能->バリデーションによる異常入力の検知後returnで機能不全
// ? メモ: "戻る"では機能する。
// ? ----------------------------------------------------------------

//* ページ読み込み後実行
window.onload = function(){
    // プリセット登録時の入力必須化
    const preset_add = document.getElementById('js-tm-add-preset');
    preset_add.addEventListener('change', function(e) {
        if (preset_add.checked) // プリセット登録 -> プリセット名入力必須
        {
            document.getElementById('js-tm-preset-name').required = true;
        } else {
            document.getElementById('js-tm-preset-name').required = false;
        }
    });
}

//* トレーニングメニュー記録

// 入力フィールド追加
let trnum = 1;
function add_tritem_field() {
    const tif = document.getElementById('js-tr-item-field');
    trnum += 1;

    data = "<div class='col-3'>\
                <input class='form-control' id='js-tm-item-name"+trnum+"-1' type='text' autocomplete='js-tm-item-name"+trnum+"-1'>\
            </div>\
            <div class='col-2'>\
                <input class='form-control' id='js-tm-item-name"+trnum+"-2' type='text' autocomplete='js-tm-item-name"+trnum+"-2'>\
            </div>\
            <div class='col-2'>\
                <input class='form-control' id='js-tm-item-name"+trnum+"-3' type='text' autocomplete='js-tm-item-name"+trnum+"-3'>\
            </div>\
            <div class='col-2'>\
                <input class='form-control' id='js-tm-item-name"+trnum+"-4' type='text' autocomplete='js-tm-item-name"+trnum+"-4'>\
            </div>\
            <div class='col-3'>\
                <input class='form-control' id='js-tm-item-name"+trnum+"-5' type='text' autocomplete='js-tm-item-name"+trnum+"-5'>\
            </div>"
    // 子要素
    const child = document.createElement('div');
    tif.appendChild(child);
    // クラス追加
    child.classList.add('form-group');
    child.classList.add('row');
    child.classList.add('row-cols-auto');
    child.classList.add('item-field');
    child.classList.add('js-tr-item-field-class');

    const tifs = document.getElementsByClassName('js-tr-item-field-class');
    tifs[tifs.length-1].innerHTML = data; // 追加
}

// データ構築
function create_trdata() {
    let trdata = {
        tm_add_preset: (document.getElementById('js-tm-add-preset').checked ? document.getElementById('js-tm-add-preset').value : ""), // プリセット登録フラグ
        tm_preset_name: document.getElementById('js-tm-preset-name').value, // プリセット名
        tm_item_name_h: {}, // 項目名
        tm_item_name: {} // アイテム
    };
    
    // 項目名
    const tinh = document.getElementsByClassName('js-tm-item-name-h-class');
    for (let i = 0; i < tinh.length; i++) {
        trdata.tm_item_name_h['tm_item_name_h'+(i+1)] = document.getElementById('js-tm-item-name-h'+(i+1)).value;
    }

    // アイテム
    const tif = document.getElementsByClassName('js-tr-item-field-class');
    for (let i = 0; i < tif.length; i++) {
        for (let j = 0; j < 5; j++) {
            trdata.tm_item_name['tm_item_name'+(i+1)+'_'+(j+1)] = document.getElementById('js-tm-item-name'+(i+1)+'-'+(j+1)).value;
        };
    }

    return trdata;
}

//* 摂取カロリー記録
// 入力フィールド追加
let clnum = 1;
function add_clitem_field() {
    const cif = document.getElementById('js-cl-item-field'); // 親要素
    clnum += 1;
    
    data = "<div class='col-3'>\
                <input class='form-control' id='js-cl-item-name"+clnum+"-1' type='text' autocomplete='js-cl-item-name"+clnum+"-1'>\
            </div>\
            <div class='col-1'>\
                <input class='form-control cal-input' id='js-cl-item-name"+clnum+"-2' type='number' step='0.01' min='0' placeholder='kcal' autocomplete='js-cl-item-name"+clnum+"-2'>\
            </div>\
            <div class='col-1'>\
                <input class='form-control cal-input' id='js-cl-item-name"+clnum+"-3' type='number' step='0.01' min='0' placeholder='g' autocomplete='js-cl-item-name"+clnum+"-3'>\
            </div>\
            <div class='col-1'>\
                <input class='form-control cal-input' id='js-cl-item-name"+clnum+"-4' type='number' step='0.01' min='0' placeholder='g' autocomplete='js-cl-item-name"+clnum+"-4'>\
            </div>\
            <div class='col-1'>\
                <input class='form-control cal-input' id='js-cl-item-name"+clnum+"-5' type='number' step='0.01' min='0' placeholder='g' autocomplete='js-cl-item-name"+clnum+"-5'>\
            </div>\
            <div class='col-1'>\
                <input class='form-control cal-input' id='js-cl-item-name"+clnum+"-6' type='number' step='0.01' min='0' placeholder='g' autocomplete='js-cl-item-name"+clnum+"-6'>\
            </div>\
            <div class='col-4'>\
                <input class='form-control' id='js-cl-item-name"+clnum+"-7' type='text' autocomplete='js-cl-item-name"+clnum+"-7'>\
            </div>"
    // 子要素
    const child = document.createElement('div');
    cif.appendChild(child);
    // クラス追加
    child.classList.add('form-group');
    child.classList.add('row');
    child.classList.add('row-cols-auto');
    child.classList.add('item-field');
    child.classList.add('js-cl-item-field-class');

    const cifs = document.getElementsByClassName('js-cl-item-field-class');
    cifs[cifs.length-1].innerHTML = data; // 追加
}

// データ構築
function create_cldata() {
    let cldata = {
        cl_item_name1: {}, // 食品名, 自由記述(文字列)
        cl_item_name2: {} // 栄養成分(数値)
    };

    // アイテム
    const cif = document.getElementsByClassName('js-cl-item-field-class');
    for (let i = 0; i < cif.length; i++) {
        cldata.cl_item_name1['cl_item_name'+(i+1)+'_1'] = document.getElementById('js-cl-item-name'+(i+1)+'-1').value;
        for (let j = 1; j < 6; j++) {
            cldata.cl_item_name2['cl_item_name'+(i+1)+'_'+(j+1)] = document.getElementById('js-cl-item-name'+(i+1)+'-'+(j+1)).value;
        };
        cldata.cl_item_name1['cl_item_name'+(i+1)+'_7'] = document.getElementById('js-cl-item-name'+(i+1)+'-7').value;
    }

    return cldata;
}

//* 画像記録
const region = "us-east-1"; // リージョン
const poolId = "us-east-1:7cfd8d7b-462d-458b-8f6b-f0acf9f6534e"; // Cognito IDプール
const aws_uploadBucket = "ewms3"; // S3バケット

AWS.config.region = region;
AWS.config.credentials = new AWS.CognitoIdentityCredentials({
    IdentityPoolId: poolId
});
// アップロード準備
function upload_setup(uf, pidata){
    // S3アップロード&データ構築
    return new Promise(function create_pidata(resolve, reject) {
        // アップロード
        function S3upload (i) {
            return new Promise(function(resolve, reject){
                    const data = new AWS.S3.ManagedUpload({
                    params: {
                        Bucket: aws_uploadBucket,
                        Key: uf[i].name,
                        Body: uf[i],
                        ContentType: uf[i].type,
                        ACL: 'public-read'
                    }
                }).promise()
                .then(function(data){ // URL格納
                    pidata.upload_file['image_'+(i+1)] = data.Location;
                    resolve(data);
                });
            });
        }

        (async ()=>{
            const index_list = [...Array(uf.length)].map((_, i) => i); // インデックスリスト
            // アップロード関数呼び出し
            const promise_result = await Promise.all(index_list.map(async function(i){
                const r = await S3upload(i);
                return r;
            }));
            // 全てのアップロード処理が完了したら返却
            resolve(pidata);
        })();
    });
}

//* 身体情報記録
// データ構築
function create_bidata() {
    let bidata = {
        stature: document.getElementById('js-bi-stature').value,
        weight: document.getElementById('js-bi-weight').value,
        bodyfat: document.getElementById('js-bi-bodyfat').value,
        muscle: document.getElementById('js-bi-muscle').value
    };

    return bidata;
}


//* 各記録データ構築
const sbtn = document.getElementById('js-submit-btn');
function create_datas() {
    const uf = document.getElementById('js-upload-file').files;

    const trdata = create_trdata();
    const cldata = create_cldata();
    const bidata = create_bidata();
    let dummy_pidata = {
        upload_file: {}
    };
    let data;

    if (uf.length > 0) { // ファイル入力がある
        pidata = upload_setup(uf, dummy_pidata).then(function(create_pidata){
            data = {
                record_date: document.getElementById('js-record-date').value,
                trdata: trdata,
                cldata: cldata,
                bidata: bidata,
                pidata: create_pidata
            };
            document.getElementById('js-shaping-recorddata').value = JSON.stringify(data);
            sbtn.click();
        });
    } else { // ファイル入力がない -> 
        data = {
            record_date: document.getElementById('js-record-date').value,
            trdata: trdata,
            cldata: cldata,
            bidata: bidata,
            pidata: dummy_pidata
        };
        document.getElementById('js-shaping-recorddata').value = JSON.stringify(data);
        sbtn.click();
    }
}