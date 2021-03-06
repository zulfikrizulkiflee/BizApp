<?php
include("session.php");
$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Shop | BizApp</title>
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
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/3d%20logo.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/3d%20logo.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/3d%20logo.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/3d%20logo.png">

        <style>
            .kedai-sort {
                display: none;
                padding-left: 15px !important;
                padding-right: 15px !important;
                padding-bottom: 15px !important;
                text-align: left;
            }
            
            .seller-pic {
                height: 10vw;
                width: 10vw;
                border-radius: 50%;
                border: 1px solid gray;
                background-image: url(images/preloader.gif);
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            
            .seller-logo {
                border: 1px solid gray;
            }
            
            .profil-kedai {
                border: 1px solid #F0F0E9;
                padding: 10px;
            }
            
            .seller-info {
                font-size: 18px;
                color: #696763;
            }
            
            @media (max-width: 480px) {
                .seller-pic {
                    height: 20vw;
                    width: 20vw;
                }
            }
            
            @media (min-width: 480px) {
                .seller-pic {
                    margin-top: 5px;
                    margin-bottom: 10px;
                }
            }
        </style>

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
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
--></div>
                        <div class="col-sm-6">
                            <div class="social-icons pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>

                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
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
                                            echo "<li class='cart-user'><a href='cart.php'><i class='fa fa-shopping-cart'></i> Cart</a></li>";
                                            echo "<li class='login-user'><a href='login.php'><i class='fa fa-lock'></i> Login/Signup</a></li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div id="snackbar">Product Successfully Added To Cart</div>
                        <!-- Modal -->
                        <div class="modal fade" id="modalAccount" tabindex="-1" role="dialog" aria-labelledby="modalAccountLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <div class="profile-pic">
                                            <br><img src='<?php echo"$profile_pic"; ?>' style="width:125px;height:125px;border-radius:50%;border:1px solid #888" />
                                            <h4 class="modal-title" id="myModalLabel"><?php echo"$login_session"; ?></h4></div>
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

        <section>
            <div class="container">
                <div class="row">
                    <h2 id='namakedai' class='title text-center focus-here' tabindex='1' style="font-size:25px !important"></h2>
                    <div class="col-xs-12 col-sm-2 profil-kedai">
                        <div class="col-xs-4 col-sm-12 col-md-4 col-lg-12">
                            <div class="seller-pic"></div>
                        </div>
                        <div class="col-xs-8 col-sm-12 col-md-12 col-lg-12 seller-info">
                            <div class="row"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> PRODUCTS: <span class="prod_jumlah"></span></div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-10 padding-right">
                        <div class="features_items" id="disc">
                            <!--features_items-->
                            <!--                            sortig-->
                            <div class="row kedai-sort">
                                <div class="col-sm-5" style="float:left">
                                    Sort By:
                                    <div class="btn-group">
                                        <button type="button" id="1" class="btn btn-default menu-button-kedai dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Relevance</button>

                                        <ul class="dropdown-menu sort-menu kedai-menu">
                                            <li id="1"><a href="javascript:void(0)">Relevance</a></li>
                                            <li id="2"><a href="javascript:void(0)">Price: High to low</a></li>
                                            <li id="3"><a href="javascript:void(0)">Price: Low to high</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="discover-items">
                                <div class="row preloader">
                                    <div class="wrap-loading">
                                        <div class="loading loading-4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--features_items-->
                    </div>
                </div>
            </div>
        </section>
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
                                    <li><a href="#">Online Help</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Order Status</a></li>
                                    <li><a href="#">Change Location</a></li>
                                    <li><a href="#">FAQ’s</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="single-widget">
                                <h2>Quick Shop</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">T-Shirt</a></li>
                                    <li><a href="#">Mens</a></li>
                                    <li><a href="#">Womens</a></li>
                                    <li><a href="#">Gift Cards</a></li>
                                    <li><a href="#">Shoes</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="single-widget">
                                <h2>Policies</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">Terms of Use</a></li>
                                    <li><a href="#">Privecy Policy</a></li>
                                    <li><a href="#">Refund Policy</a></li>
                                    <li><a href="#">Billing System</a></li>
                                    <li><a href="#">Ticket System</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="single-widget">
                                <h2>About BizApp</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">Company Information</a></li>
                                    <li><a href="#">Careers</a></li>
                                    <li><a href="#">Store Location</a></li>
                                    <li><a href="#">Affillate Program</a></li>
                                    <li><a href="#">Copyright</a></li>
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
                        <!--                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>-->
                    </div>
                </div>
            </div>
        </footer>
        <!--/Footer-->
        <script src="js/jquery.js"></script>
        <script src="js/jquery.lazyload.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.scrollUp.min.js"></script>
        <script src="js/price-range.js"></script>
        <script src="js/jquery.prettyPhoto.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(document).ready(function () {

                function toast() {
                    var x = document.getElementById("snackbar");
                    x.className = "show";
                    setTimeout(function () {
                        x.className = x.className.replace("show", "");
                    }, 3000);
                }

                $.urlParam = function (name) {
                    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
                    return results[1] || 0;
                }
                var sellerid = $.urlParam('id');

                var id_menu_kedai = $(".menu-button-kedai").attr("id");

                $(".kedai-menu li").on("click", function () {
                    var menutext = $(this).text();
                    id_menu_kedai = $(this).attr("id");
                    $(".menu-button-kedai").text(menutext);
                    $(".menu-button-kedai").attr("id", id_menu_kedai);
                    kedaiFunc();
                });

                loadProduct();

                function kedaiFunc() {
                    $('.focus-here')[0].focus();
                    $(".discover-items").html("<div class=\"row preloader\"><div class=\"wrap-loading\"><div class=\"loading loading-4\"></div></div></div>");
                    loadProduct();
                }

                function loadProduct() {
                    $.ajax({
                        type: 'POST',
                        data: {
                            id_menu_kedai: id_menu_kedai,
                            sellerid: sellerid
                        },
                        url: 'get_seller_detail.php',
                        success: function (data) {
                            $('.kedai-sort').css('display', 'block');
                            $("img.lazy").lazyload();
                            $('.discover-items').html(data);
                        }
                    });
                }
            });
        </script>
    </body>

    </html>