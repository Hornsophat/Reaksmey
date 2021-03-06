    <?php
    
    $option_room_type = array('' => "");
foreach ($room_type as $row) {
    $option_room_type[$row['id']] = $row['type'];
    
    
    $option_floor = array (
    'Ground Floor' => "Ground Floor" , 
    'First Floor' => "First Floor",
    'Second Floor' => "Second Floor",
    'Third Floor' => "Third Floor",
    'Four Floor' => "Four Floor",
    'Five Floor' => "Five Floor",
    'Six Floor' => "Six Floor",
    'Seven Floor' => "Seven Floor",
    'Eight Floor'=> "Eight Floor",
    ) ;
}

    
    ?>
    
    
    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
        </li>
        <li class="active">
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> New Room Success add to database';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');

      //form validation
      echo validation_errors();
      
      echo form_open('admin/room/add', $attributes);
      ?>
        <fieldset>
        
        <div class="row">
        
	 <div class="col-md-3">
	  <div class="control-group">
            <label for="inputError" class="control-label">Room Number</label>         
            <div class="controls">
              <input type="text" id="" class="form-control" name="room_no" value="<?php echo set_value('room_no'); ?>" >
            </div>
          </div>
         </div>

	 <div class="col-md-3">
	  <div class="form-group">
            <label for="inputError" class="control-label">Room Type</label>         
            <div class="col-sm-10">
	      	      <?php
		echo form_dropdown('type_id', $option_room_type, set_value('type_id'), 'class="form-control" id="type_id"');
		?>
            </div>
          </div>
         </div>
         
	 <div class="col-md-3">
	  <div class="control-group">
            <label for="inputError" class="control-label">Floor</label>         
            <div class="controls">
              	<?php
		echo form_dropdown('floor', $option_floor, set_value('floor'), 'class="form-control"');
		?>
            </div>
          </div>
         </div>          
                    
         
       </div>
       </br>
      <div>
             
        
          
          <div class="form-actions">
            <button class="btn btn-sm btn-primary" type="submit">Save changes</button>
            <button class="btn btn-sm" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     