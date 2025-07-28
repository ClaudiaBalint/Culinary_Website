<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4>Recenzii</h4> 
                </div>
                <div class="card-body" id="recenzii_table">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <table class="table table-boardered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nume client</th>
                                    <th>id_reteta</th>
                                    <th>Recenzie</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $recenzii = getAll("reviews");
                                    if(mysqli_num_rows($recenzii) > 0){
                                        foreach($recenzii as $item){
                                            ?>
                                                <tr>
                                                    <td> <?= $item['id']; ?> </td>
                                                    <td> <?= $item['name']; ?> </td>
                                                    <td> <?= $item['id_reteta']; ?> </td>
                                                    <td>
                                                        <?= $item['parere']?>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-sm btn-danger delete_recenzie_btn" value="<?= $item['id']; ?>" >Sterge</button>
                                                    </td>
                                                </tr>
                                            <?php

                                        }
                                    }
                                    else{
                                        echo "Nicio inregistrare gasita";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>