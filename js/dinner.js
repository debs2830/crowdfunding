$ = jQuery;
function validateForm() {
	var e1 = document.getElementById("payment");
	var paymeth = e1.options[e1.selectedIndex].value;
	if (paymeth = "") {
		alert("Please select a payment method");
		return false;
	}
	var e1 = document.getElementById("noadults");
	var adults = parseInt(e1.options[e1.selectedIndex].value);
	if (adults == 0) {
		alert("Please select at least one adult who will attend");
		return false;
	}
	return true;
}

$('#btnsubmit').click(function(e) { 


	if ($('#payment').val() == "" && $('#pagename').val() != "edit") {
		alert("Please select a payment method");
		return false;
	}
	if ($('#totaldue').val() == "" || $('#totaldue').val() == "0") {
		alert("Please select a donation amount");
		return false;
	}
	
	if ($('#level').val()=="" && $('#pagename').val() != "edit") {
		
		alert("Please select a event level");
		return false;
	}
	var firstname = document.getElementById("firstname").value;
	var lastname = document.getElementById("lastname").value;
	var email = document.getElementById("email").value;
	if(!firstname)
	{
		alert('Please enter a first name');
		return false;
	}
	if(firstname == "")
	{
		alert('Please enter a first name');
		return false;
	}
	if(!email && $('#formmode').val() !="adminxx" )
	{
		alert('Please enter a email');
		return false;
	}
	if(email == "" && $('#formmode').val() !="adminxx")
	{
		alert('Please enter a email address');
		return false;
	}
	
	if(lastname == "")
	{
		alert('Please enter a last name');
		return false;
	}
	if(!lastname)
	{
		alert('Please enter a last name');
		return false;
	}
    level =$('[name="sublevel"]:checked').val();
    
   if (level =='DinnerOnlyUnder40' || level =='preevent' || level =='DinnerOnly' )
	    {
			if ($('#firstname1').val() == "" )  {
				alert("Please enter the first name for at least one individual");
				return false;
			}
		}
	if ( level =='DinnerOnlyUnder40' || level =='preevent' || level =='DinnerOnly'  )
	    {
			if ($('#firstname2').val() == "" )  {
				alert("Please enter the second name ");
				return false;
			}
		}
    sublevel = $('[name="sublevel"]:checked').val(); 
	if ($('#adtext1').is(':visible') && $('#adtext1').val() == '' && $('#askad').val() == 0  ) {
		$('#askad').val('1') ;
		 var r =  confirm("Are you sure you want to submit your donation without an ad?");
		if (r == false) { //OK
		   return false;
		}
		 
			}
	
	if ( $('#payment').val() == "Credit" ) {
	if (	$('#address').val() == "" || $('#zip').val() == "" ) {
            alert("Please enter address and zip code");
            return false;
	}
	if (	$('#email').val() == ""  ) {
            alert("Please enter email address");
            return false;
	}
	if (	$('#ccnum').val() == "" || $('#ccmonth').val() == "" || $('#ccyear').val() == "" || $('#cvv').val() == "" ) {
            alert("Please enter all credit card information");
            return false;
	}
		  var $this = $(this);
$(this).attr('disabled', 'disabled');
			$('#errmsg').hide();
		  $.ajax({method: "POST",
				  url: "/events/chargecard.php",
				  data:$('#form1').serialize() 
		
				 })
		  .done(function( result ) {
 	  
			if (result != 'Error') { 
				$('#authcode').val(result);
				$('#form1').submit();
				  
			} else {
						$('#btnsubmit').removeAttr('disabled');
				$('#errmsg').show();
				return false
			}
		
  });
		
		;
		} //end credit card 
	else {
			$('#form1').submit();
	}
})
Number.prototype.formatMoney = function(c, d, t) {
	var n = this, c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "."
			: d, t = t == undefined ? "," : t, s = n < 0 ? "-" : "", i = parseInt(n = Math
			.abs(+n || 0).toFixed(c))
			+ "", j = (j = i.length) > 3 ? j % 3 : 0;
	return s + (j ? i.substr(0, j) + t : "")
			+ i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t)
			+ (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

function calc() {

	var total = 0;
	var freepeople = 0;
	var peopleForPreEvent= 0;
	
	
	level = $('[name="eventlevel"]:checked').val();
	sublevel = $('[name="sublevel"]:checked').val();
	dinneronly = 0;
switch (sublevel) { 
	case 'Diamond Scholarship': 
		total = 36000;
		freepeople= 2;
		peopleForPreEvent=2;
		break;
	case 'Full Scholarship': 
		total = 25000;
		freepeople= 2;
		peopleForPreEvent=2;
		break;
	case 'Major Scholarship': 
		total = 20000;
		freepeople= 2;
		peopleForPreEvent=2;
		break;
	case 'Chai Scholarship': 
		total = 18000;
		freepeople= 2;
		peopleForPreEvent=2;
		break;
	case 'Partial Scholarship': 
		total = 15000;
		freepeople= 2;
		peopleForPreEvent=2;
		break;
	case 'Gold Scholarship': 
		total = 10000;
		peopleForPreEvent=2;
		freepeople= 2;
		break;
	case 'Silver Scholarship': 
		total = 7500;
		peopleForPreEvent=2;
		freepeople= 2;
		break;
	case 'Bronze Scholarship': 
		total = 5000;
		peopleForPreEvent=2;
		freepeople= 2;
		break;
	case 'Diamond': 
		total = 3600;
		peopleForPreEvent=2;
		freepeople= 2;
		break;
	case 'Platinum': 
		total = 2500;
		peopleForPreEvent=2;
		freepeople= 2;
		break;
	case 'Chai': 
		total = 1800;
		peopleForPreEvent=2;
		freepeople= 2;
		break;
	case 'Gold': 
		total = 1500;
		peopleForPreEvent=2;
		freepeople= 2;
		break;
	case 'Silver': 
		total = 1100;
		peopleForPreEvent=2;
		freepeople= 2;
		break;
		
	case 'Bronze': 
		total = 750;
		freepeople= 2;
		break;	
	case 'Full': 
		total = 500;
		freepeople= 2;
		break;
	case 'Half': 
		total = 360;
		freepeople= 0;
		break;
	case 'Quarter': 
		total = 250;
		freepeople= 0;
		break;
	case 'Eighth': 
		total = 180;
		freepeople= 0;
		break;
	case 'Greeting': 
		total = 100;
		freepeople= 0;
		break;
	case 'other': 
		total = 0;
		freepeople= 0;
		break;
case 'DinnerOnly': 
		total = 1100;
		freepeople= 2;
dinneronly = 1;
		break;
case 'DinnerOnlyUnder40': 
		total = 500;
		freepeople= 2;
dinneronly = 1;
		break;
	//yearbook
	case 'Full Page': 
		total = 125;
		freepeople= 0;
dinneronly = 0;
		break;
	case 'Half Page': 
		total = 90;
		freepeople= 0;
dinneronly = 0;
		break;
	case 'Quarter page': 
		total = 65;
		freepeople= 0;
dinneronly = 0;
		break;
	case 'Eighth Page': 
		total = 50;
		freepeople= 0;
dinneronly = 0;
		break;
	case 'Sixteenth Page': 
		total = 36;
		freepeople= 0;
dinneronly = 0;
		break;
		
}
	extraforreservation= 0;
		dinnerreserve = 0;
//	if (level=== 'preevent') {
//		preeventreserve = 2;
//		if (preeventreserve - peopleForPreEvent > 0 ) {
//			extraforreservation = 1100;
//		}
//		
//	}
	if (level=== 'dinnercouple40') {
		dinnerreserve = 2;
		if (dinnerreserve - freepeople > 0 ) {
			extraforreservation = 500;
		}
	}
	if (level=== 'dinnercouple') {
		dinnerreserve = 2;
		if (dinnerreserve - freepeople > 0 ) {
			extraforreservation = 1100;
		}
	}	
	extradonation = Number($('#donationamt').val());
		
			$('#totaldue').val(total+extraforreservation+extradonation);
	if (dinneronly ==0 &&  total >0 ) {
	$('#adbox').show(); 
	} else{
	$('#adbox').hide(); }
	
if (freepeople > 0 ||dinnerreserve > 0  ) {
	$('#reservenames').show(); }
else{
	$('#reservenames').hide(); }

} //end function 



if (!("autofocus" in document.createElement("input"))) {
	document.getElementById("firstname").focus();
}
function showCredit(sel) {
	var e1 = document.getElementById("payment");
	var paymeth = e1.options[e1.selectedIndex].value;
	var e = document.getElementById("ccinfo");
	if (paymeth == "Credit") {
		e.style.display = 'block';
	} else {
		
		document.getElementById("ccmonth").value = "";
		document.getElementById("ccyear").value = "";
		document.getElementById("ccnum").value = "";
		e.style.display = 'none';
	}
	if (paymeth == "NOCHARGE") {
		document.getElementById('totaldue').value = "0";
	}
}
	      