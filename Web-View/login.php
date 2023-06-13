<?php
session_start();

require "../function/connect.php";

// Direct ke halaman utama lagi jika pengguna sudah login
if (isset($_SESSION['session_username'])) {
    header("Location: index.php");
    exit();
}

$err = "";
$username = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == '' || $password == '') {
        $err .= "<li>*Silakan masukkan username dan password.</li>";
    } else {
        $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$username'";
        $result = mysqli_query($koneksi, $sql);
        $row = mysqli_fetch_array($result);

        if (!$row) {
            $err .= "<p>*Username atau email <b>$username</b> tidak tersedia.</p>";
        } elseif ($row['password'] != md5($password)) {
            $err .= "<p>*Password yang dimasukkan tidak sesuai.</p>";
        }

        if (empty($err)) {
            $_SESSION['session_username'] = $row['username'];
            header("Location: index.php");
            exit();
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/style-login.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../../img/icon.png">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            background-image: url("../assets/image/login-bg.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            font-family: "Poppins", sans-serif;
        }

        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 350px;
            padding: 40px;
            background: rgba(223, 223, 223, 1);
            opacity: 95%;
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        .login-box h2 {
            margin: 0 0 30px;
            padding: 0;
            color: black;
            text-align: center;
            font-size: 25px;
        }

        .user-box {
            position: relative;
            color: black;
        }

        .user-box input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            color: black;
            margin-bottom: 30px;
            border: none;
            border-bottom: 1px solid black;
            outline: none;
            background: transparent;
        }

        .user-box label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px 0;
            font-size: 16px;
            color: black;
            pointer-events: none;
            transition: 0.5s;
        }

        .user-box input:focus ~ label,
        .user-box input:valid ~ label {
            top: -20px;
            left: 0;
            color: black;
            font-size: 12px;
        }

        input[type="submit"] {
            background: transparent;
            border: none;
            outline: none;
            color: white;
            background: rgb(123, 122, 122);
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background: rgb(88, 88, 88);
        }

        footer {
            background-color: #333;
            color: #fff;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .footer-content {
            text-align: center;
        }

        .up {
            margin-top: 1px;
            margin-bottom: 0%;
            font-size: 15px;
        }

        .login-alert {
            font-size: 13px;
            text-align: center;
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h2>Login</h2>
    <form id="loginform" action="" method="post" role="form">
        <div class="user-box">
            <?php if ($err) { ?>
                <div class="login-alert">
                    <ul><?php echo $err ?></ul>
                </div>
            <?php } ?>
        </div>

        <div class="user-box">
            <input type="text" id="username" name="username" required="" value="<?php echo $username ?>">
            <label>Username</label>
        </div>

        <div class="user-box">
            <input type="password" id="password" name="password" required="">
            <label>Password</label>
        </div>

        <div class="user-box">
            <input type="submit" name="login" value="Login">
        </div>

        <p class="up">Tidak memiliki akun? <a style="color: blue;" href="sign-up.php">Sign up</a></p>
    </form>
    <br />
</div>
</body>
</html>
