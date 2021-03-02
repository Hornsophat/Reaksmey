
    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("currencies"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
        </li>
        <li>
          <a href="<?php echo site_url("currencies").'/'.$this->uri->segment(2); ?>">
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
      ?>

   <div class="col-md-12">
        <form action="<?php echo base_url();?>currencies/exspanse_update" method="post">
             <input type="text" name="c_id" value="<?php echo $ex_up->tdid;?>" hidden>
            <div class="form-group">
              <div class="col-md-4">
                <label>Date</label>
                  <input class="dtpicker form-control input-sm" type="text" id="date_in" name="ex_date" value="<?php echo $ex_up->date;?>" >
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-4">
                <label>ex_type</label>
                <select class="form-control" name="ex_type">
                  <?php
                    foreach ($ex_t as $type_ex) {
                  ?>
                    <option value="<?php echo $type_ex->id;?>" <?php echo ($type_ex->id == $ex_up->tdid)?'selected="selected"':''?>  ><?php echo $type_ex->ex_type;?></option>
                  <?php
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-4">
                <label>amount</label>
                <input type="text" name="ex_amount" class="form-control" value="<?php echo $ex_up->amount;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <label>Note</label><br>
                <textarea rows="5" class="form-control" name="ex_note" ><?php echo $ex_up->note;?></textarea>
              </div>
            </div>

    
            <div class="col-md-3">
              <br><br>
              <button class="btn btn-primary" type="submit">Submit</button>&nbsp; 
              <button class="btn btn-warning">Cancel</button>
            </div>
     
      </form>

   </div>
