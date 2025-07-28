<?php 
include('functions/userfunctions.php'); 
include('config/dbcon.php');

if(isset($_GET['recipe'])){

    $recipe_id = $_GET['recipe'];
    $recipe_data = getRecipeActive("retete",$recipe_id);
    $recipe = mysqli_fetch_array($recipe_data);

    
    if($recipe){
        ?>
       
        <!DOCTYPE html>
        <html lang="en">

        <head>

<meta charset="UFT-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $recipe['nume']; ?>_FlavorFiesta</title>
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
    
    <!-- CSS Lightbox2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">




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
                
                <li><a class="active" href="categorii.php">Categorii rețete</a></li>
                
                <?php
                $user_id = 0;
                if(isset($_SESSION['auth'])){
                    $user_id = $_SESSION['auth_user']['user_id']; 
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
            
<style>
    
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        color: #333;
    }

    h1,h2,h3,h4,h5 {
        color: #ED9455;
    }

    p {
        line-height: 1.6;
        color: #333;
    }

    .btn-like, .btn-dislike, .btn-favorite {
        font-size: 1.25rem; /* Mărimea fontului pentru butoane */
    }

</style>



<section id="prodetails" class="section-p1 product_data">
    <div class="single-pro-image pro">
        <div class="text-center">
            
            <img src="uploads/<?= $recipe['img']; ?>" width="100%" id="MainImg" alt="<?= $recipe['nume']; ?>">
            <!-- Butonul de like -->
            <button class="btn btn-like addLike" data-user-id="<?= $user_id; ?>" data-recipe-id="<?= $recipe['id']; ?>" data-action="like">
                <i class="far fa-thumbs-up" style="color: green"></i>
            </button>
            <!-- Numărul de like-uri -->
            <span class="ms-2 me-2 num-likes"><?= countLikes($recipe['users_likes']) ?></span>
            <!-- Butonul de dislike -->
            <button class="btn btn-dislike addDislike" data-recipe-id="<?= $recipe['id']; ?>" data-action="dislike">
                <i class="far fa-thumbs-down" style="color: red"></i>
            </button>
            <!-- Numărul de dislike-uri -->
            <span class="ms-2 num-dislikes"><?= countLikes($recipe['users_dislikes']) ?></span>
            <!-- Butonul de adăugare la favorite -->
            <a href="#" class="btn addToCartProduct" data-product-id="<?= $recipe['id']; ?>">
                <i class="far fa-heart" style="color: orange; font-size: 1.25rem"></i>
            </a>
            <button id="downloadBtn" class="btn btn-download">
                <i class="fas fa-download" style="color: gray; font-size: 1.25rem"></i>
            </button>

            <iframe id="recipeFrame" style="display: none;" src="download_recipe.php?recipe=<?= $recipe['id']; ?>"></iframe>

            <script>
                document.getElementById('downloadBtn').addEventListener('click', function() {
                    var recipeFrame = document.getElementById('recipeFrame').contentWindow;
                    recipeFrame.focus();
                    recipeFrame.print();
                });
            </script>
        </div>
        
       
        <h5>Ingrediente:</h5>
        <ul>
            <?php
            // Explodează șirul de ingrediente într-un array folosind separatorul "\n" (noul rând)
            $ingrediente = explode("\n", $recipe['ingrediente']);
            // Parcurge fiecare ingredient și afișează-l sub formă de listă cu buline
            foreach ($ingrediente as $ingredient) {
                // Elimină orice spații sau caractere de nou rând din începutul și sfârșitul ingredientului
                $ingredient = trim($ingredient);
                // Dacă ingredientul nu este gol, afișează-l sub formă de listă cu buline
                if (!empty($ingredient)) {
                    echo "<li>$ingredient</li>";
                }
            }
            ?>
        </ul>
        <h5 >Alergeni:</h5>
        <p><?= $recipe['alergeni']; ?></p>
        <h5>Calorii/porție:</h5>
        <p><?= $recipe['calorii']; ?> calorii</p>
        <h5>Număr de porții:</h5>
        <p><?= $recipe['nr_portii']; ?></p>
        <h5>Timpul de preparare:</h5>
        <p><?= $recipe['ore']; ?> ore <?= $recipe['minute']; ?> minute</p>
    </div>

    <div class="single-pro-details">
        <h4><?= $recipe['nume']; ?></h4>
        
        <p><?= $recipe['descriere']; ?></p>
        <h5>Pași de preparare:</h5>
        <?php
        // Explodează șirul de pași într-un array folosind separatorul "\n" (noul rând)
        $pasii = explode("\n", $recipe['pasi']);
        // Inițializează un contor pentru numărarea pașilor
        $contor = 1;
        // Parcurge fiecare pas și afișează-l
        foreach ($pasii as $pas) {
            // Elimină orice spații sau caractere de nou rând din începutul și sfârșitul pasului
            $pas = trim($pas);
            // Dacă pasul nu este gol, afișează-l împreună cu numărul de ordine
            if (!empty($pas)) {
                echo "<p><strong>Pasul $contor:</strong> $pas</p>";
                // Incrementăm contorul pentru următorul pas
                $contor++;
            }
        }
        ?>
    </div>
</section>


<section class="mx-5"> 
    <?php if (!empty($recipe['indicatii_opt'])) : ?>
            <h5>Indicații opționale:</h5>
            <p><?= $recipe['indicatii_opt']; ?></p>
        <?php endif; ?>



</section>
<hr>
<section id="newsletter" class="section-p1 section-m1"> 
    <?php if(isset($_SESSION['auth_user'])): ?>
        <form action="#" method="POST" class="review_form">
            <div class="form-group">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['auth_user']['user_id']; ?>">
                <input type="hidden" name="recipe_id" value="<?php echo $recipe['id']; ?>">
                <label>Nume</label>
                <span class="form-control input-nume"><?php echo $_SESSION['auth_user']['name']; ?></span>
          </div>
            <div class="form-group">
                <label>Opinia ta</label>
                <textarea class="form-control input-parere" name="parere" placeholder="Scrie aici opinia ta..."></textarea>
            </div>
            <button type="submit" name="parereBtn" class="btn btn-primary parereBtn">Trimite</button>
        </form>
    <?php else: ?>
        <div class="container">
        <div class="text-center">
            <h4>Pentru a lăsa un review, te rugăm să te autentifici.</h4>
        </div>
    </div>
    <?php endif; ?>
</section>


<hr>
<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-borderd table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Parere</th>
                                <th>Creat la data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM reviews WHERE id_reteta='" . $recipe['id'] . "'";
                            $result = mysqli_query($con, $query);

                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td><strong>" . $row['name'] . "</strong></td>";
                                    echo "<td>" . $row['parere'] . "</td>";
                                    echo "<td>" . $row['created_at'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>Nu există recenzii disponibile pentru această rețetă.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>
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

    
        <script src="script.js"></script>
    

    
<!--Alertify Js JavaScript -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="assets/js/jquery-3.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>     
<!-- JavaScript Lightbox2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
             
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
            
        <?php
    }      
    else{
        echo "Reteta nu a fost gasit";
    }
}
    else{
        echo "Ceva nu a functionat";
        }
?>
</body>
</html>