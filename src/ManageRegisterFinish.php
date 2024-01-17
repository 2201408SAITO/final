<?php require 'db-connect.php'; 
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ゲーム機登録完了画面</title>
    <link rel="stylesheet" href="css/Finish.css">
    <script src="./script/Register.js"></script>
</head>
<body>
    <main class="wrapper">
        <section class="body">
        <?php
                $categories = array(
                    1 => '家具',
                    2 => 'ゲーム機',
                    3 => '家電',
                    4 => '靴',
                    5 => 'おもちゃ',
                    6 => 'スマートフォン',
                    7 => '服',
                    8 => '本'
                );

                $Co =[
                    1 => '任天堂',
                    2 => 'SONY',
                    3 => 'Microsoft',
                    4 => 'エポック',
                    5 => 'バンダイ',
                    6 => 'セガ',
                    7 => 'Atari',
                    8 => 'NEC',
                    9 => 'SNK'
                ];

                $key=$_POST['category'];
                $category=$Co[$key];
                $name=$_POST['Name'];
                $path="./img/{$category}";
                $path1="./img/{$category}/{$name}";
                if(!file_exists($path)){
                    mkdir("./img/{$category}", 0777);
                }
                if(!file_exists($path1)){
                    mkdir("./img/{$category}/{$name}", 0777);
                }
                $target_dir = $path1."/";

                // ファイルが複数アップロードされた場合の処理
                $numFiles = count($_FILES['files']['name']);

                for ($i = 0; $i < $numFiles; $i++) {
                    $currentFile = $_FILES['files']['tmp_name'][$i];
                    $currentTarget = $target_dir . basename($_FILES['files']['name'][$i]);

                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($currentTarget, PATHINFO_EXTENSION));

                    if (file_exists($currentTarget)) {
                        $uploadOk = 0;
                    }

                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "PNG") {
                        $uploadOk = 0;
                    }

                    if ($uploadOk == 1) {
                        move_uploaded_file($currentFile, $currentTarget);
                    }
                }
                if($uploadOk == 0){
                    echo '<label>写真なしで</label>';
                }
                echo '<label>追加に成功しました</label>';
                $sql=$pdo->prepare('insert into gameconsole(Name,ReleaseYear,Price,CoID) value (?,?,?,?)');
                $sql->execute([$_POST['Name'],$_POST['ReleaseYear'],$_POST['Price'],$_POST['category']]);
                ?>
        </section>
        <section class="foot">
            <form action="ManageList.php" method="post">
                <button class="register" type="submit">ゲーム機一覧へ</button>
            </form>
        </section>
    </main>
</body>
</html>
