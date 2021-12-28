<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reciept</title>
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="pragma" content="no-cache" />
    <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin/bootstrap-datepicker.min.css">
    <style type="text/css" media="all">
    body {
        color: #000;
    }

    #wrapper {
        max-width: 480px;
        margin: 0 auto;
        padding-top: 20px;
    }

    .btn {
        border-radius: 0;
        margin-bottom: 5px;
    }

    h3 {
        margin: 5px 0;
        font-size: 14px;
    }

    p.adr,
    p.pho {
        font-size: 11px;
    }

    p.pho {
        margin-top: -9px;
    }

    .nopadding {
        padding: 0px !important;
        font-size: 12px;
    }

    table tr td,
    th {
        font-size: 12px;
    }

    @media print {
        .no-print {
            display: none;
        }

        #wrapper {
            max-width: 480px;
            width: 100%;
            min-width: 250px;
            margin: 0 auto;
        }

        body {
            background-color: #fff;
            color: #000;
            background-image: none;
        }

        #ad {
            display: none;
        }

        #leftbar {
            display: none;
        }

        #contentarea {
            width: 100%;
        }
    }

    img {
        width: 99px;
        height: auto;

    }

    .table td {
        border: 1px solid #674343;


    }

    .table thead tr td {
        border-top: 1px solid #674343 !important;
        background-color: #674343;
        color: #fff;
    }
    </style>
</head>
<?php 
    date_default_timezone_set("Asia/Phnom_penh");
    //var_dump($customer);
?>

<body>
    <div id="wrapper" style="margin-top: -20px;">
        <div id="receiptData">
            <div class="no-print"></div>
            <div id="receipt-data">
                <div class="" style="text-align: center; clear: both; padding-bottom:0px;margin-top:22px">
                   <div style="margin-right:70px;margin-top:50px"> <img class="" src="<?php echo site_url('assets/login/images/chhanra.JPG'); ?>" alt="Palm River Hotel" style=' float: left; clear: both;margin-top:-50px;border-radius: 10px;width:130px;'></div>
                 
                    <b><h3 style="margin-right:70px;text-transform:uppercase; font-family:'Khmer OS Muol Light'; color: #674343; font-size: 20px; padding-top:-50px;">ទិត្យ​ ធារ៉ា អាផាតមែន</h3><b>
                    <h3 style="margin-right:70px;text-transform:uppercase; font-family:'Elephant'; color: #674343; font-size: 14px; padding-top:5px;">Tith Chhara Apartment</h3>
                    <!--<b><p class="pho" style="padding-left: 0px !important;">Website: https://rothsingvilla.com  </p></b>-->
                    </p>
                </div>
                <br>
                <div style="text-align:center">
                      <p class="adr" style=" font-size:14px;margin-top:16px;font-family:Khmer OS "> <b style="color:black;font-size:14px">ផ្ទះលេខ ២០​ ផ្លូវលេខ ២៨៩ សង្កាត់បឹងកក់ ខណ្ឌទួលគោក រាជធានីភ្នំពេញ</p>
                     <p class="adr" style="font-size:10px;margin-top:-14px; "> <b style="color:black;font-size:14px">#20 Street 289 Sangkat Beoungkak 1 Khan Toul Kork</p>
                    <p class="pho" style="font-size:14px">+85512841342/ +85517917979</p>
                    <p class="pho" style="font-size:14px;">Email: tith.chhara@hotmail.com</p>
                </div>
                <p style="text-align: center;border-bottom:1px solid black; font-weight: 500;padding:0px !important;margin:0px !important;"></p>
                <div style='float: left; font-size:14px'>Invoice Number
                    <br>Date
                    <br>Cashier Name
                </div>
                <div style='float: left; margin-left:2px; font-size:14px;'>:
                    <?php echo date('Ym-',strtotime($row_checkin->date_in)).str_pad($row_checkin->id, 6, "0", STR_PAD_LEFT);  ?>
                    <br>:
                    <?php echo date('Y-m-d H:s:i')?>
                    <br>:
                    <?php echo $this->session->userdata('user_name'); ?>
                </div>
                <div style='float: right; margin-left:20px; font-size:14px;'>:
                  <?php echo $customer->Family?>
                    <br>:
                    <?php echo date('Y-m-d',strtotime($row_checkin->date_in))?>
                    <br>:
                    <?php echo date('Y-m-d',strtotime($row_checkin->date_out))?>
                </div>
                 <div style='float: right; font-size:14px;'>
                    Customer  
                    <br>Checkin 
                    <br>Checkout 
                </div>
                <div style="clear:both;"></div>
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <td class="center">No</td>
                            <td colspan="2">Room</td>
                            <td class="center">Price</td>
                            <td class="center">Quantity</td>
                            <td class="center">Total</td>
                        </tr>
                    </thead>
                    <?php 
                        echo $data_table;
                    ?>
                </table>
                <p style="text-align: center;border-bottom:1px solid black; font-weight: 500;padding:0px !important;margin:0px !important;"></p>
                <div class="well well-sm" style="text-align:center; border:none; background:none; font-size:14px;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 pull-left">
                                <p style="font-size:12px;">Cashier's Sign</p>
                            </div>
                            <!-- <div class="col-md-6 pull-right">
                                <p style="font-size:12px;">Customer's Sign</p>
                            </div> -->
                        </div>
                           <br>
                                
                        <div class="row" style="margin-top: 35px; text-align: center;">
                                <p style="font-size:14px;font-family:'Khmer OS'; ">អរគុណសម្រាប់ការស្នាក់នៅក្នុងទិត្យ​ ធារ៉ា អាផាតមែន <br> Thank you for staying at Tith Chhara Apartment</p>
                                
                               
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
            <hr>
            <span class="pull-right col-xs-12">
                <a href="javascript:window.print()" id="web_print" class="btn btn-block btn-primary" onClick="window.print();return false;">Web Print</a>
            </span>
            <span class="col-xs-12">
                <a href="javascript:window.location=document.referrer;" class="btn btn-block btn-warning">Back</a>
                <!-- <button type="button" class="btn btn-block btn-warning" id="btnPrev"><span class="glyphicon glyphicon-chevron-left"></span> Back</button> -->
            </span>
            <div style="clear:both;"></div>
        </div>
    </div>
    <canvas id="hidden_screenshot" style="display:none;">
    </canvas>
    <div class="canvas_con" style="display:none;"></div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("btnPrev").click(function() {
            window.history.back();
        });

        $('#email').click(function() {
            var email = prompt("Email Address", "customer@tecdiary.com");
            if (email != null) {
                $.ajax({
                    type: "post",
                    url: "http://localhost/pos_restaurent/pos/email_receipt",
                    data: {
                        token: "5a4633941748bf3e3d529950924479f7",
                        email: email,
                        id: 12
                    },
                    dataType: "json",
                    success: function(data) {
                        alert(data.msg);
                    },
                    error: function() {
                        alert('Ajax request failed, pleas try again');
                        return false;
                    }
                });
            }
            return false;
        });
    });
    $(window).load(function() {
        window.print();
    });
    </script>
</body>

</html>