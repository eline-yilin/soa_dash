<style>
.questionRow{padding:10px;border:1px solid #e5e5e5; margin:5px 0px;}
</style>

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
            <input type="text"  class="input-xlarge required" name='agent' id='agent'  value=''>
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
		            <input type="text"  class="input-xlarge required" name='client' id='client'  value=''>
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
		            <input type="text"  class="input-xlarge required" name='client1' id='client1'  value=''>
		          </div>
          		<label class="control-label" for="client"><?php echo $this->lang->line('client'),$this->lang->line('content') ; ?></label>
		          <div class="controls">
		           <input type="text"  class="hand input-xlarge required" name='client_content1' id='client_content1'  value='' readonly placeholder="click to edit" onclick="javascript: editContent(this)">
		         
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

       function editContent(ele){
    	   var id = $(ele).parents('.questionRow').attr('id');
			var index = id.substring(17);
			$("#template_content").modal('show');
			function returnID(){return index;}
			$('#ok-content').unbind('click').click(function(){
				var id = returnID();
				 putContent(id);
				});
       }
       function putContent(id){
alert(id);
var content = $('#template-content').val();
$('#client_content' + id).val(content);
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
	          $("div.questionRow:last").find('input').attr('name','client' +　index).attr('id','client' +　index );
	          $("div.questionRow:last").find('textarea').attr('name','client_content' +　index).attr('id','client_content' +　index );
	          
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

    		   	ignore:":not(:visible)",

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

    	   $('#template_content').on('show.bs.modal', function () {
    	   
       	    $('.modal .modal-body').css('overflow-y', 'auto'); 
       	    $('.modal .modal-body').css('max-height', $(window).height() *0.7);
       	 	$('.modal .modal-body').css('height', $(window).height() *0.7);
       	 	
       	});
       
           });
     
        </script>
        
        <div id="template_content" class="autoModal modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Content</h4>
            </div>
            <div class="modal-body">
              
               <textarea id='template-content' style='height:90%;width:100%;max-width:100%;'></textarea>
              
            </div>
            <div class="modal-footer">
            
            	<button type="button" id='ok-content' class="btn btn-default" data-dismiss="modal">Ok</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
        