# お問い合わせフォーム
## 環境構築
**Dockerビルド**
1. git clone git@github.com:sumire8007/FleaMarket-app-test.git
2. docker-compose up -d --build
   
＊MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて docker-compose.ymlファイルを編集してください。

**Laravel環境構築**
1. docker-compose exec php bash
2. composer install
3. .env.exampleファイルから、envを作成し、環境変数を変更 (下記に変更)

   【.envファイル】

   DB_HOST=mysql
   
   DB_DATABASE=laravel_db
   
   DB_USERNAME=laravel_user
   
   DB_PASSWORD=laravel_pass
   
4. php artisan key:generate
5. exit

**MySQL、laravel_userに権限を与えるために下記を実行**
1. docker-compose exec mysql bash
2. mysql -u root -p 　            ※パスワードは、docker-compose.ymlに記載
3. ユーザーに権限を付与
   
　　GRANT ALL PRIVILEGES ON laravel_db.* TO 'laravel_user'@'%';
  
4. 権限を反映
   
　　FLUSH PRIVILEGES;
  
5. exit;
   
**テーブルの作成**
1. php artisan migrate

**シーダデータの作成**
1. シーディングは下記ファイルのrunメソッドを変更

   ファイル：src/database/seeders/DatabaseSeeder.php）
   
   runメソッド内　：　$this->call(CategoriesTableSeeder::class);
   
2. php artisan db:seed

**ファクトリによるデータ作成**
1. ファクトリは下記ファイルのrunメソッドを変更

   ファイル：src/database/seeders/DatabaseSeeder.php
   
   runメソッド内　：　$this->call(ContactTableSeeder::class);
   
2. php artisan db:seed


   
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

