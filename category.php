<?php
include("conn.php");

$sql = "SELECT * FROM track_product_category";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'><a class='cat_name' href='javascript:void(0)' id='".$row['code']."'>".$row['description_en']."</a></h4> </div></div>";
    }
    
    echo "<script>
        $('.cat_name').on('click',function(){
            var cat_code=$(this).attr('id');
            var id_menu_cat=$('.menu-button-cat').attr('id');
            $('.filter-items').css('display', 'none');
            $('.filter-items-cat').css('display', 'block');
            catFunc();
            
            $('.cat-menu li').on('click', function () {
                var menutext = $(this).text();
                id_menu_cat = $(this).attr('id');
                $('.menu-button-cat').text(menutext);
                $('.menu-button-cat').attr('id', id_menu_cat);
                catFunc();
            });
            
            function catFunc() { 
                $('.focus-here')[0].focus(); 
                $('.discover-items').html('<div class=\"row preloader\"><div class=\"wrap-loading\"><div class=\"loading loading-4\"></div></div></div>'); 
                $.ajax({ 
                    type: 'POST', 
                    data: { 
                        id_menu_cat: id_menu_cat, 
                        cat_code:cat_code 
                    }, 
                    url: 'category_filter.php', 
                    success: function (data) { 
                        $('.discover-items').html(data); 
                    } 
                }); 
            }
        });
        </script>";
} else {
    echo "<div class='col-sm-12 not-found'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Sorry, no products found...</div>";
}
$conn->close();
?>