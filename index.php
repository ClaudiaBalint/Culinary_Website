<?php 
include('functions/userfunctions.php'); 
include('config/dbcon.php');

if (isset($_GET['search_query'])) {
    $search_query = $_GET['search_query'];

    header("Location: produseSearch.php?search_query=" . urlencode($search_query));
    exit;
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
                
                <li><a class="active" href="index.php">Acasă</a></li>
                
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

    <?php if(isset($_SESSION['message'])) 
                { ?>
                
                        <!---<div class="alert alert-warning alert-dismissible fade show" role="alert" style=" color: #F0F0F0; position: center; margin: auto">
                        <strong>Ups!</strong> //<?php echo $_SESSION['message']; ?> -->
                        <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>-->
                    </div>
                <?php
                    unset($_SESSION['message']);
                }
                ?>

    <section id="hero">
        <div> 
            <h1>Descoperă aromele care îți trezesc
            </h1>
            <h1>
            simțurile și transformă
            </h1>
            <h2 style="color: #ED9455;">fiecare masă într-o aventură culinară!</h2>
              <a href="categorii.php" class="hred"><button name="buton-cumparaturi">Descopera</button>
            </a>
        </div>
    </section>

    
 <!--catgorii prod-->
 <section id="product1" class="section-p1">
    <h1>Ce ai vrea sa mananci?</h1>
    <div class="row flex-container">
        <?php
        $categories = getAllActiveAndPopular("categories");
        if (mysqli_num_rows($categories) > 0) {
            foreach ($categories as $item) {
                ?>
                <div class="col-md-4">
                    <a href="products.php?category=<?= $item['slug']; ?>">
                        <div class="pro">
                            <img src="uploads/<?= $item['image']; ?>"  alt="<?= $item['name']; ?>">
                            <div class="des">
                                <h5><?= $item['name'] ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
        } else {
            echo "Nicio categorie disponibila";
        }
        ?>
    </div>
</section>



  <section id="banner" class="section-m1">
        <h2>Exploră culinarul din tine! </h2>
        <h4>Împărtășește-ți pasiunea pentru gătit creându-ți un cont și aducând viață propriilor tale rețete alături de comunitatea noastră globală.</h4>
        <button class="normal"  onclick="window.location.href='login.php';">Conecteaza-te</button>
    </section>
    
   

<section id="product1" class="section-p1">
    <h1>Cele mai apreciate rețete</h1>
    <div class="row">
        <?php
        $products = getAllPopularRecipes();
        if (mysqli_num_rows($products) > 0) {
            foreach ($products as $item) {
                ?>
                <div class="col-md-3">
                    <div class="pro">
                        <a href="product-view.php?recipe=<?= $item['id']; ?>">
                            <img src="uploads/<?= $item['img']; ?>" alt="<?= $item['nume']; ?>">
                        </a>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="pro-details d-flex justify-content-between align-items-center">
                                    <h6><?= $item['nume'] ?></h6>
                                    <a href="#" class="btn addToCartProduct" data-product-id="<?= $item['id']; ?>">
                                        <i class="far fa-heart" style="color: orange"></i>
                                    </a>
                                </div>
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
</section>





<style>
    /* Definirea culorii textului pentru link-uri */
    .orange-link {
        color: orange;
    }

    /* Definirea culorii textului atunci când link-ul este în starea :hover (când utilizatorul plasează cursorul mouse-ului pe link) */
    .orange-link:hover {
        color: orange;
        text-decoration: none; /* Eliminarea sublinierii atunci când utilizatorul plasează cursorul mouse-ului pe link */
    }
</style>

   
 <!--Newsletter-->
 <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="width: 100%;">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/banner/italian.png" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
      <h1 class="text-center"><a href="products.php?category=italiana" class="orange-link">Bucatarie italiana</a></h1>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/banner/greek.png" alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
        <h1 class="text-center"><a href="products.php?category=greceasca" class="orange-link">Bucatarie greceasca</a></h1>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/banner/mexican.png" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
        <h1 class="text-center"><a href="products.php?category=mexicana" class="orange-link">Bucatarie mexicana</a></h1>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/banner/vegetarian.png" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
        <h1 class="text-center"><a href="products.php?category=vegetariana" class="orange-link">Bucatarie vegetarianaa</a></h1>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/banner/asian.png" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
        <h1 class="text-center"><a href="products.php?category=asiatica" class="orange-link">Bucatarie asiatica</a></h1>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>



<!--Newsletter-->


        <!--Footer-->
        <footer class="section-p1">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="logo" src="img/logo.png" style="width: 300px;">
                <h4>Contact</h4>
                <p><strong>Adresa: </strong> 2201 Hotel Cir S, San Diego, CA 92108</p>
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
 

</body>
</html>