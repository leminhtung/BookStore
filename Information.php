<?php
require_once("autoload/autoload.php");
session_start();
if(!isset($_SESSION['Phone']) || ($_SESSION['roleid']=="1"))
    {       
        header("location:index.php");
    }

$data = 
[
    "Userid"           => getInput("Userid"),
    "Phone"            => getInput("Phone"),    
    "FirstName"        => getInput("FirstName"),
    "LastName"         => getInput("LastName"),
    "Email"            => getInput("Email"),
    "Address"          => getInput("Address"),  
    "password"         => getInput("password"),
    "oldPass"          => getInput("oldPass"),
    "newpassword"      => getInput("newpassword"),
    "confirmpassword"  => getInput("confirmpassword"),
    "type"             => getInput("type"),  
    "chkchangepass"    => getInput("chkchangepass")  
];
require_once("controllers/Usercontroller.php");
$postcontroller = new Usercontroller();


if($data["Address"] == '')
{    
    $data['Phone'] = $_SESSION['Phone'] ;
    $data['password'] = $_SESSION['password'];     
    $result = $postcontroller -> Login($data["Phone"],$data["password"]);   
    if ($result) 
    {  
        $data["Userid"] = $result['userid'];
        $_SESSION['Userid'] = $result['userid'];
        $data["Email"] = $result['email'];
        $data["FirstName"] = $result['firtsname'];
        $data["Address"] = $result['address'];
        $data["LastName"] = $result['lastname'];
    }
}
else
{ 
    $data['Userid'] = $_SESSION['Userid'];
    $data['Phone'] = $_SESSION['Phone'] ;
    $data['password'] = $_SESSION['password'];
}

