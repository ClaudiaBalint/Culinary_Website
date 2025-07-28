<?php

session_start();
include('../config/dbcon.php');

if(isset($_SESSION['auth'])){
       
    if(isset($_POST['scope'])){

        $scope=$_POST['scope'];
        switch($scope){
            
            case "add":
                $prod_id=$_POST['prod_id'];
                $prod_qty=$_POST['prod_qty'];
        
                $user_id=$_SESSION['auth_user']['user_id'];
        
                $chk_existing_cart = "SELECT * FROM carts WHERE prod_id='$prod_id' AND user_id='$user_id'";
                $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);
        
                if(mysqli_num_rows($chk_existing_cart_run) > 0){
                    echo "exist";
                    exit(); // Oprește execuția scriptului aici
                }
                else{
                    // Inserați retetaul în coșul de cumpărături
                    $insert_query="INSERT INTO carts (user_id,prod_id,prod_qty) VALUES ('$user_id','$prod_id','$prod_qty')";
                    $insert_query_run=mysqli_query($con,$insert_query);
        
                    if($insert_query_run){
                        echo 201; // Succes: reteta adăugat cu succes
                    }
                    else{
                        echo 500; // Eroare internă
                    }
                }
                break;
            case "update":
                $prod_id=$_POST['prod_id'];
                $prod_qty=$_POST['prod_qty'];

                $user_id=$_SESSION['auth_user']['user_id'];

                $chk_existing_cart = "SELECT * from carts where prod_id='$prod_id' and user_id='$user_id'   ";
                $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                if(mysqli_num_rows($chk_existing_cart_run)>0){
                    $update_query= "UPDATE carts SET prod_qty='$prod_qty' where prod_id='$prod_id' and user_id='$user_id'  ";
                    $update_query_run = mysqli_query($con,$update_query);
                    if($update_query_run){
                        echo 200;
                    }
                    else{
                        echo 500;
                    }
                }
                else{
                        echo "Ceva nu a functionat";
                }   
                break;

                case "delete":
                    $cart_id=$_POST['cart_id'];
                    $user_id=$_SESSION['auth_user']['user_id'];
                
                    $chk_existing_cart = "SELECT * from carts where id='$cart_id' and user_id='$user_id'   ";
                    $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);
                
                    if(mysqli_num_rows($chk_existing_cart_run) > 0){
                        // Obțineți retetaul asociat cărții pe care doriți să o ștergeți
                        $cart_data = mysqli_fetch_assoc($chk_existing_cart_run);
                        $prod_id = $cart_data['prod_id'];
                
                        // Ștergeți cartea din coș
                        $delete_query = "DELETE FROM carts WHERE id='$cart_id'";
                        $delete_query_run = mysqli_query($con, $delete_query);
                
                        if($delete_query_run){
                            // Actualizați numărul de like-uri pentru reteta
                            $update_likes_query = "UPDATE products SET likes = likes - 1 WHERE id = '$prod_id'";
                            $update_likes_query_run = mysqli_query($con, $update_likes_query);
                            
                            if($update_likes_query_run){
                                echo 200;
                            } else {
                                echo "Ceva nu a funcționat la actualizarea numărului de like-uri pentru reteta.";
                            }
                        } else {
                            echo "Ceva nu a funcționat la ștergerea retetei.";
                        }
                    } else {
                        echo "Ceva nu a funcționat. Nu s-a găsit reteta.";
                    }
                break;
            default:
                echo 500;
            
        }
    }

}
else{
    echo 401;
}

?>