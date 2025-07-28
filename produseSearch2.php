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
        <p></p>
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
                        <label class="mb-1"><input type="checkbox" name="timp[]" value="sub10" <?php if(isset($_GET['timp']) && in_array('sub10', $_GET['timp'])) echo 'checked'; ?>> Mai puțin de 10 minute</label><br>
                        <label class="mb-1"><input type="checkbox" name="timp[]" value="10_30" <?php if(isset($_GET['timp']) && in_array('10_30', $_GET['timp'])) echo 'checked'; ?>> 10 - 30 minute</label><br>
                        <label class="mb-1"><input type="checkbox" name="timp[]" value="30_60" <?php if(isset($_GET['timp']) && in_array('30_60', $_GET['timp'])) echo 'checked'; ?>> 30 - 60 minute</label><br>
                        <label class="mb-1"><input type="checkbox" name="timp[]" value="peste60" <?php if(isset($_GET['timp']) && in_array('peste60', $_GET['timp'])) echo 'checked'; ?>> Mai mult de 60 minute</label><br>
                    </div>
                    <div class="filter" style="text-align: left;">
                        <h5>Valoarea calorică pe portie</h5>
                        <label class="mb-1"><input type="checkbox" name="calorii[]" value="sub100" <?php if(isset($_GET['calorii']) && in_array('sub100', $_GET['calorii'])) echo 'checked'; ?>> Mai puțin de 100 calorii</label><br>
                        <label class="mb-1"><input type="checkbox" name="calorii[]" value="100_200" <?php if(isset($_GET['calorii']) && in_array('100_200', $_GET['calorii'])) echo 'checked'; ?>> 100-200 calorii</label><br>
                        <label class="mb-1"><input type="checkbox" name="calorii[]" value="200_300" <?php if(isset($_GET['calorii']) && in_array('200_300', $_GET['calorii'])) echo 'checked'; ?>> 200 - 300 calorii</label><br>
                        <label class="mb-1"><input type="checkbox" name="calorii[]" value="300_500" <?php if(isset($_GET['calorii']) && in_array('300_500', $_GET['calorii'])) echo 'checked'; ?>> 300 - 500 calorii</label><br>
                        <label class="mb-1"><input type="checkbox" name="calorii[]" value="peste500" <?php if(isset($_GET['calorii']) && in_array('peste500', $_GET['calorii'])) echo 'checked'; ?>> Peste 500 calorii</label><br>
                    </div>
                    <div class="filter" style="text-align: left;">
                        <h5>Numărul de ingrediente</h5>
                        <label class="mb-1"><input type="checkbox" name="ingrediente[]" value="sub100" <?php if(isset($_GET['ingrediente']) && in_array('sub100', $_GET['ingrediente'])) echo 'checked'; ?>> Mai puțin de 5 ingrediente</label><br>
                        <label class="mb-1"><input type="checkbox" name="ingrediente[]" value="5_10" <?php if(isset($_GET['ingrediente']) && in_array('5_10', $_GET['ingrediente'])) echo 'checked'; ?>> 5 - 10 ingrediente</label><br>
                        <label class="mb-1"><input type="checkbox" name="ingrediente[]" value="10_20" <?php if(isset($_GET['ingrediente']) && in_array('10_20', $_GET['ingrediente'])) echo 'checked'; ?>> 10 - 20 ingrediente</label><br>
                        <label class="mb-1"><input type="checkbox" name="ingrediente[]" value="20_30" <?php if(isset($_GET['ingrediente']) && in_array('20_30', $_GET['ingrediente'])) echo 'checked'; ?>> 20 - 30 ingrediente</label><br>
                        <label class="mb-1"><input type="checkbox" name="ingrediente[]" value="peste30" <?php if(isset($_GET['ingrediente']) && in_array('peste30', $_GET['ingrediente'])) echo 'checked'; ?>> Peste 30 de ingrediente</label><br>
                    </div>
                    <div class="filter" style="text-align: left;">
                        <h5>Alergeni</h5>
                            <label class="mb-1"><input type="checkbox" name="allergen[]" value="fructe_cu_coaja_lemnoasa" <?php if(isset($_GET['allergen']) && in_array('fructe_cu_coaja_lemnoasa', $_GET['allergen'])) echo 'checked'; ?>> Fructe cu coajă lemnoasă</label><br>
                            <label class="mb-1"><input type="checkbox" name="allergen[]" value="arahide" <?php if(isset($_GET['allergen']) && in_array('arahide', $_GET['allergen'])) echo 'checked'; ?>> Arahide</label><br>
                            <label class="mb-1"><input type="checkbox" name="allergen[]" value="lapte de vaca" <?php if(isset($_GET['allergen']) && in_array('lapte de vaca', $_GET['allergen'])) echo 'checked'; ?>> Lapte de vaca</label><br>
                            <label class="mb-1"><input type="checkbox" name="allergen[]" value="crustacee_si_moluste" <?php if(isset($_GET['allergen']) && in_array('crustacee_si_moluste', $_GET['allergen'])) echo 'checked'; ?>> Crustacee și moluste</label><br>
                            <label class="mb-1"><input type="checkbox" name="allergen[]" value="soia" <?php if(isset($_GET['allergen']) && in_array('soia', $_GET['allergen'])) echo 'checked'; ?>> Soia</label><br>
                            <label class="mb-1"><input type="checkbox" name="allergen[]" value="ou" <?php if(isset($_GET['allergen']) && in_array('ou', $_GET['allergen'])) echo 'checked'; ?>> Ou</label><br>
                            <label class="mb-1"><input type="checkbox" name="allergen[]" value="peste" <?php if(isset($_GET['allergen']) && in_array('peste', $_GET['allergen'])) echo 'checked'; ?>> Peste</label><br>
                            <label class="mb-1"><input type="checkbox" name="allergen[]" value="gluten" <?php if(isset($_GET['allergen']) && in_array('gluten', $_GET['allergen'])) echo 'checked'; ?>> Gluten</label><br>
                            <label class="mb-1"><input type="checkbox" name="allergen[]" value="telina" <?php if(isset($_GET['allergen']) && in_array('telina', $_GET['allergen'])) echo 'checked'; ?>> Telina</label><br>
                            <label class="mb-1"><input type="checkbox" name="allergen[]" value="mustar" <?php if(isset($_GET['allergen']) && in_array('mustar', $_GET['allergen'])) echo 'checked'; ?>> Mustar</label><br>
                            <label class="mb-1"><input type="checkbox" name="allergen[]" value="seminte_de_susan" <?php if(isset($_GET['allergen']) && in_array('seminte_de_susan', $_GET['allergen'])) echo 'checked'; ?>> Semințe de susan</label><br>
                            <label class="mb-1"><input type="checkbox" name="allergen[]" value="lupin" <?php if(isset($_GET['allergen']) && in_array('lupin', $_GET['allergen'])) echo 'checked'; ?>> Lupin</label><br>
                            <label class="mb-1"><input type="checkbox" name="allergen[]" value="dioxid_de_sulf" <?php if(isset($_GET['allergen']) && in_array('dioxid_de_sulf', $_GET['allergen'])) echo 'checked'; ?>> Dioxid de sulf</label><br>
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
            <div class="row">
            <?php
