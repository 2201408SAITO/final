<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
	<head>
    <meta http-equiv="Cache-Control" content="no-cache">
		<meta charset="UTF-8">
		<title>ゲーム機更新画面</title>
        <link rel="stylesheet" href="css/Update.css">
        <script src="./script/Update.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
            function goBack() {
                location.href='ManageList.php';
            }
        </script>
	</head>
	<body>
        <div class="wrapper">
            <section class="head">
                <h2>ゲーム機更新</h2>
            </section>
            <?php
                $l = "location.href='ManageList.php'";
                $file = "fileInput";
                $s = "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g,'$1');";
                $pdo=new PDO($connect, USER, PASS);
                $sql=$pdo->prepare('select gameconsole. * , CoName from gameconsole inner join publisher on gameconsole.CoID = publisher.CoID where GameID=?');
	            $sql->execute([$_POST['id']]);
                foreach($sql as $row){
                    echo '<form action = "ManageUpdateFinish.php" method = "post" enctype="multipart/form-data">';
                    echo     '<input type="hidden" name="GameID" value="'.$row['GameID'].'">';
                    echo     '<input type="hidden" name="OldCoID" value="'.$row['CoID'].'">';
                    echo     '<input type="hidden" name="OldName" value="'.$row['Name'].'">';
                    echo     '<section class="body">';
                    echo         '<div class="image">';
                    echo             '<label>画像：</label>';
                    $category=$row['CoName'];
                    $id=$row['Name'];
                    $imageDirectory = 'img/' . $category . '/'.$id.'/';
                    $images = glob($imageDirectory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                    if (!empty($images)) {
                        foreach ($images as $image) {
                            $fileName = basename($image);
                        echo '<img src="' . $image . '" class="UpdatedImages" alt="' . $fileName . '" width="65" height="65">';
                        }
                    }else{
                        echo 'No images';
                    }
                    echo             '<label style="margin-left: 20px;">新しい画像：</label>';
                    echo             '<span id="imagePreviews" width=""></span>';
                    echo             '<input type="button" id="loadFileXml" value="画像" class="imageButton" onclick="document.getElementById(\'' . $file . '\').click();" />';
                    echo             '<input type="file" style="display:none;" name="files[]" id="fileInput" multiple="multiple" onchange="previewImages()">';
                    echo         '</div>';
                    echo         '<div>';
                    echo         '<label>カテゴリ：</label>';
                    echo             '<select name="CoID" class="input-box-option" style="padding: 5px;">';
                    echo               '<option value="'.$row['CoID'].'" selected>'.$row['CoName'].'</option>';
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
                                        foreach($Co as $CoID => $CoName){
                    echo               '<option value="'.$CoID.'">'.$CoName.'</option>';
                                        }
                    echo             '</select>';
                    echo         '</div>';
                    echo         '<div>';
                    echo             '<label>ゲーム機名：</label><input type="text"  class="input-box"  style="padding: 5px;" placeholder="ゲーム機名を入力してください" name="Name" value="'.$row['Name'].'" required="required">';
                    echo         '</div>';
                    echo         '<div>';
                    echo             '<label>価格：</label><input type="text" class="input-box-number" style="padding: 5px;" placeholder="価格" required="required" name="Price" maxlength="6" oninput="'.$s.'" value="'.$row['Price'].'"/>円';
                    echo         '</div>';
                    echo         '<div class="explain">';
                    echo             '<label>発売年：</label><input type="text" class="input-box-number" style="padding: 5px;" placeholder="発売年" required="required" name="ReleaseYear" minlength="1977" maxlength="2024" oninput="'.$s.'" value="'.$row['ReleaseYear'].'"/>年';
                    echo         '</div>';
                    echo     '</section>';
                    echo     '<section class="foot">';
                    echo         '<input type="button" value="戻る" class="register" onclick="'.$l.'">';
                    echo         '<button class="register" type="submit">更新</button>';
                    echo     '</section>';
                    echo '</form>';
                }
            ?>
        </div>
    </body>
</html>
