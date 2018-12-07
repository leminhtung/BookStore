<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="css/jquery-ui.css" rel="stylesheet" />

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>

    <div class="wrapper">
     <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

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
                    <a href="maps.html">
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
            <a class="navbar-brand" href="#">Tạo Sách</a>
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
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Sách Mới</h4>
                    </div>
                    <div class="content">
                        <?php 
                        $serverName = "localhost";
                        $connectionInfo = array( "Database"=>"BookStore", "UID"=>"sa", "PWD"=>"tung123", "CharacterSet" => "UTF-8");
                        $conn = sqlsrv_connect( $serverName, $connectionInfo );
                        if (isset($_POST['submit'])) 
                        {
                            $name = trim($_POST['name']);
                            $discrip = trim($_POST['discrip']);
                            $picture = $_FILES["picture"]["name"];
                            $price = $_POST['price'];
                            $quan = $_POST['quan'];
                            $cate = $_POST['cate'];
                            $auth = $_POST['author'];
                            $error = false;
                            
                            if(ctype_space(substr($_POST['name'],0,1)))
                            {
                                echo "Lỗi khoảng trống đầu dòng"; 
                                 $error = true ;   
                            }            // bat loi
                            if ($name == '' && !$error) {
                                            // name bi rong
                                echo "Tên không được để trống";
                                $error = true;
                            }
                            if ($price == '' && !$error) {
                                            // name bi rong
                                echo " Giá không được để trống";
                                $error = true;
                            }
                            if (((int)$price <= 0 || (int)$price > 999) && !$error) {
                                echo "Gia phai lon hon 0 va be hon 999";
                                $error = true;
                            }
                            if (((int)$quan <= 0 || (int)$quan > 100) && !$error) {
                                echo "Số Lượng không hợp lệ";
                                $error = true;
                            }
                            if ($discrip == '' && !$error) { 
                                echo "Miêu Tả không được để trống";
                                $error = true;
                            }
                            if(!$error) {
                                $result = sqlsrv_query($conn, "INSERT INTO Books(BookName, Description, Picture, Price, Quantity, CategoryID, AuthorID, Enabled) VALUES ('$name', '$discrip', '$picture', $price, $quan, $cate, $auth, 1)");
                                if($result){
                                    echo "create success";
                                    $target_dir = "img/";
                                    $target_file = $target_dir . basename($picture);
                                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                                    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ) {
                                                        // chi cho phep jpg, png, jpeg, gif
                                        move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
                                    }
                                }
                                else{
                                    echo "fail";
                                }
                            }
                        }    
                        ?>
                        <?php
                        $authors = sqlsrv_query($conn, "SELECT * FROM Authors");
                        $cates = sqlsrv_query($conn, "SELECT * FROM Category");
                        ?>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên Sách</label>
                                        <input type="text" class="form-control border-input"  name="name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Giá</label>
                                        <input type="text" class="form-control border-input" name="price">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Số Lượng</label>
                                        <input type="number" class="form-control border-input" name="quan">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Thể Loại</label>
                                        <select id="cate" class="form-control border-input" name="cate">
                                            <?php while($row = sqlsrv_fetch_array($cates, SQLSRV_FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row['CategoryID'] ?>">
                                                <?php echo $row['Name'] ?>
                                            </option>
                                            <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div  class="col-md-4">
                                <label for="profile_pic">Choose file to upload</label>
                                <input type="file" id="profile_pic" name="picture"
                                accept=".jpg, .jpeg, .png">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tác Giả</label>
                                    <select id="auth" class="form-control border-input" name="author">
                                        <?php while($row = sqlsrv_fetch_array($authors, SQLSRV_FETCH_ASSOC)) { ?>
                                        <option value="<?php echo $row['AuthorID'] ?>">
                                            <?php echo $row['Name'] ?>
                                        </option>
                                        <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Miêu Tả Sách</label>
                                <textarea rows="5" class="form-control border-input" name="discrip"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-info btn-fill btn-wd">Tạo Sách Mới</button>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
</div>   
</div>
</div>


</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="js/jquery/jquery-ui.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio.js"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>
