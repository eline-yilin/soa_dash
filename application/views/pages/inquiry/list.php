
<div class="container-fluid ">
		<div class='subnav'>
			<ul class="nav navbar nav-pills">
			  <li role="presentation" class="create"><a href="<?php echo $this->config->item('base_url');?>inquiry/create/"><?php echo $this->lang->line('createinquiry'); ?></a></li>
			</ul>
		</div>
	    <div class='product-list'>
	    <?php 
	    if(isset($error)){
	    	//var_dump($error);
	    }
	    else{ foreach($items as $item):?>
	       <div class="panel panel-warning">
	       		<div class="panel-body">
				    <div class = 'row'>
				    	<div class=" col-md-10 col-sm-10 col-xs-10">
				    		<p><?php echo $item['name']?></p>
				    	</div>
				    	<div class=" col-md-2 col-sm-2 col-xs-2 ">
						    		<a href = 'inquiry/update/id/<?php echo $item['id'] ;?>'  class="btn btn-success btn-mini"><i class="icon-white icon-pencil"></i> <?php echo $this->lang->line('edit') ; ?> </a>  	
				    	</div>
				    </div>
				</div>

	       </div>
	       <?php endforeach;}?>
	    </div>
    </div>
