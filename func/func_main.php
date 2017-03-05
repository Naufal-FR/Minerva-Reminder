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

	function fm_get_pass ($group_Id, $db_conf){

		$query = "SELECT `PASS` FROM `GROUP_INFORMATION` WHERE GROUP_ID = '" . $group_Id . "'";
		$query_result = mysqli_query($db_conf, $query);
		$query_fetch = mysqli_fetch_array($query_result);
		$group_pass = $query_fetch['PASS'] ;
		return $group_pass ;

	}

	function fm_get_unique_id ($group_Id, $db_conf){

		$query = "SELECT `UNIQUE_ID` FROM `GROUP_INFORMATION` WHERE GROUP_ID = '" . $group_Id . "'";
		$query_result = mysqli_query($db_conf, $query);

		if ( mysqli_num_rows($query_result) == 0 ) {
			return 0 ;
		} else {
			$query_fetch = mysqli_fetch_array($query_result);
			$show_id_res = $query_fetch['UNIQUE_ID'] ;
			return $show_id_res ;
		}

	}

	function fm_get_keyword ($target_keyword, $group_Id, $db_conf){

		$query = "SELECT `KEYWORD` FROM `GROUP_FUNCTION` WHERE UNIQUE_ID='" . $group_Id . "' AND KEYWORD='" . $target_keyword . "'";
		$query_result = mysqli_query($db_conf, $query);

		if ( mysqli_num_rows($query_result) == 0 ) {
			return 0 ;
		} else {
			$query_fetch = mysqli_fetch_array($query_result);
			$keyword = $query_fetch['KEYWORD'] ;
			return $keyword ;
		}

	}

	function fm_check_keyword ($target_keyword, $group_Id, $db_conf){

		$query = "SELECT COUNT(*) FROM `GROUP_FUNCTION` WHERE UNIQUE_ID='" . $group_Id . "' AND KEYWORD='" . $target_keyword . "'";
		$query_result = mysqli_query($db_conf, $query);

		if ( mysqli_num_rows($query_result) == 0 ) {
			return 0 ;
		} else {
			return 1 ;
		}

	}
?>