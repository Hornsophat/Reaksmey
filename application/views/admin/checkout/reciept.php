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
                <div class="text-center" style="text-align: center; clear: both; padding-bottom:0px;margin-top:22px">
                   <div style="margin-left:78px"> <img class="" src="<?php echo site_url('assets/images/photo_2021-02-01_07-59-25.jpg'); ?>" alt="Palm River Hotel" style=' float: left; clear: both;margin-top:-20px;border-radius: 10px;'></div>
                   <br><br><br><br><br>
                    <b><h3 style="text-transform:uppercase; font-family:'Khmer OS Muol Light'; color: #674343; font-size: 20px; padding-top:20px;">សណ្ឋាគារ រស្មីមនោរម្យ</h3><b>
                    <h3 style="text-transform:uppercase; font-family:'Elephant'; color: #674343; font-size: 12px; padding-top:5px;">RAKSMEY MONOROM HOTEL</h3>
                    
                    <p class="adr" style="text-align:center; font-family:'Khmer OS'; font-size:10px;margin-top:12px; "><b>អាស័យដ្ឋាន៖​</b> (ទល់មុខស្រះទឹកដើមស្រល់​​ កាស៊ីណូ​ ផ្លូវដីស) ស្ថិតនៅភូមិសាមគ្គីមានជ័យ សង្កាត់ប៉ោយប៉ែត ក្រុងប៉ោយប៉ែត ខេត្តបន្ទាយមានជ័យ</p>
                    <p class="pho" style="padding-left: 0px !important;margin-right:35px;">Tel: 015 77 83 83 (Smart)</p>
                    <p class="pho" style="padding-left: 0px !important;"> 017 77 83 83 (Cellcard)</p>
                    <p class="pho" style="padding-left: 0px !important;"> 067 77 83 83 (Metfone)</p>
                    <b><p class="pho" style="padding-left: 0px !important;font-family:Khmer OS;">Facebook Page:សណ្ឋាគារ រស្មីមនោរម្យ-Raksmey Monorom Hotel </p></b>
                    </p>
                </div>
                <div style='float: left; font-size:11px'>Invoice Number
                    <br>Date
                    <br>Cashier Name
                </div>
                <div style='float: left; margin-left:20px; font-size:11px;'>:
                    <?php echo date('Ym-',strtotime($row_checkin->date_in)).str_pad($row_checkin->id, 6, "0", STR_PAD_LEFT);  ?>
                    <br>:
                    <?php echo date('Y-m-d H:s:i')?>
                    <br>:
                    <?php echo $this->session->userdata('user_name'); ?>
                </div>
                <div style='float: right; margin-left:20px; font-size:11px;'>:
                    <?php echo $customer->Family?>
                    <br>:
                    <?php echo date('Y-m-d',strtotime($row_checkin->date_in))?>
                    <br>:
                    <?php echo date('Y-m-d',strtotime($row_checkin->date_out))?>
                </div>
                 <div style='float: right; font-size:11px'>
                    Customer Name :
                    <br>Checkin Date :
                    <br>Checkout Date :
                </div>
                <div style="clear:both;"></div>
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <td class="center">No</td>
                            <td colspan="2">Room</td>
                            <td class="center">Unit Price</td>
                            <td class="center">Quantity</td>
                            <td class="center">Total</td>
                        </tr>
                    </thead>
                    <?php 
                        echo $data_table;
                    ?>
                </table>
                <p style="text-align: center;border-bottom:1px solid black; font-weight: 500;padding:0px !important;margin:0px !important;"></p>
                <div class="well well-sm" style="text-align:center; border:none; background:none; font-size:8px;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 pull-left">
                                <p style="font-size:15px;">Cashier's Sign</p>
                            </div>
                            <div class="col-md-6 pull-right">
                                <p style="font-size:15px;">Customer's Sign</p>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 35px; text-align: center;">
                                <p style="font-size:8px;font-family:'Khmer OS'; ">អរគុណសម្រាប់ការស្នាក់នៅក្នុងសណ្ឋាគារ រស្មីមនោរម្យ <br> Thank you for staying at RAKSMEY MONOROM HOTEL</p>
                                
                               
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
    // $(document).ready(function() {
    //     $("btnPrev").click(function() {
    //         window.history.back();
    //     });

    //     $('#email').click(function() {
    //         var email = prompt("Email Address", "customer@tecdiary.com");
    //         if (email != null) {
    //             $.ajax({
    //                 type: "post",
    //                 url: "http://localhost/pos_restaurent/pos/email_receipt",
    //                 data: {
    //                     token: "5a4633941748bf3e3d529950924479f7",
    //                     email: email,
    //                     id: 12
    //                 },
    //                 dataType: "json",
    //                 success: function(data) {
    //                     alert(data.msg);
    //                 },
    //                 error: function() {
    //                     alert('Ajax request failed, pleas try again');
    //                     return false;
    //                 }
    //             });
    //         }
    //         return false;
    //     });
    // });
    $(window).load(function() {
        window.print();
    });
    </script>
</body>

</html>