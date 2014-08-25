<?php

	
	$con = mysql_connect("localhost","munnibhai","immuneeb");
	if(!$con){die(mysql_error);}
	$selectDB = mysql_select_db("checkin",$con);
	if(!$selectDB){die('Error selecting database. Seems like the database "checkin" doesnt exist');}
	
	//Connect to remote Database
	/*$conR = mysql_connect('mobiles.noip.me:3306','munnibhai1','immuneeb');
	if($conR){
		mysql_select_db("checkin",$conR);
	} else {echo "The remote database is not connectable atm...!";}*/
?>