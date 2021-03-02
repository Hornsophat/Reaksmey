<style type="text/css">
    .pointer{
      cursor: pointer;
    }
</style>


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
            echo '<a class="close" data-dismiss="alert">Ã</a>';
            echo '<strong>Well done!</strong> New Checkin Success add to database';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">Ã</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      

        


<fieldset>

<?php
  //form data
  $attributes = array('class' => 'form-horizontal', 'id' => 'additem', 'name', 'additem');

  //form validation
  echo validation_errors();

  echo form_open('', $attributes); 
?>
    <div class="row">


        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Reception</div>
                <div class="panel-body">

                    <div class="row">

                        <div class="col-md-4 hide">
                            <div class="form-group">
                                <label for="inputError" class="control-label">Check In ID</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm checkid" type="text" id="checkid" name="checkid" value="<?php echo $cid; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 hide">
                            <div class="form-group">
                                <label for="inputError" class="control-label">Counter</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm counter" type="text" id="counter" name="counter" value="0">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 hide">
                            <div class="form-group">
                                <label for="inputError" class="control-label">Detail ID</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm detailid" type="text" id="detailid" name="detailid" value="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputError" class="control-label">Item Name Input By Hand</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm handname" type="text" id="handname" name="handname" >
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputError" class="control-label">Item Name</label>
                                <div class="col-sm-12">

                                    <select class="form-control input-sm itemname" id="itemname" name="itemname">
                                      <option value=""> select </option>
                                      <?php 
                                        foreach ($allitem as $item) {
                                          echo "<option value='".$item->p_name."'>".$item->p_name."</option?>";
                                        }
                                      ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputError" class="control-label">Price</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm price" type="text" id="price" name="price" oninput="this.value=this.value.replace(/[^0-9.%]/g,'');" onblur="return total_item(event)" >
                                </div>
                            </div>
                        </div>

                        
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputError" class="control-label">Quantity</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm qty" type="text" id="qty" name="qty" onkeypress="return isNumberKey(event)" onblur="return total_item(event)">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputError" class="control-label">Discount</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm dis" type="text" id="dis" name="dis" onkeypress="return isNumberKey(event)" onblur="return discount(event)" value="0">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputError" class="control-label">Total</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm itotal" type="text" id="itotal" name="itotal" disabled="disabled" value="0">
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>

    </div>
    <!-- End Row two -->
    <?php echo form_close(); ?>

    <div class="form-actions">
        <button class="btn btn-sm btn-primary btn_add_item">Add</button>
        <button class="btn btn-sm btn-primary btn_edit_item hide">Edit</button>
        <button class="btn btn-sm" type="reset">Cancel</button>
    </div>
</fieldset>



<br/>

<table class="table table-striped table-bordered table-condensed">
  <thead>
    <tr>
      <th class="yellow header headerSortDown hide">Item ID</th>
      <th class="yellow header headerSortDown">Item Name</th>
      <th class="yellow header headerSortDown">Quantity</th>
      <th class="yellow header headerSortDown">Price</th>
      <th class="yellow header headerSortDown">Discount</th>
      <th class="yellow header headerSortDown">Total</th>
      <th class="yellow header headerSortDown" colspan="2">Action</th>
    </tr>
  </thead>
  <tbody class="store_item">
      <?php 
          if(isset($list_item))
          {
            $i = 1;
            foreach ($list_item as $val) 
            {
              echo "<tr>";
                      echo "<td class='i-id hide'></td>";
                      echo "<td class='i-did hide'>".$val->detail_id."</td>";
                      echo "<td class='i-checkin hide'>".$val->checkin_id."</td>";
                      echo "<td class='i-name'>".$val->d_name."</td>";
                      echo "<td class='i-qty'>".$val->dqty."</td>";
                      echo "<td class='i-price'>".$val->dprice."</td>";
                      echo "<td class='i-dis'>".$val->discount."</td>";
                      echo "<td class='i-total'>".$val->amount."</td>";
                      echo "<td class='i-upd pointer' id='".$val->detail_id."' onclick='update(event)'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>Edit</td>";
                      echo"<td class='i-del pointer' data='".$val->detail_id."' onclick='deleterow(event)'><i class='fa fa-times-circle' aria-hidden='true'></i>Delete</td>";
              echo  "</tr>";
              $i++;
            }
          }
      ?>
  </tbody>
</table>

<div class="form-actions">
    <button class="btn btn-sm btn-primary btn-save-all"> <i class="fa fa-spinner icon-save hide"></i> Save change</button>
    <button class="btn btn-sm" type="reset">Cancel</button>

    <button class="alert alert-success success-alert hide" role="alert">
      <strong>Well done!</strong> You successfully add item.
    </button>

    <button class="alert alert-danger error-alert hide" role="alert">
      <strong>Warning!</strong> Let try submitting again.
    </button>

    <button class="alert alert-danger stock-alert hide" role="alert">
      <strong>Warning!</strong> The item out of stock Let try submitting again.
    </button>
