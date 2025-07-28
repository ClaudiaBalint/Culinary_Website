<?php 

include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Adaugă o rețetă
                        <a href="products.php" class="btn btn-primary float-end">Înapoi</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="mb-0">Nume rețetă</label>
                                <input type="text" required name="recipe_name" placeholder="Introdu numele rețetei" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Categorie</label>
                                <select name="categorie" class="form-select mb-2" required >
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
                                            <button type="button" class="btn btn-primary" onclick="addIngredientField()">+</button>
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
                                            <button type="button" class="btn btn-primary" onclick="addStepField()">+</button>
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
                                <label class="mb-0">Calorii pe portie</label>
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
                                    <option value="1">Reteta postata</option>
                                    <option value="0">Reteta in curs de verificare</option>
                                    <option value="-1">Reteta revocata</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_recipe_btn">Salvează rețeta</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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


<?php include('includes/footer.php');?>