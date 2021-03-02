<?php 
	$roleid=$this->session->userdata('roleid');    
	$modules=$this->session->userdata('ModuleInfors');		
	$pages=$this->session->userdata('PageInfors');
	$year=$this->session->userdata('year');
    $schoolid=$this->session->userdata('schoolid');

    if(isset($_REQUEST['yearid']) && $_REQUEST['yearid']!=""){
        $year=$_REQUEST['yearid'];
    }elseif(isset($_REQUEST['y']) && $_REQUEST['y']!=""){
        $year=$_REQUEST['y'];
    }elseif(isset($_REQUEST['year']) && $_REQUEST['year']!=""){
        $year=$_REQUEST['year'];
    }
	if(count($modules)>0){
		$menu='';
		foreach ($modules as $row) {
            if($row['mod_position']=='1'){                      
    								
				if(count($pages)>0){

					if(isset($pages[$row['moduleid']])){
						$page_mod=$pages[$row['moduleid']];

						if(count($page_mod)>0 && isset($pages[$row['moduleid']])){
							
							foreach($page_mod as $page){
								$page_link=$page['link'];
								 $menu.='<a href="'.site_url($page_link).'?&y='.$year.'&m='.
								 			urlencode($row['moduleid']).'&p='.urlencode($page['pageid']).'" 
								 			class="list-group-item"><i class="fa '.$page['icon'].' fa-fw"></i> '.$page['page_name'].'</a>';
							}
												
						}
                    }   
					
				}
    			
			}		
		}
	}
?>
<div class="wrapper">
	<div class="clearfix" id="main_content_outer">
	    <div id="main_content">
	      <div class="row result_info">
		      	<div class="col-xs-6">
		      		<strong id='title'>System Setting</strong>
		      	</div>
		      	<div class="col-xs-6" style="text-align: right">
		      			
		      	</div> 			      
		  </div>
		  <div class="row">
	      	<div class="col-sm-12">
	      		<div class="panel panel-default">
	      			<div class="panel-body">
	      				
						<div class="list-group">						  
						  <?php echo $menu?>
						</div>

	      			</div>
	      		</div>
	      	</div>
		</div>
	</div>
</div>