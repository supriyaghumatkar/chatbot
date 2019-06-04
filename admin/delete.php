<?php
 include('include.php');

 if(isset($_GET))
 {
    $id=$_GET['id'];
    $table=$_GET['table'];
    if($id!="" && $table!="" &&  $table=='scriptdata')
    {
        echo "delete from  $table where script_id='$id'";
        $query=mysqli_query($con,"delete from  $table where script_id='$id'");
        if($query)
        {
        header('location:master.php');  
        }
    }


 }