<?php
 include('include.php');

if(isset($_POST['Action']) && $_POST['Action']=='CheckTypeInsert' && !empty($_POST['typeinsert']))
{ 
   $typeinsert=$_POST['typeinsert'];

   if($typeinsert=='texttype')
   {
      $query=mysqli_query($con, "SELECT * FROM scriptdata where comp_id=2 ORDER BY post_order_no DESC");
      $result=mysqli_fetch_assoc($query);
      $post_order=$result['post_order_no'];
      $post_order_id=$post_order +1;
      

       $str=strip_tags($_POST['dataval'],"<img>");
       $dataval = $str;
      
      $query=mysqli_query($con,"insert into scriptdata(comp_id,ques_type_id,question_text,flag,sub_script_id,ques_status,post_order_no)values('2','1','$dataval','0','0','active','$post_order_id')"); 
      
   }

   if($typeinsert=='statementtype')
   {
      $query=mysqli_query($con, "SELECT * FROM scriptdata where comp_id=2 ORDER BY post_order_no DESC");
      $result=mysqli_fetch_assoc($query);
      $post_order=$result['post_order_no'];
      $post_order_id=$post_order +1;
      

      $str=strip_tags($_POST['dataval'],"<img>");
      $dataval = $str;

      $query=mysqli_query($con,"insert into scriptdata(comp_id,ques_type_id,question_text,flag,sub_script_id,ques_status,post_order_no)VALUES('2','5','$dataval','0','0','active','$post_order_id')");
     
   }
   
   
   if($typeinsert=='dropdowntype')
   {
      $query=mysqli_query($con, "SELECT * FROM scriptdata where comp_id=2 ORDER BY post_order_no DESC");
      $result=mysqli_fetch_assoc($query);
      $post_order=$result['post_order_no'];
      $post_order_id=$post_order +1;
     

       parse_str($_POST['dropdownoption'],$searcharray);
      $str=strip_tags($_POST['dataval'],"<img>");
       $dataval = $str;
       $query=mysqli_query($con,"insert into scriptdata(comp_id,ques_type_id,question_text,flag,sub_script_id,ques_status,post_order_no)values('2','3','$dataval','0','0','active','$post_order_id')"); 
       $last_insert_id=mysqli_insert_id($con); 
       $i=0; 
       extract($searcharray);
       foreach($options as $d)
      { 
       // echo $d;
        $queryoption=mysqli_query($con,"insert into select_option(script_id,option_text)values('$last_insert_id','$d')"); 
        $i++;         
      }
       
   }
   
   if($typeinsert=='multiselecttype')
   {
      $query=mysqli_query($con, "SELECT * FROM scriptdata where comp_id=2 ORDER BY post_order_no DESC");
      $result=mysqli_fetch_assoc($query);
      $post_order=$result['post_order_no'];
      $post_order_id=$post_order +1;
      

       parse_str($_POST['multidropwnoption'], $searcharray);
       $str=strip_tags($_POST['dataval'],"<img>");
       $dataval = $str;
       $query=mysqli_query($con,"insert into scriptdata(comp_id,ques_type_id,question_text,flag,sub_script_id,ques_status,post_order_no)values('2','4','$dataval','0','0','active','$post_order_id')");  
       $last_insert_id=mysqli_insert_id($con);  
        $i=0;  
        extract($searcharray);  
        foreach($muloptions as $d)
       { 
         $queryoption=mysqli_query($con,"insert into select_option(script_id,option_text)values('$last_insert_id','$d')"); 
         $i++;         
       }
   }
   
   if($typeinsert=='emailtype')
   {
      $query=mysqli_query($con, "SELECT * FROM scriptdata where comp_id=2 ORDER BY post_order_no DESC");
      $result=mysqli_fetch_assoc($query);
      $post_order=$result['post_order_no'];
      $post_order_id=$post_order +1;
      $str=strip_tags($_POST['dataval'],"<img>");
       $dataval = $str;
       $query=mysqli_query($con,"insert into scriptdata(comp_id,ques_type_id,question_text,flag,sub_script_id,ques_status,post_order_no)values('2','2','$dataval','0','0','active','$post_order_id')"); 
   }

   if($typeinsert=='rangetype')
   {
      $query=mysqli_query($con, "SELECT * FROM scriptdata where comp_id=2 ORDER BY post_order_no DESC");
      $result=mysqli_fetch_assoc($query);
      $post_order=$result['post_order_no'];
      $post_order_id=$post_order +1;
     

      $str=strip_tags($_POST['dataval'],"<img>");
      $dataval = $str;
     
      $query=mysqli_query($con,"insert into scriptdata(comp_id,ques_type_id,question_text,flag,sub_script_id,ques_status,post_order_no)values('2','6','$dataval','0','0','active','$post_order_id')"); 
      $minimum=$_POST['minimum'];
      $maximum=$_POST['maximum'];
      $prifix=$_POST['prifix'];
      $last_insert_id=mysqli_insert_id($con);
      $query2=mysqli_query($con,"insert into range_option(script_id,minimum,maximum,prifix)values('$last_insert_id','$minimum','$maximum','$prifix')"); 


   }
}
?>