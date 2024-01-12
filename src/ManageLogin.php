<?php session_start(); ?>
<?php unset($_SESSION['manager']); ?>
<!DOCTYPE html>
<html lang="ja"> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理ログイン</title>
    <link rel="stylesheet" href="css/Login.css"> 
    <style>
        .error-message {
            color: red;
            text-align:center;

        }
    </style>
</head>
<body>
    <header>
    <img style="user-select: none;" src="img/logo.png" class="logo" alt="" width="100" height="65">
    </header>

    <div class="wrapper">
        <div class="box login">
            <h2>Login</h2>
            <form method="POST" action="ManageLogin.php">
                <div class="input-box">
                    <input type="text" name="id" required>
                    <label>社員ID</label>
                </div>
                <div class="input-box">
                    <input type="password" name="pass" required>
                    <label>Password</label>
                </div>
                <div class="error-message" id="error-msg"></div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>
    <?php
        require 'db-connect.php';
        if(!isset($_POST['logout'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST["id"];
                $pass = $_POST["pass"];
                $stmt = $pdo->prepare("SELECT * FROM employees WHERE employee_id = ?");
                $stmt->execute([$id]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    $mpass = $row["password"];
                    if ($mpass === $pass) {
                        // ログイン成功時の処理（ManageList.htmlへ遷移）
                        $_SESSION['manager']=[
                            'id'=>$row['employee_id'],'name'=>$row['employee_name'],'password'=>$row['password']];
                        echo '<script>window.location.replace("ManageList.php");</script>';
                        exit;
                    }else { 
                        // パスワードが一致しない場合のエラーメッセージ
                        echo '<script>document.getElementById("error-msg").innerHTML = "ログインに失敗しました.";</script>';
                    }
                } else {
                    // ユーザーIDが見つからない場合のエラーメッセージ
                    echo '<script>document.getElementById("error-msg").innerHTML = "ユーザーIDが存在しません.";</script>';
                }
            }
        }
    ?>
</body>
</html>


