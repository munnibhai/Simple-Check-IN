<?php
	$time = time();
	
	$morIn = strtotime("09:45:00");
	$morOut = strtotime("13:25:00");
	$eveIn = strtotime("16:15:00");
	$eveOut = strtotime("20:25:00");
	
	if($time < $morIn){$cannotLogin = true;}else{$cannotLogin = false;}


?>