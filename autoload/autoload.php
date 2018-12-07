<?php
require_once("Common/Function.php");
require_once("Common/Database.php");
class Basecontroller{
	public $db;	
	public function __construct() {
		$this->db = new Database();
	}
}

?>
