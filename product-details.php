 <?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Book Store</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">
    <style>
    input[type=text], select, textarea {
        width: 100%; /* Full width */
        padding: 12px; /* Some padding */  
        border: 1px solid #ccc; /* Gray border */
        border-radius: 4px; /* Rounded borders */
        box-sizing: border-box; /* Make sure that padding and width stays in place */
        margin-top: 6px; /* Add a top margin */
        margin-bottom: 16px; /* Bottom margin */
        resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
    }

    /* Style the submit button with a specific background color etc */
    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    /* When moving the mouse over the submit button, add a darker green color */
    input[type=submit]:hover {
        background-color: #45a049;
    }

    /* Add a background color and some padding around the form */
    .container {
        border-radius: 5px;

        padding: 10px;
    }


</style>

<link href="css/font.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style type="text/css">* { font-family: 'Roboto'  }</style>
<style >
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
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <?php if(isset($_SESSION['Phone']) && isset($_SESSION['password'])) {?>

            <div style="width:100%;background-color: #3f3567; height: 80px;display: inline-table;">
               <a href="index.php"><img src="img/core-img/logo7.jpg" alt="" style="height:80px;float: left; "></a>
                 <a href="index.php" ><span style="font-size: 50px;color:#7fc72b; margin-top: 30px; ">B</span>
                    <span style="font-size: 50px;color:#8b1178; margin-top: 30px; ">o</span>
                    <span style="font-size: 50px;color:#ebc214; margin-top: 30px; ">o</span>
                    <span style="font-size: 50px;color:#dc3545; margin-top: 30px; ">k</span>
                    <span style="font-size: 45px;color:white; margin-top: 30px; ">Store<span style = "color: red">.</span>vn<span></a>
                <div style="float:right; width: 310px; margin-top: 30px;">
                 <!--Chinh sua -->    
                 <a style="font-size: 14px; background-color: #3f3567; color: white;"><span style = "color: #ffffff">Xin Chào: &nbsp;&nbsp;</span><a href="information.php" style="color: white"><?php echo $_SESSION['Phone']; ?></a> 
                 <!--Chinh sua -->
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
                 <a href="register.php" style=" margin-right: 30% ;font-size: 14px; background-color: #3f3567;color: white;">Đăng Ký</a>               
                </div>
            </div> 


            <?php } ?>  

        <!-- Header Area Start -->
       <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li class=""><a href="index.php">Trang chủ</a></li>
                    <li>
                        <li class="dropdown-submenu">
                          <a class="theloai" href="#">Thể Loại<span class="caret"></span></a>
                          <ul class="dropdown-menu">
                              <?php
                              $serverName = "localhost";
                              $connectionInfo = array( "Database"=>"BookStore", "UID"=>"sa", "PWD"=>"tung123", "CharacterSet" => "UTF-8");
                              $conn = sqlsrv_connect( $serverName, $connectionInfo );
                              $result = sqlsrv_query($conn, 'select * from Category where Category.enabled = 1');
                              while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
                                ?>
                                <li ><a href="?id=<?php echo $row['CategoryID'] ?>"><?php echo $row['Name'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li><a href="checkout.php">Đơn Hàng</a></li>
                    </ul>
            </nav>
            <!-- Button Group -->

            <!-- Cart Menu -->
           <div class="cart-fav-search mb-100">
                <a href="Viewcart.php" class="cart-nav"><img src="img/core-img/cart.png" alt=""> Giỏ Hàng <span></span></a>
            </div>
            <!-- Social Button -->
            
        </header>
        <!-- Header Area End -->

        <!-- Product Details Area Start -->
        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <?php
                                $serverName = "localhost";
                                $connectionInfo = array( "Database"=>"BookStore", "UID"=>"sa", "PWD"=>"tung123", "CharacterSet" => "UTF-8");
                                $conn = sqlsrv_connect( $serverName, $connectionInfo );
                                $bookId = $_GET['id'];
                                $result = sqlsrv_query($conn, 'select *, Authors.Name as author, Books.Description as des from Books join Authors on Books.AuthorID = Authors.AuthorID where BookID=' . $bookId );
                                $book = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
                                ?>
                                <!-- <ol class="carousel-indicators">
                                    <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url(img/product-img/pro-big-1.jpg);">
                                    </li>                                   
                                </ol> -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a >
                                            <img class="d-block w-75" src="<?php echo 'img/'.$book['Picture'] ?>"  alt="First slide">
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">$<?php echo $book['Price'] ?></p>
                                <p>
                                    <h2><?php echo $book['BookName'] ?></h6>
                                    </p>
                                    <!-- Ratings & Review -->
                                    <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                        <div class="ratings">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <!-- Avaiable -->
                                    <!-- <p class="avaibility"><i class="fa fa-circle"></i> In Stock</p> -->
                                </div>
                                <a href="viewauthor.php?id=<?php echo $book['AuthorID'] ?>">
                                    <h6><?php echo $book['author'] ?></h6>
                                </a>

                                <div class="short_overview my-5">
                                    <p><?php echo $book['des'] ?></p>
                                </div>

                                <!-- Add to Cart Form -->
                                <form class="cart clearfix" action="cartAction.php?action=addToCart&id=<?php echo $book['BookID'] ?>" method="post">
                                    <div class="cart-btn d-flex mb-50">
                                        <p>Qty</p>
                                        <div class="quantity">
                                            <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) && qty > 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                            <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="qty" value="<?php echo $book['Quantity'] ?>">
                                            <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                    <button type="submit" name="addtocart" value="5" class="btn amado-btn">Thêm Vào Giỏ Hàng</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Details Area End -->
            <div class="container">
                <div class="row" style="max-height: 250px; overflow-y: auto;">
                <?php
                $serverName = "localhost";
                $connectionInfo = array( "Database"=>"BookStore", "UID"=>"sa", "PWD"=>"tung123", "CharacterSet" => "UTF-8");
                $conn = sqlsrv_connect( $serverName, $connectionInfo );
                $bookID = $_GET['id'];
                $result = sqlsrv_query($conn, 'select * from Comment JOIN Users ON Users.UserID = Comment.UserID WHERE BookID=' . $bookID .' AND Comment.Enabled = 1 ORDER BY CommentID DESC');
                //$book = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
                while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
                ?>
                    <div class="col-12" style="margin-bottom: 20px">
                        <div class="card">
                            <div class="card-header">
                                <?php echo $row['FirstName'].' '.$row['LastName'] ?>
                            </div>
                            <div class="card-body"><?php echo $row['Contents'] ?></div>
                        </div>
                    </div>
                
                <?php } ?>
                </div>
                <?php 

                $serverName = "localhost";
                $connectionInfo = array( "Database"=>"BookStore", "UID"=>"sa", "PWD"=>"tung123", "CharacterSet" => "UTF-8");
                $conn = sqlsrv_connect( $serverName, $connectionInfo );
                if (isset($_POST['submit'])) 
                {
                    $name = $_POST['name'];
                    $error = false;
                    if ($name == '') {
                                                // name bi rong
                        echo "Bình luận không được để trống";
                        $error = true;
                    }
                    if(!$error) {
                        $result = sqlsrv_query($conn, "INSERT INTO Comment(Contents, UserID, BookID, Enabled) VALUES (N'".$name."', '".$_SESSION['userId']."', '".$bookId."', 1)");
                        if($result){
                             echo "<meta http-equiv='refresh' content='0'>";
                        }
                        else{
                            print_r(sqlsrv_errors());
                        }
                    }
                }
                ?>
                <?php
                if (isset($_SESSION['Phone'])) {
                ?>
                <form action="" method="POST">
                    <h1>Comment</h1>
                    <textarea id="subject" name="name" placeholder="Write something.." style="height:100px" maxlength="300"></textarea>
                    <input type="submit" name="submit" value="Comment">
                </form>
                <?php
                } else {
                ?>
                    <a href="login.php" class="btn btn-primary mt-30 ml-auto mr-auto">Đăng Nhập Và Để Lại Phản Hồi</a>
                <?php
                }
                ?>
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