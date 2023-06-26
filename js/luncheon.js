$ = jQuery;
function loadform()
{
	var e4 = document.getElementById("info");
	e4.style.display = 'none';
	disablenames();
}
function copyamt()
{
    var total1 = document.getElementById("donationamt").value;
//	 total1 = total1.replace("$","");
    var elem = document.getElementById("totaldue");
	elem.value = (total1);
} 

function disablenames()
{
	    document.getElementById("txtEnterName").style.display = 'none';
	
	    document.getElementById("person1").style.display = 'none';
		document.getElementById("person2").style.display = 'none';

}
function enabletwo()
{
		    document.getElementById("txtEnterName").style.display = 'block';
  document.getElementById("noadults").value = 2;
	    document.getElementById("person1").style.display = 'block';
		document.getElementById("person2").style.display = 'block';

}
function enableone()
{
		    document.getElementById("txtEnterName").style.display = 'block';
  document.getElementById("noadults").value = 1;
	    document.getElementById("person1").style.display = 'block';
		document.getElementById("person2").style.display = 'none';

}

function clearitems() {
	clearChecks();
	var e1 = document.getElementById("leveloneinfo");
	var e2 = document.getElementById("leveltwoinfo");
	var e3 = document.getElementById("levelthreeinfo");
var e5 = document.getElementById("levelfourinfo");
	var e4 = document.getElementById("level");
	e4.selectedIndex = 0;
	e3.style.display = 'none';
	e2.style.display = 'none';
	e1.style.display = 'none';
    	e5.style.display = 'none';
	
disablenames();

}



$('#btnsubmit').click(function(e) { 
	if ($('#payment').val() == "" && $('#pagename').val() != "edit") {
		alert("Please select a payment method");
		return false;
	}
	
	
	var email = document.getElementById("email").value;
	
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
	
	
   
	
	if ($('#info').css('display') == 'block' && $('#adtext1').val() == "" ) {
		 var r =  confirm("Would you like to supply an ad?");
		if (r == true) {
		   return false;
		} else {
			return true
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

			$('#errmsg').hide();
		  $.ajax({method: "POST",
				  url: "/events/chargecard.php",
				  data:$('#form1').serialize() 
		
				 })
		  .done(function( result ) {
 	  console.log(result);
			if (result != 'Error') { 
				$('#authcode').val(result);
				$('#form1').submit();
				  
			} else {
						
				$('#errmsg').show();
				return false
			}
		
  });
		
		;
		} //end credit card 
	else {
			$('#form1').submit();
	}
		
		
});
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

	var total1 = 0;
	var sublevel = "";
				$("#info").hide();
	if (document.getElementById('diamond').checked) {
		total1 = 250;
		
		sublevel = "diamond";
		//enabletwo();
		$("#info").show();
	} else if (document.getElementById('gold').checked) {
		total1 = 180;
		sublevel = "gold";
		//enabletwo();
					$("#info").show();
	} else if (document.getElementById('silver').checked) {
		total1 = 136;
		sublevel = "silver";
		//enabletwo();
					$("#info").show();
	
	} else if (document.getElementById('ad').checked) {
		sublevel = "ad";
		total1 = 50;
			//disablenames();
					$("#info").show();
	} 
	else if (document.getElementById('y-admission').checked) {
		total1 = 10;
		sublevel = "young-admission";
		//disablenames();
		
	}else if (document.getElementById('admission').checked) {
		total1 = 18;
		sublevel = "admission";
		//disablenames();
		$("#info").show();
	}else if (document.getElementById('greeting').checked) {
		total1 = 20;
		sublevel = "greeting";
		//disablenames();
		$("#info").show();
	} else if (document.getElementById('eventonly').checked) {
		total1 = 75;
		sublevel = "couvert";
		//enabletwo();
//		enableten();
	} 
	var newtotal = Number($('#donationamt').val()) + total1;
	$('#totaldue').val(newtotal);
	$('#eventsublevel').val(sublevel);
	
}

function calcTotalA(sel) {

	var total = 0;
	var adults = $("#noadults").val();
	var kids = $("#nokids").val();
	


	var total1 = (adults*20 ) + (kids *10 );


	var elem = document.getElementById("totaldue");
	elem.value = (total1).formatMoney(2, '.', ',');

}

if (!("autofocus" in document.createElement("input"))) {
	document.getElementById("firstname").focus();
}
function showCredit(sel) {
	var paymeth = $('#payment').val();


	if (paymeth == "Credit") {
		$('#ccinfo').show();
	} else {
		$("#cc").val('');
		$("#ccmonth").val('');
		$("#ccyear").val('');
		$("#ccnum").val('');
			$('#ccinfo').hide();
	}
	if (paymeth == "NOCHARGE") {
			$('#totaldue').val('0');
	}
}