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
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Room type updated with success.';
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

      echo form_open('admin/staying/update/'.$this->uri->segment(4).'', $attributes);
      ?>
  <fieldset>        
    <div class="row">
      <div class="col-md-3">
        <div class="control-group">
          <label for="inputError" class="control-label">Roomtype</label>         
          <div class="controls">
            <select name="roomtype" class="form-control">
              <option value="0"></option>
              <?php foreach($roomtype as $item) {
                echo '<option value="'.$item['id'].'" ';
                echo $item['id']==$staytime[0]['roomtype_id'] ? 'selected' : '';
                echo '>'.$item['type'].'</option>';
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
                <option value=""> select </option>
                <option value="Overnight" <?php echo $staytime[0]['time']=='Overnight' ? 'selected' : ''; ?>>Overnight</option>
                <option value="3Hour" <?php echo $staytime[0]['time']=='3Hour' ? 'selected' : ''; ?>>3Hour</option>
                <option value="Month" <?php echo $staytime[0]['time']=='Month' ? 'selected' : ''; ?>>Month</option>
              </select>
          </div>
        </div>
      </div>

      <!-- <div class="col-md-3">
        <div class="control-group">
          <label for="inputError" class="control-label">Price</label>         
          <div class="controls">
            <input type="text" id="" class="form-control" name="price" value="<?php echo $staytime[0]['price']; ?>" >
          </div>
        </div>
      </div>
      <div class="col-md-3">
    <div class="control-group">
            <label for="inputError" class="control-label">Weekend(price)</label>         
            <div class="controls">
              <input type="text" id="" class="form-control" name="price_weekend" value="<?php echo $staytime[0]['price_weekend']; ?>" >
            </div>
          </div>
         </div>
  <div class="col-md-3">
    <div class="control-group">
            <label for="inputError" class="control-label">Cerymony(price)</label>         
            <div class="controls">
              <input type="text" id="" class="form-control" name="price_cereymony" value="<?php echo $staytime[0]['price_cereymony']; ?>" >
            </div>
          </div>
         </div> -->
  <div class="col-md-6">
    <div class="control-group">
            <label for="inputError" class="control-label">Month(price)</label>         
            <div class="controls">
              <input type="text" id="" class="form-control" name="price_month" value="<?php echo $staytime[0]['price_month']; ?>" >
            </div>
          </div>
         </div>  
      <div class="col-md-6">
        <div class="control-group">
          <label for="inputError" class="control-label">Options and note</label>         
          <div class="controls">
            <textarea type="text" id="" class="form-control" name="note"><?php echo $staytime[0]['note']; ?></textarea>
          </div>
        </div>
      </div>
    </div>
       
    </br>
    <div class="form-actions">
      <button class="btn btn-sm btn-primary" type="submit">Save changes</button>
      <button class="btn btn-sm" type="reset">Cancel</button>
    </div>
  </fieldset>

      <?php echo form_close(); ?>

    </div>
     