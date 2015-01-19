<div class="container-fluid">
		<div class='subnav'>
			<ul class="nav navbar nav-pills">
			  <li role="presentation" class="create"><a href="<?php echo $this->config->item('base_url');?>store/create/">
			  	<?php echo $this->lang->line('create') . $this->lang->line('entity'); ?>
			  </a></li>
			</ul>
		</div>
	    <div class='product-list'>
	    <?php 
	    if(isset($error)){
	    	//var_dump($error);
	    }
	    else if($items){ foreach($items as $item):?>
	       <div class="panel panel-warning">
	            <div class="panel-heading"><?php echo $item['name']?></div>
	       		<div class="panel-body">
				    <div class = 'row'>
				    	<div class=" col-md-4 col-sm-4 col-xs-4">
				    	<img style='max-width:100%' src="<?php echo isset($item['img']) ?
				    	 $this->config->item( 'cdn_url_upload_img') .'entity/' .  $item['img'] 
				    	: '';?>"></div>
				    	<div class=" col-md-8 col-sm-8 col-xs-8 ">

					    	  <div class = 'row desc'>
						    	  	<?php echo isset($item['description']) ? $item['description'] : '';?>
					    	  </div>
				    	</div>
				    </div>
				</div>
 		   		<div class="panel-footer">Panel footer</div>
	       </div>
	       <?php endforeach;}?>
	    </div>
    </div>
