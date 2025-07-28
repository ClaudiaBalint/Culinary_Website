<?php
include('../config/dbcon.php');
include('../functions/myfunctions.php');


if(isset($_POST['updateProfileBtn'])) { 

    
    $user_id = $_POST['user_id'];

    $name = $_POST['name'];
    $prenume = $_POST['prenume'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress'];
    $pincode = $_POST['pincode'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $update_user_query = "UPDATE users SET name='$name', prenume='$prenume', phone='$phone',
    adress='$adress', pincode='$pincode', password='$password', email='$email'
    WHERE id='$user_id' ";
 
    $update_user_query_run = mysqli_query($con, $update_user_query);
    
    if($update_user_query_run) {
        redirect("../myaccount.php","Profilul a fost actualizat cu succes!");
    }
    else {
        redirect("../myaccount.php","Ceva nu a functionat.");
    }
   
}
else if(isset($_POST['newsletterBtn'])){
    
    $email = $_POST['newsletterEmail'];

    $check_query = "SELECT * FROM news_letter WHERE email = '$email'";
    $result = mysqli_query($con, $check_query);


    if(mysqli_num_rows($result) > 0) {
        redirect("../categorii.php","Adresa se află deja în baza de date!");
      
    } else {
       
        $insert_query = "INSERT INTO news_letter (email) VALUES ('$email')";

        if (mysqli_query($con, $insert_query)) {
            redirect("../categorii.php","Adresa de email a fost adăugată cu succes în baza de date.");
           
        } else {
            redirect("../categorii.php","Ceva nu a functionat.");
        }
    }

}
else if(isset($_POST['parereBtn'])){
    if(isset($_POST['nume_parere'], $_POST['parere'], $_POST['user_id'], $_POST['recipe_id'])) {
        $nume = mysqli_real_escape_string($con, $_POST['nume_parere']);
        $parere = mysqli_real_escape_string($con, $_POST['parere']);
        $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
        $recipe_id = mysqli_real_escape_string($con, $_POST['recipe_id']);

        $sql = "INSERT INTO reviews (name, id_user, id_reteta, parere, created_at) VALUES ('$nume', '$user_id', '$recipe_id', '$parere', NOW())";
        $insert_query = mysqli_query($con, $sql);

        if($insert_query) {
            echo json_encode(array("status" => "success", "message" => "Recenzie adăugată cu succes!"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Ceva nu a funcționat. Te rugăm să încerci din nou mai târziu."));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Cerere incorectă. Te rugăm să completezi toate câmpurile."));
    }
}
?>
