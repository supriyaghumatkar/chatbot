<?php
$con = mysqli_connect("localhost","root","","chatbot");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
//$form="";
//echo 'select * from scriptdata order by id asc';
  $query=mysqli_query($con,"select * from scriptdata order by script_id asc");
  while($row= mysqli_fetch_array($query))
  {
      
        if($row['ques_type_id']==1)
        {
           $form='<input type="text" data-conv-question='.$row['question_text'].' data-no-answer="true">';
        }
        else if($row['ques_type_id']==2)
        {
            $form.='<input data-conv-question='.$row['question_text'].' data-pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" id="email" type="email" name="email" required placeholder="Whats your e-mail?">'; 
        }
        else if($row['ques_type_id']==3)
        {
           $form.='<select name="programmer" data-callback="storeState" data-conv-question='.$row['question_text'].'>';
                   $queryoption= mysqli_query($con,"select * from select_option where script_id=".$row['script_id']);
                   while($option= mysqli_fetch_array($queryoption))
                   {
                    $form.= '<option value='.$option['option_text'].'>'.$option['option_text'].'</option>' ; 
                   }
                   
                   $form.='</select>'; 
        }
        else if($row['ques_type_id']==4)
        {
               $form.='<select name="multi[]" data-conv-question='.$row['question_text'].' multiple>';
                   $queryoption= mysqli_query($con,"select * from select_option where script_id=".$row['script_id']);
                   while($option= mysqli_fetch_array($queryoption))
                   {
                    $form.='<option value='.$option['option_text'].'>'.$option['option_text'].'</option>';   
                   }       
               $form.='</select>'; 
        }

    }
 