$.fn.datepicker.defaults.format = "dd-mm-yyyy";



function gPrint(selector){
	
	$("#"+selector).printArea({
		mode:"popup",  //printable window is either iframe or browser popup           			
		popHt: 600 ,  // popup window height
		popWd: 500,  // popup window width
		popX: 0 ,  // popup window screen X position
		popY: 0 , //popup window screen Y position
		popTitle:"test", // popup window title element
		popClose: false,  // popup window close after printing
		strict: false 
		});
}

function gsPrint(emp_title,data,hide_print){

	var export_data = $("<center>"+data+"</center>").clone().find("."+hide_print).remove().end().html();
	var element = "<div>"+export_data+"</div>";
	
	$("<center><p style='padding-top:15px;text-align:center;'><b>"+emp_title+"</b></p><hr>"+element+"</center>").printArea({
		mode:"popup",  //printable window is either iframe or browser popup           			
		popHt: 600 ,  // popup window height
		popWd: 500,  // popup window width
		popX: 0 ,  // popup window screen X position
		popY: 0 , //popup window screen Y position
		popTitle:"test", // popup window title element
		popClose: false,  // popup window close after printing
		strict: false 
		});
}

//============= check duplicate reference =============

function isDupRef(ele,val,field,table,url){
	
	if(val!="" && field!="" && table!=""){
		$.ajax({
			url:url,
			type:"POST",
			dataType:"json",
			async:false,
			data:{				
				ref_val:val,
				ref_field:field,
				ref_table:table
			},
			success:function(data){				
				if(data.isDup>0){
					//$("#"+ele).focus();	
					$("#"+ele).val("");					
					alert("Value you entered is already exists.Please try again.");
				}					
			}

		});	
	}	
}  
//=============== format decimal place ================	
function number_format(val,decimal){	
	if(decimal==""){
		decimal=4;
	}	
	return parseFloat(val).toFixed(decimal);			
}
function convertSQLDate(date){
	var datepart=date.split("-");
	return datepart[2]+"-"+datepart[1]+"-"+datepart[0];
}



