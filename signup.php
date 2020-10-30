<?php   session_start(); 
        include("db.php"); 
        
        $objects=new query();

         // ********* FOR ALERT SESSIONS  WITH  MESSAGES *************

        // For javascript alert box with session messages
        if (isset($_SESSION['username_error']) && ! empty($_SESSION['username_error'])) {
            echo "<script type='text/javascript'>alert('Username Already Existed')</script>"; 
            //htmlentities($_SESSION['username_error']);
            unset($_SESSION['username_error']);
        }
        
        if (isset($_SESSION['email_error']) && ! empty($_SESSION['email_error'])) {
            echo "<script type='text/javascript'>alert('Email Already Existed')</script>"; 
            //htmlentities($_SESSION['email_error']);
            unset($_SESSION['email_error']);
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


            
        if($_SERVER['REQUEST_METHOD'] == "POST")
            
            {

            if(isset($_POST['signup']))
                    
                 {
                        $username = $objects->santize_inputs($_POST['username']);
                        $email= $objects->santize_inputs($_POST['email']);
                        $password= $objects->santize_inputs($_POST['password']);
                        $hash_password=password_hash($password,PASSWORD_BCRYPT);
                        $max=16;
                        $min=06;
                        $error=[];
                        if(empty($_POST['username']))
                        {
                            $error="Username is empty";
                            echo $error;
                        }
                        else
                        {
                            //$username=$objects->santize_inputs($_POST['username']);
                            //echo '<div class="msg">'.$username.'</div>';
                    
                        }

                        if(empty($_POST['email']))
                        {
                            $error[]="email is empty";
                        }
                        else
                        {
                            $email=$objects->santize_inputs($_POST['email']);
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                                {
                                    $error[] = "Invalid email format";
                                }
                            //echo '<div class="msg">'.$email.'</div>';
                        }

                        if(empty($_POST['password']))
                        {
                            $error[]="password is empty";
                        }
                        else
                        {
                            $password=$objects->santize_inputs($_POST['password']);
                           // echo '<div class="msg">'.$password.'</div>';
                        }

                        // if(!preg_match("/^[a-zA-Z,0-9]*$/",$username))
                        // {
                        //     $error[]="Username not accpetable ";
                            
                        // }
                        if(strlen($password)<$min)
                        {   
                            $error[]="Password is less than 6 character";
                        }
                        if(strlen($password)>$max)
                        {   
                            $error[]="Password is greater than 16 character";
                        }
                        
                        if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,16}$/',$password))
                        {
                            
                            //at least one lowercase , one uppercase , one digit one special sign of @#-_$%^&+=§!?

                            $error[]="password requirements not accepted";
                        }

                        if(!empty($error))
                        {
                            foreach($error as $err)
                            {
                                echo '<div class="error_msg" style="color:black;">'.$err.'</div>';
                            }
                        }
                        else
                        {

                            $sql="select * from signup where (username='$username' or email='$email');";
    
                                    $res=$objects->querys($sql);
                                    if(mysqli_num_rows($res)>0)
                                    {
                                        $row = mysqli_fetch_assoc($res);
                                        print_r($row);
                                        if($email==$row['email'])
                                        {	
                                            $_SESSION['email_error'] = 'Error!';
                                                
                                                ?>	<script type='text/javascript'>
                                                    window.location.href='signup.php';  
                                                    </script>";
                                <?php   }
                                            elseif($username==$row['username'])
                                            {
                                                
                                                $_SESSION['username_error'] = 'Error!';
                                            ?>	<script type='text/javascript'>
                                                window.location.href='signup.php';  
                                                </script>";
                                    <?php 	} 
                                            else
                                            {
                                            

                                            }              
                                        
                                    }

                                        
                                        else
                                        
                                        {
                                            $condition= array("username"=>$username,"email"=>$email,"password"=>$hash_password);
                                             $objects->insertdata('signup',$condition);
                    
                                            $_SESSION['registration_success'] = 'Registered!';
                                            ?> 
                                            <script type='text/javascript'>
                                                                window.location.href='login.php';  
                                                                </script>";
         
                                     <?php 	}  

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
            <div class="signup_form_box">
                <form id="signup_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input class="input-form" type="text" name="username" id="username" placeholder="Username">
                <input class="input-form" type="email" name="email" id="email" placeholder="Email" >
                <input class="input-form" type="password" name="password" id="password" placeholder="Password" ><br>
                <button class="btn_signup" type="submit" name="signup" id="signup">Signup</button>
                </form>
                <div class="errors">
<!-- <?php //signup_check(); ?> -->
                </div>
            </div>
        </div>                          

</body>
</html>