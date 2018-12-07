<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>   <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Book Store | Home</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">
    <link href="css/font.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style type="text/css">* { font-family: 'Roboto'  }</style>
    <style>
    .dropdown-submenu {
       position: relative!important;
   }

   .dropdown-menu {
       position: inherit;
       margin-top: -1px;
       margin-bottom: 20px;
       left: 10%!important;
       border: none;
   }

   .dropdown-submenu .dropdown-menu {
       top: 0;
       left: 50%;

   }
</style>
<script>
   $(document).ready(function(){
      $('.dropdown-submenu a.theloai').on("click", function(e){
         $(this).next('ul').toggle();
         e.stopPropagation();
         e.preventDefault();
     });
  });
</script>
</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <!--Phan chinh sửa -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                       <?php
                       $serverName = "localhost";
                       $connectionInfo = array( "Database"=>"BookStore", "UID"=>"sa", "PWD"=>"tung123", "CharacterSet" => "UTF-8");
                       $conn = sqlsrv_connect( $serverName, $connectionInfo );
                       $strKeyword = null;
                       if(isset($_POST['search'])) {
                        $strKeyword = $_POST["search"];
                        $keywords = explode(" ", $strKeyword);
                        $likeSQL = "";
                        foreach ($keywords as $word) {
                            $likeSQL = $likeSQL . "BookName LIKE '%$word%'";
                            $likeSQL = $likeSQL . " OR ";
                        }
                        $likeSQL = substr($likeSQL, 0, -4);
                        $result = sqlsrv_query($conn, "SELECT * FROM Books WHERE $likeSQL");
                    }
                    ?>
                    <form action="#" method="post">
                        <input type="search" name="search" id="search" placeholder="Type your keyword...">
                        <button type="submit"><img src="img/core-img/search.png" alt=""></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- --------------------- -->
</div>
<!-- Search Wrapper Area End -->

