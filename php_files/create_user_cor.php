<?php 

$input = file_get_contents("php://input");
$decode = json_decode($input, true);

$username = htmlentities($decode['username']);
$pwd = htmlentities($decode['pwd']);

$user_database_path = "../API/users.json";

if (file_exists($user_database_path)) {

    $user_data_get = file_get_contents($user_database_path);
    
    $user_data = json_decode($user_data_get);
    
    $id = count($user_data) + 1;

    $new_user = [
        "id" => $id,
        "username" => "{$username}",
        "password" => "{$pwd}",
        "profilePicture" => [],
        "favoriteGames" => [],
        "completedGames" => [],
        "ratedGames" => []
    ];
    array_push($user_data, $new_user);

    $data = json_encode($user_data, JSON_PRETTY_PRINT);

    file_put_contents($user_database_path,$data);
    echo json_encode(array("mags" => "Users Created Success", "status" => "true"));
    
}else{
    echo json_encode(array("mags" => "Database error!", "status" => "error"));
}



?>