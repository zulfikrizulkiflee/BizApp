<?php
include("session.php");

$order="";

$sellerid = $_POST['sellerid'];

$id_menu = $_POST['id_menu_kedai'];
if($id_menu=="1"){
    $order="";
}else if($id_menu=="2"){
    $order=" ORDER by price DESC";
}else if($id_menu=="3"){
    $order=" ORDER by price ASC";
}

if(isset($user_id)){
    $user_id=$user_id;
}else{
    $user_id=15;
}

//$sql= "SELECT * FROM track_product WHERE pid=".$sellerid." AND price IS NOT NULL AND status=1";

$sql = "SELECT track_product.attachment, track_product.id, track_product.price, track_product.productname, track_product.pid, track_user.pid, track_user.nama, track_user.attachmentphoto FROM track_product, track_user WHERE track_product.pid=".$sellerid." AND track_user.pid=".$sellerid." AND track_product.price IS NOT NULL AND track_product.status=1".$order;


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $nama="";
    // output data of each row
    
    while($row = $result->fetch_assoc()) {
//        $image="unavailable.jpg";
        $image_kedai="http://corrad.visionice.net/bizapp/upload/profile/".$row['attachmentphoto'];
        $image_name=$row['attachment'];
        $path1 = "http://corrad.visionice.net/bizapp/upload/product/".$image_name;
        $path2 = "images/home/unavailable.jpg";
        $nama = $row['nama'];
        
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
        
        $imagestr="<div data-original='".$image."' style='width: 100%; height: 380px; position: absolute; background-color: black; background-size: cover; background-position: center center;'></div>";
        
        echo"<div class='col-xs-6 col-sm-4 col-lg-3'> <div class='product-image-wrapper'> <div class='single-products'> <div class='productinfo text-center'> <a href='#' class='prod-desired' id='".$row['id']."' data-toggle='modal' data-target='#product-modal'><img class='backup_picture lazy' data-original='".$image."' alt='".$image."' /></a> <h2>RM".$row['price']."</h2> <p class='truncate' title='".$row['productname']."'>".$row['productname']."</p><br> <a href='javascript:void' class='btn btn-default add-to-cart' onclick='buyNow(".$row['id'].",".$sellerid.");'><i class='fa fa-shopping-cart'></i>Buy Now</a> </div> </div> <div class='choose'> <ul class='nav nav-pills nav-justified'> <li><a href='javascript:void' onclick='addCart(".$row['id'].",".$sellerid.");><i class='fa fa-plus'></i>Add to Cart</a></li>  </ul> </div> </div> </div>";    
    }
    
    $preloader="<div class=\"row preloader\"><div class=\"wrap-loading\"><div class=\"loading loading-4\"></div></div></div>";
    echo "<script>
    console.log(".$id_menu.");
            $('#namakedai').text('".$nama."');
            $('.prod_jumlah').text('".$result->num_rows."');
            $('.seller-pic').css('background-image','url(".$image_kedai.")');
            $('img.lazy').lazyload();
            document.title = '".$nama." | BizApp';
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
            
            var user_id = ".$user_id.";
            var jumlah=parseInt($('.cart_quantity_input').attr('value'));
    
            function buyNow(prod_id,seller_id){
                $.ajax({
                    type: 'POST'
                    , data: {
                        prod_id: prod_id,
                        seller_id: seller_id,
                        user_id: user_id,
                        jumlah:jumlah
                    }
                    , url: 'cart_insert.php'
                    , success: function (data) {
                        toast();
                        setTimeout(function(){ window.open('cart.php', '_blank');$('.modal').modal('hide'); }, 2000);

                    }
                });
            }

            function addCart(prod_id,seller_id){
                $.ajax({
                    type: 'POST'
                    , data: {
                        prod_id: prod_id,
                        seller_id: seller_id,
                        user_id: user_id,
                        jumlah:jumlah
                    }
                    , url: 'cart_insert.php'
                    , success: function (data) {
                        console.log(data);
                        toast();
                    }
                });
            }
            
            function toast() {
                var x = document.getElementById('snackbar');
                x.className = 'show';
                setTimeout(function () {
                    x.className = x.className.replace('show', '');
                }, 3000);
            }
            
        </script>";
} else {
    echo "<div class='col-sm-12 not-found'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Sorry, no products found...</div>";
}
$conn->close();
?>