<!-- ##### Main Content Wrapper Start ##### -->
<div class="main-content-wrapper d-flex clearfix">
    

       <?php if(isset($_SESSION['Phone']) && isset($_SESSION['password'])) {?>

            <div style="width:100%;background-color: #3f3567; height: 80px;display: inline-table;">
               <a href="index.php"><img src="img/core-img/logo7.jpg" alt="" style="height:80px;float: left; "></a>
                 <a href="index.php" ><span style="font-size: 50px;color:#7fc72b; margin-top: 30px; ">B</span>
                    <span style="font-size: 50px;color:#8b1178; margin-top: 30px; ">o</span>
                    <span style="font-size: 50px;color:#ebc214; margin-top: 30px; ">o</span>
                    <span style="font-size: 50px;color:#dc3545; margin-top: 30px; ">k</span>
                    <span style="font-size: 45px;color:white; margin-top: 30px; ">Store<span style = "color: red">.</span>vn<span></a>
                <div style="float:right; width: 310px; margin-top: 30px;">
                 <!--CHINH SUA MOI NHAT 26082018-->   
                <?php if( $_SESSION['roleid'] === "1" ) {?>
                 <a style="font-size: 14px; background-color: #3f3567; color: white;"><span style = "color: #dc3545">Xin Chào: &nbsp;&nbsp;</span><a href="bookadmin.php" style="color: white"><?php echo $_SESSION['Phone']; ?></a> 
                  <?php  } else { ?>
                    <a style="font-size: 14px; background-color: #3f3567; color: white;"><span style = "color: #dc3545">Xin Chào: &nbsp;&nbsp;</span><a href="information.php" style="color: white"><?php echo $_SESSION['Phone']; ?></a> 
                    <?php } ?>     
                 <!--CHINH SUA MOI NHAT 26082018 -->
                 <a style="color: white; margin-right: 5%; font-size: 25px;">&nbsp;|<a>
                 <a href="logout.php" style=" margin-right: 20% ;font-size: 14px; background-color: #3f3567;color: white;">Đăng Xuất</a>               
                </div>
            </div> 

        <?php  } else { ?>

            <div style="width:100%;background-color: #3f3567; height: 80px; display: inline-table;">
               <a href="index.php"><img src="img/core-img/logo7.jpg" alt="" style="height:80px;float: left; "></a>
                 <a href="index.php" ><span style="font-size: 50px;color:#7fc72b; margin-top: 30px; ">B</span>
                    <span style="font-size: 50px;color:#8b1178; margin-top: 30px; ">o</span>
                    <span style="font-size: 50px;color:#ebc214; margin-top: 30px; ">o</span>
                    <span style="font-size: 50px;color:#dc3545; margin-top: 30px; ">k</span>
                    <span style="font-size: 45px;color:white; margin-top: 30px; ">Store<span style = "color: red">.</span>vn<span></a>
                <div style="float:right; width: 200px; margin-top: 30px;">
                 <a href="login.php" style="font-size: 14px; background-color: #3f3567; color: white;">Đăng nhập</a> <a style="color: white">/<a>
                 <a href="Regis.php" style=" margin-right: 30% ;font-size: 14px; background-color: #3f3567;color: white;">Đăng Ký</a>               
                </div>
            </div> 


            <?php } ?>   

           <!-- Header Area Start -->
           <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->

            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li class=""><a href="index.php">Trang chủ</a></li>
                    <li>
                        <li class="dropdown-submenu">
                          <a class="theloai" href="#">Thể Loại<span class="caret"></span></a>
                          <ul class="dropdown-menu">
                              <?php
                              if (!isset($_POST["search"])) {
                              $result = sqlsrv_query($conn, 'select * from Category where Category.enabled = 1');
                              while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
                                ?>
                                <li ><a href="?id=<?php echo $row['CategoryID'] ?>"><?php echo $row['Name'] ?></a></li>
                                <?php } } ?>
                            </ul>
                        </li>
                        <li><a href="checkout.php">Đơn Hàng</a></li>
                    </ul>
                </nav>
                <!-- Button Group -->

                <!-- Cart Menu -->
                <div class="cart-fav-search mb-100">
                    <a href="viewCart.php" class="cart-nav"><img src="img/core-img/cart.png" alt=""> Giỏ Hàng <span></span></a>
                    <a href="#" class="search-nav"><img src="img/core-img/search.png" alt=""> Tìm Kiếm</a>
                </div>
                <!-- Social Button -->

            </header>
            <!-- Header Area End -->

            <!-- Product Catagories Area Start -->


            <div class="amado_product_area section-padding-100">
                <div class="container-fluid">

                    <div class="row">
                       <?php
                       if(!isset($_POST['search'])) {
                        if(isset($_GET['id'])) {
                            $id = $_GET["id"];
                            $result = sqlsrv_query($conn, "select * from Books where CategoryID=$id  and Enabled = 1 ");
                        } else {
                            $result = sqlsrv_query($conn, "select * from Books where Enabled = 1");
                        }  
                    }

                    
                    while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
                        ?>
                        <!-- Single Product Area -->
                        <div class="col-13 col-sm-4 col-md-12 col-xl-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="img/<?php echo $row['Picture'] ?>"  style="width: 300px">
                                </div>

                                <!-- Product Description -->
                                <div class="product-description d-flex align-items-center justify-content-between">
                                    <!-- Product Meta Data -->
                                    <div class="product-meta-data">
                                        <div class="line"></div>
                                        <p class="product-price">$<?php echo $row['Price'] ?></p>
                                        <a href="product-details.php?id=<?php echo $row['BookID'] ?>">
                                            <h6><?php echo $row['BookName'] ?></h6>
                                        </a>
                                    </div>
                                    <!-- Ratings & Cart -->
                                    <div class="ratings-cart text-right">
                                        <div class="ratings">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <div class="cart">
                                            <a href="cartAction.php?action=addToCart&id=<?php echo $row['BookID']?>" data-toggle="tooltip" data-placement="left" title="Add to Cart"><img src="img/core-img/cart.png"  alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <!-- Pagination -->
                            <nav aria-label="navigation">
                                <ul class="pagination justify-content-end mt-50">
                                    <li class="page-item "><a class="page-link" href="#">01.</a></li>
                                    <li class="page-item"><a class="page-link" href="#">02.</a></li>
                                    <li class="page-item"><a class="page-link" href="#">03.</a></li>
                                    <li class="page-item"><a class="page-link" href="#">04.</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ##### Main Content Wrapper End ##### -->

        <!-- ##### Newsletter Area Start ##### -->
        <!-- ##### Newsletter Area End ##### -->

        <!-- ##### Footer Area Start ##### -->
        <footer id="footer" class="footer_area clearfix" style="padding: 45px;">
            <div class="container">    
                <!-- phan chinh sua -->        
                <div class="row align-items-center">               
                    <div class="col-12 col-lg-8">
                        <div class="single_widget_area">
                            <!-- Footer Menu -->
                            <div class="footer_menu">
                                <nav class="navbar navbar-expand-lg justify-content-end">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                                    <div class="collapse navbar-collapse" id="footerNavContent" style="margin-right: -12%;">
                                        <ul class="navbar-nav ml-auto">
                                            <li class="nav-item">
                                                <a class="nav-link" href="index.php">Home</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="shop.php">Shop</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="product-details.php">Product</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="cart.php">Cart</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="checkout.php">Checkout</a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>                    
                    </div>
                    <div class= "col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white" style="font-size:15px;">

                        <span style="color: white; text-align: center;">530 Cách Mạng Tháng 8, Phường 11, Quận 3, Hồ Chí Minh</span>

                    </div>
                    <!-- Single Widget Area -->
                    <div  class="col-12 col-lg-2" style="margin-left: 45%;">
                        <div class="social-info d-flex justify-content-between">                
                            <a href="#"><i class="fa fa-instagram fa-3x" aria-hidden="true" style="color: white"></i></a>
                            <a href="#"><i class="fa fa-facebook fa-3x" aria-hidden="true" style="color: white"></i></a>
                            <a href="#"><i class="fa fa-twitter fa-3x" aria-hidden="true" style="color: white"></i></a>
                        </div>         
                    </div>
                    <!-- Single Widget Area -->
                </div>
            </div>
        </footer> 

        <!-- ##### Footer Area End ##### -->

        <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <!-- Popper js -->
        <script src="js/popper.min.js"></script>
        <!-- Bootstrap js -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Plugins js -->
        <script src="js/plugins.js"></script>
        <!-- Active js -->
        <script src="js/active.js"></script>


    </body>

    </html>