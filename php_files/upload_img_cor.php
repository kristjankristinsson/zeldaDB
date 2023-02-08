<?php
$hostname = "http://localhost/magenta";

$extension = ['png', 'jpg', 'jpeg', 'svg', 'webp'];

$file_name = $_FILES['file_img']['name'];
$file_tmp_name = $_FILES['file_img']['tmp_name'];

if (!empty($file_name)) {

    $ext = pathinfo($file_name, PATHINFO_EXTENSION);

   if (in_array($ext,$extension)) {

        $new_name = time() . "-" . $file_name;
        $path = "../images/profile/$new_name";
        if(move_uploaded_file($file_tmp_name, $path)){

        $api = "http://localhost/magenta/API/users.json";

        session_start();
        $id = $_SESSION['id'];

        $json_data = file_get_contents($api,true);
        $data = json_decode($json_data);
        foreach ($data as $val) {
            
            if ($val->id == $id) {
                $val->profilePicture = $new_name;
            }
        }
        $updated_data = json_encode($data,JSON_PRETTY_PRINT);

        file_put_contents("../API/users.json", $updated_data);
        
        $_SESSION['picture'] = $new_name;

        header("Location:{$hostname}/profilePage/index.php");


        }else{
            header("Location:../index.php");
        }

   } else {
        header("Location:../index.php");
   }
   
}else{
    header("Location:../index.php");
}

?>