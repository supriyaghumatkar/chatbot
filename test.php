
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Blink Interact</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="dist/jquery.convform.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="demo.css">
      
</head>
<style>
    .chatbox
    {
        display:none;
    }
</style>
<body> 					
<!--Chat Now Button--> 
	<section id="demo">
        <input type="button" name="chatopen" id="chatopen" class="chatnowbtnopen" value="Chat Now"> 
         <input type="button" name="chatclose" id="chatclose" class="chatnowbtnclose" value="Chat Close"> 
	    <div class="vertical-align">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-6 col-sm-offset-8 col-xs-offset-0">
	                    <div class="card no-border">
	                        <div id="chat" class="conv-form-wrapper">
	                            <form action="" method="GET" class="hidden">                   
                    <?php
                        $con = mysqli_connect("localhost","root","","chatbot");
                        // Check connection
                        if (mysqli_connect_errno())
                          {
                             echo "Failed to connect to MySQL: " . mysqli_connect_error();
                          }
                          $query=mysqli_query($con,"select * from scriptdata where comp_id='2' and ques_status='active' order by script_id asc");
                          while($row= mysqli_fetch_array($query))
                          {

                                if($row['ques_type_id']==1 && $row['flag']==0)
                                {
                                   echo '<input type="text" data-conv-question="'.$row['question_text'].'" data-no-answer="true">';
                                }
                                else if($row['ques_type_id']==2 && $row['flag']==0)
                                {
                                    echo'<input data-conv-question="'.$row['question_text'].'" data-pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" id="email" type="email" name="email" required placeholder="Whats your e-mail?">'; 
                                }
                                else if($row['ques_type_id']==3 && $row['flag']==0)
                                {
                                    echo'<select name="ques_'.$row['script_id'].'" data-callback="storeState" data-conv-question="'.$row['question_text'].'">';
                                           $queryoption= mysqli_query($con,"select * from select_option where script_id=".$row['script_id']);
                                           while($option= mysqli_fetch_array($queryoption))
                                           {
                                            echo '<option value="'.strtolower($option['option_text']).'">'.$option['option_text'].'</option>' ; 
                                           }
                                         echo'</select>'; 
                                }
                                else if($row['ques_type_id']==3 && $row['flag']==1)
                                {
                                   echo'<select name="ques_'.$row['script_id'].'" data-callback="storeState" data-conv-question="'.$row['question_text'].'">';
                                           $queryoption= mysqli_query($con,"select * from select_option where script_id=".$row['script_id']);
                                           while($option= mysqli_fetch_array($queryoption))
                                           {
                                            echo '<option value="'.strtolower($option['option_text']).'">'.$option['option_text'].'</option>' ; 
                                           }
                                         echo'</select>'; 

                                         if($row['flag']==1)
                                         {   
                                             echo '<div data-conv-fork="ques_'.$row['script_id'].'">';           
                                             echo '<div data-conv-case="yes">';
                                             //echo "yes";
                                                   $queryflagyes=mysqli_query($con,"select * from scriptdata where flag=2 and sub_script_id=".$row['script_id']." and comp_id='1' and ques_status='active' order by script_id asc");
                                                        while($rowflagyes= mysqli_fetch_array($queryflagyes))
                                                        {

                                                              if($rowflagyes['ques_type_id']==1)
                                                              {
                                                                 echo '<input type="text" data-conv-question="'.$rowflagyes['question_text'].'" data-no-answer="true">';
                                                              }
                                                              else if($rowflagyes['ques_type_id']==2)
                                                              {
                                                                  echo '<input data-conv-question="'.$rowflagyes['question_text'].'" data-pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" id="email" type="email" name="email" required placeholder="Whats your e-mail?">'; 
                                                              }
                                                              else if($rowflagyes['ques_type_id']==3)
                                                              {
                                                                 echo '<select  data-callback="storeState" data-conv-question="'.$rowflagyes['question_text'].'">';
                                                                         $queryoption1= mysqli_query($con,"select * from select_option where script_id=".$rowflagyes['script_id']);
                                                                         while($option1= mysqli_fetch_array($queryoption1))
                                                                         {
                                                                          echo '<option value="'.$option1['option_text'].'">'.$option1['option_text'].'</option>' ; 
                                                                         }

                                                                         echo '</select>'; 
                                                              }
                                                              else if($rowflagyes['ques_type_id']==4)
                                                              {
                                                                   echo '<select name="multi[]" data-conv-question="'.$rowflagyes['question_text'].'" multiple>';
                                                                         $queryoption1= mysqli_query($con,"select * from select_option where script_id=".$rowflagyes['script_id']);
                                                                         while($option1= mysqli_fetch_array($queryoption1))
                                                                         {
                                                                         echo '<option value="'.$option1['option_text'].'">'.$option1['option_text'].'</option>';   
                                                                         }       
                                                                     echo '</select>'; 
                                                              }
                                                               else if($rowflagyes['ques_type_id']==5)
                                                                {
                                                                    echo '<input type="text" data-conv-question="'.$rowflagyes['question_text'].'">';

                                                                }

                                                          }

                                             echo '</div>';
                                             echo '</div>';
                                            /* For in case of no*/
                                             echo '<div data-conv-fork="ques_'.$row['script_id'].'">'; 
	                                     echo '<div data-conv-case="no">';	
                                             // echo "no";
                                                    $queryflagno=mysqli_query($con,"select * from scriptdata where flag=3 and sub_script_id=".$row['script_id']." and comp_id='1' and ques_status='active' order by script_id asc");
                                                        while($rowflagno= mysqli_fetch_array($queryflagno))
                                                        {

                                                              if($rowflagno['ques_type_id']==1)
                                                              {
                                                                 echo '<input type="text" data-conv-question="'.$rowflagno['question_text'].'" data-no-answer="true">';
                                                              }
                                                              else if($rowflagno['ques_type_id']==2)
                                                              {
                                                                  echo '<input data-conv-question="'.$rowflagno['question_text'].'" data-pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" id="email" type="email" name="email" required placeholder="Whats your e-mail?">'; 
                                                              }
                                                              else if($rowflagno['ques_type_id']==3)
                                                              {
                                                                 echo '<select  data-callback="storeState" data-conv-question="'.$rowflagno['question_text'].'">';
                                                                         $queryoption2= mysqli_query($con,"select * from select_option where script_id=".$rowflagno['script_id']);
                                                                         while($option2= mysqli_fetch_array($queryoption2))
                                                                         {
                                                                          echo '<option value="'.$option2['option_text'].'">'.$option2['option_text'].'</option>' ; 
                                                                         }

                                                                         echo '</select>'; 
                                                              }
                                                              else if($rowflagno['ques_type_id']==4)
                                                              {
                                                                   echo '<select name="multi[]" data-conv-question="'.$rowflagno['question_text'].'" multiple>';
                                                                         $queryoption2= mysqli_query($con,"select * from select_option where script_id=".$row['script_id']);
                                                                         while($option2= mysqli_fetch_array($queryoption2))
                                                                         {
                                                                         echo '<option value="'.$option2['option_text'].'">'.$option2['option_text'].'</option>';   
                                                                         }       
                                                                     echo '</select>'; 
                                                              }
                                                               else if($rowflagno['ques_type_id']==5)
                                                                {
                                                                    echo '<input type="text" data-conv-question="'.$rowflagno['question_text'].'">';

                                                                }

                                                          }
                                            
                                             echo '</div>';
                                             echo '</div>';
                                             
                                         }
                                }
                                else if($row['ques_type_id']==4 && $row['flag']==0)
                                {
                                       echo'<select name="multi[]" data-conv-question="'.$row['question_text'].'" multiple>';
                                           $queryoption= mysqli_query($con,"select * from select_option where script_id=".$row['script_id']);
                                           while($option= mysqli_fetch_array($queryoption))
                                           {
                                            echo'<option value="'.$option['option_text'].'">'.$option['option_text'].'</option>';   
                                           }       
                                       echo '</select>'; 
                                }
                                else if($row['ques_type_id']==5 && $row['flag']==0)
                                {
                                    echo '<input type="text" data-conv-question="'.$row['question_text'].'">';

                                }

                            }

                    ?>
 
                                
	                            </form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
	<script type="text/javascript" src="jquery-1.12.3.min.js"></script>
	<script type="text/javascript" src="dist/autosize.min.js"></script>
	<script type="text/javascript" src="dist/jquery.convform.js"></script>
        <script>
