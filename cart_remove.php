<?php
include("conn.php");

$id_barang = $_POST['id_barang'];

$sql = "DELETE FROM comm_cart WHERE prod_id=".$id_barang; 
$data = $conn->query($sql);

if($data){
    echo "Product removed";
}else{
    echo "Opps, error!";
}

$conn->close();
?>