# coachtechフリマ
## 環境構築
**◽️Dockerビルド**

```
git clone git@github.com:sumire8007/FleaMarket-app-test.git
```
```
docker-compose up -d --build
```
 > *MacのM1・M2チップのPCの場合、`no matching manifest for linux/arm64/v8 in the manifest list entries`のメッセージが表示されビルドができないことがあります。
エラーが発生する場合は、docker-compose.ymlファイルの「mysql」内に「platform」の項目を追加で記載してください*
``` bash
mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0.26
    environment:
```


**◽️Laravel環境構築**

1.　PHPコンテナにアクセス
```
docker-compose exec php bash
```
2.　composerをインストール
```
composer install
```
3. .env.exampleファイルから、envを作成し、環境変数を変更 (下記に変更)
```
cp .env.example .env
```
【.envファイル 変更箇所】

   DB_HOST=mysql
   
   DB_DATABASE=laravel_db
   
   DB_USERNAME=laravel_user
   
   DB_PASSWORD=laravel_pass
   
4.　KEYを与える
  ```
  php artisan key:generate
  ```
5.  ```exit```

**◽️MySQL、laravel_userに権限を与えるために下記を実行**
1. MySQLコンテナにアクセス
   ```
   docker-compose exec mysql bash
   ```
2. MySQLにログイン　　※パスワードは、docker-compose.ymlに記載
   ```
   mysql -u root -p
   ```           
5. ユーザーに権限を付与
   ```
   GRANT ALL PRIVILEGES ON laravel_db.* TO 'laravel_user'@'%';
   ```
  
4. 権限を反映
```
　  FLUSH PRIVILEGES;
   ```
  
5. ```exit;```
   
**◽️テーブルの作成(マイグレーション)**
```
docker-compose exec php bash
```
```
php artisan migrate
```

**◽️storage保存するため、リンクを作成**
```
php artisan storage:link
```
  > *itemとuser画像をstorageに保存します。
    src/storage/app/publicディレクトリ下に[items] ・　[users]ディレクトリを作成してください。*
    
   ```
   mkdir src/storage/app/public/items
   mkdir src/storage/app/public/users
   ```
  
**◽️ダミーデータの作成**
```
php artisan db:seed
```
**◽️stripe環境構築**

1. .env ファイル内の# Stripe API keys以下にAPIキーを与える

   公式DOCSを参照ください。
   https://docs.stripe.com/keys#reveal-an-api-secret-key-for-test-mode
   
   > STRIPE_PUBLISHABLE_KEY=
   > 
   > STRIPE_SECRET_KEY=
   >
2. stripeをインストール
   ```
   composer require stripe/stripe-php
   ```
   
3. キャッシュをクリアし、設定を反映する
   ```
   php artisan config:clear
   php artisan cache:clear
   ```
4. サーバーを起動
   ```
   php -S localhost:4242
   ```

## PHPUnitテストの実行
1. MySQLコンテナにアクセス後、MySQLにログイン ※パスワードは、docker-compose.ymlに記載
   ```
   docker-compose exec mysql bash
   mysql -u root -p
   ```
2. データベース(demo_test)の作成 
   ```
   CREATE DATABASE demo_test;
   SHOW DATABASES;
   ```
   ※データベース(demo_test)が作成されていることが確認出来たら、MySQLコンテナから抜けてください。
   ```exit;```
   
3. テスト用の.envファイル作成
   ```
   docker-compose exec php bash
   cp .env .env.testing
   ```
4. 環境変数を変更
   ```
    APP_ENV=test
    APP_KEY=

    DB_DATABASE=demo_test
    DB_USERNAME=root
    DB_PASSWORD=root
   ```
5. KEYを与える
   ```
   php artisan key:generate --env=testing
   ```
6. キャッシュの削除
   ```
   php artisan config:clear
   ```
7. テスト用のテーブル作成
   ```
   php artisan migrate --env=testing
   ```
8. テストの実行
  ```
   vendor/bin/phpunit --testdox
  ```

   
   
## 使用技術
• PHP 8.2.8

• Laravel 8.83.8

• MySQL 8.0.26


## URL

・開発環境：http://localhost/

・ phpMyAdmin : http://localhost:8080/

・フリマアプリホーム: http://localhost/

・ユーザー登録　: http://localhost/register


**ER図**

