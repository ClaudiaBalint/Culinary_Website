<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php 
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];  
                    $recipe = getById("retete", $id);

                    if(mysqli_num_rows($recipe) > 0)
                    {
                        $data=mysqli_fetch_array($recipe);
                        ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Editare rețetă
                                    <a href="products.php" class="btn btn-primary float-end">Înapoi</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="mb-0">Nume rețetă</label>
                                                <input type="text" required name="recipe_name" value="<?= $data['nume']; ?>" placeholder="Introdu numele rețetei" class="form-control mb-2">
                                                <input type="hidden" name="recipe_id" value="<?= $id ?>">
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
                                                <textarea rows="3" required name="recipe_description" placeholder="Introdu o descriere scurtă a rețetei" class="form-control mb-2"><?= $data['descriere']; ?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="mb-0">Ingrediente</label>
                                                <textarea rows="3" required name="recipe_ingredients" placeholder="Introdu ingredientele necesare, fiecare ingredient pe un rând separat" class="form-control mb-2"><?= $data['ingrediente']; ?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="mb-0">Pași de preparare</label>
                                                <textarea rows="6" required name="recipe_steps[]" placeholder="Introdu pașii de preparare, fiecare pas pe un rând separat" class="form-control mb-2"><?= $data['pasi']; ?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="mb-0">Alergeni</label><br>
                                                <?php
                                                    $allergens = ["fructe_cu_coaja_lemnoasa", "arahide", "lapte de vaca", "crustacee_si_moluste", "soia", "ou", "peste", "gluten", "telina", "mustar", "seminte_de_susan", "lupin", "dioxid_de_sulf"];
                                                    foreach ($allergens as $allergen) {
                                                        $checked = in_array($allergen, explode(',', $data['alergeni'])) ? 'checked' : '';
                                                        echo '<input type="checkbox" name="allergen[]" value="' . $allergen . '" ' . $checked . '> ' . $allergen . '<br>';
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="mb-0">Indicații opționale</label>
                                                <textarea rows="3" name="optional_instructions" placeholder="Introdu indicații opționale" class="form-control mb-2"><?= $data['indicatii_opt']; ?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="mb-0">Încarcă o imagine</label>
                                                <input type="file" name="image" class="form-control mb-2">
                                                <label class="mb-0">Imagine curentă</label>
                                                <input type="hidden" name="old_image" value="<?= $data['img'] ?>">
                                                <img src="../uploads/<?= $data['img']; ?>" alt="Imagine rețetă" height="100px" width="100px">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="">Status</label>
                                                <select name="status" class="form-select">
                                                    <option value="1" <?= $data['status'] == 1 ? "selected" : "" ?>>Reteta postata</option>
                                                    <option value="0" <?= $data['status'] == 0 ? "selected" : "" ?>>Reteta in curs de verificare</option>
                                                    <option value="-1" <?= $data['status'] == -1 ? "selected" : "" ?>>Reteta revocata</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="mb-0">Calorii pe portie</label>
                                                <input type="number" name="calories" placeholder="Introdu numărul de calorii" class="form-control mb-2" value="<?= $data['calorii']; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="mb-0">Timpul de preparare (ore)</label>
                                                <input type="number" name="timp_ore" placeholder="Ore" class="form-control mb-2" min="0" max="60" step="1" value="<?= $data['ore']; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="mb-0">Timpul de preparare (minute)</label>
                                                <input type="number" name="timp_minute" placeholder="Minute" class="form-control mb-2" min="0" max="59" step="1" value="<?= $data['minute']; ?>">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="mb-0">Număr de porții</label>
                                                <input type="number" name="nr_portii" placeholder="Introdu numărul de porții" class="form-control mb-2" value="<?= $data['nr_portii']; ?>">
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary" name="update_recipe_btn">Actualizează rețeta</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php
                    }
                    else{
                        echo "Rețeta nu a fost găsită pentru ID-ul dat.";
                    }
                }  
                else{
                    echo "ID-ul lipsește din URL.";
                }
            ?>
        </div>
    </div>
</div>




<?php include('includes/footer.php');?>