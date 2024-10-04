<?php
// 1. DB接続
include("funcs.php");
$pdo = db_conn();

// 2. データ取得SQL作成
$sql = "SELECT * FROM gs_profile_table ORDER BY indate DESC";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// 3. データ表示部分
$view = "";
if ($status === false) {
    sql_error($stmt);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<div class="profile-card">';
        $view .= '<h2>' . h($result['name']) . '</h2>';
        $view .= '<p><strong>Email:</strong> ' . h($result['email']) . '</p>';
        $view .= '<p><strong>専門分野:</strong> ' . h($result['skill']) . '</p>';
        $view .= '<p><strong>経験年数:</strong> ' . h($result['experience']) . '年</p>';
        $view .= '<p><strong>スキル:</strong><br>' . h($result['appeal']) . '</p>';
        $view .= '<p><em>登録日: ' . h($result['indate']) . '</em></p>';
        $view .= '<a href="detail.php?id=' . h($result['id']) . '">[更新]</a>';
        $view .= ' ';
        $view .= '<a href="delete.php?id=' . h($result['id']) . '">[削除]</a>';
        $view .= '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メンバー一覧</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">メンバー登録</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="member-list">
            <h1>メンバー一覧</h1>
            <div class="profiles">
                <?= $view ?>
            </div>
        </section>
    </main>

    <footer>
        <p>© 2024 COOPRO. All rights reserved.</p>
    </footer>
</body>
</html>
