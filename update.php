<?php

// 1. POSTデータ取得
$id         = $_POST["id"];          // ID
$name       = $_POST["name"];        // 名前
$email      = $_POST["email"];       // メールアドレス
$skill      = $_POST["skill"];       // 専門分野
$experience = $_POST["experience"];  // 経験年数
$appeal     = $_POST["appeal"];      // アピールポイント

// 2. DB接続します
include("funcs.php");
$pdo = db_conn();

// 3. データ更新SQL作成
// テーブル名を gs_profile_table に修正
$sql = "UPDATE gs_profile_table SET name=:name, email=:email, skill=:skill, experience=:experience, appeal=:appeal WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);          // 名前
$stmt->bindValue(':email', $email, PDO::PARAM_STR);        // メール
$stmt->bindValue(':skill', $skill, PDO::PARAM_STR);        // 専門分野
$stmt->bindValue(':experience', $experience, PDO::PARAM_INT); // 経験年数（数値）
$stmt->bindValue(':appeal', $appeal, PDO::PARAM_STR);      // アピールポイント
$stmt->bindValue(':id', $id, PDO::PARAM_INT);              // ID

$status = $stmt->execute(); // 実行

// 4. データ登録処理後
if ($status == false) {
    sql_error($stmt);  // エラーハンドリング
} else {
    redirect("select.php");  // 成功した場合はselect.phpへリダイレクト
}


?>
