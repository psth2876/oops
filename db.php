<?php 

    class database
    {
        private $host;
        private $dbusername;
        private $dbpassword;
        private $dbname;

        protected function connect()
        {
            $this->host='localhost';
            $this->dbusername='root';
            $this->dbpassword='';
            $this->dbname='scratch';

            $con=new mysqli($this->host,$this->dbusername,$this->dbpassword,$this->dbname);
            return $con;

        }  

        // public function __construct()
        // {
        //         $con= new mysqli($this->host,$this->dbusername,$this->dbpassword,$this->dbname);
        //         if(mysqli_connect_errno())
        //         {
        //             echo "connection error";
        //             exit;
        //         }
        // }
    }

    //$obj=new database;
    

    class query extends database 
        {
          public function getdata($table,$field='*',$condition='',$order_by_field='',$order_by_type='',$limit='')
            { 
             $sql=" select $field from $table ";
            
            if($condition!='')
            {
                $sql.="where";
                $c=count($condition);
                $i=1;
                
                foreach($condition as $key=>$val)
                {
                    if($i==$c)
                    {
                        $sql.=" $key='$val' ";
                        //print_r($condition);
                    }
                    else
                    {
                        $sql.=" $key='$val' and ";
                        //echo $sql;
                    }
                    $i++;
                }
                echo $sql;
              
            } 
                 //print_r($condition);
            if($order_by_field!='')
            {
               $sql.="order by $order_by_field $order_by_type ";
            } 

            if($limit!='')
            {
               $sql.=" limit $limit ";
            } 
            //die($sql);
                $result=$this->connect()->query($sql);
            //print_r($result); 
                     if($result->num_rows>0)
                    {
                        $arr=array();
                        while($row=$result->fetch_assoc())
                        {
                            $arr[]=$row;
                            //print_r($sql); 
                            //print_r($arr);
                        }
                        return $arr; 
                        //print_r($arr);
                    }  
                    else
                    {
                        return 0;
                    }     
        }

                public function insertdata($table,$condition='')
            { 
                if($condition!='')
                {
                    foreach($condition as $key=>$val)
                    {
                        $fieldArr[]=$key;
                        $valueArr[]=$val;
                    }
                    $field=implode(",",$fieldArr);
                    $value=implode("','",$valueArr);
                    $value="'".$value."'";
                    $sql=" insert into $table($field) values($value) ";
                    // echo $sql;
                } 
                         $result=$this->connect()->query($sql);
                            
            }

            public function deletedata($table,$condition='')
            { 
                if($condition!='')
                {
                    $sql=" delete from $table where ";
                    $c=count($condition);
                    $i=1;
                
                foreach($condition as $key=>$val)
                {
                    if($i==$c)
                    {
                        $sql.=" $key='$val' ";
                        //print_r($condition);
                    }
                    else
                    {
                        $sql.=" $key='$val' and ";
                    }
                    $i++;
                }
                   
                    //echo $sql;
                } 
                         $result=$this->connect()->query($sql);
                            
            }

            public function updatedata($table,$condition='',$field_name,$field_value)
            { 
                if($condition!='')
                {
                    $sql=" update $table set ";
                    $c=count($condition);
                    $i=1;
                
                foreach($condition as $key=>$val)
                {
                    if($i==$c)
                    {
                        $sql.=" $key='$val' ";
                        
                    }
                    else
                    {
                        $sql.=" $key='$val', ";
                    }
                    $i++;
                }
                $sql.=" where $field_name='$field_value' ";
                    echo $sql;
                } 
                         $result=$this->connect()->query($sql);
                            
            }

            public function  santize_inputs($data)
            {
                $sanitize_trim = trim($data);
                $sanitize_trim = stripslashes($data);
                $sanitize_trim = htmlspecialchars($data);
                return $sanitize_trim;
            }

            public function protect_user_value($str)
            {
                if($str!='')
                {
                    return mysqli_real_escape_string($this->connect(),$str);
                }
            }

            public function querys($query)
            {
	            
	            return mysqli_query($this->connect(),$query);
            }

            function row_count($counts)
            {
                return mysqli_num_rows($counts);
            }


    }

    //$objects=new query();
     //$condition= array("username"=>"sad","first_name"=>4560,"last_name"=>"why");
     //$condition= array("username"=>"dark","first_name"=>4560);
    //$objects->getdata('signups','*','','id','asc','');
    //$objects->insertdata('signup',$condition);
    //$objects->deletedata('signup',$condition);
    //$objects->updatedata('signup',$condition,'id','7');
?>