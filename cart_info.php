<?php
include("session.php");

$user_id = $_POST['user_id'];

$sql = "SELECT comm_cart.user_id AS user_id,track_product.id AS id_barang,track_product.price, track_product.attachment AS pic_barang, track_product.productname AS nama_barang, track_product.productdesc AS detail_barang, track_user.nama AS nama_seller, track_product.price AS harga_barang, track_product.statusstok AS status_barang,track_product.bilstok,comm_cart.checkin_date,comm_cart.quantity AS quantity,comm_cart.price_sum AS price_sum FROM comm_cart,track_user,track_product WHERE comm_cart.user_id=".$user_id." AND track_user.pid=comm_cart.seller_id AND comm_cart.prod_id=track_product.id ORDER BY comm_cart.checkin_date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
//        $image="unavailable.jpg";
        $image_name=$row['pic_barang'];
        $path1 = "http://corrad.visionice.net/bizapp/upload/product/".$image_name;
        $path2 = "images/home/unavailable.jpg";
        $sharepath="images/product-details/share.png";
        $statusstock=$row['status_barang'];
        $bilstock=$row['bilstok'];
        $harga=$row['harga_barang'];
        
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
        }else{
            //$image=$path1;
            if (@getimagesize($path1)) {
                $image=$path1;
            } else {
                $image=$path2;
            }
        }
        
        echo"<div class='col-xs-12 col-sm-12 cart-product cart_info' id='".$row['id_barang']."'>
                    <div>
                        <div class='col-xs-2'>
                            <a href='#'><img class='img-barang' src='".$image."' alt='#'></a>
                        </div>
                        <div class='cart_description col-xs-8'>
                            <h4 style='margin-top: 0;'><a href='#'>".$row['nama_barang']."</a></h4>
                            <p>Product ID: ".$row['id_barang']."</p>
                            <p class='truncate'>".$row['detail_barang']."</p>
                            <p><b>By:</b> <a href='javascript:void(0);' class='seller-detail' onclick='getSellerDetail(5599)' style='color:#FE980F;font-weight:bold'>".$row['nama_seller']."</a></p>
                        </div>
                        <div class='col-xs-2 col-sm-1 cart_delete' style='float:right'> 
                            <a class='cart_quantity_delete' id='".$row['id_barang']."' href='javascript:void(0);'><i class='fa fa-trash-o'></i></a>
                            <label for='prod_".$row['id_barang']."' class='cart_quantity_select' href='javascript:void(0);'><i class='fa fa-check-circle'></i></label>
                            <input type='checkbox' class='select_prod' id='prod_".$row['id_barang']."' style='display:none' checked> 
                        </div>
                        <div class='col-xs-6 col-xs-offset-2 col-sm-8 col-sm-offset-0 cart_quantity'>
                            <div class='cart_quantity_button'> <a class='cart_quantity_up' href='javascript:void(0);' onclick='quantityUp(".$row['price'].",".$row['quantity'].")'> + </a>
                                <input class='cart_quantity_input' id='input_".$row['id_barang']."' type='text' name='quantity' value='".$row['quantity']."' autocomplete='off' size='2'> <a class='cart_quantity_down' href='javascript:void(0);' onclick='quantityDown(".$row['price'].",".$row['quantity'].")'> - </a> </div>
                        </div>
                        <div class='col-xs-4 col-sm-4 cart_total'>
                            <p class='cart_total_price'>RM".$row['price_sum']."</p>
                        </div>
                    </div>
                </div>";
    }
    echo "<script>
        $('.cart_quantity_input').on('change',function(){
            $(this).attr('value',jumlah);
            var hasil=(price*jumlah).toFixed(2);
            $('.cart_total_price').text('RM'+hasil);
        })
        var jumlah;
        function quantityUp(price,jumlah){
                jumlah=parseInt(jumlah);
                jumlah+=1;
                
        }
    
        function quantityDown(price,jumlah){
            jumlah=parseInt(jumlah);
            if(jumlah>1){
                jumlah-=1;
            } 
        }
    
            $('.cart_quantity_select').on('click',function(){
                var x=$(this).html();
                if(x=='<i class=\"fa fa-circle-o\"></i>'){
                    $(this).html('<i class=\"fa fa-check-circle\"></i>');
                    $(this).parents().eq(2).css('border','3px solid orange');
                    console.log($('#prod_".$row['id_barang']."').attr('class'));
                }else{
                    $(this).html('<i class=\"fa fa-circle-o\"></i>');
                    $(this).parents().eq(2).css('border','3px solid #E6E4DF');
                }
            });
            
            $('.cart_quantity_delete').on('click', function () {
                var id_barang = $(this).attr('id');
                $('#remove-modal').modal({
                  backdrop: 'static',
                  keyboard: false
                })
                .one('click', '#delete', function() {
                      $.ajax({
                        type: 'POST',
                        data: {
                            id_barang: id_barang
                        },
                        url: 'cart_remove.php',
                        success: function (data) {
                            generateCart();
                        }
                    });
                });
                
                
            });
            </script>";
} else {
    echo "<div class='col-sm-12 not-found'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Your cart is empty...</div>";
}
$conn->close();
?>