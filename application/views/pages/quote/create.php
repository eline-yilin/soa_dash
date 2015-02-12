<h2><?php echo $title;?></h2>

<?php echo validation_errors(); ?>
<?php if(isset($error)) var_dump($error);?>
<?php //if(isset($upload_data)) var_dump($upload_data);?>
<?php 
$attributes = array('class' => 'product_create', 'id' => 'quote_create');
echo form_open_multipart($this->config->item('base_url') .'quote/create', $attributes);
 ?>

     <input type="hidden" id='_method' name="_method" value="CREATE">
	<input type='hidden' name='postback' value='1' />
	
	<!-- Prod Info-->
    <fieldset>
      <div id="legend" class="">
       
    <div class="control-group">
          <!-- Text input-->
          <label class="control-label" for="agent"><?php echo $this->lang->line("agent"); ?></label>
          <div class="controls">
            <input type="text"  class="input-xlarge required" name='"agent"' id='"agent"'  value=''>
          </div>
          
         
    </div>
        
    </fieldset>

      <!-- inquery-->
	<fieldset>
      <div id="legend" >
        <legend class=""><?php echo $this->lang->line('add'), $this->lang->line('client') ; ?></legend>
    <div class="control-group   {?sizewarning} error {/sizewarning}">
          
          <!-- question-->
			<div class="controls hidden questionRow" id="questionTemplate">
          		<label class="control-label" for="client"><?php echo $this->lang->line('client_name'); ?></label>
		          <div class="controls">
		            <input type="text"  class="input-xlarge required" name='agent' id='agent'  value=''>
		          </div>
          		<label class="control-label" for="client"><?php echo $this->lang->line('client'),$this->lang->line('content') ; ?></label>
		          <div class="controls">
		            <textarea  class="input-xlarge required" name='client_content' id='client_content' >
		            </textarea>
		          </div>
          		 <button type='button' class="btn btn-danger btn-mini"><i class="icon-white icon-remove"></i>
          		 <?php echo $this->lang->line('delete') ; ?> </button>
         	 </div>
          <div class="controls questionRow" id='questionContainer1'>
           <label class="control-label" for="client"><?php echo $this->lang->line('client_name'); ?></label>
		          <div class="controls">
		            <input type="text"  class="input-xlarge required" name='agent1' id='agent1'  value=''>
		          </div>
          		<label class="control-label" for="client"><?php echo $this->lang->line('client'),$this->lang->line('content') ; ?></label>
		          <div class="controls">
		            <textarea  class="input-xlarge required" name='client_content1' id='client_content1' >
		            </textarea>
		          </div>
            <button type='button' class="btn btn-danger btn-mini" onclick='removeQuestion(1);'><i class="icon-white icon-remove"></i>
            <?php echo $this->lang->line('delete')  ; ?> 
            </button>
          </div>
 		  <label class="control-label label-warning hidden" for="thumbnail1" style='margin-top:5px;padding:3px;'><?php echo $this->lang->line('imgsizelimit'); ?></label>
 					<!-- Button -->
          <div class="controls">
            <button type='button' id='addQuest' onclick="javascript:addQuestion();"  class="btn btn-success">
            	<i class="icon-white icon-plus"></i><?php echo $this->lang->line('add') , $this->lang->line('client'); ?>
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
    	   $('#questionContainer' +　index).fadeOut().remove();
    	   avail_question_index.push (index);
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