//         $(document).ready(function() {
//      $.ajax({    //create an ajax request to display.php
//        type: "GET",
//        url: "display.php",             
//        dataType: "html",   //expect html to be returned                
//        success: function(response){                    
//            $("#responsecontainer").html(response); 
//            //alert(response);
//        }
//
//});
//});

        
        </script>
	<script>
		function google(stateWrapper, ready) {
			window.open("https://google.com");
			ready();
		}
		function bing(stateWrapper, ready) {
			window.open("https://bing.com");
			ready();
		}
		var rollbackTo = false;
		var originalState = false;
		function storeState(stateWrapper, ready) {
	
			rollbackTo = stateWrapper.current;
			//console.log("storeState called: ",rollbackTo);
			ready();
		}
		function rollback(stateWrapper, ready) {
			console.log("rollback called: ", rollbackTo, originalState);
			console.log("answers at the time of user input: ", stateWrapper.answers);
			if(rollbackTo!=false) {
				if(originalState==false) {
					originalState = stateWrapper.current.next;
						console.log('stored original state');
				}
				stateWrapper.current.next = rollbackTo;
				//console.log('changed current.next to rollbackTo');
			}
			ready();
		}
		function restore(stateWrapper, ready) {
			if(originalState != false) {
				stateWrapper.current.next = originalState;
				//console.log('changed current.next to originalState');
			}
			ready();
		}
	</script>
	<script>
		jQuery(function($){
                $("#chatclose").hide();
                setTimeout(function () {
                   convForm = $('#chat').convform();
                    $("#chatclose").show();
                 }, 5000);
                 
                  $(".chatnowbtnopen").click(function() {
                    $('.no-border').removeClass('chatbox');
                    $("#chatclose").show();
                    $("#chatopen").hide();
                    convForm = $('#chat').convform();   
                   
                  });	
                  
                  $(".chatnowbtnclose").click(function() { 
                    $('.no-border').addClass('chatbox');
                    $("#chatopen").show();
                    $("#chatclose").hide();
                  });	
                  
		});
	</script>
</body>
</html>