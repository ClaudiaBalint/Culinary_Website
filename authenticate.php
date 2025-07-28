<?php

if(!isset($_SESSION['auth'])){
    redirect("login.php","Conectează-te pentru a continua.");
}

?>