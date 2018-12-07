<?php
$serverName = "localhost";
$connectionInfo = array( "Database"=>"BookStore", "UID"=>"sa", "PWD"=>"tung123", "CharacterSet" => "UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo );
$bookId = $_GET['id'];
$sql = "UPDATE Comment SET Enabled=0 WHERE CommentID=".$bookId;
sqlsrv_query($conn, $sql);
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>