<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録完了画面</title>
    <link rel="stylesheet" href="css/Finish.css">
</head>
<body>

    <header>
        <img style="user-select: none;" src="img/logo.png" class="logo" alt="" width="100" height="65">
        <nav class="logout">
            <a href="ManageLogin.php">ログアウト</a>
        </nav>
    </header>
    <main class="wrapper">
        <section class="body">
        <?php
            try{
                $sql=$pdo->prepare("delete from gameconsole where GameID=?");
                $sql->execute([$_POST['delID']]);
                echo '<label style="color:red;">商品削除が完了しました。</label>';
                $category=$_POST['delcategory'];
                $Name=$_POST['delname'];
                $path1="./img/{$category}/{$Name}";
                $imageDirectory = 'img/' . $category . '/'.$Name.'/';
                $images = glob($imageDirectory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                if(file_exists($path1)){
                    foreach ($images as $image) {
                       unlink($image);
                    }
                }
            }catch(Exception $e){
                echo '<label style="color:red;">購入詳細に保存されているため、削除ができません！</label>';
            }
        ?>
        </section>
        <section class="foot">
            <form action="ManageList.php" method="post">
                <button class="register" type="submit">商品一覧へ</button>
            </form>
        </section>
    </main>
</body>
</html>