<?php
	
	// Error Handling Mainly In Case No Term Found
	function exceptions_error_handler($severity, $message, $filename, $lineno) {
	  if (error_reporting() == 0) {
	    return;
	  }
	  if (error_reporting() & $severity) {
	    throw new ErrorException($message, 0, $severity, $filename, $lineno);
	  }
	}

	function fm_create_log_data ($source, $command) {
		if (!isset($source['userId'])) {
			$choosenID = 'groupId' ;
			if (!isset($source['groupId'])) {
				$choosenID = 'roomId' ;
			} 
		} else {
			$choosenID = 'userId' ;
		}

		$log = 	
			date('Y-m-d h:i:s e') . PHP_EOL . 	                    		
    		"User ID: " . $source[$choosenID] . PHP_EOL . 
    		"Command: " . $command . PHP_EOL . 
    		"-----------------------------" . PHP_EOL; 

    	file_put_contents('./logs/' . date('Y-m-d') . '.txt', $log, FILE_APPEND | LOCK_EX);
	}
?>