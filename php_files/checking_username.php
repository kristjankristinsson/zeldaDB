<?php

$input = file_get_contents("php://input");
$decode = json_decode($input, true);

$username = htmlentities($decode['username']);


$user_database_path = "../API/users.json";
if (file_exists($user_database_path)) {

    $user_data_get = file_get_contents($user_database_path);
    
    $user_data = json_decode($user_data_get);
    $array = [];
    foreach ($user_data as $value) {
        if ($value->username == $username) {
            
            $user = [
                    "id" => $value->id,
                    "username" => "{$value->username}",
                ];
            array_push($array, $user);
            
        }
    }
    if (!empty($array)) {
       
        echo json_encode(array("mags" => "Username Founded", "status" => "false"));

    } else {
        echo json_encode(array("mags" => "user does not found!", "status" => "true"));
    }
 
}else{
    echo json_encode(array("mags" => "Database error!", "status" => "error"));
}



?>