<?php
include("conn.php");

$prod_id = $_POST['prod_id'];
$user_id = $_POST['user_id'];
$quantity = $_POST['jumlah'];
$seller_id = $_POST['seller_id'];
$checkin_date = date("Y-m-d h:i:sa");

$sql_price = "SELECT price FROM track_product WHERE id=".$prod_id." LIMIT 1";
$result = mysqli_query($conn, $sql_price);
$row = mysqli_fetch_assoc($result);

$price_sum = $row['price'] * $quantity;

$sql = "INSERT INTO comm_cart (id,user_id,seller_id,prod_id,quantity,price_sum,checkin_date,checkout,checkout_date) VALUES ('','".$user_id."','".$seller_id."','".$prod_id."','".$quantity."','".$price_sum."','".$checkin_date."','0','')"; 
$data = $conn->query($sql);

echo "<script>console.log('".$price_sum.",".$quantity."')</script>";

if($data){
    echo "Product added";
}else{
    echo "Opps, error!";
}

$conn->close();
?>