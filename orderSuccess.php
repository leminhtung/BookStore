<?php
if(!isset($_REQUEST['id'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Success </title>
    <meta charset="utf-8">
    <style>
    .container{width: 100%;padding: 50px;}
    p{color: #34a853;font-size: 18px;}
    </style>
</head>
</head>
<body>
<div class="container">
    <h1>Trạng Thái Đặt Hàng</h1>
    <p>Bạn Đã Đặt Hàng Thành Công. Mã Đặt Hàng Là #<?php echo $_GET['id']; ?></p>
<div class="footBtn">
        <a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Tiếp Tục Mua Sách</a>
        <a href="cartAction.php?action=placeOrder" class="btn btn-success orderBtn">Đặt Hàng <i class="glyphicon glyphicon-menu-right"></i></a>
    </div>
</div>

</body>
</html>