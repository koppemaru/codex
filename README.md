# codex

このリポジトリには、PHPで動作する簡単な在籍管理CLIアプリ `enrollment.php` が含まれています。

## 使い方

1. PHP がインストールされた環境で以下のコマンドを実行します。

```
# 在籍一覧を表示
php enrollment.php list

# 学生を追加
php enrollment.php add 001 "山田 太郎"

# 学生を削除
php enrollment.php remove 001
```

2. 学生データは `students.json` に保存されます。
