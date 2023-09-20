<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Nhập Quản Trị</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #313131;
            height: 600px;
        }

        #form-admin {
            width: 50%;
            margin: 0 auto;
            margin-top: 100px;
        }

        #form-admin form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            max-height: 80%;
            width: 60%;
            margin: 0 auto;
            border: black 1px solid;
            border-radius: 10px;
            background-color: #d9c8b4;
            text-align: center;
        }

        #form-admin form input[type=email],
        form input[type=password] {
            padding: 10px;
            margin: 5px;
            border: none;
            border-radius: 10px;
            width: 80%;
        }

        #form-admin form button {
            color: whitesmoke;
            background-color: #313131;
            padding: 10px;
            margin: 5px;
            width: 20%;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <div id="form-admin">
        <form action="<?= URL ?>admin/login" method="post">
            <h2>Admin</h2>
            <?= Security::csrf_token(); ?>
            <input name="email" class="email" type="email" placeholder="Email" required>
            <input name="password" class="psw" type="password" placeholder="Mật khẩu" required>
            <button>Gửi</button>
            <?php
            if (!empty($error)) {
            ?>
                <div>
                <p style="color: red; padding: 20px; background-color:#ffcac4; border: 1px solid #ff564a; border-radius: 5px"><?= $error; ?></p>
                </div>
            <?php
            }

            if (!empty($message)) {
            ?>
                <div>
                    <p style="color: green; padding: 20px; background-color:#75ff93; border: 1px solid #21ff51; border-radius: 5px"><?= $message; ?></p>
                </div>
            <?php
            }
            ?>
        </form>
    </div>
</body>

</html>