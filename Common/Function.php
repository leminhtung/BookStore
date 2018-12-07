<?php
 // get input
 	 function getInput($string){
 		return isset($_POST[$string]) ? $_POST[$string] : '';
}
 	function getInputed($string){
 		return isset($_GET[$string]) ? $_GET[$string] : '';
 }
?>