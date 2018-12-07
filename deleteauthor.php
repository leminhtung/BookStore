<?php
$serverName = "localhost";
$connectionInfo = array( "Database"=>"BookStore", "UID"=>"sa", "PWD"=>"tung123", "CharacterSet" => "UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo );
$authorid = $_GET['id'];
$sql = "UPDATE Authors SET Enabled=0 WHERE AuthorID=".$authorid;
sqlsrv_query($conn, $sql);
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>