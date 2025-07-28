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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reteta: <?= $recipe['nume']; ?></title>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css">

    <style>
        /* Stiluri pentru print */
        @media print {
            @page {
                margin-top: 3cm; /* Ajustează valoarea pentru a adăuga un rând liber */
                margin-bottom: 3cm;
                margin-left: 1.5cm;
                margin-right: 1.5cm;
            }
            .page-break {
                page-break-before: always;
            }

            @page :after {
                content: none; /* Elimină conținutul adăugat implicit la sfârșitul paginii */
            }
        }
    </style>

</head>

<body>

    <section id="reteta" class="mx-5">
        <div class="row justify-content-md-center">
				<div class="receipt-main col-xs-10 col-sm-10 col-md-6">
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="receipt-left">
								<img
									class="img-responsive"
									alt="iamgurdeeposahan"
									src="img/logo.png"
									style="width: 200px; border-radius: 43px"
								/>
							</div>
						</div>
					</div>

					<br />

					<div class="row">
						<div
                            class="container"
							style="display: flex; justify-content: center; align-items: center; text-align: center;"
						>
							<div class="receipt-center">
								<h1 style="color: #ED9455;"><?= $recipe['nume']; ?></h1>
                                <br>
                                <img src="uploads/<?= $recipe['img']; ?>" width="60%" id="MainImg" alt="<?= $recipe['nume']; ?>">
							</div>
						</div>
					</div>

                    <br />

					<div class="row">
						<div
                            class="container"
							style="display: flex; justify-content: center; align-items: center; text-align: left;"
						>
							<div class="receipt-left">
                                <p style="color: black;"><?= $recipe['descriere']; ?></p>
							</div>
						</div>
					</div>

					<div class="row">
						<div
                            class="container"
							style="display: flex; justify-content: left; align-items: left; text-align: left;"
						>
							<div class="receipt-left">
                                <h5 style="color: #ED9455;">Ingrediente:</h5>
                                <ul style="margin-left: 20px;">
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
                                <h5 style="color: #ED9455;">Alergeni:</h5>
                                <p style="color: black;"><?= $recipe['alergeni']; ?></p>
                                <h5 style="color: #ED9455;">Calorii/porție:</h5>
                                <p style="color: black;"><?= $recipe['calorii']; ?> calorii</p>
                                <h5 style="color: #ED9455;">Număr de porții:</h5>
                                <p style="color: black;"><?= $recipe['nr_portii']; ?></p>
                                <h5 style="color: #ED9455;">Timpul de preparare:</h5>
                                <p style="color: black;"><?= $recipe['ore']; ?> ore <?= $recipe['minute']; ?> minute</p>
							</div>
						</div>
					</div>

					<div class="row">
						<div
                            class="container"
							style="display: flex; justify-content: left; align-items: left; text-align: left;"
						>
							<div class="receipt-left">
                            <h5 style="color: #ED9455;">Pași de preparare:</h5>
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
                                        echo "<p style=\"color: black;\"><strong>Pasul $contor:</strong> $pas</p>";
                                        // Incrementăm contorul pentru următorul pas
                                        $contor++;
                                    }
                                }
                                ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div
                            class="container"
							style="display: flex; justify-content: left; align-items: left; text-align: left;"
						>
							<div class="receipt-left">
                                <?php if (!empty($recipe['indicatii_opt'])) : ?>
                                    <h5 style="color: #ED9455;">Indicații opționale:</h5>
                                    <p style="color: black;"><?= $recipe['indicatii_opt']; ?></p>
                                <?php endif; ?>
							</div>
						</div>
					</div>

				</div>
			</div>
    </section>

    <script src="script.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
             
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
        <script src="assets/js/custom.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <script>   
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
        echo "Reteta nu a fost gasita";
    }
}
    else{
        echo "Ceva nu a functionat";
        }
?>

</body>
</html>