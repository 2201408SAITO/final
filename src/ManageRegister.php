<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
	<head>
    <meta http-equiv="Cache-Control" content="no-cache">
		<meta charset="UTF-8">
		<title>ゲーム機登録画面</title>
        <link rel="stylesheet" href="css/Register.css">
        <script src="./script/Register.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
        <div class="wrapper">
            <section class="head">
                <h2>ゲーム機登録</h2>
            </section>
            <form action = "ManageRegisterFinish.php" method = "post" enctype="multipart/form-data">
                <section class="body">
                    <div class="image">
                        <label>画像：</label>
                        <span id="imagePreviews" width=""></span>
                        <input type="button" id="loadFileXml" value="画像" class="imageButton" onclick="document.getElementById('fileInput').click();" />
                        <input type="file" style="display:none;" name="files[]" id="fileInput" multiple="multiple" onchange="previewImages()">
                    </div>

                        
                    <div>
                    <label>販売元：</label>
                        <select name="category" class="input-box-option" style="padding: 5px;" required="required">
                          <option selected value="">選んでください</option>
                          <?php
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
                            echo  '<option value="'.$CoID.'">'.$CoName.'</option>';
                        }
                          ?>
                        </select>
                    </div>
                    <div>
                        <label>商品名：</label>
                        <input name="Name" type="text" class="input-box"  style="padding: 5px;" placeholder="商品名を入力してください" maxlength="50" required="required">
                    </div>
                    <div>
                        <label>発売年：</label>
                        <input name="ReleaseYear" type="text" class="input-box-number"  style="padding: 5px;" placeholder="発売年" required="required"  maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g,'$1');"/>年
                    </div>
                    <div>
                        <label>価格：</label>
                        <input  name="Price" type="text" class="input-box-number" style="padding: 5px;" placeholder="価格" required="required"maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g,'$1');"/>円
                    </div>

                </section>
                <section class="foot">
                    <button class="register" onclick="location.href='ManageList.php'" type="submit">戻る</button>
                    <button class="register" type="submit">登録</button>
                </section>
            </form>
        </div>
    </body>
</html>