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

	function fm_create_log_data ($source, $input) {
		if (!isset($source['userId'])) {
			$choosenID = 'groupId' ;
			if (!isset($source['groupId'])) {
				$choosenID = 'roomId' ;
			} 
		} else {
			$choosenID = 'userId' ;
		}

		$seperated_word = explode(" ", $input,2);
		$input_length = count($seperated_word);
		$command = $seperated_word[0];

		if ($input_length == 1) {
			$log = 	
				date('Y-m-d h:i:s e') . PHP_EOL . 	                    		
	    		"ID: " . $source[$choosenID] . PHP_EOL .         		
	    		"Type: " . $choosenID . PHP_EOL . 
	    		"Command: " . $command . PHP_EOL . 
	    		"-----------------------------" . PHP_EOL;			
		} elseif ($input_length > 1) {
			$input_text = $seperated_word[1];
			$log = 	
				date('Y-m-d h:i:s e') . PHP_EOL . 	                    		
	    		"ID: " . $source[$choosenID] . PHP_EOL . 
	    		"Type: " . $choosenID . PHP_EOL . 
	    		"Command: " . $command . PHP_EOL . 
	    		"Input: " . $input_text . PHP_EOL . 
	    		"-----------------------------" . PHP_EOL; 
		}

    	file_put_contents('./logs/' . date('Y-m-d') . '.txt', $log, FILE_APPEND | LOCK_EX);
	}
?>