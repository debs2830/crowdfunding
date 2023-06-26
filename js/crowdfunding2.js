/*testing 1234*/
$=jQuery;
 var bonusamount = 223000;
 var secondbonusamount = 250000;
function formatCurrency(n, c, d, t) {
    "use strict";

    var s, i, j;

    c = isNaN(c = Math.abs(c)) ? 2 : c;
    d = d === undefined ? "." : d;
    t = t === undefined ? "," : t;

    s = n < 0 ? "-" : "";
    i = parseInt(n = Math.abs(+n || 0).toFixed(c), 10) + "";
    j = (j = i.length) > 3 ? j % 3 : 0;

    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) ;
	//return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}


/**
 * Thermometer progressthermo meter.
 * This function will update the progressthermo element in the "thermometer"
 * to the updated percentage.
 * If no parameters are passed in it will read them from the DOM
 *
 * @param {Number} goalAmount The Goal amount, this represents the 100% mark
 * @param {Number} progressthermoAmount The progressthermo amount is the current amount
 * @param {Boolean} animate Whether to animate the height or not
 *
 */
function thermometer(id, goalAmount, progressthermoAmount, animate) {
    "use strict";

    var $thermo = $("#"+id),
        $progressthermo = $(".progressthermo", $thermo),
        $goal = $(".goal", $thermo),
        percentageAmount,progressthermoPercentage,
        isHorizontal = $thermo.hasClass("horizontal"),
        newCSS = {};
	

    goalAmount = goalAmount || parseFloat( $goal.text() );
	
    progressthermoAmount = progressthermoAmount || parseFloat( $progressthermo.text() );
/*	if (progressthermoAmount > bonusamount) { 
		   percentageAmount =  Math.min( Math.round(progressthermoAmount / secondbonusamount * 1000) / 10, 100);
	}  else*/
		
		if (progressthermoAmount > bonusamount) { 
		   percentageAmount =  Math.min( Math.round(progressthermoAmount / bonusamount * 1000) / 10, 100);
			
		} else {
    percentageAmount =  Math.min( Math.round(progressthermoAmount / goalAmount * 1000) / 10, 100);
}
	progressthermoPercentage =  Math.round(progressthermoAmount / goalAmount  * 100);
    //let's format the numbers and put them back in the DOM
  //  $goal.find(".amount").text( "$" + formatCurrency( goalAmount ) );
   $progressthermo.find(".amount").text(  progressthermoPercentage  + '%');

	
	$thermo.parent().parent().find('#totalprogress').text( " $" + formatCurrency( progressthermoAmount ) );
//$('#totalprogress').text( " $" + formatCurrency( progressthermoAmount ) );

    //let's set the progressthermo indicator
    $progressthermo.find(".amount").hide();

    newCSS[ isHorizontal ? "width" : "height" ] = percentageAmount + "%";

    if (animate !== false) {
        $progressthermo.animate( newCSS, 1200, function(){
            $(this).find(".amount").fadeIn(100);
	
			
        });
    }
    else {
        $progressthermo.css( newCSS );
        $progressthermo.find(".amount").fadeIn(100);
		
    }
}

