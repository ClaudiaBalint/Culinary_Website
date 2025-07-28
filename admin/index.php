<?php 

include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>




<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Bine ai revenit admin!</h2>
        </div>
    </div>
    <div class="container">
    <div class="row">
        <div class="col-md-5">
            <h3>Categorii rețete</h3>
            <a href="category.php" class="btn btn-primary mb-2">Toate categoriile</a>
            <a href="add-category.php" class="btn btn-primary mb-2">Adaugă Categorie</a>
            <h3>Rețete</h3>
            <a href="products.php" class="btn btn-primary mb-2">Toate rețetele</a>
            <a href="add-product.php" class="btn btn-primary mb-2">Adaugă rețete</a>
        
            <h3>Recenzii</h3>
            <a href="recenzii.php" class="btn btn-primary mb-2">Toate recenzile</a>
  
        </div>
    </div>
</div>

</div>

<?php include('includes/footer.php');?>