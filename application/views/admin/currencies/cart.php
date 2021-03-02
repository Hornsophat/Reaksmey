
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
      		$con=odbc_connect("lock","", "lockdbpass");
      		if ($con) {
      			echo "Success connect";
      		}else{
      			echo "false";
      		}
       ?>

      <?php
      //flash messages
  //     $mdbFilename="C:\Program Files (x86)\Xeeder hotel lock interface V1.723\Db\lock.mdb";
  //     $user='';
  //     $password='';
  //     $db_conn = new COM("ADODB.Connection");
		// $connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".$mdbFilename.";";
		// $db_conn->open($connstr);

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
        <form method="post" action=""><!-- <?php echo base_url();?>currencies/get_send -->
     		<div class="row">
            <div class="form-group">
              <div class="col-md-3">
                <label>ip Address</label>
                  <input type="text" name="cu_code" class="form-control">
              </div>

              <div class="col`-md-8">
              	<a href="#" class="btn btn-default">Connect</a>
              	<a href="#" class="btn btn-default">DisConnect</a>
              </div>
              <div class="col-md-3">
    			<label>Port</label>
    				<input type="text" name="i_port" class="form-control">
    			</div>
            </div>
            </div>
            <div class="row">
            	<div class="form-group">
            		<div class="col-md-3">
            			<button class="btn btn-default" id="btn_send">Send</button>
            		</div>
            		<div class="col-md-8">
            			<input type="text" name="stx_url" class="form-control" id="stx_url">
            		</div>
            		<div class="col-md-3">
            			<label>STX</label>
            		</div>
            		<div class="col-md-8">
            			<input type="text" id="card_en" name="stx_url" class="form-control">
            		</div>
            		<div class="col-md-3">
            			<label>Result Data</label>
            		</div>
            		<div class="col-md-8">
            			<input type="text" name="stx_url" class="form-control">
            		</div>
            	</div>
            </div>

    
         <!--    <div class="col-md-3">
              <br><br>
              <button class="btn btn-primary" type="submit">Submit</button>&nbsp; 
              <button class="btn btn-warning">Cancel</button>
            </div> -->
     
      </form>

   </div>
<script type="text/javascript">
  $('#card_en').bind('keypress', function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });
</script>

<script type="text/javascript">
  $(function(){

      $('#btn_send').on('click',function(){
        var stx_url=$('#stx_url').val();
        // alert(stx_url);
         
          /**
 * Read application data as indicated in the Application File Locator
 * Collect input to data authentication
 *
 */
        EMV.prototype.readApplData = function() {
            // Application File Locator must exist
            assert(typeof(this.cardDE[EMV.AFL]) != "undefined");
            var afl = this.cardDE[EMV.AFL];
            // var afl=$('#stx_url').val();

            // Must be a multiple of 4
            assert((afl.length & 0x03) == 0);

            // Collect input to data authentication 
            var da = new ByteBuffer();

            while(afl.length > 0) {
                var sfi = afl.byteAt(0) >> 3;   // Short file identifier
                var srec = afl.byteAt(1);        // Start record
                var erec = afl.byteAt(2);        // End record
                var dar = afl.byteAt(3);         // Number of records included in
                                                 // data authentication

                for (; srec <= erec; srec++) {
                    // Read all indicated records
                    var data = this.readRecord(sfi, srec);
                    print(data);

                    // Decode template
                    var tl = new TLVList(data, TLV.EMV);
                    assert(tl.length == 1);
                    var t = tl.index(0);
                    assert(t.getTag() == EMV.TEMPLATE);

                    // Add data authentication input      
                    if (dar > 0) {
                        if (sfi <= 10) {  // Only value
                            da.append(t.getValue());
                        } else {    // Full template
                            da.append(data);
                        }
                        dar--;
                    }

                    // Add card based data elements to internal list
                    var tl = new TLVList(t.getValue(), TLV.EMV);
                    this.addCardDEFromList(tl);
                }

                // Continue with next entry in AFL
                afl = afl.bytes(4);
            }
            this.daInput = da.toByteString();
            print(this.daInput);
        }
                        
      });
  });
</script>