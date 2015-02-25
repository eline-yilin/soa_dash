<?php if(isset($resp) && is_numeric($resp) &&  $resp >= 0):?>
<script>
alert('sucessfully created');
setTimeout(function(){window.location.href = "<?php echo $this->config->item( 'base_url'), $router;?>";}, 1000);
</script>
<?php endif;?>
<h2><?php echo $title;?></h2>

<?php echo validation_errors(); ?>
<?php if(isset($error)) var_dump($error);?>
<?php //if(isset($upload_data)) var_dump($upload_data);?>
<?php 
$attributes = array('class' => $router. '_' . $action, 'id' => $router. '_' . $action);
echo form_open_multipart($this->config->item('base_url') . $router . '/' . $action, $attributes);
 ?>

     <input type="hidden" id='_method' name="_method" value="CREATE">
	<input type='hidden' name='postback' value='1' />
	
	<!-- Prod Info-->
    <fieldset>
      <div id="legend" class="">
    <div class="control-group">
          <!-- Text input-->
          <label class="control-label" for="product_type_name"><?php echo $this->lang->line('airfreight_name')   ; ?></label>
          <div class="controls">
            <input type="text"  class="input-xlarge required" name='product_type_name' id='product_type_name'  value=''>
          </div> 
    </div>
        
    </fieldset>

    
    
     <!-- location-->
	<fieldset>
      <div id="legend" >
        <legend class=""><?php echo $this->lang->line('add'),$this->lang->line('site'); ?></legend>
    <div class="control-group   {?sizewarning} error {/sizewarning}">
          
          <!-- greeting-->
			<div class="controls hidden locationRow" id="locationTemplate">
          		 <input type="text"  class="input-xlarge"  id='location'>
          		  <button type='button' class="btn btn-danger btn-mini"><i class="icon-white icon-remove"></i>
		            <?php echo $this->lang->line('delete') . $this->lang->line('site') ; ?> 
		           </button>
         	 </div>
         	 <div class="controls hidden imgRow" id="imgTemplate">
          		 <input type="file",  class="input-xlarge"  id='thumbnail'>
          		 <button type='button' class="btn btn-danger btn-mini"><i class="icon-white icon-remove"></i>
          		 <?php echo $this->lang->line('delete') . $this->lang->line('file')  ; ?> </button>
         	 </div>
          <div class="controls locationRow" id='locationContainer1'>
            <input type="text" name="location1"  class="input-xlarge"  id='location1'>
            <button type='button' class="btn btn-danger btn-mini" onclick='removeLocation(1);'><i class="icon-white icon-remove"></i>
            <?php echo $this->lang->line('delete') . $this->lang->line('site') ; ?> 
            </button>
            <fieldset>
      <div id="legend" class="">
        <legend class=""><?php echo $this->lang->line('upload'),$this->lang->line('file'); ?></legend>
    <div class="control-group   ">     
          <!-- img-->		
          <div class="controls imgRow" id='thumbnailContainer1'>
            <input type="file", name="thumbnail1"  class="input-xlarge"  id='thumbnail1'>
            <button type='button' class="btn btn-danger btn-mini" onclick='removeImage(1);'><i class="icon-white icon-remove"></i>
            <?php echo $this->lang->line('delete') . $this->lang->line('product') ; ?> 
            </button>
          </div>
 		  <label class="control-label label-warning" for="thumbnail1" style='margin-top:5px;padding:3px;'><?php echo $this->lang->line('imgsizelimit'); ?></label>
 					<!-- Button -->
          <div class="controls">
            <button type='button' id='addImg' onclick="javascript:addImage();"  class="btn btn-success">
            	<i class="icon-white icon-plus"></i><?php echo $this->lang->line('add'),$this->lang->line('file'); ?>
            </button>
          </div>
          
    </div>
 
	</div>
    </fieldset>
           
          </div>
 		 <!-- Button -->
          <div class="controls">
            <button type='button' id='addlocation' onclick="javascript:addLocation();"  class="btn btn-success">
            	<i class="icon-white icon-plus"></i><?php echo $this->lang->line('add'), $this->lang->line('site'); ?>
            </button>
          </div>
          
    </div>
 
	</div>
    </fieldset>
  
   
    <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <button id='submit' class="btn btn-success"><i class="icon-white icon-hand-right"></i> <?php echo $this->lang->line('submit'); ?></button>
          </div>
        </div>
	</div>

