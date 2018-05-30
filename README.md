AutoSave
==========
baserCMS Plugin  
Copyright 2014 Nextat Inc. <http://nextat.co.jp>

AutoSave（自動保存）は福岡生まれの日本産オープンソースCMS「baserCMS」のプラグインです。

[baser CMS - 国産オープンソース！フリー（無料）で『コーポレートサイトにちょうどいいCMS』](http://basercms.net)

固定ページとブログプラグインの新規登録ページにおいて入力データを自動保存し、再度新規登録画面を開いた際に復元するかどうかを選択を可能にします。

### 対応する baserCMSのバージョン
baserCMS 3系（3.0.0～）

### ライセンス
MITライセンス  <http://opensource.org/licenses/mit-license.php>

機能・仕様
-----------------
### v0.9.0  
- 自動保存間隔を30～300秒で指定可
- 固定ページ・ブログ個別に保存のオンオフ可
- サーバ側のDBではなくブラウザに保存  
   　　[store.js](https://github.com/marcuswestin/store.js)を利用（localStorage + IEで非対応の場合userData Behaviorでフォールバック）  
- ラジオボタン（公開・非公開など）、チェックボックス（ブログ投稿のタグなど）、画像ファイル（アイキャッチ画像など）の保存には非対応
- 動作確認：Internet Explorer 8以上, Mozzila FireFox, Google Chrome

### v1.0.0
- baserCMS4に対応
- ブログ新規追加・ブログ編集・固定ページ編集の3項目をオンオフできるように変更

### 対応予定
- ラジオボタンの値の保存
- チェックボックスの値の保存

### 対応予定なし
- ファイルの保存

インストール方法
------------
###zipファイルをダウンロードする方法
1. ダウンロードしたzipを解凍（GitHubからDLした場合はディレクトリ名をAutoSaveにリネームする）
2. AutoSaveディレクトリを{baserCMSのルート}/app/Plugins/の直下に設置
3. 管理画面からプラグインをインストール

###Gitでの導入方法
1. {baserCMSのルート}/app/Plugins/ディレクトリで下記コマンドを実行

    git clone https://github.com/NextatBCPlugins/AutoSave

2. 管理画面からプラグインをインストール

###参考URL
- [baser CMS - 国産オープンソース！フリー（無料）で『コーポレートサイトにちょうどいいCMS』](http://basercms.net)
- [プラグインのインストール | baser CMS](http://basercms.net/manuals/3/introductions/install_plugin)


外部ライブラリ
----------
下記ライブラリを利用させていただいています。

- store.js  - <https://github.com/marcuswestin/store.js>  
  　　Copyright (c) 2010-2013 Marcus Westin  
  　　Licensed under [the MIT License](http://opensource.org/licenses/mit-license.php)

依存ライブラリ
----------
baserCMSに含まれる各種ライブラリが管理画面で利用されることを前提としています。  
※ソースコードには含みません

- jQuery
- CKEditor