<?php 
        session_start(); 
        include("functions/db.php");
        // ********* FOR ALERT SESSIONS  WITH  MESSAGES *************

        // For javascript alert box with session messages.
        if(isset($_SESSION['username'])&& $_SESSION['username']!="")
        {
            
        }
        else
        {
            header("location: index.php");
        }
        
        // ********* Session Timeout code *************
        $inactive=100;
        if(isset($_SESSION['timeout']))
        {
            $sessionttl=time()- $_SESSION['timeout'];
            if($sessionttl > $inactive)
            {
            header("location:logout.php");	
            }	
            
        }
        $_SESSION['timeout']=time();
        
        // *********** Query Edit Code **************
        if(isset($_GET['action']) && ($_GET['action']!= "")  && ($_GET['action']='edit'))
        {
            $id=$_GET['edit_id'];
        
        $sql="select * from signup where id='$id'";
        $query=query($sql);
        confirm($query);
        $row=fetch_data($query);
        }
?>

<html>
<head>
<title>Sratch New</title>
<link rel="stylesheet" href="custom.css">
</head>
<body>
        <div class="box">
            <div class="profile_form_box">
                <form id="profile_form" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars('update_profile.php');?>">
                <input type="hidden" name="edit_id" value="<?php echo $row['id'];?>">
                <input class="input-form" type="text" name="fname" id="fname" placeholder="First Name" value="<?php echo $row['first_name']; ?>"><br><br>
                <input class="input-form" type="text" name="lname" id="lname" placeholder="Last Name" value="<?php echo $row['last_name']; ?>"><br><br>
                <input class="input-form" type="text" name="username" id="username" placeholder="Username" value="<?php echo $row['username']; ?>" disabled="disabled"><br><br>
                <input class="input-form" type="email" name="email" id="email" placeholder="Email" value="<?php echo $row['email']; ?>"><br><br>
                <input class="input-form" type="password" name="password" id="password" placeholder="Password" value="<?php echo $row['password']; ?>"><br><br>
                Gender:
                <input type="radio" name="gender"     value="female"   <?php if($row['gender']=="female")  echo "checked" ?> >Female
                <input type="radio" name="gender"     value="male"     <?php if($row['gender']=="male") echo "checked" ?> >Male

                <!-- // This one is not working 
                <input type="radio" name="gender"     value="other"    <?php if($row['gender']=="other") echo "checked" ?>   >Other -->
                <br><br>

                <label for="core">Choose a Language:</label>
                <select id="language" name="language">
                <option value="php" <?php if($row['language']=="php") echo "selected" ?>>PHP</option>
                <option value="javascript" <?php if($row['language']=="javascript") echo "selected" ?>>Javascript</option>
                <option value="python" <?php if($row['language']=="python") echo "selected" ?>>Python</option>
                <option value="c++" <?php if($row['language']=="c++") echo "selected" ?>>C++</option>
                </select>

                Birthday: <input type="date" name="dob" value="<?php echo $row['dob']; ?>"><br><br>

                <input type="file" name="file" ><br><br>
                
                <textarea  name="comment" rows="4" cols="60"><?php echo $row['comment'];?></textarea><br><br>
                <button class="btn_update" type="submit" name="update" id="update">Update</button>
                </form>
                <div class="errors">

                </div>
            </div>
        </div>      
                
                    

</body>
</html>