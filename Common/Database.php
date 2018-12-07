<?php 

    /**
    * 
    */
    class database
    {
        /**
         * khai báo biến kết nối
         * @var [type]
         */
        public $servername;
        public $connectioninfo;
        public $conn;

        public function __construct()
        {
            $this -> servername = "localhost"; 
            $this -> connectioninfo = array( "Database"=>"BookStore", "UID"=>"sa", "PWD"=>"tung123", "CharacterSet" => "UTF-8");
            $this -> conn = sqlsrv_connect( $this -> servername, $this -> connectioninfo );

            if( $this -> conn ) { 
                return null;
            }else{
                echo "connection could not be established.<br />";
                die( print_r( sqlsrv_errors(), true));
            }
            return $this -> conn;            
        }
        
        public function getPhoneAndPassword($phone, $password )
        {      
             $sql  = "select userid, phonenumber, password, roleid, email, enabled, address, lastname, firstname from users where phonenumber = '$phone' and password = '$password'";

            if($password == "")
            {
             $sql  = "select userid, phonenumber, password, roleid, email, enabled from users where phonenumber = '$phone' ";
            }


            $stmt = sqlsrv_query( $this -> conn, $sql);            
            $params = array();
            if( $stmt === false )
            {
               die( print_r( sqlsrv_errors(), true));
            }  

           if( sqlsrv_fetch( $stmt ) === false) 
           {
               die( print_r( sqlsrv_errors(), true));
           }

           $userid = sqlsrv_get_field( $stmt, 0); 
           if (!$userid)
           {
            return null;
           } 
           else{
              $params['userid'] = $userid;     
           }

            $phone = sqlsrv_get_field( $stmt, 1);              
            $params['phone'] = $phone; 
            $password = sqlsrv_get_field( $stmt, 2);              
            $params['password'] = $password; 
            $roleid = sqlsrv_get_field( $stmt, 3);             
            $params['roleid'] = $roleid;
            $email = sqlsrv_get_field( $stmt, 4);             
            $params['email'] = $email;
            $enabled = sqlsrv_get_field( $stmt, 5);             
            $params['enabled'] = $enabled;
            $address = sqlsrv_get_field( $stmt, 6);             
            $params['address'] = $address;
            $lastname = sqlsrv_get_field( $stmt, 7);             
            $params['lastname'] = $lastname;
            $firtsname = sqlsrv_get_field( $stmt, 8);             
            $params['firtsname'] = $firtsname;

            return $params; 
         }     

        public function checkExits($email,$phone)
        {
            $sql  = "select userid from Users where email = '$email'";
            if($phone != "")
            {
                $sql  = "select userid from Users where phonenumber = '$phone'";
            }

            $stmt = sqlsrv_query( $this -> conn, $sql);            
            $params = array();
            if( $stmt === false )
            {
               die( print_r( sqlsrv_errors(), true));
            }  

           if( sqlsrv_fetch( $stmt ) === false) 
           {
               die( print_r( sqlsrv_errors(), true));
           }

           $userid = sqlsrv_get_field( $stmt, 0); 
           if (!$userid)
           {
            return null;
           } 
           else{
              $params['userid'] = $userid;     
           }

            return $params; 
        }

        public function insertregisdb( $phonenumber, $password, $firstname, $lastname, $email)
        { 
            $sql = "insert into users( roleid, phonenumber, password, firstname, lastname, email,enabled) 
            values ('9','$phonenumber','$password',N'$firstname',N'$lastname','$email','1')";
            $stmt = sqlsrv_query( $this -> conn,$sql);
            if( $stmt === false )
            {
                die( print_r( sqlsrv_errors(), true ));           
            }
            else
            {
                sqlsrv_commit($this -> conn);
            }

            $user = $this -> getPhoneAndPassword($phonenumber, $password);            
            return $user; 
        }       

        public function updateUser( $firstname,  $lastname, $password, $email, $address, $userid)
        { 
            $sql = "UpDate users set  password = '$password', firstname = N'$firstname', lastname= N'$lastname', email= '$email', address = N'$address' where userid = '$userid' ";
            $stmt = sqlsrv_prepare( $this -> conn,$sql);
            if( !$stmt )
            {
                die( print_r( sqlsrv_errors(), true));
            }

            if( sqlsrv_execute( $stmt ) === false ) 
            {
                die( print_r( sqlsrv_errors(), true));
            }

            return  sqlsrv_execute( $stmt )  ;          
        } 

        //get all data from db to view

        public function showcategorydb($table)
        {       
            $sql = "Select * from {$table}";
            $params = array();
            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $stmt = sqlsrv_query( $this -> conn, $sql , $params, $options);
            $row_count = sqlsrv_num_rows( $stmt );

            if ($row_count > 0 )
            {
                while ($row = sqlsrv_fetch_array( $stmt))
                {                
                    $params[] = $row;               
                }           
            } 
            else
            {
                echo "error";
            }

            return $params;
            sqlsrv_free_stmt($stmt);

        }
   

        public function insertcate($categoryname, $enabled)
        {
            $sql = "Insert into Category(Name, Enabled) 
            values ( N'$categoryname','$enabled')";
            $stmt = sqlsrv_query( $this -> conn,$sql);
            if( $stmt === false )
            {
                die( print_r( sqlsrv_errors(), true ));           
            }
            else
            {
                sqlsrv_commit($this -> conn);
            }

            return  sqlsrv_execute( $stmt );
        }

        public function updatecate($categoryId, $categoryname, $enabled)
        { 
            $sql = "Update Category set  Name = N'$categoryname', Enabled = '$enabled' where CategoryID = '$categoryId' ";
            $stmt = sqlsrv_prepare( $this -> conn,$sql);
            if( !$stmt )
            {
                die( print_r( sqlsrv_errors(), true));
            }

            if( sqlsrv_execute( $stmt ) === false ) 
            {
                die( print_r( sqlsrv_errors(), true));
            }

            return  sqlsrv_execute( $stmt )  ;          
        }  

        public function getcate($CategoryID)
        {
            $sql = "Select CategoryID, Name, Enabled from Category where CategoryID = '$CategoryID'";
            $stmt = sqlsrv_query( $this -> conn,$sql);
            if( $stmt === false )
            {
                die( print_r( sqlsrv_errors(), true ));           
            }

            if( sqlsrv_fetch( $stmt ) === false) 
            {
               die( print_r( sqlsrv_errors(), true));
            }

            $params = array();
            $cateid = sqlsrv_get_field( $stmt, 0);
            $params['CategoryID'] = $cateid; 
            $cateName = sqlsrv_get_field( $stmt, 1);              
            $params['Name'] = $cateName; 
            $enabled = sqlsrv_get_field( $stmt, 2);              
            $params['Enabled'] = $enabled; 

            return  $params;
        }      

    }
?>