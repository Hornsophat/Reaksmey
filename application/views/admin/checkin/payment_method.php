
<style>
  .alert { padding: 5px; margin-bottom: 10px; }
  .panel-body {
      padding: 5px 10px;
  }
  .form-group {
      margin-bottom: 5px;
  }
</style>
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
  <?php
  //flash messages
  if(isset($flash_message)){
    if($flash_message == TRUE)
    {
      echo '<div class="alert alert-success">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo '<strong>Well done!</strong> New Checkin Success add to database';
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
  $attributes = array('class' => 'form-horizontal', 'id' => '');
  echo validation_errors();

  echo form_open('admin/payment_befor_checkout'); 
  ?>
  <div class="panel panel-default">
    <div class="panel-header">
        <div class="col-sm-12">
            <h3>Adding
                <?php echo ucfirst($this->uri->segment(2));?>
            </h3>
        </div>
    </div>
    <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-info">
          <div class="panel-heading"><?php echo lang('Room Information');?></div>
          <div class="panel-body">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="hidden" name="cid" value="<?=$customer_id?>">
            <!-- /row -->
            <div class="row">
              <div class="col-md-12">

                  <div class="row">
                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputError" class="control-label">Banks</label>
                        <div class="col-sm-12">
                         <select class="form-control" name="bank" id="bank">
                           <?php foreach ($banks as $bank) { ?>
                            <option value="<?=$bank->id?>"><?=$bank->account_name?></option>
                           <?php } ?>
                         </select>  
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputError" class="control-label">Account number</label>
                        <div class="col-sm-12">
                          <input class="form-control" type="text" id="account_number" name="account_number" value="" placeholder="Account Number">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputError" class="control-label">Account name</label>
                        <div class="col-sm-12">
                          <input class="form-control" type="text" id="account_name" name="account_name" placeholder="Account Name">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputError" class="control-label">Note</label>
                        <div class="col-sm-12">
                          <input class="form-control" type="text" id="note" name="note" placeholder="Note">
                        </div>
                      </div>
                    </div>
                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputError" class="control-label">Bank Amount</label>
                        <div class="col-sm-12">
                          <input class="form-control" type="text" id="bank_amount" name="bank_amount" placeholder="Bank Amount">
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>

  </div>
  <!-- End Row One -->
    <div class="form-actions">
      <button class="btn btn-sm btn-primary" type="submit" id="write_card"><?php echo lang('Save changes');?></button>
    </div>
  </div>
</div>

<?php echo form_close(); ?>
<!-- =====================================add modal======================================= -->
    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
<!-- =========================================end add  modal============================= -->

<div class="modal fade" id="add-customer" tabindex="-1" role="dialog" aria-labelledby="infoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="infoLabel">add</h4>
      </div>
      <div class="modal-body">
        <p>Add Customer</p>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- /.search-dialog -->

<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="infoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="infoLabel">Search</h4>
      </div>
      <div class="modal-body">
        <form class="form-inline" id="frm-Customer-search" role="form" method="post">
          <div class="form-group">
            <label class="sr-only" for="Family">Customer Name</label>
            <input type="text" class="form-control  Family" id="Family" Name="LastName" placeholder="Enter CustomerName">
          </div>
          <div class="form-group">
            <div class="input-group">
              <label class="sr-only" for="Passport">Passport</label>
              <input type="text" class="form-control  Passport" id="Passport" Name="Passport" placeholder="Passport">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <button class="btn btn-primary btn-sm" id="btn-Customer-search">Search</button>
            </div>
          </div>

        </form>

      </br>

      <table id="tblresult" class="table table-bordered">
        <tbody>
          <tr class="active">
            <th style="text-align:center;">#</th>
            <th style="text-align:center;">Family</th>
            <th style="text-align:center;">Passport</th>
            <th style="text-align:center;">ID</th>
            <th style="text-align:center;"></th>
          </tr>

        </tbody>
      </table>

    </div>
  </div>
</div>
</div>

<!-- /.modal-dialog -->

</div>
