<?php
     $dsn = 'mysql:dbname=php_book_app;host=localhost;charset=utf8mb4';
     $user = 'root';
     $password = '';

     try {
          $pdo = new PDO($dsn, $user, $password);

          // 動的に変わる値をプレースホルダに置き換えたDELETE文を用意する
          $sql_delete = 'DELETE FROM books WHERE id = :id';
          $stmt_delete = $pdo->prepare($sql_delete);

          // bindValue()メソッドを使って実際の値をプレースホルダにバインドする（割り当てる）
          $stmt_delete ->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

          // SQL文の実行
          $stmt_delete ->execute();

          // 追加した件数を取得する
          $count = $stmt_delete ->rowCount();

          $message = "商品を{$count}件削除しました。";

          // 書籍一覧ページにリダイレクト
          header("Location: read.php?message={$message}");
     } catch (PDOException) {
          exit($e->getMessage());
     }
?>