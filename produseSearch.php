<?php 
include('functions/userfunctions.php'); 
include('config/dbcon.php');


if (isset($_GET['search_query'])) 
    $cuvant = $_GET['search_query'];

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
                    <li><a  href="login.php"><i class="far fa-user"></i>Conectează-te</a></li> 
                    <?php
                }
                
                ?>

                 
                <li>
                    <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bars"></i>
                    </button>
                        <ul class="dropdown-menu">
                            <li><a href="about.php">Despre noi</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li><a href="feedback.php">Recenzii</a></li>
                        </ul>
                    </div>
                </li> 
                <li id="lg-bag"><a href="cart.php"><i class="far fa-heart"></i></a></li>
                <a href="#" id="close"><i class="fas fa-times"></i></a>
            </ul>
            
        </div>
        
        <div id="mobile">
            <a href="cart.php"><i class="far fa-heart"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <section id="page-header">
        <h2>Descopera gustul vietii: Retetele noastre, bucuria ta!</h2>
    
    </section>


<section id="product1" class="section-p1">
    <div class="row">
        <!-- Bara de filtre -->
        <div class="col-md-3 filter-bar">
            <form action="produseSearch2.php" method="GET">

                <div class="filterSection">
                    <!-- Opțiunile de filtrare -->
                    <div class="filter" style="text-align: left;">
                        <h5>Timpul de preparare</h5>
                        <?php
                            $con = mysqli_connect("localhost","root","","ceramica");

                            $category_query = "SELECT * FROM filtre WHERE nume_filtru='Timpul de preparare'";
                            $category_query_run = mysqli_query($con, $category_query);

                            if(mysqli_num_rows($category_query_run) > 0)
                            {
                                foreach($category_query_run as $categoryList)
                                {
                                    $checked = [];
                                    if(isset($_GET['filtre']))
                                    {
                                        $checked = $_GET['filtre'];
                                    }
                                    ?>
                                        <div>
                                            <input type="checkbox" name="filtre[]" value="<?= $categoryList['id'];?>" 
                                                <?php if(in_array($categoryList ['id'],$checked)){echo "checked";} ?>
                                            />
                                            <?= $categoryList['valoare_filtru'];?>
                                        </div>
                                    <?php
                                }
                            }
                            else {
                                echo "Nicio categorie gasita";
                            }
                        ?>
                    </div>
                    <div class="filter" style="text-align: left;">
                        <h5>Valoarea calorică</h5>
                        <?php
                            $con = mysqli_connect("localhost","root","","ceramica");

                            $category_query = "SELECT * FROM filtre WHERE nume_filtru='Valoarea calorică'";
                            $category_query_run = mysqli_query($con, $category_query);

                            if(mysqli_num_rows($category_query_run) > 0)
                            {
                                foreach($category_query_run as $categoryList)
                                {
                                    $checked = [];
                                    if(isset($_GET['filtre']))
                                    {
                                        $checked = $_GET['filtre'];
                                    }
                                    ?>
                                        <div>
                                            <input type="checkbox" name="filtre[]" value="<?= $categoryList['id'];?>" 
                                                <?php if(in_array($categoryList ['id'],$checked)){echo "checked";} ?>
                                            />
                                            <?= $categoryList['valoare_filtru'];?>
                                        </div>
                                    <?php
                                }
                            }
                            else {
                                echo "Nicio categorie gasita";
                            }
                        ?>
                    </div>
                    <div class="filter" style="text-align: left;">
                        <h5>Numărul de ingrediente</h5>
                        <?php
                            $con = mysqli_connect("localhost","root","","ceramica");

                            $category_query = "SELECT * FROM filtre WHERE nume_filtru='Numărul de ingrediente'";
                            $category_query_run = mysqli_query($con, $category_query);

                            if(mysqli_num_rows($category_query_run) > 0)
                            {
                                foreach($category_query_run as $categoryList)
                                {
                                    $checked = [];
                                    if(isset($_GET['filtre']))
                                    {
                                        $checked = $_GET['filtre'];
                                    }
                                    ?>
                                        <div>
                                            <input type="checkbox" name="filtre[]" value="<?= $categoryList['id'];?>" 
                                                <?php if(in_array($categoryList ['id'],$checked)){echo "checked";} ?>
                                            />
                                            <?= $categoryList['valoare_filtru'];?>
                                        </div>
                                    <?php
                                }
                            }
                            else {
                                echo "Nicio categorie gasita";
                            }
                        ?>
                    </div>
                    <div class="filter" style="text-align: left;">
                        <h5>Alergeni</h5>
                        <?php
                            $con = mysqli_connect("localhost","root","","ceramica");

                            $category_query = "SELECT * FROM filtre WHERE nume_filtru='Alergeni'";
                            $category_query_run = mysqli_query($con, $category_query);

                            if(mysqli_num_rows($category_query_run) > 0)
                            {
                                foreach($category_query_run as $categoryList)
                                {
                                    $checked = [];
                                    if(isset($_GET['filtre']))
                                    {
                                        $checked = $_GET['filtre'];
                                    }
                                    ?>
                                        <div>
                                            <input type="checkbox" name="filtre[]" value="<?= $categoryList['id'];?>" 
                                                <?php if(in_array($categoryList ['id'],$checked)){echo "checked";} ?>
                                            />
                                            <?= $categoryList['valoare_filtru'];?>
                                        </div>
                                    <?php
                                }
                            }
                            else {
                                echo "Nicio categorie gasita";
                            }
                        ?>
                    </div>
                    <div class="filter" style="text-align: left;">
                        <h5>Categorii</h5>
                        <?php
                            $con = mysqli_connect("localhost","root","","ceramica");

                            $category_query = "SELECT * FROM categories";
                            $category_query_run = mysqli_query($con, $category_query);

                            if(mysqli_num_rows($category_query_run) > 0)
                            {
                                foreach($category_query_run as $categoryList)
                                {
                                    $checked = [];
                                    if(isset($_GET['categories']))
                                    {
                                        $checked = $_GET['categories'];
                                    }
                                    ?>
                                        <div>
                                            <input type="checkbox" name="categories[]" value="<?= $categoryList['id'];?>" 
                                                <?php if(in_array($categoryList ['id'],$checked)){echo "checked";} ?>
                                            />
                                            <?= $categoryList['name'];?>
                                        </div>
                                    <?php
                                }
                            }
                            else {
                                echo "Nicio categorie gasita";
                            }
                        ?>
                    </div>
                    <!-- Butonul de aplicare a filtrelor -->
                    <button type="submit" class="normal">Aplică filtrele</button>
                </div>
            </form>
        </div>


        <!-- Produsele -->
        <div class="col-md-9">
            <h1>Ai căutat: <?=$cuvant?></h1 >
            <div class="row">
                <?php 
                $products =  getBySearch($cuvant);
                if(count($products) > 0){
                    foreach($products as $index => $item){
                        if($index % 4 == 0 && $index != 0) {
                            echo '</div><div class="row">';
                        }
                ?>
                        <div class="col-md-3">
                            <div class="pro">
                                <a href="product-view.php?recipe=<?= $item['id']; ?>">
                                    <img src="uploads/<?= $item['img']; ?>">
                                </a>
                                <div class="row mt-2">
                                    <div class="col-8">
                                        <div class="pro-details">
                                            <h6><?= $item['nume'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <input type="hidden" value="<?= $item['id'] ?>" class="prod_id">
                                        <button class="btn addToCartProduct" value="<?= $item['id']; ?>" data-product-id="<?= $item['id']; ?>">
                                            <i class="far fa-heart" style="color: orange"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "Niciun produs disponibil";
                }
                ?>
            </div>
        </div>
    </div>
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

            <div class="col-md-4">
                <h4>Informatii utile</h4>
               <p><a href="about.php" >Despre noi</a></p>
                <p><a href="#">Informatii despre transport</a></p>
                <p><a href="#">Politica de confidentialitate</a></p>
                <p><a href="#">Termeni si conditii</a></p>
               <p><a href="contact.php" >Contact</a></p>
            </div>

            <div class="col-md-4">
                <h4>Contul meu</h4>
                <p><a href="login.php" target="_blank">Conecteaza-te</a></p>
                <p><a href="cart.php">Lista de dorinte</a></p>
                <p><a href="#">Urmareste comanda</a></p>
                <p><a href="contact.php">Ajutor</a></p>
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
  
<?php
    if(isset($_SESSION['auth'])){
    ?>
    <script>
        window.embeddedChatbotConfig = {
        chatbotId: "IobxL_JUxqzn4ULqxZdAK",
        domain: "www.chatbase.co"
        }
        </script>
        <script
        src="https://www.chatbase.co/embed.min.js"
        chatbotId="IobxL_JUxqzn4ULqxZdAK"
        domain="www.chatbase.co"
        defer>
    </script>
    <?php
    }
                
?>

</body>
</html>
