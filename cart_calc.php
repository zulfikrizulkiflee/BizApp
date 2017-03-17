<?php
include("session.php");

//$user_id = $_POST['user_id'];

if(isset($user_id)){
    $user_id=$user_id;
}else{
    $user_id=15;
}

$total_price=0;

$sql = "SELECT price_sum FROM comm_cart WHERE user_id=".$user_id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $total_price+=(float)$row['price_sum'];   
    }
    echo "<ul style='padding-left:0'>
                <li>Shipping Cost <span>Not Available</span></li>
                <li class='total_price'>Total <span>RM".number_format((float)$total_price, 2, '.', '')."</span></li>
        </ul>";
    
} else {
    echo "Sorry, Error!";
}
$conn->close();
?>