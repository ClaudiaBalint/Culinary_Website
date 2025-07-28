function updateTotalPrice() {
    var totalPrice = 0;
    $('.product_data').each(function() {
        var sellingPriceText = $(this).find('.selling-price h5').text().replace(' lei', '');
        var sellingPrice = parseFloat(sellingPriceText);
        var quantity = parseInt($(this).find('.input-qty').val(), 10);

        console.log('Selling Price Text:', sellingPriceText);
        console.log('Selling Price:', sellingPrice);
        console.log('Quantity:', quantity);

        totalPrice += sellingPrice * quantity;
    });

    $('#totalPriceValue').text(totalPrice);
}





$(document).ready(function () {


    $('#applyCouponBtn').on('click', function(){
        var cupon = $('#cupon').val();
        var totalPrice = parseFloat($('#hiddenTotalPrice').val()); 
        console.log(typeof totalPrice); 
        $.ajax({
            method: 'POST',
            url: 'functions/cuponfct.php',
            data: {
                cupon: cupon,
                totalPrice: totalPrice // Trimiterea variabilei totalPrice
            },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    alertify.error(response.error);
                    return;
                }
            
              
    
                var newTotalPrice = response.newTotalPrice;
                $('#newTotalPrice').text('Valoarea coșului dupa reducere: ' + newTotalPrice).show();
    
                var transportCost = (newTotalPrice >= 150) ? 'Gratuit!' : '19 lei';
                $('#transportCost').text('Transport: ' + transportCost);
                
                var totalCost = newTotalPrice + ((newTotalPrice >= 150) ? 0 : 19);
                $('#totalCost').text(totalCost);
    


                alertify.success("Cuponul a fost aplicat cu succes!");


            },
            error: function(xhr, status, error) {
                console.error(error);
                alertify.error("A apărut o eroare în aplicarea cuponului.");
            }
        });
    });


     
    $(document).off('click', '.increment-btn').on('click', '.increment-btn', function(e) {
        e.preventDefault();
    
       
        var inputQty = $(this).closest('.card').find('.input-qty');
        var value = parseInt(inputQty.val(), 10);
        var qtyDinBazaDeDate = parseInt($(this).closest('.card').find('.databaseQty').val(), 10);
        console.log('Value:', value);
        console.log('Qty din baza de date:', qtyDinBazaDeDate);

        if (!isNaN(value) && value < qtyDinBazaDeDate) {
            inputQty.val(value + 1);
        } else {
            console.log('Value is already equal or greater than Qty from Database');
        }
       

    });
    
    $(document).off('click', '.decrement-btn').on('click', '.decrement-btn', function(e) {
        e.preventDefault();
    
        var inputQty = $(this).closest('.card').find('.input-qty');
        var value = parseInt(inputQty.val(), 10);
        var qtyDinBazaDeDate = parseInt($(this).closest('.card').find('.databaseQty').val(), 10);
    
        if (!isNaN(value) && value > 1) {
            inputQty.val(value - 1);
        }
    });

    $(document).off('click', '.increment-btn-prod').on('click', '.increment-btn-prod', function(e) {
        e.preventDefault();
    
        var inputQty = $(this).siblings('.input-qty');
        var value = parseInt(inputQty.val(), 10);
        var qtyDinBazaDeDate = parseInt($('.databaseQty').val(), 10);
    
        if (!isNaN(value) && value < qtyDinBazaDeDate) {
            inputQty.val(value + 1);
        } else {
            console.log('Value is already equal or greater than Qty from Database');
        }
    });
    
    $(document).off('click', '.decrement-btn-prod').on('click', '.decrement-btn-prod', function(e) {
        e.preventDefault();
    
        var inputQty = $(this).siblings('.input-qty');
        var value = parseInt(inputQty.val(), 10);
    
        if (!isNaN(value) && value > 1) {
            inputQty.val(value - 1);
        }
    });

    $('.parereBtn').click(function (e) { 
        e.preventDefault();
    
        var nume = $('.input-nume').text(); // Folosește text() pentru a prelua valoarea ca text static
        var parere = $('.input-parere').val();
        var user_id = $('[name="user_id"]').val(); // Folosește atributul name pentru a selecta corect
        var recipe_id = $('[name="recipe_id"]').val();
    
        $.ajax({
            method: "POST",
            url: "functions/user-code.php",
            data: {
                "nume_parere": nume,
                "parere": parere,
                "user_id": user_id,
                "recipe_id": recipe_id,
                "parereBtn": true // Adăugați o cheie suplimentară pentru a indica că a fost apăsat butonul de trimitere
            },
            success: function (response) {
                try {
                    var responseData = JSON.parse(response);
                    if(responseData.status === "success"){
                        alertify.success(responseData.message);
                        // Poți face orice acțiune suplimentară aici, cum ar fi actualizarea listei de recenzii
                    }
                    else {
                        alertify.error(responseData.message);
                    }
                } catch (e) {
                    console.error("Eroare la parsarea răspunsului JSON:", e);
                }
            }
        });
    });
    
    
    


    $('.addToCartBtn').click(function (e) { 
        e.preventDefault();

        var qty=$(this).closest('.product_data').find('.input-qty').val();
        var prod_id= $(this).val();
        
        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "add"
            },
            success: function (response) {
                
                if(response==201){
                   
                    alertify.success("Rețetă adaugat cu succes!");
                }
                else if(response=="exist"){
                    alertify.error("Rețeta se afla deja in coșul de cumparaturi!");
                }
                else if(response==401){
                    alertify.error("Conecteaza-te pentru a continua");
                }
                else if(response==500){
                    alertify.error("Ceva nu a functionat");
                }
            }
        });
    });

    $('.addLike').click(function(e) {
        e.preventDefault();
        var button = $(this);
        var recipeId = button.data('recipe-id');
        var action = button.data('action');
        var user_id = button.data('user-id');
        console.log(user_id);
        console.log(recipeId);
        
        // Trimite cererea AJAX către handle_like.php pentru procesare
        $.ajax({
            method: "POST",
            url: "functions/handle_like.php",
            data: {
                "recipe_id": recipeId,
                "scope": action
            },
            success: function(response) {
                handleLikeResponse(response, button);
            }
        });
    });
    
    $('.addDislike').click(function(e) {
        e.preventDefault();
        var button = $(this);
        var recipeId = button.data('recipe-id');
        var action = button.data('action');
        var user_id = button.data('user-id');

        // Trimite cererea AJAX către handle_like.php pentru procesare
        $.ajax({
            method: "POST",
            url: "functions/handle_like.php",
            data: {
                "recipe_id": recipeId,
                "scope": action
            },
            success: function(response) {
                handleDislikeResponse(response, button);
            }
        });
    });
    
    // Funcție pentru a gestiona răspunsurile de la server pentru like
    function handleLikeResponse(response, button) {
        if (response === "200") {
            // Actualizează culoarea butonului și numărul de like-uri
            button.find('i').css('color', 'green');
            var likesCount = parseInt(button.siblings('.num-likes').text());
            button.siblings('.num-likes').text(likesCount + 1);
            alertify.success("Like adăugat cu succes!");
        } else if (response === "401") {
            alertify.error("Conectează-te pentru a putea da like sau dislike!");
        } else if (response === "402") {
            alertify.error("Ai dat deja dislike.");
        } else if (response === "403") {
            alertify.error("Like sters cu succes.");
        } else if (response === "500") {
            alertify.error("Ceva nu a funcționat.");
        }
    }
    
    // Funcție pentru a gestiona răspunsurile de la server pentru dislike
    function handleDislikeResponse(response, button) {
        if (response === "200") {
            // Actualizează culoarea butonului și numărul de dislike-uri
            button.find('i').css('color', 'red');
            var dislikesCount = parseInt(button.siblings('.num-dislikes').text());
            button.siblings('.num-dislikes').text(dislikesCount + 1);
            alertify.success("Disike adăugat cu succes!");
        } else if (response === "401") {
            alertify.error("Conectează-te pentru a putea da like sau dislike!");
        } else if (response === "402") {
            alertify.error("Ai dat deja dislike la această postare.");
        } else if (response === "403") {
            alertify.success("Dislike sters cu succes!");
        } else if (response === "500") {
            alertify.error("Ceva nu a funcționat.");
        }
    }
    
    

    


    $('.addToCartProduct').click(function (e) { 
        e.preventDefault();
    
        var prod_id = $(this).closest('.pro').find('.addToCartProduct').data('product-id');
        console.log("Produs ID:", prod_id);

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": 1, 
                "scope": "add"
            },
            success: function (response) {
                
                if(response == 201){
                    alertify.success("Reteta adăugat cu succes!");
                }
                else if(response == "exist"){
                    alertify.error("Reteta se află deja în favortie!");
                }
                else if(response == 401){
                    alertify.error("Conectează-te pentru a continua");
                }
                else if(response == 500){
                    alertify.error("Ceva nu a funcționat");
                }
            }
        });
    });
    
     $(document).on('click','.updateQty', function () {

        var qty=$(this).closest('.product_data').find('.input-qty').val();
        var prod_id= $(this).closest('.product_data').find('.prod-id').val();
       
        console.log("Product ID:", prod_id, "Quantity:", qty);

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "update"
            },
            success: function (response) {
                console.log('Răspuns:', response);
                if(response==200){
                    alertify.success("Rețetă actualizată cu succes!");
                }
                else if(response==500){
                    alertify.error("Ceva nu a functionat");
                }
            }
        });
    });


    
    $(document).on('click','.deleteItem', function () {

        var cart_id = $(this).val();
        
        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "cart_id": cart_id,
                "scope": "delete"
            },
            success: function (response) {
                if(response == 200){
                    alertify.success("Rețetă stears cu succes!");
                    $('#mycart').load(' #mycart > *');

                }
                else{
                    alertify.success(response);
                }
            }
        });
        
    }); 
    
    
 
    $(document).on('click', '.updateQty, .deleteItem', function() {
        updateTotalPrice();
    });




});


