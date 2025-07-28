<?php

include('config/dbcon.php');

if (isset($_POST['verify_code']) && isset($_POST['email'])) {
    $entered_code = mysqli_real_escape_string($con, $_POST['verification_code']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check_code = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email' AND token_code = '$entered_code'") or die('query failed');

    if (mysqli_num_rows($check_code) == 0) {
        mysqli_query($con, "UPDATE `users` SET token_code = NULL WHERE email = '$email'");

        header('location: login.php');
    } else {
        $message[] = 'Cod de verificare incorect!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conectare</title>

    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style.css">


    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('img/banner/fundal.png');
            height: 100vh;
        }

        .form-container {
            text-align: center;
        }

        .message {
            background-color: #f2dede;
            color: #a94442;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            position: relative;
        }

        .message span {
            margin-right: 10px;
        }

        .btn {
            background-color: #E65C19;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #CD5C08;
        }

        .box {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        h2 {
        color: #673516;
        font-family: "Papyrus", sans-serif;
        font-weight: bold; 
        font-size: 33px; 
}
    </style>

</head>

<body>

    <?php

    if (isset($message)) {
        foreach ($message as $message)
            echo '<div class="message">
                    <span>' . $message . '</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>';
    }
    ?>

<div class="form-container">
        <form action="" method="post">
            <h2>Validare email</h2>
            <input type="hidden" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
            <input type="text" name="verification_code" placeholder="Introduceți codul de verificare" required class="box">
            <br>
            <br>
            <br>
            <input type="submit" name="verify_code" value="Verificare cod" class="btn">
        </form>
    </div>

</body>

</html>