$(document).ready(function(){
	
		 $('.btn-donate-type').click(function() {
		
			 $('.btn-donate-type').removeClass('active');
			 $(this).addClass('active');
			var paymentSpread = $(this).val();
			 $('#payment-spread').val(paymentSpread);
			 if (paymentSpread == 'monthly')  {
				 $('#paymentChoiceDiv').hide();
				 $('#ccinfodiv').show();
				 	$('#monthlyCharges').show();
			 } else  {
				 $('#paymentChoiceDiv').show();
				 	$('#monthlyCharges').hide();
				 $('#ccinfodiv').hide();
			 }
	 }); 
	

	$('a[href="#donors"], .close-team').click(function()  {
		$('#donationsul2 li' ).removeClass('hidden');
		$('#teamamount').remove();
	});
		$('.totaldue, #duration').keyup(function() { 
				amttoduplicate = Number($('#amtduplicated').text() ) ;
			if (isNaN (amttoduplicate)) {
				amttoduplicate= 1 ;
			}
			var amtToDonate = $('#totaldue').val();
			newtotal= Number(amtToDonate * amttoduplicate );
			
				//$(this).next('span').next('span').text('= $' + newtotal);
				$(this).parent().find('#newtotal').text('= $' + newtotal);
			
		
			var duration = Number($('#duration').val())  ;
				if ( duration )  {
			var newdivisor = Math.floor(Number(amtToDonate/duration) ); 
				}
			
		
			if  (amtToDonate>= 50 )  {
				if ( duration )  {
			$('#donatemonthlyAmount').text('$' + newdivisor  + ' x ' + duration + " Months");
				}
				$('#divmonthlyoptions').show();
			} else {
				$('#divmonthlyoptions').hide();
			}

			$('#min-message').remove();
			if (newdivisor < 10 )  {
				$('#donatemonthlyAmount').before('<span id="min-message" class="error">Minimum monthly amount is $10</span>');
				$('#duration').val('');
				return false;
			} 
		
					});
	
		$('#donatebtn, #donatebtnpaypal, .donate-sponsor').click(function() { 
		$(this).closest('.donatebox').find('#donateerror').remove();
	
		
			if ($(this).data('type')=='sponsorship')  { 
			var donationamt = $(this).data('totalamt');
			//$('#divmonthlyoptions').show();
			//	$('#is-sponsor').val('1');
			//	var duration = Number($('#duration').val()) ;
				
			//$('#donatemonthlyAmount').text( Math.floor(Number(donationamt/duration) )  + ' x ' + duration);
		} else {
			var donationamt = $(this).closest('.donatebox').find('#totaldue').val();		
		//	$('#divmonthlyoptions').hide();

		}
		
		
		if (donationamt == 0 || donationamt < 0 ) {
			
			$(this).after('<br><span style="color:red;" id="donateerror">Please enter a donation amount</span>');
			return false;
		}
		$('.copysponsorinfo #totaldue').val(donationamt);
			
			if (!isNaN(donationamt))  {
				
					$('.copysponsorinfo #newtotal').text("= $" + donationamt * Number($('#amtduplicated').text() ) );
			}
	
		var teamid = $('.teamid').text();

	//	if ($(this).attr('data-type')=='cc') {
		
		$('#formModal').modal();
		/*}
		else {
			var location = "paypal-donation.php?amt=" + donationamt ;
			 if (teamid) { location += '&team=' + teamid ; }
			window.location.href = location ; 
		}*/
	});
	var hrs = -(new Date().getTimezoneOffset() / 60) ;
	var 	endingHr=18 +(-6+ hrs+12);
 

	$('#countdown').countdown("2023/05/17 "+endingHr +":00:00", function(event) {
  }).on('finish.countdown', function() {
           $(this).hide();
		$('#countdowndiv').html('Time\'s up! Thank you.');
//		$('.sponsorinfo  .donatebox').hide();
		$('#DateCountdown').remove();
		/*$('.sponsorinfo  .donatebox').hide();
		$('.copysponsorinfo.donatebox').show();
		$('.donateboxover').show();
		$('.bonusmessage').hide();
		$('.bonusmessage2').hide();
		$('.copysponsorinfo #totaldue').val("0");
		$('.copysponsorinfo #newtotal').text("");

				var text =  $(".copysponsorinfo.donatebox").html();
          var   textnew = text.replace("x " +$('#amtduplicated').text() , "");
            $(".copysponsorinfo.donatebox").html(textnew);*/
		  
    });

  

	
	
	
	$('#form').validate({
		
		 submitHandler: function(form) {
		 
		 	$('#submitbtn').attr('disabled', 'disabled');
					$.ajax({ 
				type: 'POST', 
				 url: "/events/chargecard.php",
				data: $("#form").serialize(), 
				
				success: function (data) { 
					if (data != 'Error') { 
				$('#authcode').val(data);
		 if ( $('#payment-spread').val() == 'monthly') { 
				 
				 //resend ajax to create subscription 
						   $.ajax({
				url: "/subscription_create.php",
				type: "POST",
				data:$('#form').serialize()
				});
			 }
				

//					$.post( "insertGeneral.php", $( "#form" ).serialize() );


				window.location.href= ("/events/receiptDonation.php");
				  
			} else {
						
						
				$('#errormsg').html("<strong style='color:red;font-size:1.1em;'>There was a problem with your credit card. Please try again.</strong>");
									
							$('#submitbtn').removeAttr('disabled');
				return false;
			}
						
				}
			});
		 }
		});
		
	

});
	
	function getmoreresults() {
			
			//var initialgoal = $('#initialgoal').val();
		//fix below
			var amttotimesby= 3;

		$.ajax({method: "POST",dataType :'json', url: "doubledonationscript.php",data:{lastnum: $('#lastnum').val() }, success: function(result){
		
		var firsttime = 0;
		var currentttotal = $('#totalamount').val();	
			if ( $('.teamid').text() ){
			var currentTeamtTotal = $('.totalamountteam').text();
		currentTeamtTotal= 	currentTeamtTotal.replace(/[$,]+/g,"");	
			
			}
		$.each(result, function (index, item) { 
		if (currentttotal > bonusamount ) { 
			 amttotimesby= 3;
		}
			 if (currentttotal >= secondbonusamount) {
				 amttotimesby= 1;
			 }

			 $('#lastnum').val(item.tnxid);
					
					li = "<li data-nickname='" + item.nickname+"'";
				if ( $('.teamid').text()  != '' && item.ID != $('.teamid').text() ) { 
					
						li += " class='hidden' ";
				} else {
						 currentTeamtTotal = Number(currentTeamtTotal) + Number(item.amtpayed * amttotimesby);
				}
			
					li +=">" + item.names1 + " <span class='rtamt'> $" + ( item.amtpayed * amttotimesby)+"</span>";
					 li = li +  "<small>";
					 if ( item.adcomment) {
			li = li +  "<br>" + item.adcomment +  "";
		} if ( item.realname) {
			li = li +  "<br>Team " + item.realname +  "";
		}
					 li = li +  "</small>"; 
					 li= li + "</li>";
					 
					 currentttotal = Number(currentttotal) + Number(item.amtpayed * amttotimesby);
					$("#donationsul2").prepend(li);
					  $('#totalamount').val(currentttotal);
					 var newtotaldonor = Number($('#totaldonorsspan').text()) + 1;
				$('#totaldonorsspan').text( newtotaldonor);
			var currentAmtOfDonorsPerTeamDiv =  $('.teambox[data-id="' + item.ID + '"] .teamgoalpeople strong');
			 var donorAmount = currentAmtOfDonorsPerTeamDiv.text().replace(/[^0-9]/g,"");
				currentAmtOfDonorsPerTeamDiv.text(Number(donorAmount)+1 + ' donors');
					 if (currentttotal >= bonusamount) {
						  $('.bonusmessage').show().text('still tripled');
						 $('.bonusmessage2').show();
//						$('.goaltotal').append(' - REACHED');
						 $('#wordsduplicated').text('');
						$('#amtduplicated').text('3');
						
					 } 
					 if (currentttotal >= secondbonusamount) {
//							$('.bonusmessage2').append(' - REACHED');
				/*	 $('#wordsduplicated').text('');
					$('#amtduplicated').text('1');
					$('.divdouble').text('');*/
						 $('.sponsorinfo  .donatebox').hide();
		$('.copysponsorinfo.donatebox').show();
		$('.donateboxover').show();
		$('.bonusmessage').hide();
		$('.bonusmessage2').hide();
		$('.copysponsorinfo #totaldue').val("0");
		$('.copysponsorinfo #newtotal').text("");

				var text =  $(".copysponsorinfo.donatebox").html();
          var   textnew = text.replace("x " +$('#amtduplicated').text() , "");
            $(".copysponsorinfo.donatebox").html(textnew);


						
					 } 
						 thermometer("thermo1", bonusamount, currentttotal  ,0);
					if ( $('.teamid').text()  != '' ) { 
					 var newtotaldonor = Number($('#teamtotaldonor').text()) + 1;
				$('#teamtotaldonor').text( newtotaldonor);
					 thermometer("thermoTeam", $('.teamgoal').text(), currentTeamtTotal  ,0);
					}
					 
                 });
	setTimeout(getmoreresults, 120000);
				
    }});
	
}//end function 
$(document).ready(function(){

	var hrs = -(new Date().getTimezoneOffset() / 60) ;
	var 	endingHr=18 +(-6+ hrs+12);
	

	$('#DateCountdown').attr("data-date", "2023/05/17 "+endingHr +":00:00");

			var dateObj = new Date().toLocaleString("en-US", {timeZone: "America/Denver"});
			
			
		//	var day = dateObj.getUTCDate();
			
	//	dateshow = (dateObj > '6/15/2021'? true:true);
			
           $("#DateCountdown").TimeCircles( {time: { Days: { show: true , color: '#014bae' }, Hours: { show: true, color:'#38a0c7' }, Minutes: { show: true, color:'#F2B644' }, 	Seconds:{show:true, color:'#16A65C'} },  direction: "Counter-Clockwise",     circle_bg_color: "#555"} );
         //   $("#CountDownTimer").TimeCircles({ time: { Days: { show: false }, Hours: { show: true }, Minutes: { show: false }, 	Seconds:{show:false} },  direction: "Counter-Clockwise"});
            
	
	/*video */
	
	
	$('#modalVideo').on('show.bs.modal', function (event) {
	/*end video */
		$(this).find( ' video' ).get(0).play();	
	
           });
	
		$('#modalVideo').on('hidden.bs.modal', function () {
	 $(this).find('video').get(0).pause();
	 $(this).find('video').get(0).currentTime = 0;
	
    });
	
	
           });
