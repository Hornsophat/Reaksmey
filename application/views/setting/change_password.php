<?php
  $m='';
  $p='';
  
  if(isset($_GET['m'])){
      $m=$_GET['m'];
    }
    if(isset($_GET['p'])){
        $p=$_GET['p'];
    }
    //echo FCPATH;
    $adsid='';
    $arr=array();
    if(isset($data->adsid)){
        $adsid=$data->adsid;
        $arrblog=$this->ads->getblogname($adsid,1);
    }

    $pict_path=base_url('assets/upload/no_image.jpg');
    if(file_exists(FCPATH."/assets/upload/adminuser/".$userrow->userid.".png")){       
        $pict_path=base_url("assets/upload/adminuser/".$userrow->userid.".png");
    }
?>

<style type="text/css">
    table tbody tr td img{width: 20px; margin-right: 10px}
    ul,ol{
        margin-bottom: 0px !important;
    }
    a{
        cursor: pointer;
    }
    .datepicker {z-index: 9999;}
</style>

    <div id="content-header" class="mini">
        <h1>Change Password</h1>
        <ul class="mini-stats box-3">
            
        </ul>
    </div>  
    <div id="breadcrumb">
      <a href="<?php echo base_url('index.php/system/dashboard')?>" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i>Home</a>
      <a href="<?php echo base_url("index.php/Setup/setupads/index?m=$m&p=$p")?>" title="Go to Store List" class="tip-bottom">User</a>
      <a href='#' class="current">Password</a>
    </div>
    <div class="col-sm-6" style="text-align: center">
        <strong>
            <center class='error' style='color:red;'><?php if(isset($error)) echo "$error"; ?></center>
        </strong>   
    </div>
   <!-- main content -->
  <div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                      <i class="fa fa-align-justify"></i>                 
                    </span>
                    <h5>Change Password.</h5>
                    <h5 class="result_text" style='color:red;'></h5>
                </div>

                <div class="widget-content nopadding">
                    <form enctype="multipart/form-data" name="basic_validate" id="basic_validate" method="POST" action="" class="form-horizontal basic_validate">
                        
                          
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class='col-lg-2 control-label'>Old-Password</label>
                                    <div class=" col-lg-3"> 
                                        <div class="col-md-12">
                                            <input type="password"  class="form-control input-sm required" name="old_password" id="old_password">
                                        </div>                   
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class='col-lg-2 control-label'>New-Password</label>
                                    <div class=" col-lg-3"> 
                                        <div class="col-md-12">
                                            <input type="password"  class="form-control input-sm required" name="password" id="password">
                                        </div>                   
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class='col-lg-2 control-label'>Confirm-Password</label>
                                    <div class=" col-lg-3"> 
                                        <div class="col-md-12">
                                            <input type="password"  class="form-control input-sm required" name="password_again" id="password_again">
                                        </div>                   
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <!-- <label class="col-lg-4 control-label"></label>                       -->
                                    <div class="col-md-10">
                                        <div class="col-lg-3">
                                            <button id="save" name="save" type="submit" class="btn btn-primary">Save</button>
                                            <a href="<?php echo site_url('sys/dashboard') ?>" id="cancel" name="cancel" type="button" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                    </form> 
                    <div style="clear:both"></div>               
                </div>
            </div>
          </div>
    </div>
 </div>
 
<script type="text/javascript">
    function PreviewImage(event) {
                var uppreview=$(event.target).attr('rel');
                //alert(uppreview);
                var upimage=$(event.target).attr('id');
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById(upimage).files[0]);

                oFReader.onload = function (oFREvent) {
                    document.getElementById(uppreview).src = oFREvent.target.result;
                     document.getElementById(uppreview).style.backgroundImage = "none";
                };
            };
    function isNumberKey(evt){
        var e = window.event || evt; // for trans-browser compatibility 
        var charCode = e.which || e.keyCode; 
        if ((charCode > 45 && charCode < 58) || charCode == 8){ 
            return true; 
        } 
        return false;  
    }  
    $('#cancel').click(function(){
        location.href="<?PHP echo site_url('store/store/index');?>?<?php echo 'm=$m&p=$p' ?>";
    }) 
   
    function uploads(adsid,formdata){
        //alert(visitid+'/'+familyid);
        $.ajax({
            type:'POST',
            url:"<?PHP echo site_url('setting/setting/do_upload');?>/"+adsid,
            data:formdata,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                // location.reload();
                console.log("success");
                console.log(data);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
       
    }
    $(function(){       
     
    // Form Validation
    $("#basic_validate").submit(function(e){
      e.preventDefault();
    })
    .validate({
        rules:{
          required:{
            required:true
          },
          password_again: {
              equalTo: "#password"
            },
          email:{
            required:true,
            email: true
          },
          date:{
            required:true,
            date: true
          },
          url:{
            required:true,
            url: true
          }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
          $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
        },        
        submitHandler: function(form) {
          var url="<?php echo site_url('setting/setting/savechagepwd')?>";
         
          $.ajax({
            url:url,
            type:"POST",
            datatype:"Json",
            async:false,
            data:{          
                password:$("#password").val(),
                old_password:$("#old_password").val()
            },
            success:function(data) {
                // $(".result_text").html(data.msg);
                var formdata = new FormData(form);
                if(data.userid!='' && data.userid!=null){
                    // uploads(data.userid,formdata,data.msg);
                    // toasmsg('success',data.msg);
                    alert(data.msg);
                    location.href="<?php echo site_url('login/logout') ?>";
                }else{
                   alert(data.msg);
                }
            }
          })
        }
      });


    $("#is_active").on("click",function(){      
      if($(this).prop("checked")==true){
        $(this).val(1);
      }else{
        if(window.confirm("Are you sure ! Do you want to set Inactive for this Ads.")){
          $(this).val(0);
        }else{
          return false;
        }        
      }      
    });
    /*
    $('input').on('ifChecked', function(event){      
        $(this).val(1);          
    });
   $('input').on('ifUnchecked', function(event){
      if(window.confirm("Are you sure ! Do you want to set Inactive for this stock.")){
        $(this).val(0);
      }else{
        return false;
      } 
    });
    */
    });
</script>
    
        
    
