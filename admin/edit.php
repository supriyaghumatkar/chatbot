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
        Blank page
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

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>

          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button> -->
            <a href="master.php" class="btn btn-success">
             Back</a>
          </div>
        </div>
        <div class="box-body">
            <div class="col-md-6" id="myscripttext">
            <?php 
                    $id=$_GET['id'];
                    $query=mysqli_query($con,"select * from scriptdata where script_id=$id");
                    $row=mysqli_fetch_assoc($query);
                    $typedata=$row['ques_type_id'];
                    echo "<input type='hidden' name='script_id' class='form-control' id='script_id' value='".$id."' placeholder='Enter Your Text'/>";
                    if($typedata=='1')
                    {
                        echo '<textarea class="textarea"  name="textques"  id="textques" placeholder="Place some text here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">'.$row['question_text'].'</textarea><br/><br/>';
                       // echo "<input type='text' name='textques' class='form-control' id='textques' value='".$row['question_text']."' placeholder='Enter Your Text'/><br/><br/>";
                        echo "<button type='button' value='texttype' class='btn btn-success editval' id='textdata'>SAVE</button>";
                    }
                    
                    if($typedata=='5')
                    {
                            echo '<textarea class="textarea"   name="textstate"  id="textstate"  placeholder="Place some text here" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">'.$row['question_text'].'</textarea><br/><br/>';
                            //echo "<input type='text' name='textstate' class='form-control' value='".$row['question_text']."'  id='textstate' placeholder='Enter Your Statement'/><br/><br/>";
                            echo "<button type='button' value='statementtype' class='btn btn-success editval' id='statementQ'>SAVE</button>";
                    }
                    
                    if($typedata=='3')
                    {
                            $i=1;
                            echo '<textarea class="textarea"   name="dropdowntext" id="dropdowntext"  placeholder="Place some text here" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">'.$row['question_text'].'</textarea><br/><br/>';
                            //echo "<input type='text' class='form-control' name='dropdowntext' value='".$row['question_text']."' id='dropdowntext' placeholder='Enter Your Text'/><br/><br/>";
                            $select_option=mysqli_query($con,"select * from select_option where script_id='".$row['script_id']."'");
                                $numrow=mysqli_num_rows($select_option);
                                //echo $numrow;
                               if($numrow!=0 ) {
                                while($options=mysqli_fetch_array($select_option))
                                {
                                echo '<div id="inc"><input type="text" class="form-control" name="options[]" id="options" value="'.$options['option_text'].'"  placeholder="Enter Your Option"/>';
                               if($i==$numrow) {
                                    echo '<button style="margin-left: 50px" class="btn btn-info" type="submit" id="append" name="append">Add Option</button></div><br/><br/>';
                                }
                                else {
                                    echo '<a href="#" class="remove_this_multi btn btn-danger">remove</a></div><br/><br/>';
                                }
                                $i++;
                                }
                              }
                          
                            else{
                              echo '<div id="inc"><input type="text" class="form-control" name="options[]" id="options"   placeholder="Enter Your Option"/>';
                             
                              echo '<button style="margin-left: 50px" class="btn btn-info" type="submit" id="append" name="append">Add Option</button></div><br/><br/>';
                            }
                            
                            echo "<button type='button' value='dropdowntype' class='btn btn-success editval' id='Dropdowndata'>SAVE</button>";
                              
                           
                    }
                    
                    if($typedata=='4')
                    {
                        $i=1;
                            //echo "<input type='text' class='form-control' name='multiselecttext' value='".$row['question_text']."' id='multiselecttext' placeholder='Enter Your Text'/><br/><br/>";
                            echo '<textarea class="textarea"   name="multiselecttext" id="multiselecttext"  placeholder="Place some text here" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">'.$row['question_text'].'</textarea><br/><br/>';
                            $select_option=mysqli_query($con,"select * from select_option where script_id='".$row['script_id']."' order by select_id asc");
                            $numrow=mysqli_num_rows($select_option);
                            if($numrow!=0) {
                            while($options=mysqli_fetch_array($select_option))
                            {                      
                             
                            echo '<div id="multi"> <input type="text" class="form-control" name="muloptions[]" value="'.$options['option_text'].'" id="muloptions" placeholder="Enter Your Option"/>';
                            if($i==$numrow) {
                            echo '<button style="margin-left: 50px" class="btn btn-info" type="submit" id="appendmulti" name="appendmulti">Add Option</button></div><br/><br/>';
                            }
                            else {
                                echo '<a href="#" class="remove_this_multi btn btn-danger">remove</a></div><br/><br/>';
                            }
                            $i++;
                               }
                              }
                          
                              else{
                                echo '<div id="multi"> <input type="text" class="form-control" name="muloptions[]"  id="muloptions" placeholder="Enter Your Option"/>';
                               
                                echo '<button style="margin-left: 50px" class="btn btn-info" type="submit" id="appendmulti" name="appendmulti">Add Option</button></div><br/><br/>';
                              }
                            echo "<button type='button' value='multiselecttype' class='btn btn-success editval' id='multiselectdata'>SAVE</button>";
                          
                    }
                    
                    if($typedata=='2')
                    {
                            echo '<textarea class="textarea"   name="emailtext" id="emailtext"  placeholder="Place some text here" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">'.$row['question_text'].'</textarea><br/><br/>';
                            //echo "<input type='text' name='emailtext' class='form-control' value='".$row['question_text']."'  id='emailtext' placeholder='Enter Your Text'/><br/><br/>";
                            echo "<button type='button' value='emailtype' class='btn btn-success editval' id='emailtextdata'>SAVE</button>";
                    }
                    if($typedata=='6')
                    {
                      echo '<textarea class="textarea"   name="rangetext" id="rangetext"  placeholder="Place some text here" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">'.$row['question_text'].'</textarea><br/><br/>';
                      $select_option=mysqli_query($con,"select * from  range_option where script_id='".$row['script_id']."'");
                      $rangeop=mysqli_fetch_assoc($select_option);
                      echo "<input type='number' name='minrange' class='form-control' value='".$rangeop['minimum']."'  id='minrange' placeholder='Minmum Rage'/><br/><br/>";
                      echo "<input type='number' value='".$rangeop['maximum']."' name='maxrange' class='form-control'  id='maxrange' placeholder='Maximum Rage'/><br/><br/>";
                      echo "<input type='text' value='".$rangeop['prifix']."'  name='prifix' class='form-control'  id='prifix' placeholder='prifix'/><br/><br/>";
                      echo "<button type='button' value='rangetype' class='btn btn-success editval' id='rangetextdata'>Save</button>";
                    }
                    ?>
                    </div>
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
jQuery(document).ready( function () {
  var count = 0;
  
        $("#append").click( function(e) {
          e.preventDefault();
        $("#inc").append('<div class="controls">\
                <input class="form-control" type="text" name="options[]" id="options" placeholder="Enter Your Option">\
                <a href="#" class="remove_this btn btn-danger">remove</a>\
            </div>');
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
        jQuery(this).parent().remove();
        return false;
        });
        
    //For Multiselect option
    
     $("#appendmulti").click( function(e) {
          e.preventDefault();
        $("#multi").append('<div class="controls">\
                <input class="form-control" type="text" name="muloptions[]" id="muloptions" placeholder="Enter Your Option">\
                <a href="#" class="remove_this_multi btn btn-danger">remove</a>\
            </div>');
        return false;
        });

    jQuery(document).on('click', '.remove_this_multi', function() {
        jQuery(this).parent().remove();
        return false;
        });

        $(".editval").click(function() {
            alert("dsasd");
       var typeinsert=$(this).val();
       var script_id=$('#script_id').val();
       if(typeinsert=='texttype')
       {
           var dataval=$("#textques").val();
       }
       else if(typeinsert=='statementtype')
       {
          var dataval=$("#textstate").val(); 
       }
       else if(typeinsert=='dropdowntype')  
       {
         var dataval=$("#dropdowntext").val(); 
         var dropdownoption=$('input#options').serialize();
          alert(dropdownoption);
       }
       else if(typeinsert=='multiselecttype')  
       {
         var dataval=$("#multiselecttext").val();     
         var multidropwnoption= $("input#muloptions").serialize();  
        
       }
       else if(typeinsert=='emailtype')  
       {
         var dataval=$("#emailtext").val();       
         
       }
       else if(typeinsert=='rangetype')  
       {
         var dataval=$("#rangetext").val();
         var minimum=$("#minrange").val();  
         var maximum=$("#maxrange").val();  
         var prifix=$("#prifix").val();    

         
       }
$.ajax({				
					url:"editdata.php",
					type: "POST",
					data: {'typeinsert':typeinsert,'dataval':dataval,'dropdownoption':dropdownoption,'multidropwnoption':multidropwnoption,'script_id':script_id,'minimum':minimum,'maximum':maximum,'prifix':prifix,'Action':'CheckTypeInsert'},
					datatype: "html",
					async: true,
					cache: false,
					success: function(data) 
					{
//$("#myscripttext").html(data);	
            location.reload();				
         }
				        
     });
});


        
});
 </script>
 <!-- <script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    //CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script> -->