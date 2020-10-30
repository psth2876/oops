<?php  
session_start();
include("db.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if(isset($_POST['update']))
            {   
                $update_id=santize_inputs($_POST['edit_id']);
                $fname=santize_inputs($_POST['fname']);
                $lname=santize_inputs($_POST['lname']);
                $email=santize_inputs($_POST['email']);
                $password=santize_inputs($_POST['password']);
                $gender=santize_inputs($_POST['gender']);
                $language=santize_inputs($_POST['language']);
                $dob=santize_inputs($_POST['dob']);
                $comment=($_POST['comment']);
                $errors=[];

                $file_name = $_FILES['file']['name'];
                $file_size = $_FILES['file']['size'];
                $file_tmp = $_FILES['file']['tmp_name'];
                $file_type = $_FILES['file']['type'];
                $exploded=explode('.',$file_name);
                $file_ext=strtolower(end($exploded));
                $extensions= array("jpeg","jpg","png");
                $file_path="documents/";
                $newfilename=$_SESSION['username'].'.'.end($exploded);
                
                //check image is real or not 
                // $check=getimagesize($_FILES['file']['tmp_name']);
                // if($check !== false) {
                //     echo "File is an image - " . $check["mime"] . ".";
                    
                //   } 
                //   else 
                //   {
                //     echo "File is not an image."; 
                //   }

                // if (file_exists($file_path.$file_name)) {
                //     $errors[]='Sorry, file already exists.';
                //   }

                    //query fetch for checking the previous file from database  
                    $select_query="SELECT img FROM signup WHERE id='$update_id' ";
                    $select_query_run=mysqli_query($connection,$select_query);
                    list($img)=mysqli_fetch_array($select_query_run); 
                    $img_path="documents/$img";


                //checks whether the file is going to be updated or not ....  
                if($file_tmp !="")
                {
                    // check extension of file 
                    if(in_array($file_ext,$extensions)=== false){
                        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                    }

                    //check file size limit
                    if($file_size > 2097152) {
                        $errors[]='Sorry, your file is too large';
                    }

                    //if no erros are found 
                    if(empty($errors)==true) {

                        //if file already exits in databse then delete and replace files
                        if(file_exists($img_path)==true){
                            unlink($img_path);
                            $updated_image=$newfilename;
            
                        }

                        move_uploaded_file($file_tmp,$file_path.$newfilename);
                        $_SESSION['file_upload_success']= "uploaded";
                        $sql="UPDATE signup SET first_name='$fname' , last_name='$lname'  , email='$email' , password='$password' ,img='$newfilename', gender='$gender' , language='$language' , dob='$dob', comment='$comment' WHERE id='$update_id' ";
                        $query=query($sql);
                        confirm($query);
                        header("location:profile.php");
                        }
                    else
                        {
                            foreach($errors as $err)
                            {
                                $_SESSION['upload_error']= $err;
                                header("location:profile.php");
                            }
                    }
                }
                else
                        //if file is not selected for updating .....
                    {
                        $_SESSION['upload_success']= "uploaded";
                        $sql="UPDATE signup SET first_name='$fname' , last_name='$lname'  , email='$email' , password='$password' , gender='$gender' , language='$language' , dob='$dob', comment='$comment' WHERE id='$update_id' ";
                        $query=query($sql);
                        confirm($query);
                        header("location:profile.php");
                    }
           }
     }
        // sanitize the required inputs given by user
        function santize_inputs($data)
            {
                $sanitize_trim = trim($data);
                $sanitize_trim = stripslashes($data);
                $sanitize_trim = htmlspecialchars($data);
                return $sanitize_trim;
            }

        ?>