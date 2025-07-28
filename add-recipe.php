<?php 

include('functions/userfunctions.php'); 
include('config/dbcon.php');

include('authenticate.php');


$id_utilizator = $_SESSION['auth_user']['user_id'];

$result = getIDActive("users", $id_utilizator);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row["id"];
    $name = $row["name"];
    $prenume = $row["prenume"];
    $phone= $row["phone"];
    $email = $row["email"];
    $adress = $row["adress"];
    $pincode = $row["pincode"];
    $password = $row["password"];
    
} else {
    echo "Eroare la obținerea datelor utilizatorului activ.";
}
?>


<!DOCTYPE html>
<html>
<head><!DOCTYPE html>
    <html lang="en">
    

    
    <head>

<meta charset="UFT-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceramica</title>
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
                
                <li><a href="categorii.php">Categorii produse</a></li>
                
                <?php
                if(isset($_SESSION['auth'])){
                    ?>
                    
                    
                    <li><a class="active" href="myaccount.php"><i class="far fa-user"></i>
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

<br>
<br>
<br>
<br>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <center><h4>Adaugă o rețetă</h4></center>
                </div>
                <div class="card-body">
                    <form action="user_code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="mb-0">Nume rețetă</label>
                                <input type="text" required name="recipe_name" placeholder="Introdu numele rețetei" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Categorie</label>
                                <select name="categorie" class="form-select mb-2">
                                    <option value="">Selectează o categorie</option>
                                    <?php
                                    $categories_query = "SELECT * FROM categories";
                                    $categories_result = mysqli_query($con, $categories_query);
                                    while ($category = mysqli_fetch_array($categories_result)) {
                                        $selected = ($category['id'] == $data['categorie']) ? 'selected' : '';
                                        echo '<option value="' . $category['id'] . '" ' . $selected . '>' . $category['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Descriere scurtă a rețetei</label>
                                <textarea rows="3" required name="recipe_description" placeholder="Introdu o descriere scurtă a rețetei" class="form-control mb-2"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Ingrediente</label>
                                <div id="ingredients-container">
                                    <!-- Câmpurile pentru ingrediente vor fi adăugate aici -->
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <input type="text" required name="ingredient_name[]" placeholder="Nume ingredient" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" required name="ingredient_quantity[]" placeholder="Cantitate" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <select required name="ingredient_unit[]" class="form-control">
                                                <option value="ml">ml</option>
                                                <option value="l">l</option>
                                                <option value="g">g</option>
                                                <option value="kg">kg</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-warning" onclick="addIngredientField()">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Pași de preparare</label>
                                <div id="steps-container">
                                    <!-- Câmpurile pentru pași de preparare -->
                                    <div class="row mb-2">
                                        <div class="col-md-11">
                                            <div class="input-group">
                                                <span class="input-group-text">1.</span>
                                                <input type="text" required name="preparation_step[]" placeholder="Pasul de preparare" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-warning" onclick="addStepField()">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Indicații opționale</label>
                                <textarea rows="3" name="optional_instructions" placeholder="Introdu indicații opționale" class="form-control mb-2"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Alergeni</label><br>
                                <input type="checkbox" name="allergen[]" value="fructe_cu_coaja_lemnoasa"> Fructe cu coajă lemnoasă<br>
                                <input type="checkbox" name="allergen[]" value="arahide"> Arahide<br>
                                <input type="checkbox" name="allergen[]" value="lapte de vaca"> Lapte de vaca<br>
                                <input type="checkbox" name="allergen[]" value="crustacee_si_moluste"> Crustacee si moluste<br>
                                <input type="checkbox" name="allergen[]" value="soia"> Soia<br>
                                <input type="checkbox" name="allergen[]" value="ou"> Ou<br>
                                <input type="checkbox" name="allergen[]" value="peste"> Peste<br>
                                <input type="checkbox" name="allergen[]" value="gluten"> Gluten<br>
                                <input type="checkbox" name="allergen[]" value="telina"> Telina<br>
                                <input type="checkbox" name="allergen[]" value="mustar"> Mustar<br>
                                <input type="checkbox" name="allergen[]" value="seminte_de_susan"> Seminte de susan<br>
                                <input type="checkbox" name="allergen[]" value="lupin"> Lupin<br>
                                <input type="checkbox" name="allergen[]" value="dioxid_de_sulf"> Dioxid de sulf<br>
                            </div>
                            <div class="col-md-4">
                                <label class="mb-0">Calorii</label>
                                <input type="number" name="calories" placeholder="Introdu numărul de calorii" class="form-control mb-2">
                            </div>
                            <div class="col-md-4">
                                <label class="mb-0">Timpul de preparare (ore)</label>
                                <input type="number" name="timp_ore" placeholder="Ore" class="form-control mb-2"  min="0" max="60" step="1">
                            </div>
                            <div class="col-md-4">
                                <label class="mb-0">Timpul de preparare (minute)</label>
                                <input type="number" name="timp_minute" placeholder="Minute" class="form-control mb-2" min="0" max="48" step="1">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Număr de porții</label>
                                <input type="number" name="nr_portii" placeholder="Introdu numărul de porții" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Incarcă o imagine</label>
                                <input type="file" required name="image" class="form-control mb-2">
                            </div>
                            <div class="col-md-6 mb-3">
                                <select name="recipe_status" class="form-select">
                                    <option value="0">Reteta in curs de verificare</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <center><button type="submit" class="btn btn-warning" name="add_recipe_btn">Salvează rețeta</button></center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<br>
<br>
<br>
<br>
<br>

<script>
    // Funcția pentru validarea timpului de preparare
    function validatePreparationTime() {
        var hoursInput = document.getElementById("preparation_time_hours");
        var minutesInput = document.getElementById("preparation_time_minutes");
        var hours = parseInt(hoursInput.value);
        var minutes = parseInt(minutesInput.value);
        var valid = true;

        // Verificăm dacă numărul de ore este în intervalul [0, 48]
        if (hours < 0 || hours > 48) {
            document.getElementById("hours-error").innerText = "Numărul de ore trebuie să fie între 0 și 48.";
            valid = false;
        } else {
            document.getElementById("hours-error").innerText = "";
        }

        // Verificăm dacă numărul de minute este în intervalul [0, 59]
        if (minutes < 0 || minutes > 59) {
            document.getElementById("minutes-error").innerText = "Numărul de minute trebuie să fie între 0 și 59.";
            valid = false;
        } else {
            document.getElementById("minutes-error").innerText = "";
        }

        return valid;
    }

    // Ascultă evenimentul de trimitere a formularului și validează timpul de preparare
    document.querySelector("form").addEventListener("submit", function(event) {
        if (!validatePreparationTime()) {
            event.preventDefault(); // Opriți trimiterea formularului dacă validarea a eșuat
        }
    });
</script>


<script>
    function addIngredientField() {
    var ingredientsContainer = document.getElementById('ingredients-container');

    var newIngredientField = document.createElement('div');
    newIngredientField.classList.add('row', 'mb-2');
    newIngredientField.innerHTML = `
        <div class="col-md-4">
            <input type="text" required name="ingredient_name[]" placeholder="Nume ingredient" class="form-control">
        </div>
        <div class="col-md-4">
            <input type="text" required name="ingredient_quantity[]" placeholder="Cantitate" class="form-control">
        </div>
        <div class="col-md-3">
            <select required name="ingredient_unit[]" class="form-control">
                <option value="ml">ml</option>
                <option value="l">l</option>
                <option value="g">g</option>
                <option value="kg">kg</option>
                <option value="buc">bucati</option>
            </select>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger" onclick="removeField(this)">-</button>
        </div>
    `;
    ingredientsContainer.appendChild(newIngredientField);
}
    function addStepField() {
        var stepsContainer = document.getElementById('steps-container');

        // Verificăm dacă există deja 15 pași
        if (stepsContainer.children.length >= 15) {
            alert('Ai atins numărul maxim de 15 pași de preparare!');
            return;
        }

        var newStepField = document.createElement('div');
        newStepField.classList.add('row', 'mb-2');
        var stepNumber = stepsContainer.children.length + 1;
        newStepField.innerHTML = `
            <div class="col-md-11">
                <div class="input-group">
                    <span class="input-group-text">${stepNumber}.</span>
                    <input type="text" required name="preparation_step[]" placeholder="Pasul de preparare" class="form-control">
                </div>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger" onclick="removeField(this)">-</button>
            </div>
        `;
        stepsContainer.appendChild(newStepField);
    }

    // Funcția pentru eliminarea unui câmp
    function removeField(btn) {
        btn.parentNode.parentNode.remove();
    }

</script>

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
<script src="assets/js/custom.js"></script>
             
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