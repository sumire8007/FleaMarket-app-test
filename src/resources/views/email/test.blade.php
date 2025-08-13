<!DOCTYPE html>
<html lang="ja">
  <style>
    body {
      background-color: #fffacd;
    }
    h1 {
      font-size: 16px;
      color: #ff6666;
    }
    #button {
      width: 200px;
      text-align: center;
    }
    #button a {
      padding: 10px 20px;
      display: block;
      border: 1px solid #2a88bd;
      background-color: #ffffff;
      color: #2a88bd;
      text-decoration: none;
      box-shadow: 2px 2px 3px #f5deb3;
    }
    #button a:hover {
      background-color: #2a88bd;
      color: #ffffff;
    }
  </style>
  <body>
    <h1>「{{ $item->item_name }}」が取引評価されました!</h1>
    <p>{{ $loginUser->name }}さんを評価して、取引を完了させてください。</p>
    <p id="button">
      <a href="https://localhost/">今すぐ確認する</a>
    </p>
  </body>
</html>