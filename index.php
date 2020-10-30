<html>
<head>
<title>OOPS New</title>
<link rel="stylesheet" href="custom.css">
</head>
<body>
     
                <div class="navbar">
                    <div class="logo"></div>
                        <div class="navbar_header">
                            <div class="list_header">

                                <a href="index.php"> Home </a>
                                <?php if(isset($_SESSION['username']))
                                { ?>
                                    <a href="profile.php"> Profile </a>
                                    <a href="logout.php">Logout</a>
                               <?php }
                                else
                                { ?>
                                    <a href="login.php"> Login </a>
                                    <a href="signup.php"> Signup </a>
                                <?php } ?>

                            </div>
                        </div>
                        
                        
                </div>
                <?php include('db.php'); 
                                $objects=new query();
                                $res=$objects->getdata('signups','*','','','','');
                                echo '<pre>';
                                //print_r($res);
                                

                                    
                        ?>

 <?php 
 /*
    class first 
{
    function one()
    {
        echo "hey hi";
    }
  
}

$obj=new first();
$obj->one();

*/
?> 

</body>
</html>