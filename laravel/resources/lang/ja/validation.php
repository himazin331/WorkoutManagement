<?php
//* バリデーション返却メッセージ */

return [
    'accepted' => 'The :attribute must be accepted.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_dash' => 'The :attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'current_password' => 'The password is incorrect.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => 'The :attribute must not be greater than :max characters.',
        'array' => 'The :attribute must not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',

    // カスタム
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message'
        ],
        //* 認証系
        // ユーザID
        'name' => [
            'required' => ':attributeを入力してください。',
            'string' => '不正な入力です。',
            'max' => ':attributeは:max文字以内で入力してください。',
            'regex' => ':attributeには英数字以外を入力しないでください。',
            'unique' => 'その:attributeは既に使用されています。'
        ],
        // 性別
        'gender' => [
            'required' => ':attributeを選択してください。',
            'in' => '不正な入力です。',
        ],
        // 生年月日
        'birthday' => [
            'required' => ':attributeを入力してください。',
            'date' => ':attributeを正しく入力してください。',
            'before_or_equal' => ':date以前の日付を選択してください。',
            'after_or_equal' => ':date以降の日付を選択してください。'
        ],
        // 身長
        'stature' => [
            'required' => ':attributeを入力してください。',
            'numeric' => ':attributeを正しく入力してください。',
            'between' => ':attributeは:minから:maxまでの数値のみ有効です。',
            'regex' => ':attributeは小数第二位まで有効です。'
        ],
        // 体重
        'weight' => [
            'required' => ':attributeを入力してください。',
            'numeric' => ':attributeを正しく入力してください。',
            'between' => ':attributeは:minから:maxまでの数値のみ有効です。',
            'regex' => ':attributeは小数第二位まで有効です。'
        ],
        // メールアドレス
        'email' => [
            'required' => ':attributeを入力してください。',
            'email' => ':attributeを正しく入力してください。',
            'max' => ':attributeは:max文字以内で入力してください。',
            'unique' => 'その:attributeは既に使用されています。'
        ],
        // パスワード
        'password' => [
            'required' => ':attributeを入力してください。',
            'string' => '不正な入力です。',
            'min' => ':attributeは:min文字以上で入力してください。',
        ],
        // パスワード(確認)
        'password_confirmation' => [
            'required' => ':attributeを入力してください。',
            'string' => '不正な入力です。',
            'same' => ':attributeが一致しません。'
        ],
        //* 記録
        // 記録日
        'record_date' => [
            'required' => ':attributeを入力してください。',
            'date' => ':attributeを正しく入力してください。',
            'before_or_equal' => ':date以前の日付を選択してください。',
            'after_or_equal' => ':date以降の日付を選択してください。'
        ],
        // トレーニングメニュ－記録
        'trdata.tm_add_preset' => [
            'in' => '不正な入力です。',
        ],
        'trdata.tm_preset_name' => [
            'required_if' => ':attributeを入力してください。',
            'string' => '不正な入力です。',
        ],
        'trdata.tm_item_name_h.*' => [
            'string' => '不正な入力です。',
        ],
        'trdata.tm_item_name.*' => [
            'string' => '不正な入力です。',
        ],
        // 摂取カロリー記録
        'cldata.cl_item_name1.*' => [
            'string' => '不正な入力です。',
        ],
        'cldata.cl_item_name2.*' => [
            'numeric' => ':attributeを正しく入力してください。',
            'min' => ':attributeは:min以上の数値のみ有効です。',
            'regex' => ':attributeは小数第二位まで有効です。'
        ],
        // 画像記録
        // ファイル名
        'pidata.upload_file.*.0' => [
            'required_with' => '不正な入力です。',
            'string' => ':attributeが不正です。',
            'unique' => '過去にアップロードしたファイルと:attributeが重複しています。:attributeを変更してください。',
            'regex' => '.jpeg .jpg .png以外のファイルタイプ、:attributeに !%~\'()._- 以外の記号や特殊文字が含まれるファイルはアップロードできません。'
        ],
        // ファイルタイプ
        'pidata.upload_file.*.1' => [
            'required_with' => '不正な入力です。',
            'string' => ':attributeが不正です。',
            'regex' => ':attributeがjpeg .jpg .png以外のファイルはアップロードできません。'
        ],
        // ファイル
        'pidata.upload_file.*.2' => [
            'required_with' => '不正な入力です。',
            'string' => ':attributeが不正です。',
            'regex' => ':attributeが不正です。'
        ],
        // 身体情報
        // 身長
        'bidata.stature' => [
            'required' => ':attributeを入力してください。',
            'numeric' => ':attributeを正しく入力してください。',
            'between' => ':attributeは:minから:maxまでの数値のみ有効です。',
            'regex' => ':attributeは小数第二位まで有効です。'
        ],
        // 体重
        'bidata.weight' => [
            'required' => ':attributeを入力してください。',
            'numeric' => ':attributeを正しく入力してください。',
            'between' => ':attributeは:minから:maxまでの数値のみ有効です。',
            'regex' => ':attributeは小数第二位まで有効です。'
        ],
        // 体脂肪率
        'bidata.bodyfat' => [
            'numeric' => ':attributeを正しく入力してください。',
            'between' => ':attributeは:minから:maxまでの数値のみ有効です。',
            'regex' => ':attributeは小数第二位まで有効です。'
        ],
        // 筋肉量
        'bidata.muscle' => [
            'numeric' => ':attributeを正しく入力してください。',
            'between' => ':attributeは:minから:maxまでの数値のみ有効です。',
            'regex' => ':attributeは小数第二位まで有効です。'
        ],
        //* 目標設定
        // 体重(目標)
        'weightg' => [
            'numeric' => ':attributeを正しく入力してください。',
            'between' => ':attributeは:minから:maxまでの数値のみ有効です。',
            'regex' => ':attributeは小数第二位まで有効です。'
        ],
        // BMI(目標)
        'bmig' => [
            'numeric' => ':attributeを正しく入力してください。',
            'between' => ':attributeは:minから:maxまでの数値のみ有効です。',
            'regex' => ':attributeは小数第二位まで有効です。'
        ],
        // 体脂肪率(目標)
        'bodyfatg' => [
            'numeric' => ':attributeを正しく入力してください。',
            'between' => ':attributeは:minから:maxまでの数値のみ有効です。',
            'regex' => ':attributeは小数第二位まで有効です。'
        ],
        // 筋肉量(目標)
        'muscleg' => [
            'numeric' => ':attributeを正しく入力してください。',
            'between' => ':attributeは:minから:maxまでの数値のみ有効です。',
            'regex' => ':attributeは小数第二位まで有効です。'
        ]
    ],

    // :attribute定義
    'attributes' => [
        //* 認証系
        'name' => 'ユーザID',
        'gender' => '性別',
        'birthday' => '生年月日',
        'stature' => '身長',
        'weight' => '体重',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード',
        //* 記録
        // 記録日
        'record_date' => '記録日',
        // トレーニングメニュ－記録
        'trdata.tm_add_preset' => 'プリセット',
        'trdata.tm_preset_name' => 'プリセット名',
        'trdata.tm_item_name_h.*' => '項目名',
        'trdata.tm_item_name.*' => '入力値',
        // 摂取カロリー記録
        'cldata.cl_item_name1.*' => '食品名',
        'cldata.cl_item_name2.*' => '栄養成分量',
        // 画像記録
        'pidata.upload_file.*.0' => 'ファイル名',
        'pidata.upload_file.*.1' => 'ファイルタイプ',
        'pidata.upload_file.*.2' => 'ファイル',
        // 身体情報
        'bidata.stature' => '身長',
        'bidata.weight' => '体重',
        'bidata.bodyfat' => '体脂肪率',
        'bidata.muscle' => '筋肉量',
        //* 目標設定
        'weightg' => '体重',
        'bmig' => 'BMI',
        'bodyfatg' => '体脂肪率',
        'muscleg' => '筋肉量'
    ],
];
