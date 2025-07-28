<?php
session_start();
include('../config/dbcon.php');

if(isset($_SESSION['auth_user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['scope']) && isset($_POST['recipe_id'])) {
        $scope = $_POST['scope'];
        $recipe_id = $_POST['recipe_id'];
        $user_id = $_SESSION['auth_user']['user_id']; // Folosește ID-ul utilizatorului în loc de nume

        $recipe_query = "SELECT users_likes, users_dislikes FROM retete WHERE id = $recipe_id";
        $recipe_result = mysqli_query($con, $recipe_query);
        $recipe = mysqli_fetch_assoc($recipe_result);

        if ($scope == "like") {
            if (strpos($recipe['users_likes'], $user_id) !== false) {
                // Utilizatorul a dat deja like, deci îl eliminăm
                $updated_users_likes = str_replace($user_id . ",", "", $recipe['users_likes']);
                $query = "UPDATE retete SET users_likes = '$updated_users_likes' WHERE id = $recipe_id";
                mysqli_query($con, $query);
                echo(403); // Utilizatorul a dat deja like
            } else {
                // Utilizatorul nu a dat like, așa că îl adăugăm
                $updated_users_likes = $recipe['users_likes'] . $user_id . ",";
                $query = "UPDATE retete SET users_likes = '$updated_users_likes' WHERE id = $recipe_id";
                
                // În cazul în care utilizatorul a dat deja dislike, eliminăm dislike-ul
                $updated_users_dislikes = str_replace($user_id . ",", "", $recipe['users_dislikes']);
                $query_dislike = "UPDATE retete SET users_dislikes = '$updated_users_dislikes' WHERE id = $recipe_id";
                mysqli_query($con, $query_dislike);
                
                mysqli_query($con, $query);
                echo(200); // Răspuns 200 pentru succes
            }
        } elseif ($scope == "dislike") {
            if (strpos($recipe['users_dislikes'], $user_id) !== false) {
                // Utilizatorul a dat deja dislike, deci îl eliminăm
                $updated_users_dislikes = str_replace($user_id . ",", "", $recipe['users_dislikes']);
                $query = "UPDATE retete SET users_dislikes = '$updated_users_dislikes' WHERE id = $recipe_id";
                mysqli_query($con, $query);
                echo(403); // Utilizatorul a dat deja dislike
            } else {
                // Utilizatorul nu a dat dislike, așa că îl adăugăm
                $updated_users_dislikes = $recipe['users_dislikes'] . $user_id . ",";
                $query = "UPDATE retete SET users_dislikes = '$updated_users_dislikes' WHERE id = $recipe_id";
                
                // În cazul în care utilizatorul a dat deja like, eliminăm like-ul
                $updated_users_likes = str_replace($user_id . ",", "", $recipe['users_likes']);
                $query_like = "UPDATE retete SET users_likes = '$updated_users_likes' WHERE id = $recipe_id";
                mysqli_query($con, $query_like);
                
                mysqli_query($con, $query);
                echo(200); // Răspuns 200 pentru succes
            }
        }
    } else {
        echo(400); // Răspuns 400 pentru cerere incorectă
    }
} else {
    echo(401); // Răspuns 401 pentru utilizator neconectat
}
?>
