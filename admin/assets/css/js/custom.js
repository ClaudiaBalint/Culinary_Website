$(document).ready(function () {

  
    $(document).on('click', '.delete_recipe_btn', function (e) {
        e.preventDefault();
    
        var recipe_id = $(this).data('id'); // Obține valoarea atributului data-id
    
        Swal.fire({
            title: "Ești sigur?",
            text: "Nu vei putea recupera datele!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Da"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "code.php",
                    data: {
                        'recipe_id': recipe_id,
                        'delete_recipe_btn': true
                    },
                    success: function (response) {
                        if (response == 200) {
                            Swal.fire("Felicitări!", "Rețetă ștearsă cu succes!", "success");
                            $("#recipes_table").load(location.href + " #recipes_table");
                        } else if (response == 500) {
                            Swal.fire("Ups!", "Ceva nu a funcționat", "error");
                        }
                    }
                });
            }
        });
    });
    

    $(document).on('click', '.delete_cupon_btn', function (e) {
        e.preventDefault();
    
        var cuponId = $(this).val();
    
        Swal.fire({
            title: "Ești sigur?",
            text: "Nu vei putea recupera datele!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Da"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "code.php",
                    data: {
                        'cupon_id': cuponId,
                        'delete_cupon_btn': true
                    },
                    success: function (response) {
                        if (response == 200) {
                            Swal.fire("Felicitări!", "Cupon șters cu succes!", "success");
                            $("#cupoane_table").load(location.href + " #cupoane_table");
                        } else if (response == 500) {
                            Swal.fire("Ups!", "Ceva nu a funcționat", "error");
                        }
                    }
                });
            }
        });
    });
    
    $(document).on('click', '.delete_recenzie_btn', function (e) {
        e.preventDefault();
    
        var recenzieId = $(this).val();
    
        Swal.fire({
            title: "Ești sigur?",
            text: "Nu vei putea recupera datele!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Da"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "code.php",
                    data: {
                        'recenzie_id': recenzieId,
                        'delete_recenzie_btn': true
                    },
                    success: function (response) {
                        if (response == 200) {
                            Swal.fire("Felicitări!", "Recenzie ștearsă cu succes!", "success");
                            $("#recenzii_table").load(location.href + " #recenzii_table");
                        } else if (response == 500) {
                            Swal.fire("Ups!", "Ceva nu a funcționat", "error");
                        }
                    }
                });
            }
        });
    });
    





    $(document).on('click','.delete_category_btn', function (e) {
        
        e.preventDefault();

        var id = $(this).val();
        //alert(id);

        Swal.fire({
            title: "Ești sigur?",
            text: "Nu vei putea recupera datele!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Da"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    method: "POST",
                    url: "code.php",
                    data: {
                        'category_id': id,
                        'delete_category_btn': true
                    },
                    success: function (response) {
                        console.log(response);
                        if (response == 200) {
                            Swal.fire("Felicitări!", "Categorie ștearsă cu succes!", "success");
                            $("#category_table").load(location.href + " #category_table");
                        } else if (response == 500) {
                            Swal.fire("Ups!", "Ceva nu a funcționat", "error");
                        }
                    }
                });

            }
        });
    });

});
