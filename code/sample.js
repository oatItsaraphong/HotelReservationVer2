$(function(){


	$('#AddGuestBTN').click(function(){
		console.log("Guest");
		$('.MainBODY').load('AddGuest.html');
	});

	$('#ReservationBTN').click(function(){
		console.log("Rsvp");
		$('.MainBODY').load('CheckInSnip.php');
	});

	$('#CheckInBTN').click(function(){
		console.log("In");
		$('.MainBODY').load('CheckInSnip.php');
	});

	$('#CheckOutBTN').click(function(){
		console.log("Out");
		$('.MainBODY').load('CheckOutSnip.php');
	});

	$('.testMix').click(function(){
		$('.phpContain').load('test.php');
	});

	$('#SearchAllGuestBTN').click(function(){
		$('.MainBODY').load('SearchAllGuest.php');
	});

	
});
