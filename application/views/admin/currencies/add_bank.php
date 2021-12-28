
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
        <form action="<?php echo base_url();?>admin_currencies/bank_insert" method="post">
     
            <div class="form-group">
              <div class="col-md-3">
                <label>Date</label>
                  <input class="dtpicker form-control input-sm" type="text" id="date_in" name="ex_date" value="" >
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-3">
                <label>Bank Name</label>
                <input type="text" name="bname" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-3">
                <label>Account Name</label>
                <input type="text" name="name" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-3">
                <label>Account Number</label><br>
                <input type="text" name="accnumber" class="form-control">
              </div>
            </div>

    
            <div class="col-md-3">
              <br><br>
              <button class="btn btn-primary" type="submit">Submit</button>&nbsp; 
              <button class="btn btn-warning">Cancel</button>
            </div>
     
      </form>

   </div>

<div class="row">
  <div class="col-md-12">
      <table class="table table-hovered table-border">
        <thead>
          <tr>
            <th>No</th>
            <th>Date</th>
            <th>Bank Name</th>
            <th>Account Name</th>
            <th>Bank Account</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
              $i=0;
              foreach ($list_bank as $row) {
             ?>
                <tr style="text-align: center !important;">
                  <td><?php echo $i;?></td>
                  <td><?php echo $row->date; ?></td>
                  <td><?php echo $row->account_name; ?></td>
                  <td><?php echo $row->name; ?></td>
                  <td><?php echo $row->account_number; ?></td>
                  <td></a>&nbsp;<a  onclick='return confirm("Are you sure you want to delete this bank?")' href="  <?php echo base_url().'admin_currencies/delete_bank/'.$row->id;?>" data-toggle="tooltip" title="Delete" style="color:#ff0000;"><span class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
                
              <?php
              $i++;
              }
           ?>
        </tbody>
      </table>
  </div>
</div>
