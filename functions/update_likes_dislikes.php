<div id="likeDislikeCounts"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Funcție pentru a actualiza numărul de like-uri și dislike-uri
    function updateLikesDislikes() {
        var recipeId = <?= $recipe['id']; ?>;
        $.ajax({
            method: "POST",
            url: "update_likes_dislikes.php",
            data: {
                "recipe_id": recipeId
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.hasOwnProperty('likes') && data.hasOwnProperty('dislikes')) {
                    $("#likeDislikeCounts").html("Likes: " + data.likes + ", Dislikes: " + data.dislikes);
                }
            }
        });
    }

    // Actualizăm numărul de like-uri și dislike-uri la încărcarea paginii
    updateLikesDislikes();
});
</script>
