<?php 
session_start(); 

if(isset($_SESSION['auth'])){
    $_SESSION['message']="Esti deja conectat";
    header('Location: index.php');
    exit();
}

include('config/dbcon.php'); // include conexiunea la baza de date
require 'vendor/autoload.php'; // include fișierele PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function generateSecurityCode() {
    return mt_rand(100000, 999999); 
}

if(isset($_POST['register_btn'])) {
    $prenume = mysqli_real_escape_string($con, $_POST['prenume']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    $security_code = generateSecurityCode();

    // Verifică dacă parolele coincid
    if($password != $cpassword) {
        $_SESSION['message'] = "Parola confirmată nu se potrivește!";
    } else {
        // Inserează utilizatorul în baza de date
        $query = "INSERT INTO users (prenume, name, email, password, token_code) VALUES ('$prenume', '$name', '$email', '$password', '$security_code')";
        mysqli_query($con, $query);

        // Trimite un email de confirmare către utilizator
        $mailer = new PHPMailer(true);
        try {
            // Configurare SMTP
            $mailer->isSMTP();
            $mailer->Host       = 'smtp.gmail.com'; // Host SMTP
            $mailer->SMTPAuth   = true;
            $mailer->Username   = 'formularcontact1@gmail.com'; // Adresa de email pentru autentificare SMTP
            $mailer->Password   = 'aayg mocl ifyq bnsv'; // Parola pentru autentificare SMTP
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // SSL/TLS
            $mailer->Port       = 587; // Port SMTP

            // Destinatar
            $mailer->setFrom('formularcontact1@gmail.com', 'FlavorFiesta');
            $mailer->addAddress($email, $name);

            // Conținut
            $mailer->isHTML(true);
            $mailer->Subject = 'Cod de securitate pentru inregistrare';
            $mailer->Body    = "Salut, $name! <br><br> Codul tău de securitate este: $security_code";

            $mailer->send();
            $_SESSION['message'] = "Înregistrare cu succes! Un email de confirmare a fost trimis la adresa $email.";

            header('Location: email_validation.php');
            exit();

        } catch (Exception $e) {
            $_SESSION['message'] = "Eroare la trimiterea emailului: {$mailer->ErrorInfo}";
        }
    }

    header('Location: register.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UFT-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flavor Fiesta</title>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

     <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!--- Alertify-Js --->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
</head>
<body>

<section id="header">
        <a href="index.php"><img src="img/logo.png" height="75"></a>
        <form class="form-inline my-2 my-lg-0" action="produseSearch.php" method="GET">
           <input class="form-control mr-sm-2 mt-10" name="search_query" type="search" placeholder="Cauta..." aria-label="Search" style="background-color: #ED9455; color: white;">
            <button class="normal" type="submit">Search</button>
        </form>
        <div>
            <ul id="nvbar">
                
                <li><a  href="index.php">Acasă</a></li>
                
                <li><a href="categorii.php">Categorii rețete</a></li>
                
                <?php
                if(isset($_SESSION['auth'])){
                    ?>
                    
                    
                    <li><a  href="myaccount.php"><i class="far fa-user"></i>
                    <?= $_SESSION['auth_user']['name']; ?></li>
                    <li><a href="logout.php">Deconectează-te</a></li>
                    <?php
                }
                else{
                    ?>
                    <li><a class="active" href="login.php"><i class="far fa-user"></i>Înregistreză-te</a></li> 
                    <?php
                }
                
                ?>

                 
                <li>
                    
                </li> 
                <li id="lg-bag"><a href="cart.php"><i class="fa fa-shopping-cart"></i></a></li>
                <a href="#" id="close"><i class="fas fa-times"></i></a>
            </ul>
            
        </div>
        
        <div id="mobile">
            <a href="cart.php"><i class="fa fa-shopping-cart"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <?php if(isset($_SESSION['message'])) { 
                    ?>
                        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
                        <script>
                            alertify.set('notifier','position', 'top-right');
                            alertify.error('<?php echo $_SESSION['message']; ?>');
                        </script>
                    <?php 
                        unset($_SESSION['message']);
                    }
                ?>

    <!---LOGIN +REGISTER PAGE-->
   
    <section id="formular">
        <div class="form-box">
                <!--REGISTER-->
                <div class="register-container" id="register" style="width: 99%;">
                <div class="top">
                    <span>Ai deja cont? <a href="login.php">Conectează-te</a></span>
                    <header>Înregistreză-te</header>
                </div>
                
                <form action="register.php" method="POST">
                    <div class="two-forms">
                        <div class="input-box">
                            <input type="text" class="form-control pl-5"  required name="prenume" placeholder="Prenume">
                            <i class="fas fa-user mt-2" style="color:#192655" ></i>
                        </div>
                        <div class="input-box">
                            <input type="text" class="form-control pl-5" required name="name" placeholder="Nume">
                            <i class="fas fa-user mt-2" style="color:#192655" ></i>
                        </div>
                    </div>
                        <div class="input-box">
                            <input type="text" class="form-control pl-5" required name="email" placeholder="Email">
                            <i class="fas fa-envelope mt-2" style="color:#192655" ></i>
                            <span id="emailMessage" style="color:red"></span>      
                        </div>
                        <div class="input-box">
                            <input type="password" id="password" onkeyup="validatePassword()" class="form-control pl-5" required name="password" placeholder="Parola">
                            <i class="fas fa-lock mt-2" style="color:#192655"></i>
                            <span id="passwordMessage" style="color:red"></span>
                        </div>
                        <div class="input-box">
                            <input type="password" id="cpassword" onkeyup="validateConfirmPassword()" class="form-control pl-5" required name="cpassword" placeholder="Confirma parola">
                            <i class="fas fa-lock mt-2" style="color:#192655"></i>
                            <span id="confirmPasswordMessage" style="color:red"></span>
                        </div>
                        <div class="input-box">
                            <input type="submit" name="register_btn" class="submit" value="Inregistrează-te">
                        </div>

                        <script>
                            function validatePassword() {
                                var passwordInput = document.getElementById('password');
                                var password = passwordInput.value;
                                var message = document.getElementById('passwordMessage');

                                if (password.length < 8) {
                                    message.textContent = 'Parola trebuie să aibă minim 8 caractere';
                                } else {
                                    message.textContent = '';
                                }
                            }

                            function validateConfirmPassword() {
                                var password = document.getElementById('password').value;
                                var confirmPassword = document.getElementById('cpassword').value;
                                var message = document.getElementById('confirmPasswordMessage');

                                if (password !== confirmPassword) {
                                    message.textContent = 'Parolele nu coincid';
                                } else {
                                    message.textContent = '';
                                }
                            }
                        </script>

                        
            </form>
            </div>
        </div>
    </section>



</section>
       <!--Footer-->
       <footer class="section-p1">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="logo" src="img/logo.png" style="width: 300px;">
                <h4>Contact</h4>
                 <p><strong>Adresa:: </strong> 2201 Hotel Cir S, San Diego, CA 92108</p>
                <p><strong>Telefon: </strong> +01 2222 365</p>
                <p><strong>Program: </strong>Luni - Vineri: 10:00 - 16:00</p>
                <div class="follow">
                    <h4>Retele de socializare</h4>
                    <div class="icon">
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a> 
                        <a href="https://twitter.com/?lang=ro" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/vintage.newhome/?hl=ro" target="_blank"><i class="fab fa-instagram"></i></a> 
                        <a href="https://ro.pinterest.com/search/pins/?q=ceramics&rs=typed" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                        <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            

           
        </div>
    </div>
</footer>

    
        <script src="script.js"></script>
    

    
<!--Alertify Js JavaScript -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="assets/js/jquery-3.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>     
             
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
        <script src="assets/js/custom.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <Script>   
            alertify.set('notifier','position', 'top-right');
        <?php 
            if(isset($_SESSION['message']))
            { 
                ?>
                alertify.success('<?= $_SESSION['message']; ?>');
                <?php 
                unset($_SESSION['message']);

            } 
        ?>
</script>

</body>
</html>
