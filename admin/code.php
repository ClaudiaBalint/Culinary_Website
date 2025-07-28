<?php
include('../config/dbcon.php');
include('../functions/myfunctions.php');


if(isset($_POST['add_category_btn'])){
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0';
    $popular = isset($_POST['popular']) ? '1':'0';
  

    $image = $_FILES['image']['name'];

    $path ="../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $cate_query="INSERT INTO categories 
    (name,slug,description,meta_title,meta_description,meta_keywords,status,popular,image)
    VALUES('$name','$slug','$description','$meta_title','$meta_description','$meta_keywords','$status','$popular','$filename')";

    $cate_query_run = mysqli_query($con,$cate_query);

    if($cate_query_run){

        move_uploaded_file($_FILES['image']['tmp_name'],$path.'/'.$filename);
       
        redirect("add-category.php","Categorie adaugata cu succes!");

    }
    else{
        redirect("add-category.php","Ceva nu a functionat, incearca iar");
    }

}
else if(isset($_POST['update_category_btn'])){

    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0';
    $popular = isset($_POST['popular']) ? '1':'0';

    $new_image = $_FILES['image']['name'];
    $old_image= $_POST['old_image'];

    if($new_image != ""){
       // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else{
        $update_filename = $old_image;
    }
    $path ="../uploads";

    $update_query ="UPDATE categories SET name='$name', slug='$slug', description='$description', meta_title='$meta_title',
    meta_description='$meta_description', meta_keywords='$meta_keywords', status='$status', popular='$popular',
    image='$update_filename' WHERE id='$category_id'";


    $update_query_run=mysqli_query($con,$update_query);

    if($update_query_run){

        if($_FILES['image']['name'] != ""){
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image)){
                unlink("../uploads/".$old_image);
            }
        }
        redirect("edit-category.php?id=$category_id","Categorie actualizata cu succes!");
    }
    else{
        redirect("edit-category.php?id=$category_id","Ceva nu a functionat");
    }



}
else if(isset($_POST['delete_category_btn'])){
    $category_id = mysqli_real_escape_string($con,$_POST['category_id']);

    $category_query=" SELECT * FROM categories WHERE id='$category_id'";
    $category_query_run=mysqli_query($con,$category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id='$category_id' ";
    $delete_query_run = mysqli_query($con,$delete_query);

    if($delete_query_run){
        
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        
        //redirect("category.php","Categorie stearsa cu succes!");
        echo 200;
        
    }
    else{
        //redirect("category.php","Ceva nu a functionat");
        echo 500;
    }
}
else if(isset($_POST['add_product_btn'])){
    
    $category_id= $_POST['category_id'];

    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $selling_price= $_POST['selling_price'];
    $qty=$_POST['qty'];

    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0';
    $trending = isset($_POST['trending']) ? '1':'0';

    $image = $_FILES['image']['name'];

    $path ="../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    if($name != "" && $slug != "" && $description !=""){
    
        $product_query = "INSERT INTO products (category_id,name,slug,small_description,description,selling_price,
        qty,meta_title,meta_description,meta_keywords,status,trending,image) VALUES 
        ('$category_id','$name','$slug','$small_description','$description','$selling_price','$qty',
        '$meta_title','$meta_description','$meta_keywords','$status','$trending','$filename') ";

        $product_query_run = mysqli_query($con,$product_query);

        if($product_query_run){
            
            move_uploaded_file($_FILES['image']['tmp_name'],$path.'/'.$filename);
        
            redirect("add-product.php","Reteta adaugat cu succes!");
        }
        else{
            redirect("add-product.php","Ceva nu a functionat");
        }

    }
    else{
        redirect("add-product.php","Toate câmpurile trebuie completate");
    }
}
else if(isset($_POST['update_order_btn'])){

    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];

    $updateOrder_query = "UPDATE orders SET status='$order_status' where tracking_no='$track_no'  ";
    $updateOrder_query_run= mysqli_query($con,$updateOrder_query);

    redirect("view-order.php?t=$track_no","Statusul comenzii a fost actualizat cu succes!");

}
else if(isset($_POST['add_cupon_btn'])){
    
   
    $name = $_POST['name_cupon'];
    $valoare= $_POST['val_cupon'];
    $status = isset($_POST['status_cupon']) ? '1':'0';
    
    if($name != "" && $valoare != "" && $status !=""){
    
        $cupon_query = "INSERT INTO cupoane (cupon,valoare,status) VALUES ('$name','$valoare','$status') ";

        $cupon_query_run = mysqli_query($con,$cupon_query);

        if($cupon_query_run){
            
            redirect("add-cupon.php","Cupon adăugat cu succes!");
        }
        else{
            redirect("add-cupon.php","Ceva nu a functionat");
        }

    }
    else{
        redirect("add-cupon.php","Toate câmpurile trebuie completate");
    }
}
else if(isset($_POST['update_cupon_btn'])){
    $cupon_id = $_POST['cupon_id'];
    $nume = $_POST['nume_cupon'];
    $valoare_cupon = $_POST['valoare_cupon'];
    $status = isset($_POST['status_cupon']) ? '1':'0';

    $update_cupon_query = "UPDATE cupoane SET cupon='$nume', valoare='$valoare_cupon', status='$status' WHERE id='$cupon_id'";
 
    $update_cupon_query_run = mysqli_query($con, $update_cupon_query);
    
    if($update_cupon_query_run){
        redirect("edit-cupon.php?id=$cupon_id","Cupon actualizat cu succes!");
    } else {
        redirect("edit-cupon.php?id=$cupon_id","Ceva nu a funcționat");
    }
}
else if(isset($_POST['delete_cupon_btn'])){

    $cupon_id = mysqli_real_escape_string($con,$_POST['cupon_id']);

    $cupon_query=" SELECT * FROM cupoane WHERE id='$cupon_id'";
    $cupon_query_run=mysqli_query($con,$cupon_query);
    $cupon_data = mysqli_fetch_array($cupon_query_run);

    $delete_query = "DELETE FROM cupoane WHERE id='$cupon_id' ";
    $delete_query_run = mysqli_query($con,$delete_query);

    if($delete_query_run){
        //redirect("cupon.php","Reteta șters cu succes!");
        echo 200;  
    }
    else{
        //redirect("cupon.php","Ceva nu a funcționat");
        echo 500;
    }
}
else if(isset($_POST['delete_recenzie_btn'])){

    $recenzie_id = mysqli_real_escape_string($con,$_POST['recenzie_id']);

    $recenzie_query=" SELECT * FROM reviews WHERE id='$recenzie_id'";
    $recenzie_query_run=mysqli_query($con,$recenzie_query);
    $recenzie_data = mysqli_fetch_array($recenzie_query_run);

    $delete_query = "DELETE FROM reviews WHERE id='$recenzie_id' ";
    $delete_query_run = mysqli_query($con,$delete_query);

    if($delete_query_run){
        //redirect("cupon.php","Reteta șters cu succes!");
        echo 200;  
    }
    else{
        //redirect("cupon.php","Ceva nu a funcționat");
        echo 500;
    }
}
else if(isset($_POST['add_recipe_btn'])){
    // Extragem datele din formular
    $recipe_name = mysqli_real_escape_string($con, $_POST['recipe_name']);
    $recipe_description = mysqli_real_escape_string($con, $_POST['recipe_description']);
    $ingredients = $_POST['ingredient_name']; 
    $quantities = $_POST['ingredient_quantity']; 
    $units = $_POST['ingredient_unit']; 
    $preparation_steps = $_POST['preparation_step']; 
    $optional_instructions = mysqli_real_escape_string($con, $_POST['optional_instructions']);
    $image = $_FILES['image']['name'];
    $recipe_status = mysqli_real_escape_string($con, $_POST['recipe_status']); // Adăugăm și statusul rețetei
    $calories = mysqli_real_escape_string($con, $_POST['calories']); // Adăugăm și numărul de calorii
    $nr_portii = mysqli_real_escape_string($con, $_POST['nr_portii']); // Adăugăm și numărul de porții

    // Directorul în care va fi salvată imaginea
    $upload_dir = "../uploads/";

    // Mutăm fișierul încărcat în directorul de upload
    move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $image);

    // Construim array-ul de ingrediente
    $ingredients_data = [];
    for ($i = 0; $i < count($ingredients); $i++) {
        $ingredient = mysqli_real_escape_string($con, $ingredients[$i]);
        $quantity = mysqli_real_escape_string($con, $quantities[$i]);
        $unit = mysqli_real_escape_string($con, $units[$i]);
        // Concatenăm informațiile și le adăugăm la array
        $ingredients_data[] = "$ingredient $quantity $unit";
    }
    // Construim array-ul de ingrediente
    $ingredients_data = [];
    for ($i = 0; $i < count($ingredients); $i++) {
        $ingredient = mysqli_real_escape_string($con, $ingredients[$i]);
        $quantity = mysqli_real_escape_string($con, $quantities[$i]);
        $unit = mysqli_real_escape_string($con, $units[$i]);
        // Concatenăm informațiile și le adăugăm la array
        $ingredients_data[] = "$ingredient $quantity $unit";
    }
    // Serializăm array-ul de ingrediente într-un string, fiecare ingredient pe o linie nouă
    $ingredients_str = implode("\n", $ingredients_data);

    // Verificăm dacă sunt pași de preparare și îi procesăm
    if (!empty($preparation_steps)) {
        // Transformăm fiecare pas de preparare într-un string, fiecare pe o linie nouă
        $preparation_steps_str = implode("\n", $preparation_steps);
    } else {
        $preparation_steps_str = "Nu există pași de preparare";
    }


    // Extragem orele și minutele pentru timpul de preparare
    $timp_ore = mysqli_real_escape_string($con, $_POST['timp_ore']);
    $timp_minute = mysqli_real_escape_string($con, $_POST['timp_minute']);


    // Verificăm dacă există alergeni
    $alergeni = isset($_POST['alergeni']) ? implode(',', $_POST['alergeni']) : '-';

    $recipe_category = mysqli_real_escape_string($con, $_POST['categorie']); // Adăugăm și categoria

    // Query pentru inserarea datelor în baza de date, includând și categoria
    $recipe_query = "INSERT INTO retete (nume, descriere, ingrediente, pasi, indicatii_opt, img, status, alergeni, calorii, nr_portii, ore, minute, categorie) VALUES 
    ('$recipe_name', '$recipe_description', '$ingredients_str', '$preparation_steps_str', '$optional_instructions', '$image', '$recipe_status','$alergeni', '$calories', '$nr_portii','$timp_ore','$timp_minute', '$recipe_category')";
    
    // Rulăm query-ul
    $recipe_query_run = mysqli_query($con, $recipe_query);

    if($recipe_query_run){
        redirect("add-product.php", "Rețetă adăugată cu succes!");
    } else {
        redirect("add-product.php", "Ceva nu a funcționat");
    }
}
else if(isset($_POST['update_recipe_btn'])){
    $recipe_id = $_POST['recipe_id'];
    $recipe_name = $_POST['recipe_name'];
    $recipe_description = $_POST['recipe_description'];
    $recipe_ingredients = $_POST['recipe_ingredients'];
    $recipe_steps = $_POST['recipe_steps'];
    $optional_instructions = $_POST['optional_instructions'];
    $status = $_POST['status'];
    $calories = $_POST['calories'];
    $nr_portii = $_POST['nr_portii'];
    $timp_ore = $_POST['timp_ore'];
    $timp_minute = $_POST['timp_minute'];

    // Verificăm dacă există o imagine nouă
    if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
        $image = $_FILES['image']['name'];
        $upload_dir = "../uploads/";
        move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $image);
    } else {
        $image = $_POST['old_image'];
    }

    $ingredients_str = mysqli_real_escape_string($con, $recipe_ingredients);

    if (!empty($recipe_steps)) {
        $preparation_steps_str = mysqli_real_escape_string($con, implode("***", $recipe_steps));
    } else {
        $preparation_steps_str = "Nu există pași de preparare";
    }

    $optional_instructions = mysqli_real_escape_string($con, $optional_instructions);
    $recipe_name = mysqli_real_escape_string($con, $recipe_name);
    $recipe_description = mysqli_real_escape_string($con, $recipe_description);
    $image = isset($image) ? mysqli_real_escape_string($con, $image) : "";
    $status = mysqli_real_escape_string($con, $status);
    $calories = mysqli_real_escape_string($con, $calories);
    $nr_portii = mysqli_real_escape_string($con, $nr_portii);
    $timp_ore = mysqli_real_escape_string($con, $timp_ore);
    $timp_minute = mysqli_real_escape_string($con, $timp_minute);

    // Construim stringul pentru alergenii selectați
    $alergeni = isset($_POST['allergen']) ? implode(',', $_POST['allergen']) : '';

    $recipe_category = mysqli_real_escape_string($con, $_POST['categorie']); // Adăugăm și categoria

    // Query-ul pentru actualizarea datelor în baza de date, includând și categoria
    $update_recipe_query = "UPDATE retete SET nume='$recipe_name', descriere='$recipe_description', ingrediente='$ingredients_str', pasi='$preparation_steps_str', indicatii_opt='$optional_instructions', img='$image', status='$status', calorii='$calories', nr_portii='$nr_portii', ore='$timp_ore', minute='$timp_minute', alergeni='$alergeni', categorie='$recipe_category' WHERE id='$recipe_id'";

    // Rulăm query-ul
    $update_recipe_query_run = mysqli_query($con, $update_recipe_query);

    if($update_recipe_query_run){
        redirect("edit-recipe.php?id=$recipe_id", "Rețetă actualizată cu succes!");
    } else {
        redirect("edit-recipe.php?id=$recipe_id", "Ceva nu a funcționat");
    }
}
else if(isset($_POST['delete_recipe_btn'])){
    $recipe_id = mysqli_real_escape_string($con, $_POST['recipe_id']);

    // Obținem numele imaginii pentru a o șterge din directorul de încărcare
    $image_query = mysqli_query($con, "SELECT img FROM retete WHERE id='$recipe_id'");
    $image_data = mysqli_fetch_assoc($image_query);
    $image = $image_data['img'];

    // Ștergem rețeta din baza de date
    $delete_recipe_query = "DELETE FROM retete WHERE id='$recipe_id'";
    $delete_recipe_query_run = mysqli_query($con, $delete_recipe_query);

    if($delete_recipe_query_run){
        // Ștergem imaginea asociată rețetei din directorul de încărcare
        if(file_exists("../uploads/".$image)){
            unlink("../uploads/".$image);
        }
        //redirect("recipes.php", "Rețetă ștearsă cu succes!");
        echo 200;  
    } else {
        //redirect("recipes.php", "Ceva nu a funcționat");
        echo 500;
    }
}




else{
    header('Location: ../index.php');
}
?>