</form>
<script>  
       var avail_question_index = [];
       var avail_location_index = [];
       var avail_ending_index = [];
       function addAEnding()
       {
         var index  = $('div.endingRow').length;
        
             if(avail_ending_index.length)
             {
           	  index = avail_ending_index[0];
           	  avail_ending_index.splice(0, 1);
             }
         if(index < 10)
         { 
	          $("#endingTemplate").clone().removeClass('hidden').attr('id','endingContainer' +　index ).insertAfter("div.endingRow:last");
	          $("div.endingRow:last").find('input').attr('name','ending' +　index).attr('id','ending' +　index );
	          $('#endingContainer' +　index  + ' .btn-danger').click(function(){
					var id = $(this).parents('.endingRow').attr('id');
					var index = id.substring(15);
					removeEnding(index);
	             });
         }
       }
      function removeEnding(index){
    	  var conf = confirm("<?php echo  $this->lang->line('confirm_delete');?>");
          if(!conf)
              return false;
   	   $('#endingContainer' +　index).fadeOut().remove();
   	   avail_ending_index.push (index);
      }
       function addQuestion()
        {
          var index  = $('div.questionRow').length;
         
              if(avail_question_index.length)
              {
            	  index = avail_question_index[0];
            	  avail_question_index.splice(0, 1);
              }
          if(index < 10)
          { 
	          $("#questionTemplate").clone().removeClass('hidden').attr('id','questionContainer' +　index ).insertAfter("div.questionRow:last");
	          $("div.questionRow:last").find('input').attr('name','question' +　index).attr('id','question' +　index );
	          $('#questionContainer' +　index  + ' .btn-danger').click(function(){
					var id = $(this).parents('.questionRow').attr('id');
					var index = id.substring(17);
					removeQuestion(index);
	             });
          }
        }
       function removeQuestion(index){
    	   var conf = confirm("<?php echo  $this->lang->line('confirm_delete');?>");
           if(!conf)
               return false;
    	   $('#questionContainer' +　index).fadeOut().remove();
    	   avail_question_index.push (index);
       }

       function addLocation()
       {
         var index  = $('div.locationRow').length;
        
             if(avail_location_index.length)
             {
           	  	index = avail_location_index[0];
           		avail_location_index.splice(0, 1);
             }
         if(index < 10)
         { 
	          $("#locationTemplate").clone().removeClass('hidden').attr('id','locationContainer' +　index ).insertAfter("div.locationRow:last");
	          $("div.locationRow:last").find('input').attr('name','location' +　index).attr('id','location' +　index );
	          $('#locationContainer' +　index  + ' .btn-danger').click(function(){
					var id = $(this).parents('.locationRow').attr('id');
					var index = id.substring(17);
					removeLocation(index);
	             });
         }
       }
      function removeLocation(index){
    	  var conf = confirm("<?php echo  $this->lang->line('confirm_delete');?>");
          if(!conf)
              return false;
   	   $('#locationContainer' +　index).fadeOut().remove();
   		avail_location_index.push (index);
      }
      
       var validator_messages = {

    	         'price': {

    	             required: "<?php echo $this->lang->line('required_error') . $this->lang->line('price');?>"
    	         },
    	         'productname': {

    	             required: "<?php echo $this->lang->line('required_error') . $this->lang->line('productname');?>"
    	         }
       };
       function validator_show_errors(errorMap,errorList, form){

    	   jQuery('label.my-error').remove();
    	  
    	   for (var i in errorMap) {

    	       var rst = errorMap[i];

    	         console.log(i, ":", rst);

    	         var selector = i.replace(/\[/ig, '');

    	         selector = selector.replace(/\]/ig, '');

    	       

    	         switch (i)

    	         {    
    	               default:             
    	               $('#' + i).after('<label class="error my-error for_' + selector +  '">' + rst + '</label>');

    	                   break;

    	              }

    	   }

    	  }
       $(document).ready(function(){ 
    	   var add_validator = jQuery('#<?php echo $router . "_" . $action;?>').validate({

    	         ignore: "",

    	         onkeyup: false,//function(element) {},

    	         onfocusout: false,

    	         messages : validator_messages ,

    	         showErrors: function(errorMap, errorList)

    	         {           

    	          validator_show_errors(errorMap, errorList,'#<?php echo $router . "_" . $action;?>');            

    	         },

    	         submitHandler: function(form) {

    	             form.submit();

    	         },           

    	     });

       
           });
        </script>