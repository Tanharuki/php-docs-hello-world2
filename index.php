<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>テキストファイルアップロード</title>
</head>
<body>
    <h2>テキストファイルアップロード</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="textfile" accept=".txt">
        <input type="submit" value="アップロード">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["textfile"])) {
        $uploadDir = "uploads/";
        $uploadFile = $uploadDir . basename($_FILES["textfile"]["name"]);
        
        // アップロードディレクトリが存在しない場合は作成
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // ファイルがテキストファイルかチェック
        $fileType = pathinfo($uploadFile, PATHINFO_EXTENSION);
        if ($fileType != "txt") {
            echo "<p>エラー: テキストファイル（.txt）のみアップロード可能です。</p>";
        } else {
            // ファイルを指定ディレクトリに移動
            if (move_uploaded_file($_FILES["textfile"]["tmp_name"], $uploadFile)) {
                echo "<p>ファイルが正常にアップロードされました: " . htmlspecialchars(basename($uploadFile)) . "</p>";
            } else {
                echo "<p>エラー: ファイルのアップロードに失敗しました。</p>";
            }
        }
    }
    ?>
</body>
</html>
