<?php

    session_start();
    if(!isset($_SESSION['Phone']) || ( $_SESSION['roleid'] == "9"))
    {
     
        header("location:index.php");
    }
    require_once("autoload/autoload.php");
    require_once("controllers/Usercontroller.php");	
	$postcontroller = new Usercontroller(); 
    $data =
    [
        "Category"      => getInput("Category"),
        "chkEnabled"    => getInput("chkEnabled")        
    ];
    

    $error = [];      
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
                
        if ($data['Category'] == '') 
        {
            $error['Category'] = "tên thể loại không được bỏ trống!!!";
        }
        elseif(ctype_space(substr($data['Category'],0,1)))
        {
            $error['Category'] = "Lỗi khoảng trống đầu dòng";    
        }
        elseif(!preg_match("/^([a-zA-Z0-9 -,.ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\\s])+$/", $data["Category"]))
        {
            $error['Category'] = " Không được nhập ký tự số và ký tự đặc biệt !!!";    
        }
        elseif (strlen($data["Category"]) > 50)
        {       
            $error['Category'] = "Số ký tự không được  lớn hơn 50 !!!";     
        }
        elseif (strlen($data["Category"]) < 2)
        {       
            $error['Category'] = "Số ký tự không được nhỏ hơn 2 !!!";      
        }         
        
        if (empty($error)) 
        {                 
                $isSuccess = $postcontroller -> inserCateToDb($data["Category"],$data["chkEnabled"]);           
                header('location:categorymanager.php');            
        }         
    }
   
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    
    <!-- <link href="assets/css/demo.css" rel="stylesheet" /> -->
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="Datatable/css/dataTables.bootstrap.css">
    <link href="Datatable/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="Datatable/css/jquery.dataTables.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="css/jquery-ui.css">
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     --> 

    <!--  Fonts and icons     -->
    <!-- <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"> -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'> -->
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    

</head>
<body>    
<div class="wrapper">
	<div class="sidebar" data-background-color="white" data-active-color="danger">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index.php" class="simple-text">
                    Book Store
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="bookadmin.php">
                        <i class="ti-view-list-alt"></i>
                        <p>Quản Lý Sách</p>
                    </a>
                </li>
                <li>
                    <a href="categorymanager.php">
                        <i class="ti-text"></i>
                        <p>Quan Lý Thể Loại</p>
                    </a>
                </li>
                <li>
                    <a href="authoradmin.php">
                        <i class="ti-pencil-alt2"></i>
                        <p>Quản Lý Tác Giả</p>
                    </a>
                </li>
                <li>
                    <a href="orderadmin.php">
                        <i class="ti-map"></i>
                        <p>Quản lý Đơn Hàng</p>
                    </a>
                </li>
                <li>
                    <a href="commentadmin.php">
                        <i class="ti-map"></i>
                        <p>Quản Lý Comment</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Quản Lý Thể Loại</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
								<p>Stats</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <p class="notification">5</p>
									<p>Notifications</p>
									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
						<li>
                            <a href="#">
								<i class="ti-settings"></i>
								<p>Settings</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>        
        <div class="content">            
            <div class="container-fluid">
                <div class="row">
                     <div class="border" > 
                        <form  method="Post" >
                            <div class="form-group">
                                <label style="font-size: x-large;">Tên Thể Loại</label>                            
                                <input type="text" name="Category" id="Category" tabindex="1" class="form-control border-input" placeholder="Tên Thể Loại" style="margin-left: 10px; width:98%" value="<?php echo $data['Category'] ?>">
                                <?php if (isset($error['Category'])): ?>
                                    <p class="text-danger" style="margin-left: 10px;"><?php echo $error['Category'] ?></p> 
                                <?php endif ?>
                            </div>
                            <div class="form-group">
                                <div style="display: flex; " >
                                    <label style="height: 10px;font-size: x-large;margin: 5px 5px;">Hiển Thị</label> 
                                    <input type="checkbox" name="chkEnabled"  id="chkEnabled" value="1" style="width: 20px;height: 35px; margin-left: 10px"></input>                                                  
                                    <input type="hidden" name="checked" id="hdnChecked" value="<?php echo $data["chkEnabled"]; ?>"></input>
                                </div>
                            </div>                                     
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3" style="margin-left: 40%;">
                                        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="btn btn-info btn-fill btn-wd" value="Cập Nhật Thể Loại">
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
</body>

    <!--   Core JS Files   -->
    <!-- <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script> -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
     <script src="js/jquery/jquery-ui.js"></script>
     <script src="js/bootstrap.js"></script>
	<!-- <script src="assets/js/bootstrap.min.js" type="text/javascript"></script> -->
    <script src="Datatable/js/jquery.dataTables.min.js"></script>
    <script src="Datatable/js/dataTables.bootstrap.js"></script>
    <script src="Datatable/js/jquery.dataTables.js"></script>
    <script src="js/main.js"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio.js"></script>   


	<script src="assets/js/paper-dashboard.js"></script>
    <!-- <script src="js/jquery-2.2.4.min.js"></script>
    
    <script src="js/bootstrap.min.js"></script> -->

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
    
           <script type="text/javascript" >
            
            $(document ).ready(function() {
                if($("#hdnChecked").val() == "1")
                {
                    $("#chkEnabled").attr('checked', true);
                }
            });
           $("#chkEnabled").change(function() {
                    if(this.checked) {
                        $("#hdnChecked").value = "1";
                    }
                    else
                    {
                        $("#hdnChecked").value = "0";
                    }
                });
       </script>
</html>
