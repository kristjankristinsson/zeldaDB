<?php
$hostname = "http://localhost/magenta";

 $id = htmlentities($_POST['id']);
 $username = htmlentities($_POST['username']);

 if(!empty($username)){
    $api = "http://localhost/magenta/API/users.json";
        
        $json_data = file_get_contents($api,true);
        $data = json_decode($json_data);
        foreach ($data as $val) {
            
            if ($val->id == $id) {
                $val->username = $username;
            }
        }
        $updated_data = json_encode($data,JSON_PRETTY_PRINT);

        file_put_contents("../API/users.json", $updated_data);
        session_start();
        
        $_SESSION['username'] = $username;

        header("Location:{$hostname}/profilePage/index.php");

 }else{
    header("Location:{$hostname}");
 }





?>


