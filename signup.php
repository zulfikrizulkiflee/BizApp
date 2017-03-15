<?php
    include("conn.php");

    $name = $_POST['name'];
    $phone_num = $_POST['phone_num']; 
    $email = $_POST['email'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password']; 
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!empty($email))  { 
            $sql_check = "SELECT * FROM comm_user WHERE email = '$_POST[email]'"; 
            $check = $conn->query($sql_check);
            if ($check->num_rows <= 0) {
                $query = "INSERT INTO comm_user (id,name,phone_num,email,address,username,password) VALUES ('','".$name."','".$phone_num."','".$email."','".$address."','".$username."','".$password."')"; 
                $data = $conn->query($query);
                if($data) { 
                    echo "YOUR REGISTRATION IS COMPLETED..."; 
                } 
            } else { 
                echo "SORRY...YOU ARE ALREADY REGISTERED USER..."; 
            } 
        }
    }

?>