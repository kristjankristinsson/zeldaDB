<?php

$input = file_get_contents("php://input");
$decode = json_decode($input, true);

$username = htmlentities($decode['username']);
$pwd = htmlentities($decode['pwd']);

$user_database_path = "../API/users.json";

if (file_exists($user_database_path)) {

    $user_data_get = file_get_contents($user_database_path);
    
    $user_data = json_decode($user_data_get);
    $array = [];
    foreach ($user_data as $value) {
        if ($value->username == $username & $value->password == $pwd) {
            
            $user = [
                    "id" => $value->id,
                    "username" => "{$value->username}",
                    "password" => "{$value->password}",
                    "profilePicture" => "{$value->profilePicture}",
                ];
            array_push($array, $user);
            
        }
    }
    if (!empty($array)) {
      
        session_start();
        $_SESSION['id'] = $array[0]["id"];
        $_SESSION['username'] = $array[0]["username"];
        $_SESSION['picture'] = $array[0]["profilePicture"];

        echo json_encode(array("mags" => "Log In success", "status" => "true"));

    } else {
        echo json_encode(array("mags" => "user does not found!", "status" => "false"));
    }
    
    
}else{
    echo json_encode(array("mags" => "Database error!", "status" => "error"));
}


?>