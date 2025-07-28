<?php
session_start();
include('../config/dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 

if(isset($_SESSION['auth'])){
    
    //Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

//required files
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';


    if(isset($_POST['palceOrderBtn'])){

        
        $name= mysqli_real_escape_string($con,$_POST['name']);
        $email= mysqli_real_escape_string($con,$_POST['email']);
        $phone= mysqli_real_escape_string($con,$_POST['phone']);
        $pincode= mysqli_real_escape_string($con,$_POST['pincode']);
        $adress= mysqli_real_escape_string($con,$_POST['adress']);
        $payment_mode=mysqli_real_escape_string($con,$_POST['payment_mode']);
        
        if($payment_mode=="card"){
            $_SESSION['message'] = "Trebuie prima data sa platesti pentru a putea plasa comanda!";
            header('Location: ../checkout.php');
            exit(0);
        }
        else if($payment_mode==""){
            $_SESSION['message'] = "Trebuie sa alegi o metoda de plata!";
            header('Location: ../checkout.php');
            exit(0);
        }


        if($name=="" || $email=="" || $phone=="" || $pincode=="" || $adress=="")
        {
            $_SESSION['message'] = "Toate campurile trebuie completate!";
            header('Location: ../checkout.php');
            exit(0);
        }


        $userId = $_SESSION['auth_user']['user_id'];
        $query= "SELECT c.id as cid ,c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price 
                from carts c, products p where c.prod_id=p.id and c.user_id='$userId' order by c.id desc ";
        $query_run = mysqli_query($con,$query);

    
        $totalPrice = 0;
        foreach($query_run as $citem)
        {
            $totalPrice += $citem['selling_price'] * $citem['prod_qty'];
        }

        $tracking_no = "".rand(111,999).substr($phone,2);

        $insert_query = "INSERT into orders (tracking_no, user_id, name, email, phone, adress, pincode, 
        total_price, payment_mode, payment_id) values ('$tracking_no','$userId','$name','$email',
        '$phone','$adress','$pincode','$totalPrice','$payment_mode','$payment_id')";

        $insesrt_query_run=mysqli_query($con,$insert_query);
        if( $insesrt_query_run){

            $order_id= mysqli_insert_id($con);
            foreach($query_run as $citem)
            {   
                $prod_id = $citem['prod_id'];
                $prod_qty = $citem['prod_qty'];
                $price = $citem['selling_price'];
                
                $insert_items_query = "INSERT INTO order_items (order_id, prod_id, qty, price) VALUES ('$order_id', '$prod_id', '$prod_qty', '$price')";
                $insert_items_query_run = mysqli_query($con, $insert_items_query);
               
                $product_query = "SELECT * FROM products WHERE id='$prod_id' LIMIT 1";
                $product_query_run = mysqli_query($con, $product_query);
                $productData = mysqli_fetch_array($product_query_run);
                $current_qty = $productData['qty'];

                $new_qty = $current_qty - $prod_qty;

                $updateQty_query = "UPDATE products SET qty='$new_qty' WHERE id='$prod_id'";
                $updateQty_query_run = mysqli_query($con, $updateQty_query);

            
            }

            $deleteCartQuery = "DELETE from carts where user_id='$userId' ";
            $deleteCartQuery_run = mysqli_query($con,$deleteCartQuery);


            if( $payment_mode == "cash"){
                $_SESSION['message']="Comanda a fost plasata cu succes!";
                header('Location: ../my-orders.php');

                $mail = new PHPMailer(true);
 
                //Server settings
                $mail->isSMTP();                              //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
                $mail->SMTPAuth   = true;             //Enable SMTP authentication
                $mail->Username   = 'danciudenisa12@gmail.com';   //SMTP write your email
                $mail->Password   = 'popi clwy ndyk gjf';      //SMTP password
                $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
                $mail->Port       = 465;                                    
            
                //Recipients
                $mail->setFrom('danciudenisa12@gmail.com','Ceramica'); // Sender Email and name
                $mail->addAddress('danciudenisa12@gmail.com');     //Add a recipient email  
                $mail->addReplyTo('danciudenisa12@gmail.com', 'Ceramica'); // reply to sender email
            
                //Content
                $mail->isHTML(true);               //Set email format to HTML
                $mail->Subject =  "Comanda $tracking_no"  ;// email subject headings
                $mail->Body    =  "Comanda cu numarul $tracking_no, in valoare de $totalPrice lei a fost plasata cu succes! ";//email message
                
                // Success sent message alert
                $mail->send();
                echo
                " 
                <script> 
                alert('Message was sent successfully!');
                document.location.href = 'index.php';
                </script>
                ";

                die();
            }
            else{
                echo 201;
            }
        }


    }

}
else{
    header('Location: ../index.php');
}


?>

