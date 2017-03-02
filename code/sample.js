$(function(){


	$('#AddGuestBTN').click(function(){
		console.log("Guest");
		$('.MainBODY').load('AddGuest.php');
	});

	$('#ReservationBTN').click(function(){
		console.log("Rsvp");
		$('.MainBODY').load('ReservationCheckDate.php');
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

	$('#ReportBTN').click(function(){
		$('.MainBODY').load('Report.php');
	});

	/*
	$('.checkRoom').click(function(){
		console.log('$_POST["DateIn"]');
		//$('.MainBODY').empty();

		$('.MainBODY').load('CheckOutSnip.php');
	});
	*/

	
});