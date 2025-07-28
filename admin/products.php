<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4>Rețete</h4> 
                </div>
                <div class="card-body" id="recipes_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nume</th>
                                <th>Imagine</th>
                                <th>Status</th>
                                <th>Acțiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Obține toate rețetele din baza de date
                                $recipes = getAll("retete");
                                if(mysqli_num_rows($recipes) > 0){
                                    foreach($recipes as $recipe){
                            ?>
                                        <tr>
                                            <td><?= $recipe['id']; ?></td>
                                            <td><?= $recipe['nume']; ?></td>
                                            <td>
                                                <img src="../uploads/<?= $recipe['img']; ?>" width="50px" height="50px" alt="<?= $recipe['nume']; ?>"> 
                                            </td>
                                            <td><?= $recipe['status'] == 1 ? "Reteta postata" : ($recipe['status'] == 0 ? "Reteta in curs de verificare" : "Reteta revocata"); ?></td>

                                            <td>
                                                <a href="edit-recipe.php?id=<?= $recipe['id']; ?>" class="btn btn-sm btn-primary">Editează</a>
                                                <button type="button" class="btn btn-sm btn-danger delete_recipe_btn" data-id="<?= $recipe['id']; ?>">Șterge</button>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                                else{
                                    echo "Nicio înregistrare găsită";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>





<?php include('includes/footer.php');?>