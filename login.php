<?php
   include("conn.php");
   session_start();

    $error = "";
    $success_register="";
    $registered_user="";
    $error_password="<div style='display:none;color:red;text-align:center'></div>";

   
   if (isset($_POST['login'])) {
        // removes backslashes
       $username = stripslashes($_POST['username']);
        //escapes special characters in a string
       $username = mysqli_real_escape_string($conn,$username);
       $password = stripslashes($_POST['password']);
       $password = mysqli_real_escape_string($conn,$password);
	   //Checking is user existing in the database or not
       $query = "SELECT id FROM comm_user WHERE username='$username' and password='".md5($password)."'";
       $result = mysqli_query($conn,$query) or die(mysql_error());
       $rows = mysqli_num_rows($result);
       if($rows==1){
           $_SESSION['login_user'] = $username;
            // Redirect user to index.php
           header("Location: ". $_SESSION['current_page']);
       }
    }

    if (isset($_POST['register'])) {
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $phone_num = mysqli_real_escape_string($conn,$_POST['phone_num']); 
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $address = mysqli_real_escape_string($conn,$_POST['address']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']); 
        $register_date = date("Y-m-d h:i:sa");

            if(!empty($email))  { 
                $sql_check = "SELECT * FROM comm_user WHERE email = '$_POST[email]'"; 
                $check = $conn->query($sql_check);
                if ($check->num_rows <= 0) {
                    $query = "INSERT INTO comm_user (id,name,phone_num,email,address,username,password,date_register) VALUES ('','".$name."','".$phone_num."','".$email."','".$address."','".$username."','".md5($password)."','".$register_date."')"; 
                    $data = $conn->query($query);
                    if($data) { 
                        $success_register="YOUR REGISTRATION IS COMPLETED..."; 
                    } 
                } else { 
                     $registered_msg="SORRY...YOU ARE ALREADY REGISTERED USER...";
                } 
            }
        
    }  

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Login | BizApp</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/prettyPhoto.css" rel="stylesheet">
        <link href="css/price-range.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/responsive.css" rel="stylesheet">
        <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
        <link rel="shortcut icon" href="images/ico/3d%20logo.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

    </head>
    <!--/head-->

    <body>
        <header id="header">
            <!--header-->
            <div class="header_top">
                <!--header_top-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <!--
                        <div class="contactinfo">
    <ul class="nav nav-pills">
        <li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
        <li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
    </ul>
</div>
--></div>
                        <div class="col-sm-6">
                            <div class="social-icons pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>

                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/header_top-->
            <div class="header-middle">
                <!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="index.php"><img src="images/bizapp_logo_final.svg" alt="" height="60px" /></a>
                            </div>
                            <div class="btn-group pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown"> English <span class="caret"></span> </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Bahasa Malaysia</a></li>
                                    </ul>
                                </div>
                                <!--
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown"> DOLLAR <span class="caret"></span> </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
--></div>
                        </div>
                        <div class="col-sm-8" style="margin-top:20px">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    <?php
                                        if(isset($_SESSION['login_user'])){
                                            echo "<li class='account-user' data-toggle='modal' data-target='#modalAccount'><a href=''><i class='fa fa-user'></i> ".$login_session."</a></li>";
                                            echo "<li class='cart-user'><a href='cart.php'><i class='fa fa-shopping-cart'></i> Cart</a></li>";
                                            echo "<li class='logout-user' data-toggle='modal' data-target='#logout-modal'><a href='javascript:void'><i class='fa fa-lock'></i> Logout</a></li>";
                                        }else{
                                            echo "<li class='login-user'><a href='login.php'><i class='fa fa-lock'></i> Login/Signup</a></li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="modalAccount" tabindex="-1" role="dialog" aria-labelledby="modalAccountLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <div class="profile-pic">
                                            <br><img src='' style="width:125px;height:125px;border-radius:50%;border:1px solid #888" />
                                            <h4 class="modal-title" id="myModalLabel"></h4></div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-md-3"><b>Name:</b></div>
                                                <div class="col-md-9">
                                                    <?php echo"$user_name"; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-3"><b>Email:</b></div>
                                                <div class="col-md-9">
                                                    <?php echo"$email"; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-md-3"><b>Member Since:</b></div>
                                                <div class="col-md-9">
                                                    <?php echo"$date_register"; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-3"><b>Rating: </b></div>
                                                <div class="col-md-9" style="color:gold"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- logout modal-->
                        <div class="modal fade" id="logout-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="text-align:center">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Logout?</h4> </div>
                                    <div class="modal-body" style="text-align:center"><img src="images/home/alert-icon.png" style="width:15vw"></div>
                                    <div class="modal-footer" style="text-align:center">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" style="background-color:#fff;color:#FE980F">Cancel</button>
                                        <button type="button" class="btn btn-primary logout-btn">Logout Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end logout modal-->
                        <!--product modal-->
                        <div class="modal fade" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="ProductModalLabel">
                            <div class="modal-dialog product-info" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <div class="row" style="padding-top:0;padding-bottom:0">
                                            <div class="col-sm-12">
                                                <div class="product-details">
                                                    <!--product-details-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end product modal-->
                    </div>
                </div>
            </div>
            <!--/header-middle-->
            <div class="header-bottom">
                <!--header-bottom-->
                <div class="container">
                    <div class="row" style="display:none">
                        <div class="col-sm-9">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li><a href="index.html" class="active">Home</a></li>
                                    <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                        <ul role="menu" class="sub-menu">
                                            <li><a href="shop.html">Products</a></li>
                                            <li><a href="product-details.html">Product Details</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                            <li><a href="cart.html">Cart</a></li>
                                            <li><a href="login.html">Login</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#">Private Site<i class="fa fa-angle-down"></i></a>
                                        <ul role="menu" class="sub-menu">
                                            <li><a href="templates/template_01/index.html" target="_blank">Template #1</a></li>
                                            <li><a href="templates/template_02/index.html" target="_blank">Template #2</a></li>
                                            <li><a href="templates/template_03/index.html" target="_blank">Template #3</a></li>
                                            <li><a href="templates/template_04/index.html" target="_blank">Template #4</a></li>
                                            <li><a href="templates/template_05/index.html" target="_blank">Template #5</a></li>
                                            <li><a href="templates/template_06/index.html" target="_blank">Template #6</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="404.html">404</a></li>
                                    <li><a href="contact-us.html">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--/header-bottom-->
        </header>
        <!--/header-->
        <section id="form">
            <!--form-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-1">
                        <div class="login-form">
                            <!--login form-->
                            <h2>Login to your account</h2>
                            <form action="" name="login-form" method="post">
                                <input type="text" name="username" placeholder="Username" />
                                <input type="password" name="password" placeholder="Password" /> <span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
                                <div style="color:red;text-align:center">
                                    <?php echo $error ?>
                                </div>
                                <button type="submit" name="login" class="btn btn-default">Login</button>
                            </form>
                        </div>
                        <!--/login form-->
                    </div>
                    <div class="col-sm-1">
                        <h2 class="or">OR</h2> </div>
                    <div class="col-sm-4">
                        <div class="signup-form">
                            <!--sign up form-->
                            <h2>New User Signup!</h2>
                            <form name="register-form" id="signup-form" method="post" onsubmit="return checkForm(this);">
                                <input type="text" id="name" name="name" placeholder="Name" required/>
                                <input type="text" id="phone_num" name="phone_num" placeholder="Phone Number" required/>
                                <input type="email" id="email" name="email" placeholder="Email Address" required/>
                                <textarea name="address" id="address" placeholder="Address" rows="3" style="font-family: 'Roboto', sans-serif;font-size: 14px;font-weight: 300;margin-bottom: 50px;outline: medium none;padding-left: 10px;" required></textarea>
                                <input name="username" id="username" type="text" title="Username must contain only letters, numbers and underscores." placeholder="Username" required/>
                                <input name="password" id="password" type="password" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" placeholder="Password" required/>
                                <input name="password_confirm" id="password_confirm" type="password" title="Please enter same password as above." placeholder="Confirm Password" required/>
                                <button type="submit" name="register" id="signup-btn" class="btn btn-default">Signup</button>
                            </form>
                        </div>
                        <!--/sign up form-->
                    </div>
                </div>
            </div>
        </section>
        <!--/form-->
        <footer id="footer">
            <!--Footer-->
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="companyinfo">
                                <h2><span>biz</span>app</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="col-sm-3">
                                <div class="video-gallery text-center">
                                    <a href="#">
                                        <div class="iframe-img"> <img src="images/home/iframe1.png" alt="" /> </div>
                                        <div class="overlay-icon"> <i class="fa fa-play-circle-o"></i> </div>
                                    </a>
                                    <p>Circle of Hands</p>
                                    <h2>24 DEC 2014</h2> </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="video-gallery text-center">
                                    <a href="#">
                                        <div class="iframe-img"> <img src="images/home/iframe2.png" alt="" /> </div>
                                        <div class="overlay-icon"> <i class="fa fa-play-circle-o"></i> </div>
                                    </a>
                                    <p>Circle of Hands</p>
                                    <h2>24 DEC 2014</h2> </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="video-gallery text-center">
                                    <a href="#">
                                        <div class="iframe-img"> <img src="images/home/iframe3.png" alt="" /> </div>
                                        <div class="overlay-icon"> <i class="fa fa-play-circle-o"></i> </div>
                                    </a>
                                    <p>Circle of Hands</p>
                                    <h2>24 DEC 2014</h2> </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="video-gallery text-center">
                                    <a href="#">
                                        <div class="iframe-img"> <img src="images/home/iframe4.png" alt="" /> </div>
                                        <div class="overlay-icon"> <i class="fa fa-play-circle-o"></i> </div>
                                    </a>
                                    <p>Circle of Hands</p>
                                    <h2>24 DEC 2014</h2> </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="address"> <img src="images/home/map.png" alt="" />
                                <p>9-2, Jalan Tasik Selatan 3, Bandar Tasik Selatan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-widget">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="single-widget">
                                <h2>Service</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="">Online Help</a></li>
                                    <li><a href="">Contact Us</a></li>
                                    <li><a href="">Order Status</a></li>
                                    <li><a href="">Change Location</a></li>
                                    <li><a href="">FAQ’s</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="single-widget">
                                <h2>Quick Shop</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="">T-Shirt</a></li>
                                    <li><a href="">Mens</a></li>
                                    <li><a href="">Womens</a></li>
                                    <li><a href="">Gift Cards</a></li>
                                    <li><a href="">Shoes</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="single-widget">
                                <h2>Policies</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="">Terms of Use</a></li>
                                    <li><a href="">Privecy Policy</a></li>
                                    <li><a href="">Refund Policy</a></li>
                                    <li><a href="">Billing System</a></li>
                                    <li><a href="">Ticket System</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="single-widget">
                                <h2>About BizApp</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="">Company Information</a></li>
                                    <li><a href="">Careers</a></li>
                                    <li><a href="">Store Location</a></li>
                                    <li><a href="">Affillate Program</a></li>
                                    <li><a href="">Copyright</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3 col-sm-offset-1">
                            <div class="single-widget">
                                <h2>About BizApp</h2>
                                <form action="#" class="searchform">
                                    <input type="text" placeholder="Your email address" />
                                    <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                    <p>Get the most recent updates from
                                        <br />our site and be updated your self...</p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <p class="pull-left">Copyright © 2017 BizApp All rights reserved.</p>
                        <!--<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>-->
                    </div>
                </div>
            </div>
        </footer>
        <!--/Footer-->
        <script src="js/jquery.js"></script>
        <script src="js/price-range.js"></script>
        <script src="js/jquery.scrollUp.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.prettyPhoto.js"></script>
        <script src="js/main.js"></script>
        <script>
            function checkPassword(str) {
                var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
                return re.test(str);
            }

            function checkForm(form) {
                if (form.username.value == "") {
                    alert("Error: Username cannot be blank!");
                    form.username.focus();
                    return false;
                }
                re = /^\w+$/;
                if (!re.test(form.username.value)) {
                    alert("Error: Username must contain only letters, numbers and underscores!");
                    form.username.focus();
                    return false;
                }
                if (form.password.value != "" && form.password.value == form.password_confirm.value) {
                    if (!checkPassword(form.password.value)) {
                        alert("The password you have entered is not valid!");
                        form.password.focus();
                        return false;
                    }
                } else {
                    alert("Error: Please check that you've entered and confirmed your password!");
                    form.password.focus();
                    return false;
                }
                return true;
            }

            // select all desired input fields and attach tooltips to them
            $("#signup-form :input").tooltip({

                trigger: "focus",

                // place tooltip on the right edge
                placement: "top",

                // a little tweaking of the position
                offset: [-2, 10],

                // use the built-in fadeIn/fadeOut effect
                effect: "fade",

                // custom opacity setting
                opacity: 0.7

            });
        </script>
    </body>

    </html>