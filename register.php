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
        width: 100px;
        margin-left: auto;
        margin-bottom: 0px !important;
        }
        .register_inform {
            color: white;
        }

        .register_inform ul {
            margin-left: 25px !important;
            margin: 10px 0px;
        }
        span#error_username {
            margin-bottom: 10px;
            color: red;
            font-size: 18px;
        }
        span#error_pwd{
            margin-bottom: 10px;
            color: red;
            font-size: 18px;
        }
        h1#login_info {
            color: white;
            margin-top: 10px;
            text-align: center;
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
            <form action="" method="post" id="register_form">

                <label for="username">Username</label>
                <input type="text" name="username" id="username" />
                    <span id="error_username"></span>
                <label for="username">Password</label>
                <input type="password" name="pwd" id="password" />
                    <span id="error_pwd"></span>
                <div class="register_inform">
                    <p>Password must...</p>
                    <ul>
                        <li>Be at least 6 characters long.</li>
                        <li>Contain a lowercase letter.</li>
                        <li>Contain an uppercase letter.</li>
                        <li>Contain a number or special character.</li>
                    </ul>
                </div>
                <input type="submit" id="submit_btn" value="Sign In" />   
               <h1 id="login_info"></h1>
            </form>
        </div>
    </section>
    
<script type="text/javascript">
    // user registration functionally

const register_form = document.getElementById("register_form");

const username_input = document.getElementById("username");

const pwd_input = document.getElementById("password");
     var pass = true;   
    // function for username checking
    username_input.addEventListener("keyup",(e)=>{
        const username = username_input.value;
        const data = {
            username : username
        }
        const jsonData = JSON.stringify(data);

        fetch("php_files/checking_username.php",{
            method : "POST",
            body : jsonData,
            headers : {
                "Content-type" : "application/json"
            }
        }).then((response)=> response.json()).then((data)=>{
            
            if (data.status === "false") {
                document.getElementById("error_username").innerHTML="Username taken";
                
                pass = false;
            
            }else if(data.status === "error"){
                document.getElementById("login_error").innerHTML="Database Error";

            }else{
                document.getElementById("error_username").innerHTML="";
                pass = true;
            }

        }).catch((error)=>{
            console.log(error);
        })
    });

    pwd_input.addEventListener("keyup",(e)=>{
        const pwd = pwd_input.value;

        const containsUppercase =(str)=>{
            return /[A-Z]/.test(str);
        }
        const containsLowercase =(str)=>{
            return /[a-z]/.test(str);
        }
        
        if (pwd.length > 6 & containsLowercase(pwd) & containsUppercase(pwd)) {
            document.getElementById("error_pwd").innerHTML="";
            pass = true;
        }else if(pwd.length == 0){
            document.getElementById("error_pwd").innerHTML="";
        }else {
            document.getElementById("error_pwd").innerHTML="Weak Password!";
            pass = false;
        }


    });


    register_form.addEventListener("submit",(e)=>{
        e.preventDefault();

        const username = username_input.value;
        const pwd = pwd_input.value;
        
        if (username !== "" & pwd !== "") {
            if (pass === true) {
                
                const data ={
                    username: username,
                    pwd: pwd
                }
                const jsonData = JSON.stringify(data);

                fetch("php_files/create_user_cor.php",{
                    method:"POST",
                    body: jsonData,
                    headers:{
                        "Content-type":"application/json"
                    }
                }).then((response)=> response.json()).then((data)=>{
                    
                    if (data.status == "true") {
                        document.getElementById("login_info").innerHTML="The account has been created Now Please Log In.";
                        setInterval(()=>{window.location="index.php"},1000)
                    }else{
                        alert("Something is wrong.. Please try again!!")
                    }

                }).catch((error)=>{
                    console.log(error);
                })

            }else{
                alert("Something is wrong!Please try again!")
            }
        } else {
            alert("Working");
        }
      
    });
</script>
<?php include "include/footer.php" ?>