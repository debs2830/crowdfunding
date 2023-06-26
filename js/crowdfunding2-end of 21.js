	$=jQuery;
 var bonusamount = 200000;
 var secondbonusamount = 275000;
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
		 } else  {
			 $('#paymentChoiceDiv').show();
			 $('#ccinfodiv').hide();
		 }
	 }); 
	$('a[href="#donors"], .close-team').click(function()  {
		$('#donationsul2 li' ).removeClass('hidden');
		$('#teamamount').remove();
	});
		$('.totaldue').keyup(function() { 
			
				amttoduplicate = Number($('#amtduplicated').text() ) ;
			if (isNaN (amttoduplicate)) {
				amttoduplicate= 1 ;
			}
			newtotal= Number($(this).val() * amttoduplicate );
			
				//$(this).next('span').next('span').text('= $' + newtotal);
				$(this).parent().find('#newtotal').text('= $' + newtotal);
			
		if ($('#is-sponsor').val()==1)  {
			var newdivisor = Math.floor(Number(newtotal/12) ); 
			if  (newdivisor >= 10 )  {
			$('#donatemonthly').text('DONATE MONTHLY : $' + newdivisor  + ' x 12');
				$('#divmonthlyoptions').show();
			} else {
				$('#divmonthlyoptions').hide();
			}

		}
					});
	
		$('#donatebtn, #donatebtnpaypal, .donate-sponsor').click(function() { 
		$(this).closest('.donatebox').find('#donateerror').remove();
	
		
			if ($(this).data('type')=='sponsorship')  { 
			var donationamt = $(this).data('totalamt');
			$('#divmonthlyoptions').show();
				$('#is-sponsor').val('1');
//			if (donationamt == 3600 || donationamt == 5000) { 
//			 	$('#paymentChoiceDiv').show();}
//			$('#formModal #totaldue').attr('readonly', 'readonly');
			
			$('#donatemonthly').text('DONATE MONTHLY : $' + Math.floor(Number(donationamt/12) )  + ' x 12');
		} else {
			var donationamt = $(this).closest('.donatebox').find('#totaldue').val();		
			$('#divmonthlyoptions').hide();
//			$('#formModal #totaldue').removeAttr('readonly');
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
	var time = Number($('#endtime').val()  );
	var date =$('#enddate').val()  ;
	var hrs = -(new Date().getTimezoneOffset() / 60) ;
	var 	endingHr=18 +(-6+ hrs+12);
	
 

	$('#countdown').countdown("2021/05/05 "+endingHr +":00:00", function(event) {
		 //var totalHours = event.offset.totalDays * 24 + event.offset.hours;
   //console.log(totalHours);
		// $(this).html(event.strftime(totalHours +'H %MM  %SS'));
		//$(this).html(event.strftime('%dD  %HH  %MM  %SS'));
  }).on('finish.countdown', function() {
           $(this).hide();
		$('#countdowndiv').html('Time\'s up! Thank you.');
		$('.sponsorinfo  .donatebox').hide();
		$('#DateCountdown').remove();
		$('.copysponsorinfo.donatebox').show();
		$('.donateboxover').show();
		$('.bonusmessage').hide();
		$('.bonusmessage2').hide();
		$('.copysponsorinfo #totaldue').val("0");
		$('.copysponsorinfo #newtotal').text("");

				var text =  $(".copysponsorinfo.donatebox").html();
          var   textnew = text.replace("x " +$('#amtduplicated').text() , "");
            $(".copysponsorinfo.donatebox").html(textnew);

			  
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
			var amttotimesby= 4;

		$.ajax({method: "POST",dataType :'json', url: "doubledonationscript.php",data:{lastnum: $('#lastnum').val() }, success: function(result){
		
		var firsttime = 0;
		var currentttotal = $('#totalamount').val();	
			if ( $('.teamid').text() ){
			var currentTeamtTotal = $('.totalamountteam').text();
		currentTeamtTotal= 	currentTeamtTotal.replace(/[$,]+/g,"");	
			
			}
		$.each(result, function (index, item) { 
		if (currentttotal > bonusamount ) { 
			 amttotimesby= 2;
		}
			 if (currentttotal >= secondbonusamount) {
				 amttotimesby= 1;
			 }
			
			
			//if (firsttime === 0){
			 $('#lastnum').val(item.tnxid);
						//	 firsttime = 1;
						 //	}
					li = "<li data-nickname='" + item.nickname+"'";
				if ( $('.teamid').text()  != '' && item.ID != $('.teamid').text() ) { 
					
						li += " class='hidden' ";
				} else {
						 currentTeamtTotal = Number(currentTeamtTotal) + Number(item.amtpayed * amttotimesby);
				}
			
					li +=">" + item.names1 + " <span class='rtamt'> $" + ( item.amtpayed * amttotimesby)+"</span>";
					 
					 if ( item.adcomment) {
			li = li +  "<br><i >" + item.adcomment +  "</i>";
		} if ( item.realname) {
			li = li +  "<br><i >Team " + item.realname +  "</i>";
		}
					 
					 li= li + "</li>";
					 
					 currentttotal = Number(currentttotal) + Number(item.amtpayed * amttotimesby);
					$("#donationsul2").prepend(li);
					  $('#totalamount').val(currentttotal);
					 var newtotaldonor = Number($('#totaldonorsspan').text()) + 1;
				$('#totaldonorsspan').text( newtotaldonor);
					 if (currentttotal >= bonusamount) {
						  $('.bonusmessage').show().text('now doubled');
						 $('.bonusmessage2').show();
//						$('.goaltotal').append(' - REACHED');
						 $('#wordsduplicated').text('');
						$('#amtduplicated').text('2');
						
					 } 
					 if (currentttotal >= secondbonusamount) {
//							$('.bonusmessage2').append(' - REACHED');
					 $('#wordsduplicated').text('');
					$('#amtduplicated').text('1');
					$('.divdouble').text('');

						
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
			//options
			 /*https://www.jqueryscript.net/time-clock/Attractive-jQuery-Circular-Countdown-Timer-Plugin-TimeCircles.html
			https://www.jqueryscript.net/time-clock/Attractive-jQuery-Circular-Countdown-Timer-Plugin-TimeCircles.html
			4
	circle_bg_color: "#60686F", 
	
	fg_width: 0.1, //  sets the width of the foreground circle.
07
	bg_width: 1.2, // sets the width of the backgroundground circle.
08
	text_size: 0.07, // This option sets the fon*/
			var time = Number($('#endtime').val()  );
	var date =$('#enddate').val()  ;
	var hrs = -(new Date().getTimezoneOffset() / 60) ;
	var 	endingHr=18 +(-6+ hrs+12);
	

	$('#DateCountdown').attr("data-date", "2021/05/05 "+endingHr +":00:00");

			var dateObj = new Date().toLocaleString("en-US", {timeZone: "America/Denver"});
			
			
		//	var day = dateObj.getUTCDate();
			
	//	dateshow = (dateObj > '6/15/2021'? true:true);
			
           $("#DateCountdown").TimeCircles( {time: { Days: { show: false , color: '#014bae' }, Hours: { show: true, color:'#38a0c7' }, Minutes: { show: true, color:'#F2B644' }, 	Seconds:{show:true, color:'#16A65C'} },  direction: "Counter-Clockwise",     circle_bg_color: "#555"} );
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
