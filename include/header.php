<?php
$hostname = "http://localhost/magenta";
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:$hostname");
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>The Game Zelda-DB</title>
    
    <!-- custom css -->
    <link rel="stylesheet" href="../css/styles.css" />
    <script type="text/javascript">
        const toggle =()=>{
            const target = document.querySelector("#sing_option");
            if (target.style.display === "none") {
            target.style.display = "block";
            } else {
            target.style.display = "none";
            }
        }
        const toggle_form =()=>{
             const target_form = document.querySelector("#username_check_form");
                if (target_form.style.display === "none") {
                    target_form.style.display="block";
                } else {
                    target_form.style.display="none";
                }
            }
    </script>
  </head>
  <body>
    
    <header>
        <nav class="main-header">
            <div class="menu_wrapper">
                <div class="logo-wrapper">
                    <a href="../mainPage/index.php" class="logo">Zelda-DB</a>
                </div>
                <ul class="menu-items">
                    <li><a href="../mainPage/index.php" class="active">Games</a></li>
                    <li><a href="../mycollection/index.php">My Collection</a></li>
                </ul>
            </div>
            <div class="profile_wrapper">
                <div class="user_name">
                    <a href="../profilePage/index.php"><?php echo $_SESSION['username'];?></a>
                </div>
                <div class="user_image" onclick="toggle()">
                    <img src="<?php echo ($_SESSION['picture'] !== "") ? "../images/profile/".$_SESSION['picture'] : "../images/profile/profilePic.jpg"; ?> " alt="">
                    <div class="below_option">
                        <ul id="sing_option" style="display: none;">
                            <li><a href="../profilePage/index.php?pid=<?php echo $_SESSION['id'];?>">Profile</a></li>
                            <li><a href="../php_files/logout.php">Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
