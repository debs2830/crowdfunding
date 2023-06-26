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
function clearChecks()
{
	document.getElementById('diamond').checked = false;
	document.getElementById('platinum').checked = false;
	document.getElementById('gold').checked = false;
	document.getElementById('silver').checked = false;
	document.getElementById('chai').checked = false;
	document.getElementById('parchment').checked = false;
	document.getElementById('diamond1').checked = false;
	document.getElementById('platinum1').checked = false;
	document.getElementById('gold1').checked = false;
	document.getElementById('silver1').checked = false;
	document.getElementById('chai1').checked = false;
	document.getElementById('parchment1').checked = false;
	document.getElementById('patron').checked = false;
	document.getElementById('benefactor').checked = false;
	document.getElementById('sponsor').checked = false;
	document.getElementById('supporter').checked = false;
	document.getElementById('halfpage400').checked = false;
	document.getElementById('quarterpage200').checked = false;
	document.getElementById('eighthpage100').checked = false;
	//document.getElementById('greeting50').checked = false;
	document.getElementById('eventonly1').checked = false;
	document.getElementById('eventonly2').checked = false;	
    document.getElementById('donation').checked = false;	
}
function disablenames()
{
	    document.getElementById("txtEnterName").style.display = 'none';
	
	    document.getElementById("person1").style.display = 'none';
		document.getElementById("person2").style.display = 'none';
		document.getElementById("person3").style.display = 'none';
		document.getElementById("person4").style.display = 'none';
		document.getElementById("person5").style.display = 'none';
		document.getElementById("person6").style.display = 'none';
		document.getElementById("person7").style.display = 'none';
		document.getElementById("person8").style.display = 'none';
		document.getElementById("person9").style.display = 'none';
		document.getElementById("person10").style.display = 'none';
}
function enabletwo()
{
		    document.getElementById("txtEnterName").style.display = 'block';
  document.getElementById("noadults").value = 2;
	    document.getElementById("person1").style.display = 'block';
		document.getElementById("person2").style.display = 'block';
		document.getElementById("person3").style.display = 'none';
		document.getElementById("person4").style.display = 'none';
		document.getElementById("person5").style.display = 'none';
		document.getElementById("person6").style.display = 'none';
		document.getElementById("person7").style.display = 'none';
		document.getElementById("person8").style.display = 'none';
		document.getElementById("person9").style.display = 'none';
		document.getElementById("person10").style.display = 'none';
}
function enableone()
{
		    document.getElementById("txtEnterName").style.display = 'block';
  document.getElementById("noadults").value = 1;
	    document.getElementById("person1").style.display = 'block';
		document.getElementById("person2").style.display = 'none';
		document.getElementById("person3").style.display = 'none';
		document.getElementById("person4").style.display = 'none';
		document.getElementById("person5").style.display = 'none';
		document.getElementById("person6").style.display = 'none';
		document.getElementById("person7").style.display = 'none';
		document.getElementById("person8").style.display = 'none';
		document.getElementById("person9").style.display = 'none';
		document.getElementById("person10").style.display = 'none';
}
function enableten()
{
		    document.getElementById("txtEnterName").style.display = 'block';
  document.getElementById("noadults").value = 2;
	    document.getElementById("person1").style.display = 'block';
		document.getElementById("person2").style.display = 'block';
		document.getElementById("person3").style.display = 'block';
		document.getElementById("person4").style.display = 'block';
		document.getElementById("person5").style.display = 'block';
		document.getElementById("person6").style.display = 'block';
		document.getElementById("person7").style.display = 'block';
		document.getElementById("person8").style.display = 'block';
		document.getElementById("person9").style.display = 'block';
		document.getElementById("person10").style.display = 'block';
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

function selectOption(sel) {
	disablenames();
	clearChecks();
	var e1 = document.getElementById("level");
	var level = e1.options[e1.selectedIndex].value;
	var e1 = document.getElementById("leveloneinfo");
	var e2 = document.getElementById("leveltwoinfo");
	var e3 = document.getElementById("levelthreeinfo");
	var e4 = document.getElementById("info");
    var e5 = document.getElementById("levelfourinfo");
	 
  
	e4.style.display = 'none';
	document.getElementById('eventlevel').value = level;
	if (level == "EVENTJOURNAL") {
		document.getElementById("totaldue").value = "";
        document.getElementById("noadults").value = 1;
		e3.style.display = 'none';
		e2.style.display = 'none';
        e5.style.display = 'none';
			e4.style.display = 'block';
		e1.style.display = 'block';
	} else if (level == "JOURNAL") {
        document.getElementById("noadults").value = 0;
        
		document.getElementById("totaldue").value = "";
		e2.style.display = 'block';
		e3.style.display = 'none';
        e5.style.display = 'none';
			e4.style.display = 'block';
		e1.style.display = 'none';
	} else if (level == "EVENTONLY") {
         document.getElementById("noadults").value = 1;
		document.getElementById("totaldue").value = "";
		document.getElementById("eventsublevel").value = "eventonly";
		e1.style.display = 'none';
        e5.style.display = 'none';
		e2.style.display = 'none';
		e3.style.display = 'block';
	}
     else if (level == "DONATION") {
        document.getElementById("noadults").value = 0;
         document.getElementById("totaldue").value = "";
         	document.getElementById("eventsublevel").value = "donation";
         e4.style.display = 'none';
        e1.style.display = 'none';
        e5.style.display = 'block';
		e2.style.display = 'none';
		e3.style.display = 'none';
         document.getElementById('donation').checked = true;	
         
     }
}
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

function validateForm1() {
	if ($('#payment').val() == "" && $('#pagename').val() != "edit") {
		alert("Please select a payment method");
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
    level =   document.getElementById('eventlevel').value ;
   
    
    if (level != "DONATION" && $('input[name="sublevel"]').is(':checked') ==false) {
	alert('Please select a donation level');
	return false;
	}
    if(level == "DONATION" || level == "JOURNAL")
    {
         
    }
    else
    {
           
         firstname1 =   document.getElementById('firstname1').value ;
         lastname1 =   document.getElementById('lastname1').value ;
         firstname2 =   document.getElementById('firstname2').value ;
         lastname2 =   document.getElementById('lastname2').value ;
         
    
        if(!firstname1  )
        {
            alert("Please enter the first name for at least one individual");
            return false;
        }
         if(!lastname1  )
        {
         alert("Please enter the last name for at least one individual");
            return false;
        }
        
        if(firstname1 ==  "")
        {
            alert("Please enter the first name for at least one individual");
            return false;
        }
         if(lastname1 ==  "")
        {
            alert("Please enter the last name for at least one individual");
            return false;
        }
     
       if( document.getElementById('eventonly2').checked)
       {
    
        if(!firstname2  )
        {
            alert("Please enter the first name for at least one individual");
            return false;
        }
         if(!lastname2  )
        {
         alert("Please enter the last name for at least one individual");
            return false;
        }
        
        if(firstname2 ==  "")
        {
            alert("Please enter the first name for at least one individual");
            return false;
        }
         if(lastname2 ==  "")
        {
            alert("Please enter the last name for at least one individual");
            return false;
        }
    
    }
    }// end check for names
	
	
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
		
		}//end check for credit card
	return true;
}
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
				//document.getElementById("info").style.display = 'none';
	if (document.getElementById('diamond').checked) {
		total1 = 18000;
		
		sublevel = "diamond";
		enableten();
					document.getElementById("info").style.display = 'block';
	} else if (document.getElementById('platinum').checked) {
		total1 = 10000;
		sublevel = "platinum";
		enableten();
					document.getElementById("info").style.display = 'block';
	} else if (document.getElementById('gold').checked) {
		total1 = 5000;
		sublevel = "gold";
		enableten();
					document.getElementById("info").style.display = 'block';
	} else if (document.getElementById('silver').checked) {
		total1 = 2500;
		sublevel = "silver";
		enableten();
					document.getElementById("info").style.display = 'block';
	} else if (document.getElementById('chai').checked) {
		total1 = 1800;
		sublevel = "chai";
		enableten();
					document.getElementById("info").style.display = 'block';
	} else if (document.getElementById('parchment').checked) {
		sublevel = "parchment";
		total1 = 1000;
		enabletwo();
					document.getElementById("info").style.display = 'block';
	} 
	else if (document.getElementById('diamond1').checked) {
		total1 = 18000;
		sublevel = "diamond";
		disablenames();
//		enableten();
	} else if (document.getElementById('platinum1').checked) {
		total1 = 10000;
		sublevel = "platinum";
		disablenames();
//		enableten();
	} else if (document.getElementById('gold1').checked) {
		total1 = 5000;
		sublevel = "gold";
		disablenames();
//		enableten();
	} else if (document.getElementById('silver1').checked) {
		total1 = 2500;
		sublevel = "silver";
		disablenames();
//		enableten();
	} else if (document.getElementById('chai1').checked) {
		total1 = 1800;
		sublevel = "chai";
		disablenames();
//		enableten();
	} else if (document.getElementById('parchment1').checked) {
		sublevel = "parchment";
	disablenames();
	//	enabletwo();
		total1 = 1000;
	}
	
	
	else if (document.getElementById('benefactor').checked) {
		total1 = 800;
		sublevel = "benefactor";
					document.getElementById("info").style.display = 'block';
		enabletwo();
	} else if (document.getElementById('patron').checked) {
		total1 = 600;
		sublevel = "patron";
					document.getElementById("info").style.display = 'block';
		 
		enabletwo();
	} else if (document.getElementById('sponsor').checked) {
		total1 = 500;
		sublevel = "sponsor";
					document.getElementById("info").style.display = 'block';
		 
		enabletwo();
	} else if (document.getElementById('supporter').checked) {
		total1 = 400;
		sublevel = "Supporter";
					document.getElementById("info").style.display = 'block';
		disablenames();
		enabletwo();
	} else if (document.getElementById('fullpage800').checked) {
		total1 = 800;
		sublevel = "Benefactor Ad";
		//enabletwo();
		disablenames();
	} else if (document.getElementById('halfpage400').checked) {
		total1 = 400;
		sublevel = "Patron Dedication Ad";
		disablenames();
	} else if (document.getElementById('quarterpage200').checked) {
		total1 = 200;
		sublevel = "Sponsor Dedication Ad";
		disablenames();
	} else if (document.getElementById('eighthpage100').checked) {
		total1 = 100;
		sublevel = "Supporter Dedication Ad";
		disablenames();
//	} //else if (document.getElementById('greeting50').checked) {
//		total1 = 50;
//		sublevel = "Greeting Ad";
//        	disablenames();
	} else if (document.getElementById('eventonly1').checked) {
		total1 = 200;
		sublevel = "Event 1 Person";
					document.getElementById("info").style.display = 'none';
		enableone();
	} else if (document.getElementById('eventonly2').checked) {
		total1 = 400;
		sublevel = "Event 2 People";
					document.getElementById("info").style.display = 'block';
		enabletwo();
	}
	var elem = document.getElementById("totaldue");
	elem.value = total1;
	document.getElementById("eventsublevel").value = sublevel;
}
function fillName() {

	var e1 = document.getElementById("noadults");
	var adults = parseInt(e1.options[e1.selectedIndex].value);

	if (adults <= 1) {
		var e1 = document.getElementById("noadults");
		e1.selectedIndex = 1;
		document.getElementById("totaldue").value = "54";
	}

	var names = document.getElementById("adultnames").value;

	if (!names && names == "") {
		var firstname = document.getElementById("firstname").value;
		var lastname = document.getElementById("lastname").value;

		var fullname = firstname + " " + lastname;
		document.getElementById("adultnames").value = fullname;
	}

}
function calcTotalA(sel) {
	var total = 0;
	var e1 = document.getElementById("noadults");
	var adults = parseInt(e1.options[e1.selectedIndex].value);

	var todaysDate = new Date();

	var date = new Date('01/11/2014');

	total = adults;

	var total1 = 0;

	if (todaysDate < date) {

		total1 = total * 36.00;
	} else {
		total1 = total * 54.00;
	}

	var elem = document.getElementById("totaldue");
	elem.value = (total1).formatMoney(2, '.', ',');

}

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
		document.getElementById("cc").value = "";
		document.getElementById("ccmonth").value = "";
		document.getElementById("ccyear").value = "";
		document.getElementById("ccnum").value = "";
		e.style.display = 'none';
	}
	if (paymeth == "NOCHARGE") {
		document.getElementById('totaldue').value = "0";
	}
}