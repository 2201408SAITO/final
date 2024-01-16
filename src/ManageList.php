<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
    <link rel="stylesheet" href="css/List.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
</head>
<body>
    <?php
                echo '<header>';
                echo '<img style="user-select: none;" src="img/logo.png" class="logo" alt="" width="100" height="65">';
                echo     '<nav class="logout">';
                echo 'こんにちは、<strong>'.$_SESSION['manager']['name'].'</strong>&nbsp;';
                echo         '<a href="ManageLogin.php">ログアウト</a>';
                echo     '</nav>';
                echo '</header>';
 
                echo '<main class="wrapper">';
                echo    '<section class="head">';
                echo        '<h1>商品一覧</h1>';
                echo    '</section>';
                echo    '<section class="body">';
               
                $delete = "return confirm('削除しますか？')";
                echo '<table><thead><tr><th width="8%">ID</th><th  width="18%">ゲーム機名</th><th  width="10%">発売年</th><th  width="7%">価格</th><th  width="5%">販売元</th><th width="20%">商品画像</th><th  width="10%">動作</th></tr></thead>';
                    echo '<tbody>';
                    foreach ($pdo->query('SELECT gameconsole. * , CoName FROM gameconsole INNER JOIN publisher ON gameconsole.CoID = publisher.CoID') as $row) {
                        echo '<tr>';
                            $CoName=$row['CoName'];
                            $Name=$row['Name'];
                            $path="./img/{$CoName}";
                            $path1="./img/{$CoName}/{$Name}";
                            if(!file_exists($path)){
                                mkdir("./img/{$CoName}", 0777);
                            }
                            if(!file_exists($path1)){
                                mkdir("./img/{$CoName}/{$Name}", 0777);
                            }
                            echo '<td class="center"  style="word-break: break-word">'.$row['GameID'].'</td>';
                            echo '<td style="word-break: break-word">'.$row['Name'].'</td>';
                            echo '<td style="word-break: break-word">'.$row['ReleaseYear'].'</td>';
                            echo '<td style="word-break: break-word"><strong>'.$row['Price'].'</strong></td>';
                            echo '<td class="center" style="word-break: break-word">'.$row['CoName'].'</td>';
                            echo '<td style="word-break: break-word">';
                            $imageDirectory = 'img/' . $CoName . '/'.$Name.'/';
                       
                            // 画像ファイルを取得
                            $images = glob($imageDirectory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                       
                            if (!empty($images)) {
                                foreach ($images as $image) {
                                    $fileName = basename($image);
                                    echo '<a style="cursor:zoom-in;" href="' . $image . '" data-lightbox="group"><img src="' . $image . '" alt="' . $fileName . '" width="65" height="65"></a>';
                                }
                            } else {
                                echo 'No images';
                            }
                            echo '</td>';
                            echo '<td class="center">';
                                echo '<form action="ManageUpdate.php" method="post">';
                                    echo '<input type="hidden" name="id" value="'.$row['GameID'].'">';
                                    echo '<button class="up" type ="submit">更新</button>';
                                echo '</form>';
                                echo '<form action="ManageDeleteFinish.php" method="post">';
                                    echo '<input type="hidden" name="delcategory" value="'.$row['CoName'].'">';
                                    echo '<input type="hidden" name="delname" value="'.$row['Name'].'">';
                                    echo '<input type="hidden" name="delID" value="'.$row['GameID'].'">';
                                    echo '<button onclick="'.$delete.'" class="del" type ="submit">削除</button>';
                                echo '</form>';
                        echo '</td></tr>';
                    }
                    echo '</tbody>';
                echo '</table>';
            echo '</section>';
            echo '<section class="foot">';
            echo     '<form action="ManageRegister.php" method="post">';
            echo         '<button class="register" type="submit">登録</button>';
            echo     '</form>';
            echo '</section>';
            echo '</main>';
        ?>
    </main>
</body>
</html>