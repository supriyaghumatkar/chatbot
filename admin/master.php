<?php
session_start();
if($_SESSION['SESS_id']=="" || $_SESSION['SESS_id']==" ") 
	{
	header("location:index.php");
   }

 include('header.php'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Master Form
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- <span id="SecondsUntilExpire"></span> -->
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Make Your Own Script</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
   
    <div class="col-sm-12"> 
       
  <form class="form-inline" method="POST" action="#" id="myform">
        <div class="col-sm-6"> 
    <div class="form-group col-sm-8">
        <button type="button"  class="btn .btn-sm btn-primary find_type col-sm-6"  id="text_ques" value="text_question">Text</button>
    </div><br><br>
    <div class="form-group col-sm-8">
      <button  type="button" class="btn .btn-sm btn-success find_type col-sm-6" id="statement" value="statement">Question</button>
    </div><br><br>
    <div class="form-group col-sm-8">
      <button type="button" class="btn .btn-sm btn-info find_type col-sm-6" id="dropdown" value="dropdown">Dropdown</button>
    </div><br><br>
   <div class="form-group col-sm-8">
      <button type="button"  class="btn .btn-sm btn-danger find_type col-sm-6" id="multiselect" value="multiselect">Multiselect</button>
    </div><br><br>
      <div class="form-group col-sm-8">
      <button type="button" class="btn .btn-sm btn-warning find_type col-sm-6" id="email_type" value="email_type">Email</button>
    </div><br><br>
    <div class="form-group col-sm-8">
      <button type="button" class="btn .btn-sm btn-primary find_type col-sm-6" id="range_type" value="range_type">Range Slider</button>
    </div>
<!--<button type="submit" class="btn btn-default">Submit</button>-->
  </div>
       <div class="col-sm-6" id="myscripttext"> 
    </div>
  </form>
   </div> 

<div  class="col-sm-6">
<h3 class="box-title">Your Script</h3>
   <div class="alert icon-alert with-arrow alert-success form-alter" role="alert">
	<i class="fa fa-fw fa-check-circle"></i>
	<strong> Success ! </strong> <span class="success-message"> Post Order has been updated successfully </span>
</div>
<div class="alert icon-alert with-arrow alert-danger form-alter" role="alert">
	<i class="fa fa-fw fa-times-circle"></i>
	<strong> Note !</strong> <span class="warning-message"> Empty list cant be ordered </span>
</div>
<ul class="list-unstyled" id="post_list">
<?php
//get rows query
$query = mysqli_query($con, "SELECT * FROM scriptdata where comp_id=2 ORDER BY post_order_no ASC");

//number of rows
$rowCount = mysqli_num_rows($query);

if($rowCount > 0){ 
	while($row = mysqli_fetch_assoc($query)){ 
		$tutorial_id = 	$row['script_id'];
?>
	<li data-post-id="<?php echo $row["script_id"]; ?>">
		<div class="li-post-group">
		<h5 class="li-post-title"><?php echo $row["script_id"].')' ?><?php if(preg_match('~<img.*?src=["\']+(.*?)["\']+~', $row["question_text"])){ echo "Media";}  else { echo substr($row["question_text"],0,50);} ?><a href="edit.php?id=<?php echo $row["script_id"]; ?>"><i class="fa fa-edit"></i></a> <a href="delete.php?id=<?php echo $row["script_id"]; ?>&table=scriptdata"><i class="fa fa-trash"></i></a></h5>
		<p class="li-post-desc"><?php echo ucfirst($row["question_text"]); ?></p>
	</div>
	</li>
<?php } 
} ?>
</ul>

</div>

   <section id="">
        <input type="button" name="chatopen" id="chatopen" class="chatnowbtnopen" value="Preview"> 
         <input type="button" name="chatclose" id="chatclose" class="chatnowbtnclose" value="Preview Close"> 
	    <div class="vertical-align chatbotwrap">
	        
	                    <div class="card no-border">
	                  <div id="chat" class="conv-form-wrapper ">
                          <p class="chatfooter">powered by : <span>BlinkInteract</span></p>
							        	<a href="#" class="upperchatnowbtnclose" ><i class="fa fa-close"></i></a>	
	                            <form action="" method="GET" class="hidden">                   
                    <?php
                       
                       $query=mysqli_query($con,"select * from scriptdata where comp_id='2' and ques_status='active' ORDER BY post_order_no ASC");
                       while($row= mysqli_fetch_array($query))
                       {

                             if($row['ques_type_id']==1 && $row['flag']==0)
                             {
                                echo "<input type='text' data-conv-question='".$row['question_text']."' data-no-answer='true'>";
                             }
                             else if($row['ques_type_id']==2 && $row['flag']==0)
                             {
                                 echo"<input data-conv-question='".$row['question_text']."' data-pattern='^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$' id='email' type='email' name='email' required placeholder='Whats your e-mail?'>"; 
                             }
                            
                             else if($row['ques_type_id']==3 && $row['flag']==0)
                             {
                                 echo"<select name='ques_".$row['script_id']."' data-callback='storeState' data-conv-question='".$row['question_text']."'>";
                                        $queryoption= mysqli_query($con,"select * from select_option where script_id=".$row['script_id']);
                                        while($option= mysqli_fetch_array($queryoption))
                                        {
                                         echo "<option  class='dragscroll' value='".strtolower($option['option_text'])."'>".$option['option_text']."</option>" ; 
                                        }
                                      echo"</select>"; 
                             } 
                             else if($row['ques_type_id']==3 && $row['flag']==1)
                             {
                                echo"<select name='ques_".$row['script_id']."' data-callback='storeState' data-conv-question='".$row['question_text']."'>";
                                        $queryoption= mysqli_query($con,"select * from select_option where script_id=".$row['script_id']);
                                        while($option= mysqli_fetch_array($queryoption))
                                        {
                                         echo "<option  class='dragscroll' value='".strtolower($option['option_text'])."'>".$option['option_text']."</option>" ; 
                                        }
                                      echo"</select>"; 

                                      if($row['flag']==1)
                                      {   
                                          echo "<div data-conv-fork='ques_".$row['script_id']."'>";           
                                          echo "<div data-conv-case='yes'>";
                                          //echo "yes";
                                                $queryflagyes=mysqli_query($con,"select * from scriptdata where flag=2 and sub_script_id=".$row['script_id']." and comp_id='1' and ques_status='active' order by script_id asc");
                                                     while($rowflagyes= mysqli_fetch_array($queryflagyes))
                                                     {

                                                           if($rowflagyes['ques_type_id']==1)
                                                           {
                                                              echo "<input type='text' data-conv-question='".$rowflagyes['question_text']."' data-no-answer='true'>";
                                                           }
                                                           else if($rowflagyes['ques_type_id']==2)
                                                           {
                                                               echo "<input data-conv-question='".$rowflagyes['question_text']."' data-pattern='^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$' id='email' type='email' name='email' required placeholder='Whats your e-mail?'>"; 
                                                           }
                                                           else if($rowflagyes['ques_type_id']==3)
                                                           {
                                                              echo "<select  data-callback='storeState' data-conv-question='".$rowflagyes['question_text']."'>";
                                                                      $queryoption1= mysqli_query($con,"select * from select_option where script_id=".$rowflagyes['script_id']);
                                                                      while($option1= mysqli_fetch_array($queryoption1))
                                                                      {
                                                                       echo "<option  class='dragscroll' value='".$option1['option_text']."'>".$option1['option_text']."</option>" ; 
                                                                      }

                                                                      echo "</select>"; 
                                                           }
                                                           else if($rowflagyes['ques_type_id']==4)
                                                           {
                                                                echo "<select name='multi[]' data-conv-question='".$rowflagyes['question_text']."' multiple>";
                                                                      $queryoption1= mysqli_query($con,"select * from select_option where script_id=".$rowflagyes['script_id']);
                                                                      while($option1= mysqli_fetch_array($queryoption1))
                                                                      {
                                                                      echo "<option  class='dragscroll' value='".$option1['option_text']."'>".$option1['option_text']."</option>";   
                                                                      }       
                                                                  echo "</select>"; 
                                                           }
                                                            else if($rowflagyes['ques_type_id']==5)
                                                             {
                                                                 echo "<input type='text' data-conv-question='".$rowflagyes['question_text']."'>";

                                                             }
                                                             else if($row['ques_type_id']==6)
                                                                {
                                                                  $queryrange= mysqli_query($con,"select * from range_option where script_id=".$row['script_id']);
                                                                  $rageop=mysqli_fetch_array($queryrange);
                                                                  echo "<input data-conv-question='".$row['question_text']."' type='rang' name='rang' required placeholder=''  data-no-answer='true'>";
                                                                  echo "<script>var str ='".$rageop['prifix']."';</script>";
                                                                  $range='<input type="range" name="range" id="range_weight" value="5" min="'.$rageop['minimum'].'" max="'.$rageop['maximum'].'" oninput="userInput.value= str + range_weight.value;">';
                                                                  echo "<input type='text' data-pattern='[0-9]+$' data-conv-question='$range'>" ;            

                                                                }

                                                       }

                                          echo "</div>";
                                          echo "</div>";
                                         /* For in case of no*/
                                          echo "<div data-conv-fork='ques_".$row['script_id']."'>"; 
                                    echo "<div data-conv-case='no'>";	
                                          // echo "no";
                                                 $queryflagno=mysqli_query($con,"select * from scriptdata where flag=3 and sub_script_id=".$row['script_id']." and comp_id='1' and ques_status='active' order by script_id asc");
                                                     while($rowflagno= mysqli_fetch_array($queryflagno))
                                                     {

                                                           if($rowflagno['ques_type_id']==1)
                                                           {
                                                              echo "<input type='text' data-conv-question='".$rowflagno['question_text']."' data-no-answer='true'>";
                                                           }
                                                           else if($rowflagno['ques_type_id']==2)
                                                           {
                                                               echo "<input data-conv-question='".$rowflagno['question_text']."' data-pattern='^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$' id='email' type='email' name='email' required placeholder='Whats your e-mail?'>"; 
                                                           }
                                                           else if($rowflagno['ques_type_id']==3)
                                                           {
                                                              echo "<select  data-callback='storeState' data-conv-question='".$rowflagno['question_text']."'>";
                                                                      $queryoption2= mysqli_query($con,"select * from select_option where script_id=".$rowflagno['script_id']);
                                                                      while($option2= mysqli_fetch_array($queryoption2))
                                                                      {
                                                                       echo "<option  class='dragscroll' value='".$option2['option_text']."'>".$option2['option_text']."</option>" ; 
                                                                      }

                                                                      echo "</select>"; 
                                                           }
                                                           else if($rowflagno['ques_type_id']==4)
                                                           {
                                                                echo "<select name='multi[]' data-conv-question='".$rowflagno['question_text']."' multiple>";
                                                                      $queryoption2= mysqli_query($con,"select * from select_option where script_id=".$row['script_id']);
                                                                      while($option2= mysqli_fetch_array($queryoption2))
                                                                      {
                                                                      echo "<option  class='dragscroll' value='".$option2['option_text']."'>".$option2['option_text']."</option>";   
                                                                      }       
                                                                  echo "</select>"; 
                                                           }
                                                            else if($rowflagno['ques_type_id']==5)
                                                             {
                                                                 echo "<input type='text' data-conv-question='".$rowflagno['question_text']."'>";

                                                             }
                                                             else if($row['ques_type_id']==6)
                                                                {
                                                                  $queryrange= mysqli_query($con,"select * from range_option where script_id=".$row['script_id']);
                                                                  $rageop=mysqli_fetch_array($queryrange);
                                                                  echo "<input data-conv-question='".$row['question_text']."' type='rang' name='rang' required placeholder=''  data-no-answer='true'>";
                                                                  echo "<script>var str ='".$rageop['prifix']."';</script>";
                                                                  $range='<input type="range" name="range" id="range_weight" value="5" min="'.$rageop['minimum'].'" max="'.$rageop['maximum'].'" oninput="userInput.value= str + range_weight.value;">';
                                                                  echo "<input type='text' data-pattern='[0-9]+$' data-conv-question='$range'>" ;           

                                                                }

                                                       }
                                         
                                          echo "</div>";
                                          echo "</div>";
                                          
                                      }
                             }
                             else if($row['ques_type_id']==4 && $row['flag']==0)
                             {
                                    echo"<select name='multi[]' data-conv-question='".$row['question_text']."' multiple>";
                                        $queryoption= mysqli_query($con,"select * from select_option where script_id=".$row['script_id']);
                                        while($option= mysqli_fetch_array($queryoption))
                                        {
                                         echo"<option  class='dragscroll' value='".$option['option_text']."'>".$option['option_text']."</option>";   
                                        }       
                                    echo "</select>"; 
                             }
                             else if($row['ques_type_id']==5 && $row['flag']==0)
                             {
                                 echo "<input type='text' data-conv-question='".$row['question_text']."'>";

                             }
                             else if($row['ques_type_id']==6 && $row['flag']==0)
                             {
                                  $queryrange= mysqli_query($con,"select * from range_option where script_id=".$row['script_id']);
                                  $rageop=mysqli_fetch_array($queryrange);
                                  echo "<input data-conv-question='".$row['question_text']."' type='rang' name='rang' required placeholder=''  data-no-answer='true'>";
                                  echo "<script>var str ='".$rageop['prifix']."';</script>";
                                  $range='<input type="range" name="range" id="range_weight" value="5" min="'.$rageop['minimum'].'" max="'.$rageop['maximum'].'" oninput="userInput.value= str  + range_weight.value;">';
                                  echo "<input type='text' data-pattern='[0-9]+$' data-conv-question='$range'>" ;           

                             }

                         }
                          ?>      
	                            </form>
	                      
	            </div>
	        </div>
	    </div>
	</section>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('footer.php'); ?>

  <script>
 $(document).ready(function() { 
  $("#myscripttext ").hide();    
 $(".find_type").click(function() {
 
     var typedata=$(this).val();
                       $.ajax({				
					url:"ajax.php",
					type: "POST",
					data: {'typedata':typedata,'Action':'CheckType'},
					datatype: "html",
					async: true,
					cache: false,
					success: function(data) 
					{
            $("#myscripttext ").show();
           $("#myscripttext").html(data);					}
				});
});
});
 </script>
 <script type="text/javascript" src="../dist/jquery.convform.js"></script>
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
                $("#chat").hide();
                $('.no-border').removeClass('card');
                // setTimeout(function () {
                //    convForm = $('#chat').convform();
                //     $("#chatclose").show();
                //  }, 5000);
                 
                  $(".chatnowbtnopen").click(function() {
                    $('.no-border').addClass('card');
				            $('#chat').show();
                    $('.no-border').removeClass('chatbox');
                    $("#chat").show();
                    $("#chatclose").show();
                    $("#chatopen").hide();
                    convForm = $('#chat').convform();   
                   
                  });	
                  
                  $(".chatnowbtnclose").click(function() { 
                    $('#chat').hide();
                    $('.no-border').addClass('chatbox');
                    $("#chatopen").show();
                    $("#chatclose").hide();
                    $('.no-border').removeClass('card');
                  });	

                  $(".upperchatnowbtnclose").click(function() {
				    $('#chat').hide();
                    $('.no-border').addClass('chatbox');
                    $("#chatopen").show();
                    $("#chatclose").hide();
                    $('.no-border').removeClass('card');
                  });	


      

                  
		});
	</script>
   <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
  <script>
  $(".alert-danger").hide();
  $(".alert-success ").hide();

  
 $( "#post_list" ).sortable({
	placeholder : "ui-state-highlight",
	update  : function(event, ui)
	{
		var post_order_ids = new Array();
		$('#post_list li').each(function(){
			post_order_ids.push($(this).data("post-id"));
		});
    alert(post_order_ids);
		$.ajax({
			url:"ajax_upload.php",
			method:"POST",
			data:{post_order_ids:post_order_ids},
			success:function(data)
			{
			 if(data){
          //$(".alert-danger").hide();
         //$(".alert-success ").show();
         location.reload();
			 }else{
			 	$(".alert-success").hide();
			 	$(".alert-danger").show();
			 }
			}
		});
	}
});
  </script>