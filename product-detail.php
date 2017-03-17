<?php
include("session.php");

$id = $_POST['id'];
//$id = 49584;
//$sql = "SELECT * FROM track_product WHERE id=".$id." LIMIT 1";
$sql = "SELECT track_user.pid AS userid,track_user.nama AS namaseller,track_product.pid AS barangid,track_product.id,track_product.attachment,track_product.attachmentweb1,track_product.attachmentweb2,track_product.attachmentweb3,track_product.productname,track_product.price,track_product.statusstok,track_product.bilstok,track_product.productdesc FROM track_user,track_product WHERE track_user.pid = track_product.pid AND track_product.id = ".$id." LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
//        $image="unavailable.jpg";
        $image_name=$row['attachment'];
        $image_1="http://corrad.visionice.net/bizapp/upload/product/".$row['attachmentweb1'];
        $image_2="http://corrad.visionice.net/bizapp/upload/product/".$row['attachmentweb2'];
        $image_3="http://corrad.visionice.net/bizapp/upload/product/".$row['attachmentweb3'];
        $path1 = "http://corrad.visionice.net/bizapp/upload/product/".$image_name;
        $path2 = "images/home/unavailable.jpg";
        $sharepath="images/product-details/share.png";
        $statusstock=$row['statusstok'];
        $bilstock=$row['bilstok'];
        $harga=$row['price'];
        
        if($statusstock=='Y'){
            $stockdisplay="In Stock";
        }else{
            if($bilstock==0){
                $stockdisplay="Out of Stock";
            }else{
                $stockdisplay=$bilstock;
            }
        }
        
        if($image_name == null){
            $image=$path2;
            $imagestr="<div class='image-display' style='background-image: url(".$image."); border: 1px solid #E6E4DF;border: 1px solid #E6E4DF;width: 100%; height: 380px; position: absolute; background-color: black; background-size: cover; background-position: center center;background-repeat:no-repeat'></div>";
        }else{
            //$image=$path1;
            if (@getimagesize($path1)) {
                $image=$path1;
                $imagestr="<div class='image-display' style='background-image: url(".$image."); border: 1px solid #E6E4DF;width: 100%; height: 380px; position: absolute; background-color: black; background-size: cover; background-position: center center;background-repeat:no-repeat'></div>";

            } else {
                $image=$path2;
                $imagestr="<div class='image-display' style='background-image: url(".$image."); border: 1px solid #E6E4DF;width: 100%; height: 380px; position: absolute; background-color: black; background-size: cover; background-position: center center;background-repeat:no-repeat'></div>";
            }
        }
        
        if($image_1 == null){
            $image_1=$path2;
        }else{
            if (@getimagesize($image_1)) {
                $image_1=$image_1;
            } else {
                $image_1=$path2;
            }
        }
        
        if($image_2 == null){
            $image_2=$path2;
        }else{
            if (@getimagesize($image_2)) {
                $image_2=$image_2;
            } else {
                $image_2=$path2;
            }
        }
        
        if($image_3 == null){
            $image_3=$path2;
        }else{
            if (@getimagesize($image_3)) {
                $image_3=$image_3;
            } else {
                $image_3=$path2;
            }
        }
        
        if($user_id==""){
            $user_id=15;
        }
        
        
        
        echo"<div class='col-sm-4'> <div class='row' style='padding-top:0'><div class='view-product'> ".$imagestr." </div></div><div class='row' style='margin-top:370px;padding-bottom:0;'><div class='col-sm-12' style='padding-left: 0;padding-right: 0;'><table style='width:100%;height:60px;text-align:center;'><tr><td style='width:25%;border: 5px solid transparent;'><a href='javascript:void(0)' class='image-click' id='".$path1."'><img class='image_1' src='".$path1."' style='width:100%;height:60px;border:1px solid gray;'></a></td><td style='width:25%;border: 5px solid transparent;'><a href='javascript:void(0)' class='image-click' id='".$image_1."'><img class='image_1' src='".$image_1."' style='width:100%;height:60px;border:1px solid gray;'></a></td><td style='width:25%;border: 5px solid transparent;'><a href='javascript:void(0)' class='image-click' id='".$image_2."'><img src='".$image_2."' style='width:100%;height:60px;border:1px solid gray;'></a></td><td style='width:25%;border: 5px solid transparent;'><a href='javascript:void(0)' class='image-click' id='".$image_3."'><img src='".$image_3."' style='width:100%;height:60px;border:1px solid gray;'></a></td></tr></table></div></div></div> <div class='col-sm-8'> <div class='product-information'> <!--/product-information--><div class='row'> <div class='col-sm-8'><h2>".$row['productname']."</h2></div> <div class='col-sm-4'><p>Product ID: ".$row['id']."</p></div></div>  <div class='row'><div class='col-sm-8'><span><span class='prod_harga'>RM".$harga."</span></div><div class='col-sm-4'><label>Quantity:</label> <div class='cart_quantity' style='margin-left: 25px;'>
                            <div class='cart_quantity_button'> <a class='cart_quantity_up' href='javascript:void(0);'> + </a>
                                <input class='cart_quantity_input' type='text' name='quantity' value='1' autocomplete='off' size='2'> <a class='cart_quantity_down' href='javascript:void(0);'> - </a> </div>
                          </span></div><div class='col-sm-8></div><div class='col-sm-4'><p><b>Availability:</b> ".$stockdisplay."</p></div></div> <div class='row'><div class='col-sm-8'> </div><!-- <p><b>Condition:</b> New</p>--> <div class='col-sm-12 text-center'><p><b>By:</b> <a href='javascript:void(0);' class='seller-detail' onclick='getSellerDetail(".$row['userid'].")' style='color:#FE980F;font-weight:bold'>".$row['namaseller']."</a></p></div></div> <div class='row'><div class='choose'> <ul class='nav nav-pills nav-justified'><li style='text-align:center'><button type='button' class='btn btn-fefault cart' style='margin-bottom: 0;margin-left: 0;' onclick='buyNow(".$id.",".$row['userid'].");'> <i class='fa fa-shopping-cart'></i> Buy Now! </button></li> <li><a href='javascript:void(0);' onclick='addCart(".$id.",".$row['userid'].");'><i class='fa fa-plus'></i>Add to Cart</a></li>  </ul> </div></div><div class='row' style='border-bottom:0 !important;'><h2>Product Detail</h2><p style='text-align:justify'><pre style='text-align:justify'>".$row['productdesc']."</pre></p></div> </div> <!--/product-information--> </div>";

    }
    
    echo "<script>$('.image-click').on('click',function(){var image_take=$(this).attr('id');$('.image-display').css('background-image','url('+image_take+')')});function getSellerDetail(sellerid) {window.open('seller-detail.php?id=' + sellerid);}</script>";
    
    echo "<script>
    var jumlah=parseInt($('.cart_quantity_input').attr('value'));
    
    $('.cart_quantity_up').on('click',function(){
        jumlah+=1;
        $('.cart_quantity_input').attr('value',jumlah);
        var harga=".$harga.";
        var hasil=(harga*jumlah).toFixed(2);
        $('.prod_harga').text('RM'+hasil);
    });
    
    $('.cart_quantity_down').on('click',function(){
        if(jumlah>1){
            jumlah-=1;
            $('.cart_quantity_input').attr('value',jumlah);
            var harga=".$harga.";
            var hasil=(harga*jumlah).toFixed(2);
            $('.prod_harga').text('RM'+hasil);
        } 
    });
    
    var user_id = ".$user_id.";
    
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
    </script>";
    
} else {
    echo "<div class='col-sm-12 not-found'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Sorry, no products found...</div>";
}
$conn->close();
?>