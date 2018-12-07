<?php
require_once("autoload/autoload.php");

$data = [
	"FirstName"  	   => getInput("FirstName"),
	"LastName"  	   => getInput("LastName"),
	"Email" 		   => getInput("Email"),
	"Phone" 		   => getInput("Phone"),
	"password" 		   => getInput("password"),
	"confirmpassword"  => getInput("confirmpassword")
];

///Check User
$error = []; 
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{			
	if ($data["FirstName"] == '')
	{      
		$error['FirstName'] = "Không được để trống!!!";  
	}
	elseif(ctype_space(substr($data['FirstName'],0,1)))
	{
		$error['FirstName'] = "Lỗi khoảng trống đầu dòng";    
	}
	elseif(!preg_match("/^([a-zA-Z ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\\s])+$/", $data["FirstName"]))
	{
		$error['FirstName'] = " Không được nhập ký tự số và ký tự đặc biệt !!!";    
	}  
	elseif (strlen($data["FirstName"]) > 50)
	{       
		$error['FirstName'] = "Số ký tự không được  lớn hơn 50 !!!";     
	}
	elseif (strlen($data["FirstName"]) < 2)
	{       
		$error['FirstName'] = "Số ký tự không được nhỏ hơn 2 !!!";      
	}

	if ($data["LastName"] == '')
	{       
		$error['LastName'] = "Không được để trống!!!";        
	}
	elseif(!preg_match("/^([a-zA-Z ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\\s])+$/", $data["LastName"]))
	{
		$error['LastName'] = "Không được nhập ký tự số và ký tự đặc biệt !!!"; 
	}
	elseif(ctype_space(substr($data['LastName'],0,1)))
	{
		$error['LastName'] = "Lỗi khoảng trống đầu dòng";    
	}
	elseif (strlen($data["LastName"]) > 50)
	{       
		$error['LastName'] = "Số ký tự không được lớn hơn  50 !!!";       
	}
	elseif (strlen($data["LastName"]) < 2)
	{       
		$error['LastName'] = "Số ký tự không được nhỏ hơn 2 !!!";        
	}
	
	if ($data["Email"] == ''){      
		$error['Email'] = "Email Không được để trống!!!";      
	}
	elseif (strlen($data["Email"]) > 50)
	{       
		$error['Email'] = "Số ký tự không được lớn hơn  50 !!!";     
	}
	elseif (strlen($data["Email"]) < 10)
	{       
		$error['Email'] = "Số ký tự không được nhỏ hơn 10 !!!"; 
	}

	if ($data["Phone"] == ''){      
		$error['Phone'] = "Số điện thoại Không được để trống!!!";      
	} 	  
	elseif(!preg_match("/^([0][0-9]{10,12})$/", $data["Phone"])) {
		$error['Phone'] = "Số điện thoại bắt đầu từ 0 và từ {10-12} ký tự!!!";	
	}

	if ($data["password"] == ''){       
		$error['password'] = "Mật khẩu không được để trống!!!";        
	}
	elseif (strlen($data["password"]) > 30) {       
		$error['password'] = "Số ký tự không được lớn hơn  30 !!!";       
	}
	elseif (strlen($data["password"]) < 6) {        
		$error['password'] = "Số ký tự không được nhỏ hơn  6 !!!";        
	}
	elseif(ctype_space(substr($data['password'],0,1)))
    {
        $error['password'] = "Lỗi khoảng trống đầu dòng";     
    }

	if ( $data["password"] != $data["confirmpassword"])
	{        
		$error['confirmpassword'] = "Mật khẩu và Mật khẩu xác nhận không giống nhau!!!";
	}
	elseif ($data["confirmpassword"] ==  '')
	{       
		$error['confirmpassword'] = "Không được để trống!!!";      
	}
	elseif(ctype_space(substr($data['confirmpassword'],0,1)))
    {
        $error['confirmpassword'] = "Lỗi khoảng trống đầu dòng";     
    } 	

	///  Dang ky user
	require_once("controllers/Usercontroller.php");
	$postcontroller = new Usercontroller(); 
	$rsChkPhone = $postcontroller -> checkExits("",$data["Phone"]);
	$rsChkEmail = $postcontroller -> checkExits($data["Email"],"");

	if (empty($error)) {				
		if($rsChkPhone)
		{
			$error['Phone'] = "Số điện thoại đã tồn tại!!!";	

		}
		elseif ($rsChkEmail) {
					$error['Email'] = "Địa chỉ email đã tồn tại!!!";	
				}		
		else
		{
			$isSuccess = $postcontroller -> insertUserToDb($data["Phone"], $data["password"], $data["FirstName"], $data["LastName"], $data["Email"]); 
			if ($isSuccess)
			{
				header('Location: Login.php');
			}				
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Book Store | Login</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">
    <link href="css/font.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">	
	<link rel="stylesheet" type="text/css" media="all" href="css/Login.css">
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

#footer {
  	width: 100%;
  	margin-top: 100px;
    height: 250px;
    position: absolute;
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
    <!-- ##### Main Content Wrapper Start ##### -->
	    <div class="main-content-wrapper d-flex clearfix"  >
	        <div style="width:100%;background-color: #3f3567; height: 80px;margin-top: -90px;display: inline-table;">
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

	        <!-- Header Area Start -->
	        <header class="header-area clearfix">
	            <!-- Close Icon -->
	            <div class="nav-close">
	                <i class="fa fa-close" aria-hidden="true"></i>
	            </div>          
	            
	        </header>
	        <!-- Header Area End -->

	        <!-- Product Catagories Area Start -->	        

	        <div class="container" style="max-width: 900px; margin-top: 5%; margin-left: -5%;">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">							
							<div class="col-xs-12">
								<a class = "active">Đăng Ký</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">	
								<form id="register-form"  method="Post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="FirstName" id="FirstName"  placeholder="FirstName" tabindex="1" class="form-control"  value="<?php echo $data['FirstName'] ?>">
										<?php if (isset($error['FirstName'])): ?>
											<p class="text-danger"><?php echo $error['FirstName']?></p> 
										<?php endif ?>
									</div>
									<div class="form-group">
										<input type="text" name="LastName" id="LastName" tabindex="1" class="form-control" placeholder="LastName" value="<?php echo $data['LastName'] ?>">
										<?php if (isset($error['LastName'])): ?>
											<p class="text-danger"><?php echo $error['LastName']?></p> 
										<?php endif ?>
									</div>
									<div class="form-group">
										<input type="email" name="Email" id="Email" tabindex="1" class="form-control" placeholder="Email " value="<?php echo $data['Email'] ?>">
										<?php if (isset($error['Email'])): ?>
											<p class="text-danger"><?php echo $error['Email']?></p> 
										<?php endif ?>
									</div>
									<div class="form-group">
										<input type="text" name="Phone" id="Phone" tabindex="1" class="form-control" placeholder=
										"0XXX-XXX-XXX" value="<?php echo $data['Phone'] ?>">
										<?php if (isset($error['Phone'])): ?>
											<p class="text-danger"><?php echo $error['Phone']?></p> 
										<?php endif ?>
									</div>									
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" value="<?php echo $data['password'] ?>">
										<?php if (isset($error['password'])): ?>
											<p class="text-danger"><?php echo $error['password']?></p> 
										<?php endif ?>
									</div>
									<div class="form-group">
										<input type="password" name="confirmpassword" id="confirmpassword" tabindex="2" class="form-control" placeholder="Confirm Password" value="<?php echo $data['confirmpassword'] ?>">
										<?php if (isset($error['confirmpassword'])): ?>
											<p class="text-danger"><?php echo $error['confirmpassword']?></p> 
										<?php endif ?>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Tạo Tài Khoản">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
					</div>
				</div>				 
			</div>
	    </div>

    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Newsletter Area Start ##### -->
    <!-- ##### Newsletter Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
     <footer id="footer" class="footer_area clearfix">
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


