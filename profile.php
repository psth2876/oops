<?php   session_start(); 
        include("db.php");
        // ********* FOR ALERT SESSIONS  WITH  MESSAGES *************

        // For javascript alert box with session messages.
        if(isset($_SESSION['username'])&& $_SESSION['username']!="")
        {
            
        }
        else
        {  
            header("location: index.php");
        }

        if (isset($_SESSION['file_upload_success']) && ! empty($_SESSION['file_upload_success'])) {
            echo "<script type='text/javascript'>alert('File Uploaded Successfully')</script>"; 
            unset($_SESSION['file_upload_success']);
        }

        if (isset($_SESSION['upload_error']) && ! empty($_SESSION['upload_error'])) { ?>
            <script> alert('<?php echo $_SESSION['upload_error']; ?>') </script>
            <?php unset($_SESSION['upload_error']);
        }

        if (isset($_SESSION['upload_success']) && ! empty($_SESSION['upload_success'])) {
            echo "<script type='text/javascript'>alert('Updated Successfully')</script>"; 
            unset($_SESSION['upload_success']);
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

        // ********* Fetch Query *************
        $username=$_SESSION['username'];
        $sql="SELECT * from signup where username='$username'";
        $query=query($sql);
        confirm($query);
        $row=fetch_data($query);
?>


<html>
<head>
<title>Sratch New</title>
<link rel="stylesheet" href="custom.css">
</head>
<body>
        <div class="box">
            <div class="profile_box">
         
                <span class="">First Name: <?php echo $row['first_name']; ?></span>
                <img src="documents/<?php echo $row['img']; ?>" style="width: 150px; height:100px; margin-left:300px;"><br><br>
                <span class="">Last Name: <?php echo $row['last_name']; ?></span><br><br>
                <span class="">Username: <?php echo $row['username']; ?></span><br><br>
                <span class="">Email: <?php echo $row['email']; ?></span><br><br>
                <span class="">Password: <?php echo $row['password']; ?></span><br><br>
                <span class="">Gender: <?php echo $row['gender']; ?></span><br><br>
                <span class="">Choose a Language:<?php echo $row['language']; ?></span><br><br>
                <span class="">Birthday: <?php echo $row['dob']; ?></span><br><br>
                <span class="">Comment: <?php echo $row['comment']; ?></span><br><br>
                <a href="edit_profile.php?edit_id=<?php echo $row['id']; ?>&action=edit" class="btn_edit" name="edit" id="edit">Edit</a>
                              
            </div>
        </div>                  
</body>
</html>