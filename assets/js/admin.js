var Admin = {

  toggleLoginRecovery: function(){
    var is_login_visible = $('#modal-login').is(':visible');
    (is_login_visible ? $('#modal-login') : $('#modal-recovery')).slideUp(300, function(){
      (is_login_visible ? $('#modal-recovery') : $('#modal-login')).slideDown(300, function(){
        $(this).find('input:text:first').focus();
      });
    });
  }
   
};


function PrintElem(elem)
    {
        Popup($(elem).html());
    }

function Popup(data) 
{
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

  return true;
}







$(function(){

  $('.toggle-login-recovery').click(function(e){
    Admin.toggleLoginRecovery();
    e.preventDefault();
  });

});

function  set_customer(id,family,gender,passport)
{
 
  $("#customer_id").val(id);
  $("#Family").val(family);
  $("#Passport").val(passport);
  $("#Gender").val(gender);
  $('#search').modal('hide')
  
}


function calc(){ 
  var total;
	if($('#Price').val() != 0 )
	{  
	  $('#per_day').val((parseInt($('#Price').val()) + parseInt($('#extra_charge').val())));

    if($("#chtype").find("option:selected").text() == "Overnight") {
      total = parseInt($("#per_day").val()) * parseInt($("#staying").val());
    } else {
      total = parseInt($("#per_day").val());
    }
	  
	  if($('#discount').val() != 0 )
	  {
	   var fl = total *  parseInt($('#discount').val()) / 100 ;
	   $('#total').val( (total - parseInt(fl) ) );
	  }
	  else
	  {
	    $('#total').val(total);
	  }
	  
	}
	else
	{
	  // alert ('Please Choose the room type !');
	 return false ;
	}
}


//Customer Search function 
  $(document).ready(function(){ 
    
      $('#staying').focusout(function() { 
      
      // var checkin = new Date($('#date_in').val());
      
      // var dd = checkin.getDate() + parseInt($('#staying').val());
      // var mm = checkin.getMonth() + 1 ;
      // var y = checkin.getFullYear();

      // var someFormattedDate = mm + '/'+ dd + '/'+ y;
      
      // $('#date_out').val(someFormattedDate);
      
      calc();
      
      });

      $("#chtype").on('blur', function() {
        calc();
      });
          
      $('#extra_charge').focusout(function() { 
	
      	if($('#extra_charge').val() == "" )
      	{
      	  $('#extra_charge').val('0');
      	}
            
      	calc();
	
      });
      
      $('#discount').focusout(function() { 
	
      	if($('#discount').val() == "" )
      	{
      	  $('#discount').val('0');
      	}
      
        calc();
      
      });
  
  });

  
  calc();
