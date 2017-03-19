<?php
	$help_group = 
		"..request [Group Callsign] [Password]" . PHP_EOL . 
			"> A one time action used to register your group. Make sure to fill [Callsign] with something that can be used to identify your group easily such as your own group name. You also need to provide a NUMBERED [PASS] for your group, preferably something easy to type." . PHP_EOL .
			"Ex : ..request My Group Name 12345" . PHP_EOL . PHP_EOL .
		"..info" . PHP_EOL . 
			"> Shows the callsign and pass information of your group based on the '..request' command." . PHP_EOL .
			"Ex : ..info" . PHP_EOL . PHP_EOL .
		"..list" . PHP_EOL . 
			"> Shows all ping created by your group." . PHP_EOL .
			"Ex : ..list" . PHP_EOL . PHP_EOL .
		"..create [PingName] [PASS]" . "" . PHP_EOL .
			"> Create a new ping for your group that your group member can use to link. For now you cannot create ping with space in it" . PHP_EOL .
			"Ex : ..create GroupNewPing 12345" . PHP_EOL . PHP_EOL . 
		"..delete [PingName] [PASS]" . "" . PHP_EOL .
			"> Delete a ping from your group. All member linked to that ping will be automatically unlinked." . PHP_EOL .
			"Ex : ..delete GroupNewPing 12345" . PHP_EOL . PHP_EOL .
		"..wholink [Ping Name]" . "" . PHP_EOL .
			"> Shows all the member profile name linked to specific ping." . PHP_EOL .
			"Ex : ..wholink GroupNewPing" . PHP_EOL . PHP_EOL .
		"..revoke [Pass]" . "" . PHP_EOL .
			"> WARNING : Executing this command will delete ALL data associated with your group including linked members and group pings. You can use '..request' again after this command executed." . PHP_EOL .
			"Ex : ..revoke 12345" . PHP_EOL . PHP_EOL .
		"..help" . "" . PHP_EOL .
			"> Shows all the explanation for each command. Content will change depending if request sent from group or personal chat." . PHP_EOL .
			"Ex : ..wholink GroupNewPing" . PHP_EOL
		 ; 
?>