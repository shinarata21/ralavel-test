# バックエンド編課題

Laravelの環境を構築します。

## 開発環境

Dockerを使って環境を構築します。  

### Docker

以下のコマンドを実行します（[docker/docker-compose-dev.yml](./docker/docker-compose-dev.yml) ファイルを指定）。

```bash
# docker-compose-dev.yml ファイルを指定して実行
docker-compose -f users/{★ユーザー名}/05_laravel/docker/docker-compose-dev.yml up -d
```

#### 使用しているDockerイメージ

- PHP (`php:<version>-apache`)
  - <https://hub.docker.com/_/php?tab=tags>
  - composer (マルチステージビルドで使用しています)
    - <https://hub.docker.com/_/composer?tab=tags>
- MySQL
  - <https://hub.docker.com/_/mysql?tab=tags>
- phpMyAdmin
  - <https://hub.docker.com/r/phpmyadmin/phpmyadmin/tags>

### Laravel

Laravel関連のコマンドはDockerで用意した、WEBサーバー上で行います。

```bash
# ■ Git Bashで入力
# WEBサーバーに入るコマンド
docker exec -it training-laravel-web bash
```

#### composer install

```bash
# ■ WEBサーバーで入力
cd /var/www/app
# 「composer.json」、「composer.lock」に記載されているパッケージをvendorディレクトリにインストール
#   ※ 時間がかかるので注意。
#   ※ 「Package swiftmailer/swiftmailer is abandoned, you should avoid using it. Use symfony/mailer instead.」のメッセージが出ることがありますが問題なし。
composer install
```

`composer install` 実行後に「`Exception`」とか出ていると失敗しているので  
[05_laravel/app/vendor/](./app/vendor/)ディレクトリを削除して、再実行してみましょう。  
「`successfully`」が出ていれば成功です。

#### Laravel初期設定

```bash
# ■ WEBサーバーで入力
cd /var/www/app
# storage ディレクトリに読み取り・書き込み権限を与える（storage内に書き込み（ログ出力時等）に「Permission denied」のエラーが発生する）
chmod -R 777 storage/
```

#### 確認

- WEB ※ ポート番号は [`docker/.env`](./docker/.env) の `PORT_WEB` を参照
  - <http://localhost:8026/>
- phpMyAdmin ※ ポート番号は [`docker/.env`](./docker/.env) の `PORT_PHPMYADMIN` を参照
  - <http://localhost:8889>

### SQLクライアント

- `A5:SQL Mk-2`
  - <https://a5m2.mmatsubara.com/>
- 接続情報 ※ [`docker/.env`](./docker/.env) の情報にあわせて設定すること
  - ホスト名: `localhost`  ～  `IP` 参照 (localhost = 127.0.0.1)
  - ユーザーID: `root`
  - パスワード: `root`  ～  `DB_ROOT_PASSWORD` 参照
  - ポート番号: `3307`  ～  `PORT_DB` 参照

### データベースの確認

「[`app/.env`](./app/.env)」ファイルの`DB_DATABASE`のデータベースが実際に追加されていることを確認してください(`cbc_laravel`)。
# ralavel-test
