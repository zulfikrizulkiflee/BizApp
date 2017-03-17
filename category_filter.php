<?php
include("conn.php");

$order="";

$cat_code = $_POST['cat_code'];
$id_menu_cat = $_POST['id_menu_cat'];
if($id_menu_cat=="1"){
    $order="";
}else if($id_menu_cat=="2"){
    $order=" ORDER by price DESC";
}else if($id_menu_cat=="3"){
    $order=" ORDER by price ASC";
}

$sql = "SELECT * FROM track_product WHERE productcategorycode=".$cat_code." AND price IS NOT NULL AND status=1".$order;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
//        $image="unavailable.jpg";
        $image_name=$row['attachment'];
        $path1 = "http://corrad.visionice.net/bizapp/upload/product/".$image_name;
        $path2 = "images/home/unavailable.jpg";
        
        if($image_name == null){
            $image=$path2;
        }else{
//            $image=$path1;
            if (@getimagesize($path1)) {
                $image=$path1;
            } else {
                $image=$path2;
            }
        }
        
        $imagestr="<div style='background-image: url(".$image."); width: 100%; height: 380px; position: absolute; background-color: black; background-size: cover; background-position: center center;'></div>";
        
        echo"<div class='col-xs-6 col-sm-4 col-lg-3'> <div class='product-image-wrapper'> <div class='single-products'> <div class='productinfo text-center'> <a href='#' class='prod-desired' id='".$row['id']."' data-toggle='modal' data-target='#product-modal'><img class='backup_picture' src='".$image."' alt='".$image."' /> <h2>RM".$row['price']."</h2> <p class='truncate' title='".$row['productname']."'>".$row['productname']."</p><br></a> </div> </div>  </div> </div>";    
    }
    
    $preloader="<div class=\"row preloader\"><div class=\"wrap-loading\"><div class=\"loading loading-4\"></div></div></div>";
    echo "<script>
            $('.prod-desired').on('click', function () {
                $('html').css('overflow','hidden');
                $('.product-details').html('".$preloader."');
                var id = $(this).attr('id');
                $.ajax({
                    type: 'POST'
                    , data: {
                        id: id
                    }
                    , url: 'product-detail.php'
                    , success: function (data) {
                        $('.product-details').html(data);
                    }
                });
            });
            $('.modal').on('hidden.bs.modal', function () {
                $('html').css('overflow-y','scroll');
            });
        </script>";
} else {
    echo "<div class='col-sm-12 not-found'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Sorry, no products found...</div>";
}
$conn->close();
?>