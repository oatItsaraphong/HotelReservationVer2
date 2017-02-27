Hotel Reservation Application

Using Lamp server

contain: html, php, javascript


Map

-Index.php

-MainPage.php

	- AddGuest.html -> AddGuestInsert.php

	- ReservationCheckDate.php -> RoomReservation.php -> ExeRoomReservation.php
		- LiveSearchSearchAllGuest.php

	- CheckInSnip.php -> CheckInConfirm.php
		- LiveSearchReserved.php

	- CheckOutSnip -> CheckOutPayment.php -> ChechOutConfirm.php
		- LiveSearchCheckIn.php

	- SearchAllGuest.php
		- LiveSearchSearchAllGuest.php


Additinal Code:

- configHotel.php
	- contain function to login to the DB
	- login in for the user
	- exit to MainPage.php function

- functionUse.php
	- function to calculate number of day

Input for Search Type

- LiveSearchSearchAllGuest.php
	- GuestName (partial)
	- Tel (partial)
	- Email (partial)

- LiveSearchReserved.php
	- GuestName (partial)
		
- LiveSearchCheckIn.php
	- Room Number (exact)