</div>


    <!-- /.search-dialog -->

    <!-- /.modal-dialog -->

    </div>



<script>
  function isNumberKey(evt){
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
      return true;
  }
  function total_item(evt)
  {
      var qty = $('.qty').val(),
          price = $('.price').val(),
          dis = $('.dis').val(),
          all = "";
      if(dis > 0)
      {
        all = (qty * price);
        dis = all * dis / 100;
        $('.itotal').val(all - dis);
      }else{
        $('.itotal').val(qty * price);
      }
  }
  function discount(evt)
  {
      var qty = $('.qty').val(),
          price = $('.price').val(),
          dis = $('.dis').val(),
          all = "";

          all = (qty * price);
          dis = all * dis / 100;
      $('.itotal').val(all - dis)
  }
</script>


<script type="text/javascript">
  $(document).ready(function(){

    $('#additem').validate({
      rules: {
        qty: {
          required: true
        },
        price: {
          required: true
        }
      }
    });


    $('.btn_add_item').click(function(){
      var counter = $('.counter').val();
          counter++ ;
          $('.counter').val(counter);
      var  checkinid = $('.checkid').val(),
           temname = $('.itemname').val(),
           qty = $('.qty').val(),
           price = $('.price').val(),
           dis  =  $('.dis').val(),
           total = $('.itotal').val(),
           validate = $('#additem').valid(),
           i_id = $('.counter').val(),
           did = $('.detailid').val(),
           handname = $('.handname').val();
      if(temname !=''){
        var itemname = temname;
      }else{
        var itemname = handname;

      }


      // var iname = $('.i-name').text(),
      //     iqty = $('.i-qty').text(),
      //     dis = $('.i-dis').text()
      //     tot = $('.i-total').text();

       
        $('.store_item tr').each(function(){
            var iname = $(this).find('td.i-name').text(),
                iqty = $(this).find('td.i-qty').text(),
                idis = $(this).find('td.i-dis').text(),
                tot = $(this).find('td.i-total').text();
            if(iname == itemname)
            {
                var alldis = Number(dis) + Number(idis);
                var alltot = Number(total) + Number(tot);
                var lastdis= alltot * alldis / 100;
                var last   = alltot - lastdis; 
                $(this).find('td.i-qty').text(Number(qty) + Number(iqty));
                $(this).find('td.i-dis').text(alldis);
                $(this).find('td.i-total').text(last)+(last);

                $('.itemname').val('');
                $('.qty').val('');
                $('.price').val('');
                $('.dis').val(0);
                $('.itotal').val('');

                if($('.store_item').length > 0)
                {
                  $('.btn-save-all').prop('disabled', false);
                }

                exit();
            }
        });

       if(validate)
       {
          
           $('.store_item').append("<tr>"+
                              "<td class='i-id hide'>"+ i_id +"</td>"+
                              "<td class='i-did hide'>"+ did +"</td>"+
                              "<td class='i-checkin hide'>"+ checkinid +"</td>"+
                              "<td class='i-name'>"+ itemname +"</td>"+
                              "<td class='i-qty'>"+ qty +"</td>"+
                              "<td class='i-price'>"+ price +"</td>"+
                              "<td class='i-dis'>"+ dis +"</td>"+
                              "<td class='i-total'>"+ total +"</td>"+
                              "<td class='i-upd pointer' onclick='update(event)'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>Edit</td>"+
                              "<td class='i-del pointer' onclick='deleterow(event)'><i class='fa fa-times-circle' aria-hidden='true'></i>Delete</td>"+
                            "</tr>");
       }
        

       $('.itemname').val('');
       $('.qty').val('');
       $('.price').val('');
       $('.dis').val(0);
       $('.itotal').val('');
       $('.handname').val('');

        if($('.store_item').length > 0)
        {
          $('.btn-save-all').prop('disabled', false);
        }

    });

    if($('.store_item').length > 0)
    {
      $('.btn-save-all').prop('disabled', true);
    }

    $('.btn-save-all').click(function(){
        $('.icon-save').removeClass('hide'); $('.icon-save').addClass('fa-spin');

        $('.store_item tr').each(function(){

            var id = $(this).find('td.i-checkin').text(),
                name = $(this).find('td.i-name').text(),
                qty  = $(this).find('td.i-qty').text(),
                price= $(this).find('td.i-price').text(),
                dis  = $(this).find('td.i-dis').text(),
                total= $(this).find('td.i-total').text(),
                did  = $(this).find('td.i-did').text();

                //alert(name);
                //exit();

            if(id !='')
            {
                $.ajax({
                  url:  "<?php echo site_url('admin_checkin/save_all_item')?>",
                  type: "post",
                  async: false,
                  dataType: "json",
                  data: {
                    id: id,
                    name: name,
                    qty: qty,
                    price: price,
                    dis: dis,
                    total: total,
                    did: did
                  },
                  success: function(data)
                  {
                      $('.icon-save').removeClass('fa-spin'); $('.icon-save').addClass('hide');

                      if(data == "success"){
                        $('.success-alert').removeClass('hide');
                      }else if(data == "false"){
                        $('.error-alert').removeClass('hide');
                      }else if(data == "stock_false")
                      {
                        $('.stock-alert').removeClass('hide');
                      }
                      
                      //$('.store_item').html("");
                  },
                  error: function(data)
                  {
                      $('.error-alert').removeClass('hide');
                  }
                });
            }else{
              alert('please add item before save');
              $('.icon-save').removeClass('fa-spin'); $('.icon-save').addClass('hide');
            }
                
        });
    });

    $('.btn_edit_item').click(function(){
        var  checkinid = $('.checkid').val(),
           temname = $('.itemname').val(),
           qty = $('.qty').val(),
           price = $('.price').val(),
           dis  =  $('.dis').val(),
           total = $('.itotal').val(),
           i_id = $('.counter').val(),
           did = $('.detailid').val(),
           handname = $('.handname').val();

            if(temname == null){
               var itemname = handname;
            }else{
              var itemname = temname;
            }

        $('.store_item tr').each(function(){
            var rowid= $(this).find('td.i-did').text();

            if(rowid  == i_id)
            {
              $(this).remove();

              $('.store_item').append("<tr>"+
                                "<td class='i-id hide'>"+ i_id +"</td>"+
                                "<td class='i-did hide'>"+ did +"</td>"+
                                "<td class='i-checkin hide'>"+ checkinid +"</td>"+
                                "<td class='i-name'>"+ itemname +"</td>"+
                                "<td class='i-qty'>"+ qty +"</td>"+
                                "<td class='i-price'>"+ price +"</td>"+
                                "<td class='i-dis'>"+ dis +"</td>"+
                                "<td class='i-total'>"+ total +"</td>"+
                                "<td class='i-upd pointer' onclick='update(event)'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>Edit</td>"+
                                "<td class='i-del pointer' onclick='deleterow(event)'><i class='fa fa-times-circle' aria-hidden='true'></i>Delete</td>"+
                              "</tr>");
            }
        });

        $('.itemname').val('');
        $('.detailid').val('');
        $('.qty').val('');
        $('.price').val('');
        $('.dis').val(0);
        $('.itotal').val('');
        $('.counter').val('');
        $('.handname').val('');

        $('.btn_add_item').removeClass('hide');
        $('.btn_edit_item').addClass('hide');

    });

    $('.itemname').change(function(){
        var value = $(this).val(),
            price = $('.price').val(),
            qty   = $('.qty').val();
        

        $.ajax({
          url: "<?php echo site_url('admin_checkin/getItemPrice')?>",
          type: "post",
          async: false,
          dataType: "json",
          data:{
            value: value
          },
          success: function(data)
          {
            if(data)
            {
              $('.price').val(data.price);
              $('.itotal').val(data.price * qty);
            }
          },
          error: function(data)
          {

          }
        });
    });

  });

  function update(event)
  {

      var i_name = $(event.target).closest('tr').find('.i-name').text(),
          i_qty = $(event.target).closest('tr').find('.i-qty').text(),
          i_price = $(event.target).closest('tr').find('.i-price').text(),
          i_dis = $(event.target).closest('tr').find('.i-dis').text(),
          i_total = $(event.target).closest('tr').find('.i-total').text(),
          i_counter = $(event.target).closest('tr').find('.i-id').text(),
          i_did = $(event.target).closest('tr').find('.i-did').text();


      $('.itemname').val(i_name);
      $('.qty').val(i_qty);
      $('.price').val(i_price);
      $('.dis').val(i_dis);
      $('.itotal').val(i_total);
      $('.counter').val(i_counter);
      $('.detailid').val(i_did);

      $('.btn_add_item').addClass('hide');
      $('.btn_edit_item').removeClass('hide');


      var r =  $('.itemname').val();
      if(r != i_name)
      {
          $('.handname').val(i_name)
      }

      if($('.store_item').length > 0)
      {
        $('.btn-save-all').prop('disabled', false);
      }
  }
  function deleterow(event)
  {
    var id = $(event.target).closest('tr').find('.i-did').text();
    var name = $(event.target).closest('tr').find('.i-name').text();
    var qty = $(event.target).closest('tr').find('.i-qty').text();
    if(id)
    {
        $.ajax({
          url: "<?php echo site_url('admin_checkin/delectItem')?>",
          type: "post",
          async: false,
          dataType: "json",
          data:{
            id: id,
            name: name,
            qty: qty
          },
          success: function(data)
          {
            
          }
        });
    }
    $(event.target).closest('tr').remove();
  }

</script>