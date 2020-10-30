<?php 
        session_start();
        include("db.php");
        
        if (isset($_SESSION['registration_success']) && ! empty($_SESSION['registration_success'])) {
            echo "<script type='text/javascript'>alert('Registered Successfully')</script>"; 
            //htmlentities($_SESSION['success']);
            unset($_SESSION['registration_success']);
        } 

        if (isset($_SESSION['password_error']) && ! empty($_SESSION['password_error'])) {
            echo "<script type='text/javascript'>alert('Password Incorrect')</script>"; 
            //htmlentities($_SESSION['username_error']);
            unset($_SESSION['password_error']);
        
        }
        
        if (isset($_SESSION['user_error']) && ! empty($_SESSION['user_error'])) {
            echo "<script type='text/javascript'>alert('Username Incorrect')</script>"; 
            //htmlentities($_SESSION['username_error']);
            unset($_SESSION['user_error']);
        }


        
        
        class login extends query
        {
           
           
            public function check_login()
                {
        
                    if($_SERVER['REQUEST_METHOD'] == "POST")
                        {
                            if(isset($_POST['login']))
                            {

                            
                            $error=[];
                            $username = $this->santize_inputs($_POST['username']);
                            echo $username;
                            $password= $this->santize_inputs($_POST['password']);
    
                                if(empty($_POST['username']))
                            {
                                $error[]="Username is empty";
                            }
                            else
                            {
                                $username=santize_inputs($_POST['username']);
                                echo $username;
                                echo '<div class="msg">'.$username.'</div>';
                            }
                            
                            if(empty($_POST['password']))
                            {
                                $error[]="password is empty";
                            }
                            else
                            {
                                $password=santize_inputs($_POST['password']);
                                echo $password;
                            }
                     }
    
            if(!empty($error))
            {
                foreach($error as $err)
                {
                    echo '<div class="error_msg">'.$err.'</div>';
                }
            }
           /* else
            {
                $query="select * from signup where username='$username'";	
                $result=querys($query);
                if(row_count($result) > 0)
                {   
                  $row=mysqli_fetch_array($result);
                  
                  $pass_hash=$row['password'];
                            if(password_verify($password,$pass_hash))
                            {
                                    session_regenerate_id(false);
                                    $_SESSION['username']=$_POST['username']; 
                                    $_SESSION['login_success'] = 'Logged!';
    
                            ?>
                                     <script type='text/javascript'>
                                      window.location.href='index.php';  
                                      </script>";
    
                                 <?php   
                                 }
                                    else
                                    { 
                                      $_SESSION['password_error'] = 'Error in Password'; ?>
                                      - <script type='text/javascript'>
                                      window.location.href='login.php';  
                                      </script>"; 
                                        <?php 
                                   }
                     
                }
                else
                {
                  
                  $_SESSION['user_error'] = 'Error in Username'; ?>
                                      <script type='text/javascript'>
                                      window.location.href='login.php';  
                                      </script>";
        <?php   }
    
            } */
            
        }
    }

        }

?>
<html>
<head>
<title>Sratch New</title>
<link rel="stylesheet" href="custom.css">
</head>
<body>
        <div class="box">
            <div class="login_form_box">
                <form id="login_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input class="input-form" type="text" name="username" id="username" placeholder="Username">
                <input class="input-form" type="password" name="password" id="password" placeholder="Password" ><br>
                <button class="btn_login" type="submit" name="login" id="login">Login</button>
                </form>
                <div class="errors">
<!-- <?php login_check(); ?> -->
                </div>
            </div>
        </div>      
                
                    

</body>
</html>

<?php  $login_obj = new login();
        echo $login_obj->check_login();?>