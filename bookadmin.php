<?php
session_start(); 
    if(!isset($_SESSION['Phone']))
    {
       
        header("location:index.php");
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
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">

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
                    <a class="navbar-brand" href="#">Quản Lý Sách</a>
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
            <a href="createbook.php">
                <button type="submit" class="btn btn-info btn-fill btn-wd">Thêm Sách</button>
            </a>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content table-responsive table-full-width"> 
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>Mã Sách</th>
                                            <th>Tên Sách</th>
                                            <th>Miêu Tả</th>
                                            <th>Ảnh</th>
                                            <th>Giá Sách</th>
                                            <th>Số Lượng</th>
                                            <th>Thể Loại</th>
                                            <th>Tác Giả</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php
                                    $serverName = "localhost";
                                    $connectionInfo = array( "Database"=>"BookStore", "UID"=>"sa", "PWD"=>"tung123", "CharacterSet" => "UTF-8");
                                    $conn = sqlsrv_connect( $serverName, $connectionInfo );
                                    $result = sqlsrv_query($conn, 'select * , Authors.Name as aname, Category.Name as cname, Books.Description as des from Books join Category on Books.CategoryID = Category.CategoryID join Authors on Books.AuthorID = Authors.AuthorID WHERE Books.Enabled=1' );
                                    while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
                                    ?>
                                    
                                        <tr>
                                        	<td><?php echo $row["BookID"] ?></td>
                                        	<td><?php echo $row["BookName"] ?></td>
                                        	<td style="height: 2em; overflow-y: hidden;"><?php echo $row["des"] ?></td>
                                        	<td>
                                                <img class="d-block w-75" style="width: 100px" src="<?php echo 'img/'.$row['Picture'] ?>"  alt="First slide">
                                            </td>
                                        	<td>$<?php echo $row["Price"] ?></td>
                                            <td><?php echo $row['Quantity'] ?></td>
                                            <td><?php echo $row['cname'] ?></td>
                                            <td><?php echo $row['aname'] ?></td>
                                            <td>
                                                <?php
                                                $result2 = sqlsrv_query($conn, 'SELECT * FROM OrdersDetail WHERE BookID=' . $row['BookID']);
                                                ?>
                                                <a href="delete.php?id=<?php echo $row['BookID'] ?>" style="background: black" class="btn btn-info btn-fill btn-wd" onclick="return confirm('Bạn có đồng ý ẩn sách này?')">Ẩn Sách</button>
                                                <a href="updatebook.php?id=<?php echo $row['BookID'] ?>">
                                                    <button type="submit"   class="btn btn-info btn-fill btn-wd">Sửa Sách</button>
                                                </a>                                           
                                            </td>
                                        </tr>
                                    
                                    <?php } ?>
                                    </tbody>
                                </table>
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
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>

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