///Check User
$error = []; 
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{ 
        if($data["chkchangepass"] == "1")
        {
            if ( $data["newpassword"] != $data["confirmpassword"])
            {        
                $error['confirmpassword'] = "Mật khẩu và Mật khẩu xác nhận không giống nhau!!!";
            }

            if ($data["confirmpassword"] ==  '')
            {       
                $error['confirmpassword'] = "Không được để trống!!!";      
            }
            elseif(ctype_space(substr($data['confirmpassword'],0,1)))
            {
                $error['confirmpassword'] = "Lỗi khoảng trống đầu dòng";     
            }


            if ($data["newpassword"] ==  '')
            {       
                $error['newpassword'] = "Không được để trống!!!";      
            }
            elseif(ctype_space(substr($data['newpassword'],0,1)))
            {
                $error['newpassword'] = "Lỗi khoảng trống đầu dòng";     
            }

            if ($data["oldPass"] ===  '')
            {       
                $error['oldPass'] = "Không được để trống!!!";      
            }
            elseif(ctype_space(substr($data['oldPass'],0,1)))
            {
                $error['oldPass'] = "Lỗi khoảng trống đầu dòng";     
            }
            elseif ($data["oldPass"] != $_SESSION['password']) {
                $error['oldPass'] = "Mật khẩu cũ không chính xác!!!"; 
                # code...
            }
        }

    if ($data["type"] == "update")  

    {
        if ($data["FirstName"] == '')
        {      
            $error['FirstName'] = "Không được để trống!!!";  
        }
        elseif(ctype_space(substr($data['FirstName'],0,1)))
        {
            $error['FirstName'] = "Lỗi khoảng trống đầu dòng";    
        }   
        elseif(!preg_match("/^([a-zA-Z ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\\s])+$/", $data["FirstName"]))
        {
            $error['FirstName'] = " Không được nhập ký tự số và ký tự đặc biệt !!!";    
        }   
        elseif (strlen($data["FirstName"]) > 50)
        {       
            $error['FirstName'] = "Số ký tự không được  lớn hơn 50 !!!";     
        }
        elseif (strlen($data["FirstName"]) < 2)
        {       
            $error['FirstName'] = "Số ký tự không được nhỏ hơn 2 !!!";      
        }
        
        if ($data["LastName"] == '')
        {       
            $error['LastName'] = "Không được để trống!!!";        
        }
        elseif(!preg_match("/^([a-zA-Z ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\\s])+$/", $data["LastName"]))
        {
            $error['LastName'] = "Không được nhập ký tự số và ký tự đặc biệt !!!"; 
        }
        elseif(ctype_space(substr($data['LastName'],0,1)))
        {
            $error['LastName'] = "Lỗi khoảng trống đầu dòng";    
        }
        elseif (strlen($data["LastName"]) > 50)
        {       
            $error['LastName'] = "Số ký tự không được lớn hơn  50 !!!";       
        }
        elseif (strlen($data["LastName"]) < 2)
        {       
            $error['LastName'] = "Số ký tự không được nhỏ hơn 2 !!!";        
        }

        $rsChkEmail = $postcontroller -> checkExits($data["Email"],""); 
        if ($data["Email"] == ''){      
            $error['Email'] = "Email Không được để trống!!!";      
        }         
        elseif (strlen($data["Email"]) > 50)
        {       
            $error['Email'] = "Số ký tự không được lớn hơn  50 !!!";     
        }
        elseif (strlen($data["Email"]) < 10)
        {       
            $error['Email'] = "Số ký tự không được nhỏ hơn 10 !!!"; 
        } 
        elseif ($rsChkEmail &&  $rsChkEmail["userid"] != ($data['Userid'])) 
        {
            $error['Email'] = "Email đã tồn tại!!!";    
        }

        if ($data["Address"] == '')
        {       
            $error['Address'] = "Địa chỉ không được để trống!!!";      
        }
        elseif (strlen($data["Address"]) > 70) 
        {       
            $error['Address'] = "Số ký tự không được lớn hơn  70 !!!";     
        }
        elseif (strlen($data["Address"]) < 10) {        
            $error['Address'] = "Số ký tự không được nhỏ hơn 10 !!!"; 
        }
        elseif(!preg_match("/^([a-zA-Z ,.-ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\\s])+$/", $data["Address"]))
        {
            $error['Address'] = "Không được nhập ký tự số và ký tự đặc biệt !!!"; 
        }
         elseif(ctype_space(substr($data['Address'],0,1)))
        {
            $error['Address'] = "Lỗi khoảng trống đầu dòng";    
        }       
    } 
    
    if (empty($error))
    {   
            if ($data["newpassword"] != '') {
                $data["password"] = $data["newpassword"];
            }            

            $result = $postcontroller -> update($data["FirstName"], $data["LastName"], $data["password"], $data["Email"], $data["Address"], $data["Userid"]);            

            if ($result === true)
            {
                $_SESSION['password'] =$data["password"] ;
                echo '<script type="text/javascript"> alert("Cập Nhật Thành Công!!!");</script>' ;   
                //header("location:index.php");
            }        
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Profile Customer</title>
        <link href="themes/bootstrap/css/bootstrap.min.css" rel="stylesheet">      
        <link href="themes/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

        <link href="themes/css/bootstrappage.css" rel="stylesheet"/>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />

        <!-- global styles -->
        <link href="themes/css/flexslider.css" rel="stylesheet"/>
        <link href="themes/css/main.css" rel="stylesheet"/>
        <link href="themes/css/my-style.css" rel="stylesheet"/>    
        <!-- scripts -->
        <script src="themes/js/jquery-1.7.2.min.js"></script>
        <script src="themes/jsinfo/bootstrap.min.js"></script>				
        <script src="themes/js/superfish.js"></script>	
        
        <script src="themes/js/login-register.js" type="text/javascript"></script>
        <script src="themes/js/date-of-birth.js" type="text/javascript"></script>
         <style>
         #cus-info-2 input
        {
            height: 30px;            
        }
         </style>
    </head>
    <body>      
       
        <!--Phần dialog box Message-->
        <div class="modal fade login" id="MessageModal">
            <div class="modal-dialog login animated">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #ff6666">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" style="color: #fff">ERROR</h4>
                    </div>
                    <div class="modal-body">  
                        <div class="box">
                            <div class="content">
                                <div class="error" style="font-size: 20px;">${message}</div>                  
                            </div>
                        </div>                      
                    </div>        
                </div>
                <div class="modal-footer">
                    <div class="forgot login-footer">
                        <span>Tech Line In The Best</span>
                    </div>
                </div>           
            </div>
        </div>
        <!--Kết thúc dialog box Message--> 
        <div id="wrapper" class="container">            
            <section class="main-content">
                <div class="row">
                    <div class="span12">
                        <div class="my-main"><!-----!!!!!!!!!!!!!!!!!!!!!!!!.my-main Phan than noi dung trang!!!!!!!!!!!!!!!!!!!!!!!!!!!!----->
                            <!-- <button onclick="topFunction()" id="myBtn" title="Go to top">Go to top</button> -->
                            <h3>My Account Information</h3>

                            <div class="cus-info"><!----- .cus-info ---->                                
                                <h4>Personal Information</h4>
                                <form id="Updateregister-form"  method="Post" role="form" style="display: block;">
                                    <table style="border:#003 2px solid; border-radius:5px;">
                                        <input type="hidden" name="type" value="update">
                                        <tbody>
                                            <tr>
                                                <td id="cus-info-1">First Name</td>
                                                <td id="cus-info-2" colspan="3"><input type="text" id="FirstName" name="FirstName" style="width:100%;"value="<?php echo $data['FirstName'] ?>" placeholder="Enter your FirstName" required="">
                                                    <?php if (isset($error['FirstName'])): ?>
                                            <p class="alert alert-warning"><?php echo $error['FirstName']?></p> 
                                        <?php endif ?>
                                                </td> 
                                                <td id="cus-info-3"></td>                                               
                                            </tr>
                                            
                                             <tr>
                                                <td id="cus-info-1">Last Name</td>
                                                <td id="cus-info-2" colspan="3"><input type="text" id="LastName" name="LastName" style="width:100%;"value="<?php echo $data['LastName'] ?>" placeholder="Enter your LastName" required="">
                                                    <?php if (isset($error['LastName'])): ?>
                                            <p class="alert alert-warning"><?php echo $error['LastName']?></p> 
                                        <?php endif ?>
                                                </td>
                                                <td id="cus-info-3"></td>
                                            </tr>

                                             <tr>
                                                <td id="cus-info-1">Email</td>
                                                <td id="cus-info-2" colspan="3"><input type="text" id="Email" name="Email" style="width:100%;"value="<?php echo $data['Email'] ?>" placeholder="Enter your Email" required="">              
                                                <?php if (isset($error['Email'])): ?>
                                            <p class="alert alert-warning"><?php echo $error['Email']?></p> 
                                        <?php endif ?>                                                    
                                                </td>
                                                <td id="cus-info-3"></td>
                                            </tr>
                                             <tr>
                                                <td id="cus-info-1">Address</td>
                                                <td id="cus-info-2" colspan="3"><input type="text" id="Address" name="Address" style="width:100%;"value="<?php echo $data['Address'] ?>" placeholder="Enter your Address" required="">
                                                    <?php if (isset($error['Address'])): ?>
                                            <p class="alert alert-warning"><?php echo $error['Address']?></p> 
                                              <?php endif ?>
                                                </td>
                                                <td id="cus-info-3"></td>
                                            </tr>     
                                            <tr>
                                                <td id="cus-info-1">Change Password</td>
                                                <td id="cus-info-2" colspan="3">
                                                <div style="display: flex; " >
                                                  <input type="checkbox" name="chkchangepass" id="chkchangepass" value="1" style="width: 20px;">
                                                  <label style="height: 10px;font-size: inherit;margin: 5px 5px;">Change password</label> </input>
                                                  <input type="hidden" name="checked" id="hdnChecked" value="<?php echo $data["chkchangepass"]; ?>">
                                                </div>
                                                  <br/>
                                                    <div id="changepassDiv" style="display:none">
                                                   <div>
                                                        <input type="password" name="oldPass" id="oldPass" tabindex="2" class="input-xlarge" placeholder="oldPass" value="<?php echo $data['oldPass'] ?>">
                                                        <?php if (isset($error['oldPass'])): ?>
                                                        <p class="alert alert-danger"><?php echo $error['oldPass']?></p> 
                                                         <?php endif ?>
                                                    </div> 

                                                     
                                                    <div>
                                                        <input type="password" name="newpassword" id="newpassword" tabindex="2" class="input-xlarge" placeholder="newpassword" value="<?php echo $data['newpassword'] ?>">
                                                        <?php if (isset($error['newpassword'])): ?>
                                                        <p class="alert alert-danger"><?php echo $error['newpassword']?></p> 
                                                         <?php endif ?>
                                                    </div>

                                                    <div>
                                                        <input type="password" name="confirmpassword" id="confirmpassword" tabindex="2" class="input-xlarge" placeholder="confirmpassword" value="<?php echo $data['confirmpassword'] ?>">
                                                        <?php if (isset($error['confirmpassword'])): ?>
                                                        <p class="alert alert-danger"><?php echo $error['confirmpassword']?></p>
                                                         <?php endif ?><br/>
                                                    </div>
                                                </div>
                                                </td>
                                                <td id="cus-info-3"></td>
                                            </tr>

                                            <tr>
                                                <td id="cus-info-1"></td>
                                                <td id="cus-info-2" colspan="4" style="text-align: -webkit-center; width: 94px; height: 28px;"><input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Cập Nhật">
                                                    <a class="btn btn-primary" href="index.php" role="button">Trở Về</a>
                                                </td>

                                            </tr>    
                                        </tbody>
                                    </table>
                                </form>
                            </div><!----- .cus-info end ---->
                            <div class="clearfix"></div>                      
                        </div><!-----.my-main end----->
                    </div>
                </div>
            </section>
        </div>
        <script src="themes/js/common.js"></script>
       <script src="themes/js/jquery.flexslider-min.js"></script>
       <script type="text/javascript" >
            
            $(document ).ready(function() {
                if($("#hdnChecked").val()=="1")
                {
                    $("#chkchangepass").attr('checked', true);
                    $("#changepassDiv").show();
                }
            });
           $("#chkchangepass").change(function() {
                    if(this.checked) {
                        $("#changepassDiv").show();
                        $("#hdnChecked").val()="1";
                    }
                    else
                    {
                        $("#changepassDiv").hide();
                        $("#hdnChecked").val()="0";
                    }
                });
       </script>
                                         
        </script>
    </body>
</html>