<?php
$hostname = "http://localhost/magenta";
session_start();

if (isset($_SESSION['username'])) {
    header("Location:$hostname/mainPage");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In Page</title>
    <link rel="stylesheet" href="font/The Wild Breath of Zelda.otf">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body{
            background: url('images/extra_images/background.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .title{
            text-align: center;
            text-transform: uppercase;
            font-family: 'The Wild Breath of Zelda';
            color: white;
            font-size: 20px;
            line-height: 2;
            margin-top: 4%;
        }
        div#login_wrapper {
            width: 550px;
            background: rgba(4, 29, 20, 0.61);
            border-radius: 5px;
            margin: auto;
        }

        div#login_wrapper form {
            display: flex;
            flex-direction: column;
            padding: 50px 70px;
            margin-top: 50px;
        }

        div#login_wrapper form label {
            color: white;
            font-size: 20px;
            margin-bottom: 5px;
        }

        div#login_wrapper form input{
            padding: 10px;
            margin-bottom: 20px;
            background: #B4BDBD;
            border: none;
            border-radius: 3px;
        }
        .button span {
            color: white;
            font-size: 14px;
        }

        a#register_btn {
            padding: 8px 18px;
            background: #FFFFFF;
            border-radius: 3px;
            color: #4E514F;
            text-decoration: none;
            font-size: 16px;
        }

        input#submit_btn {
            padding: 8px 18px !important;
            background: #FFFFFF !important;
            border-radius: 3px;
            color: #4E514F;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            margin-left: 50px;
            margin-bottom: 0px !important;
        }
        span#error_username {
            margin-bottom: 10px;
            font-size: 18px;
            color: red;
        }
        span#error_pwd {
            margin-bottom: 10px;
            font-size: 18px;
            color: red;
        }
        h3#login_success {
        text-align: center;
        margin-top: 20px;
        color: white;
        font-size: 30px;
        }
        h3#login_error {
        text-align: center;
        margin-top: 20px;
        color: red;
        font-size: 30px;
        }
    
    </style>
</head>
<body>
    <header>
        <nav class="main-header">
            <div class="menu_wrapper">
                <div class="logo-wrapper">
                    <a href="index.php" class="logo">Zelda-DB</a>
                </div>
            </div>
        </nav>
    </header>
    
    <section>
        <div class="title">
            <h1>Discover the games you haven't played and track those you have.</h1>
            <h1>For all fans of The Legend of Zelda.</h1>
        </div>
        <div id="login_wrapper">
            <form action="" id="login_form" method="post">

                <label for="username">Username</label>
                <input type="text" name="username" id="username" />
                    <span id="error_username"></span>
                <label for="username">Password</label>
                <input type="password" name="pwd" id="password" />
                <span id="error_pwd"></span>
               <div class="button">
                    <span>Not a member yet? </span>
                    <a id="register_btn" href="register.php">Create Account</a>
                 <input type="submit" id="submit_btn" value="Sign In" />   
               </div> 
               <h3 id="login_success"></h3>
               <h3 id="login_error"></h3>
            </form>
            
        </div>
    </section>

<?php include "include/footer.php" ?>