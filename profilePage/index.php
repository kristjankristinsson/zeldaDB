<?php include "../include/header.php";

$api = "../API/users.json";
$get_data = file_get_contents($api);
$data = json_decode($get_data);

$game_url = "../API/game_database.json";
$get_games = file_get_contents($game_url, true);
$data_games = json_decode($get_games);
foreach($data as $val){
    if ($val->id == $_SESSION['id']) {
?>

<section id="profile_page_wrapper">
    <div class="container">

        <div class="img_wrapper">
            <img src="<?php echo ($_SESSION['picture'] !== "") ? "../images/profile/".$_SESSION['picture'] : "../images/profile/profilePic.jpg"; ?> " alt="Profile Picture">

            <div class="file_change_div">
                <img src="../images/extra_images/edit-button.svg" alt="edit button" />
                <form id="form_img" action="../php_files/upload_img_cor.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="file_img" id="file_img">
                </form>
            </div>

        </div>

        <div class="username_wrapper">
            <div class="username_show">
                <h4><?php echo $_SESSION['username']?></h4>
                <button type="button" id="change_username" onclick="toggle_form()">Change username</button>
            </div>

            <form action="../php_files/change_username_cor.php" method="post" id="username_check_form" style="display: none;">
                <input type="text" name="username" id="username" placeholder="New Username">
                <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                <input type="submit" id="submit_btn_change" value="Change">
            </form>
            <p id="error_username"></p>
        </div>

</section>
<div class="delete_btn">
    <a href="#">Delete account</a>
</div>

<script type="text/javascript">

    const username_input = document.getElementById("username");
   
    // function for username checking
    username_input.addEventListener("keyup",(e)=>{
        const username = username_input.value;
        const data = {
            username : username
        }
        const jsonData = JSON.stringify(data);

        fetch("../php_files/checking_username.php",{
            method : "POST",
            body : jsonData,
            headers : {
                "Content-type" : "application/json"
            }
        }).then((response)=> response.json()).then((data)=>{
            
            if (data.status === "false") {
                document.getElementById("error_username").innerHTML="Username taken";
                document.getElementById("submit_btn_change").setAttribute("disabled",true);
    
            }else{
                document.getElementById("error_username").innerHTML="";
                document.getElementById("submit_btn_change").removeAttribute("disabled");
            }

        }).catch((error)=>{
            console.log(error);
        })
    });


    document.getElementById("file_img").addEventListener("change",(e)=>{
        e.preventDefault();
        document.getElementById("form_img").submit();
    });


</script>
<?php }
}?>
</body>
</html>