// Verificăm dacă sunt trimise date pentru filtrare
// Verificăm dacă sunt trimise date pentru filtrare
if(isset($_GET['timp']) || isset($_GET['calorii']) || isset($_GET['ingrediente']) || isset($_GET['allergen']) || isset($_GET['categories'])) {
    // Construim interogarea SQL de bază pentru a selecta rețetele
    $query = "SELECT * FROM retete";

    // Array-uri pentru a stoca condițiile pentru fiecare categorie de filtru
    $conditions = [];

    // Filtrare după timpul de preparare
    if (isset($_GET['timp'])) {
        $timp = $_GET['timp'];
        $timp_conditions = [];

        // Creăm o condiție pentru fiecare opțiune selectată pentru timpul de preparare
        foreach ($timp as $interval) {
            switch ($interval) {
                case 'sub10':
                    $timp_conditions[] = " retete.minute < 10 and retete.ore=0";
                    break;
                case '10_30':
                    $timp_conditions[] = " retete.minute BETWEEN 10 AND 30 and retete.ore=0";
                    break;
                case '30_60':
                    $timp_conditions[] = " retete.minute BETWEEN 30 AND 60 and retete.ore=0";
                    break;
                case 'peste60':
                    $timp_conditions[] = " retete.ore >= 1";
                    break;
            }
        }

        // Adăugăm condițiile de timp de preparare la array-ul de condiții
        if (!empty($timp_conditions)) {
            $conditions[] = '(' . implode(' OR ', $timp_conditions) . ')';
        }
    }

    // Filtrare după valoarea calorică
    if (isset($_GET['calorii'])) {
        $calorii = $_GET['calorii'];
        $calorii_conditions = [];

        // Creăm o condiție pentru fiecare opțiune selectată pentru valoarea calorică
        foreach ($calorii as $interval) {
            switch ($interval) {
                case 'sub100':
                    $calorii_conditions[] = " retete.calorii < 100";
                    break;
                case '100_200':
                    $calorii_conditions[] = " retete.calorii BETWEEN 100 AND 200";
                    break;
                case '200_300':
                    $calorii_conditions[] = " retete.calorii BETWEEN 200 AND 300";
                    break;
                case '300_500':
                    $calorii_conditions[] = " retete.calorii BETWEEN 300 AND 500";
                    break;
                case 'peste500':
                    $calorii_conditions[] = " retete.calorii > 500";
                    break;
            }
        }

        // Adăugăm condițiile de valoare calorică la array-ul de condiții
        if (!empty($calorii_conditions)) {
            $conditions[] = '(' . implode(' OR ', $calorii_conditions) . ')';
        }
    }

    // Filtrare după numărul de ingrediente
    if (isset($_GET['ingrediente'])) {
        $ingrediente = $_GET['ingrediente'];
        $ingrediente_conditions = [];

        // Creăm o condiție pentru fiecare opțiune selectată pentru numărul de ingrediente
        foreach ($ingrediente as $interval) {
            switch ($interval) {
                case 'sub100':
                    $ingrediente_conditions[] = "(LENGTH(ingrediente) - LENGTH(REPLACE(ingrediente, '\n', '')) + 1) < 5";
                    break;
                case '5_10':
                    $ingrediente_conditions[] = "(LENGTH(ingrediente) - LENGTH(REPLACE(ingrediente, '\n', '')) + 1) BETWEEN 5 AND 10";
                    break;
                case '10_20':
                    $ingrediente_conditions[] = "(LENGTH(ingrediente) - LENGTH(REPLACE(ingrediente, '\n', '')) + 1) BETWEEN 10 AND 20";
                    break;
                case '20_30':
                    $ingrediente_conditions[] = "(LENGTH(ingrediente) - LENGTH(REPLACE(ingrediente, '\n', '')) + 1) BETWEEN 20 AND 30";
                    break;
                case 'peste30':
                    $ingrediente_conditions[] = "(LENGTH(ingrediente) - LENGTH(REPLACE(ingrediente, '\n', '')) + 1) > 30";
                    break;
            }
        }

        // Adăugăm condițiile de număr de ingrediente la array-ul de condiții
        if (!empty($ingrediente_conditions)) {
            $conditions[] = '(' . implode(' OR ', $ingrediente_conditions) . ')';
        }
    }

    // Filtrare după categorii
    if(isset($_GET['categories'])) {
        $categorii = $_GET['categories'];
        $categorii_str = "'" . implode("','", $categorii) . "'";
        $conditions[] = "retete.categorie IN ($categorii_str)";
    }

    // Filtrare după alergeni
    if(isset($_GET['allergen'])) {
        $alergeni = $_GET['allergen'];
        $alergeni_str = "'" . implode("','", $alergeni) . "'";
        // Excludem rețetele care conțin alergenii specificați
        $conditions[] = "retete.alergeni NOT IN ($alergeni_str)";
    }

    // Construim clauza WHERE pentru toate condițiile
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(' AND ', $conditions);
    }

    // Executăm interogarea SQL și afișăm rețetele rezultate
    $products_run = mysqli_query($con, $query);

    if(mysqli_num_rows($products_run) > 0) {
        foreach($products_run as $index => $item) :
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
        endforeach;
    } else {
        echo "Niciun produs disponibil";
    }
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
   
                
?>

</body>
</html>