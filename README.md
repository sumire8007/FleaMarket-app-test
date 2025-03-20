# coachtechフリマ
## 環境構築
**Dockerビルド**

```
  git clone git@github.com:sumire8007/FleaMarket-app-test.git
```
```
 docker-compose up -d --build
```
   
＊MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて docker-compose.ymlファイルを編集してください。

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
5. ```exit```

**◽️MySQL、laravel_userに権限を与えるために下記を実行**
1. docker-compose exec mysql bash
2. mysql -u root -p 　            ※パスワードは、docker-compose.ymlに記載
3. ユーザーに権限を付与
   
　　GRANT ALL PRIVILEGES ON laravel_db.* TO 'laravel_user'@'%';
  
4. 権限を反映
   
　　FLUSH PRIVILEGES;
  
5. exit;
   
**◽️テーブルの作成**
1. php artisan migrate

**◽️storage保存するためリンクを作成**
```
php artisan storage:link
```
   ※itemとuser画像をstorageに保存します。

   ※もし、src/storage/app/publicディレクトリに[items],[users]ディレクトリが無い場合、ディレクトリ作成します。
   ```
   mkdir src/storage/app/public/items
   mkdir src/storage/app/public/users
   ```
  
**◽️ダミーデータの作成**
```
php artisan db:seed
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

