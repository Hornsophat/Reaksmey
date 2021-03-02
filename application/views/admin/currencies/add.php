
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
        <form method="post" action="<?php echo base_url();?>currencies/get_insert">
     
            <div class="form-group">
              <div class="col-md-3">
                <label>Currencies Code</label>
                  <input type="text" name="cu_code" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-3">
                <label>Currencies Name</label>
                <input type="text" name="cu_name" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-3">
                <label>Exchange Rate</label>
                <input type="text" name="ex_rate" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-3">
                <label>Symbol</label>
                <input type="text" name="cu_symbol" class="form-control">
              </div>
            </div>

    
            <div class="col-md-3">
              <br><br>
              <button class="btn btn-primary" type="submit">Submit</button>&nbsp; 
              <button class="btn btn-warning">Cancel</button>
            </div>
     
      </form>

   </div>
