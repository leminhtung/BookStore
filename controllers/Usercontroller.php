<?php
	require_once("autoload/autoload.php");
	class Usercontroller extends Basecontroller{

		public function GetAllUser()
		{	
			$params = $this->db->ShowUserdb("M_User");	
			require_once('viewmodels/getshowuser.php');	
			$postView = new PostView();
			$postView -> showAllPost($params);		
		}

		public function GetCategory()
		{	
			$params = $this->db->showcategorydb("Category");	
			return $params;
					
		}

		public function GetCategoryDetail($CategoryID)
		{	
			$params = $this->db->getcate($CategoryID);
			return $params;
					
		}

		public function Login($phone,$password)
		{			
			$user = $this->db->getPhoneAndPassword($phone,$password);
			return $user;
		}

		public function checkExits($email,$phone)
		{			
			$user = $this->db->checkExits($email,$phone);
			return $user;
		}

		public function inserCateToDb($categoryname, $enabled)
		{	
			$category = $this->db->insertcate($categoryname, $enabled);
			return $category;
		}

		public function updateCateToDb($categoryId, $categoryname, $enabled)
		{	
			$category = $this->db->updatecate($categoryId, $categoryname, $enabled);
			return $category;
		}

		public function update($firstname,  $lastname, $password, $email, $address, $userid)
		{			
			$user = $this->db->updateUser($firstname,  $lastname, $password, $email, $address, $userid);
			return $user;
		}

		public function insertUserToDb($phonenumber,$password, $FirstName, $LastName, $email)
		{
			$insert = $this->db->insertregisdb($phonenumber, $password, $LastName, $FirstName, $email);
			return $insert;
		}				
	}
?>