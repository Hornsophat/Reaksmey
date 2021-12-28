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
            echo '<strong>Well done!</strong> New Customer Success add to database';
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
      
      echo form_open('admin/staying/add', $attributes);
      ?>
        <fieldset>
        
        <div class="row">
        <div class="col-md-3">
    <div class="control-group">
            <label for="inputError" class="control-label">Roomtype</label>         
            <div class="controls">
              <select name="roomtype" class="form-control">
                <option value="0"selected disabled hidden> Select Roomtype </option>
                <?php foreach($roomtype as $item) {
                  echo '<option value="'.$item['id'].'">'.$item['type'].'</option>';
                  } ?>
              </select>
            </div>
          </div>
         </div>
	 <div class="col-md-3">
	  <div class="control-group">
            <label for="inputError" class="control-label">Time</label>         
            <div class="controls">
              <select name="time" id="time" class="form-control">
                <option value=""selected disabled hidden> Select Time </option>
                <option value="Overnight">Overnight</option>
                <option value="Time">Time</option>
                <option value="Month">Month</option>
               
              </select>
            </div>
          </div>
         </div>

	   <div class="col-md-3">
    <!-- <div class="control-group">
            <label for="inputError" class="control-label">Price</label>         
            <div class="controls">
              <input type="text" id="" class="form-control" name="price" value="<?php echo set_value('price'); ?>" >
            </div>
          </div>
         </div>     
  <div class="col-md-3">
    <div class="control-group">
            <label for="inputError" class="control-label">Weekend(Price)</label>         
            <div class="controls">
              <input type="text" id="" class="form-control" name="price_weekend" value="<?php echo set_value('price_weekend'); ?>" >
            </div>
          </div>
         </div>
  <div class="col-md-3">
    <div class="control-group">
            <label for="inputError" class="control-label">Cerymony(Price)</label>         
            <div class="controls">
              <input type="text" id="" class="form-control" name="price_cereymony" value="<?php echo set_value('price_cereymony'); ?>" >
            </div>
          </div>
         </div> -->
  <div class="col-md-12">
    <div class="control-group">
            <label for="inputError" class="control-label">Month(Price)</label>         
            <div class="controls">
              <input type="text" id="" class="form-control" name="price_month" value="<?php echo set_value('price_month'); ?>" >
            </div>
          </div>
         </div>      
  <div class="col-md-12">
    <div class="control-group">
            <label for="inputError" class="control-label">Options and note</label>         
            <div class="controls">
              <textarea type="text" id="" class="form-control" name="note" value="<?php echo set_value('note'); ?>" ></textarea>
            </div>
          </div>
         </div>    
         
       </div>
       
    
        
          </br></br></br></br></br></br></br></br>
          <div class="form-actions">
            <button class="btn btn-sm btn-primary" type="submit">Save changes</button>
            <button class="btn btn-sm" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     