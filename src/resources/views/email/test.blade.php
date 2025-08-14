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
  </style>
  <body>
    <h1>「{{ $item->item_name }}」が取引評価されました!</h1>
    <p>{{ $loginUser->name }}さんを評価して、取引を完了させてください。</p>
  </body>
</html>