<?php
 include('include.php');
 
if(isset($_POST['Action']) && $_POST['Action']=='CheckType' && !empty($_POST['typedata']))
{
   $typedata=$_POST['typedata'];
   
   if($typedata=='text_question')
   {  
       echo '<textarea class="textarea"  name="textques"  id="textques" placeholder="Place some text here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea><br/><br/>';          
      // echo "<input type='text' name='textques' class='form-control' id='textques' placeholder='Enter Your Text'/><br/><br/>";
      echo "<button type='button' value='texttype' class='btn btn-success insertval' id='textdata'>DONE</button>";
   }
   
   if($typedata=='statement')
   {
        echo '<textarea class="textarea"   name="textstate"  id="textstate"  placeholder="Place some text here" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea><br/><br/>';
        // echo "<input type='text' name='textstate' class='form-control'  id='textstate' placeholder='Enter Your Question'/><br/><br/>";
        echo "<button type='button' value='statementtype' class='btn btn-success insertval' id='statementQ'>DONE</button>";
   }
   
   if($typedata=='dropdown')
   {
         echo '<textarea class="textarea"   name="dropdowntext" id="dropdowntext"  placeholder="Place some text here" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea><br/><br/>';
        //  echo "<input type='text' class='form-control' name='dropdowntext' id='dropdowntext' placeholder='Enter Your Text'/><br/><br/>";

         echo '<div class="inc"> <input type="text" class="form-control" name="options[]" id="options" placeholder="Enter Your Option"/> 
                <button style="margin-left: 50px" class="btn btn-info" type="submit" id="append" name="append">
                Add Option</button></div><br/><br/>';
         echo "<button type='button' value='dropdowntype' class='btn btn-success insertval' id='Dropdowndata'>DONE</button>";
   }
   
   if($typedata=='multiselect')
   {
    echo '<textarea class="textarea"   name="multiselecttext" id="multiselecttext"  placeholder="Place some text here" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea><br/><br/>';
        // echo "<input type='text' class='form-control' name='multiselecttext' id='multiselecttext' placeholder='Enter Your Text'/><br/><br/>";

         echo '<div class="multi"> <input type="text" class="form-control" name="muloptions[]" id="muloptions" placeholder="Enter Your Option"/> 
                <button style="margin-left: 50px" class="btn btn-info" type="submit" id="appendmulti" name="appendmulti">
                Add Option</button></div><br/><br/>';
         echo "<button type='button' value='multiselecttype' class='btn btn-success insertval' id='multiselectdata'>DONE</button>";
   }
   
   if($typedata=='email_type')
   {
         
        echo '<textarea class="textarea"   name="emailtext" id="emailtext"  placeholder="Place some text here" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea><br/><br/>';
         //echo "<input type='text' name='emailtext' class='form-control'  id='emailtext' placeholder='Enter Your Text'/><br/><br/>";
         echo "<button type='button' value='emailtype' class='btn btn-success insertval' id='emailtextdata'>DONE</button>";
   }

   if($typedata=='range_type')
   {
         echo '<textarea class="textarea"   name="rangetext" id="rangetext"  placeholder="Place some text here" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea><br/><br/>';
         echo "<input type='number' name='minrange' class='form-control'  id='minrange' placeholder='Minmum Rage'/><br/><br/>";
         echo "<input type='number' name='maxrange' class='form-control'  id='maxrange' placeholder='Maximum Rage'/><br/><br/>";
         echo "<input type='text' name='prifix' class='form-control'  id='prifix' placeholder='prifix'/><br/><br/>";
         echo "<button type='button' value='rangetype' class='btn btn-success insertval' id='rangetextdata'>DONE</button>";
   }

    
}
?>
<script>
jQuery(document).ready( function () {
        $("#append").click( function(e) {
            //alert("jkjn");
          e.preventDefault();
        $(".inc").append('<div class="controls">\
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
           // alert("gfhgfhfg");
          e.preventDefault();
        $(".multi").append('<div class="controls">\
                <input class="form-control" type="text" name="muloptions[]" id="muloptions" placeholder="Enter Your Option">\
                <a href="#" class="remove_this_multi btn btn-danger">remove</a>\
            </div>');
        return false;
        });

    jQuery(document).on('click', '.remove_this_multi', function() {
        jQuery(this).parent().remove();
        return false;
        });
        
  $(".insertval").click(function() {
       var typeinsert=$(this).val();
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
					url:"insertedit.php",
					type: "POST",
					data: {'typeinsert':typeinsert,'dataval':dataval,'dropdownoption':dropdownoption,'multidropwnoption':multidropwnoption,'minimum':minimum,'maximum':maximum,'prifix':prifix,'Action':'CheckTypeInsert'},
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
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    //CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>