<?php
	
	////////////////
	// Get Query //
	///////////////

	function fm_get_pass ($group_id, $db_conf){

		$query = "SELECT `PASS` FROM `GROUP_INFORMATION` WHERE GROUP_ID = '" . $group_id . "'";
		$query_result = mysqli_query($db_conf, $query);
		$query_fetch = mysqli_fetch_array($query_result);
		$group_pass = $query_fetch['PASS'] ;
		return $group_pass ;

	}

	function fm_get_unique_id ($group_id, $db_conf){

		$query = "SELECT `UNIQUE_ID` FROM `GROUP_INFORMATION` WHERE GROUP_ID = '" . $group_id . "'";
		$query_result = mysqli_query($db_conf, $query);

		if ( mysqli_num_rows($query_result) == 0 ) {
			return 0 ;
		} else {
			$query_fetch = mysqli_fetch_array($query_result);
			$show_id_res = $query_fetch['UNIQUE_ID'] ;
			return $show_id_res ;
		}

	}

	function fm_get_group_description ($group_id, $db_conf){

		$query = "SELECT `GROUP_DESCRIPTION` FROM `GROUP_INFORMATION` WHERE GROUP_ID = '" . $group_id . "'";
		$query_result = mysqli_query($db_conf, $query);

		if ( mysqli_num_rows($query_result) == 0 ) {
			return 0 ;
		} else {
			$query_fetch = mysqli_fetch_array($query_result);
			$show_id_res = $query_fetch['GROUP_DESCRIPTION'] ;
			return $show_id_res ;
		}

	}

	function fm_get_keyword ($unique_id, $db_conf){

		$query = "SELECT `KEYWORD` FROM `GROUP_FUNCTION` WHERE UNIQUE_ID='" . $unique_id . "'";
		$query_result = mysqli_query($db_conf, $query);

		if ( mysqli_num_rows($query_result) == 0 ) {
			return 0 ;
		} else {
			return $query_result ;
		}

	}

	function fm_get_keyword_secure ($target_keyword, $unique_id, $db_conf){

		$query = "SELECT `KEYWORD` FROM `GROUP_FUNCTION` WHERE UNIQUE_ID='" . $unique_id . "' AND KEYWORD='" . $target_keyword . "'";
		$query_result = mysqli_query($db_conf, $query);

		if ( mysqli_num_rows($query_result) == 0 ) {
			return 0 ;
		} else {
			$query_fetch = mysqli_fetch_array($query_result);
			$query_fetch_result = $query_fetch['KEYWORD'];
			return $query_fetch_result ;
		}

	}

	function fm_get_gf_id_secure ($target_keyword, $unique_id, $db_conf){

		$query = "SELECT `GF_ID` FROM `GROUP_FUNCTION` WHERE UNIQUE_ID='" . $unique_id . "' AND KEYWORD='" . $target_keyword . "'";
		$query_result = mysqli_query($db_conf, $query);

		if ( mysqli_num_rows($query_result) == 0 ) {
			return 0 ;
		} else {
			$query_fetch = mysqli_fetch_array($query_result);
			$query_fetch_result = $query_fetch['GF_ID'];
			return $query_fetch_result ;
		}

	}

	function fm_get_gf_id_array ($unique_Id, $db_conf){

		$query = "SELECT `GF_ID` FROM `GROUP_FUNCTION` WHERE UNIQUE_ID='" . $unique_Id . "'";
		$query_result = mysqli_query($db_conf, $query);

		if ( mysqli_num_rows($query_result) == 0 ) {
			return 0 ;
		} else {
			return $query_result ;
		}

	}

	function fm_get_personal_id ($target_gf_id, $db_conf){

		$query = "SELECT `PERSONAL_ID` FROM `LINKED_ACC` WHERE GF_ID='" . $target_gf_id . "'";
		$query_result = mysqli_query($db_conf, $query);

		if ( mysqli_num_rows($query_result) == 0 ) {
			return 0 ;
		} else {
			return $query_result ;
		}

	}


	//////////////////
	// Check Query //
	////////////////

	function fm_check_gf_id_secure ($target_keyword, $unique_id, $db_conf){

		$query = "SELECT COUNT(*) AS `IS_GF_CREATED` FROM `GROUP_FUNCTION` WHERE UNIQUE_ID='" . $unique_id . "' AND KEYWORD='" . $target_keyword . "'";
		$query_result = mysqli_query($db_conf, $query);
		$query_fetch = mysqli_fetch_array($query_result);

		return $query_fetch;
	}

	function fm_check_linked_id ($target_gf_id, $db_conf){
		$query = "SELECT COUNT(*) AS `LINKED_COUNT` FROM `LINKED_ACC` WHERE GF_ID='" . $target_gf_id . "'" ;
		$query_result = mysqli_query($db_conf, $query);
		$query_fetch = mysqli_fetch_array($query_result);

		if ( $query_fetch['LINKED_COUNT'] == 0 ) {
			return 0 ;
		} elseif ( $query_fetch['LINKED_COUNT'] > 0 ) {
			return 1 ;
		}
	}

	function fm_check_unique_id ($group_id, $db_conf){

		$query = "SELECT COUNT(*) AS `IS_CREATED` FROM `GROUP_INFORMATION` WHERE GROUP_ID='" . $group_id . "'" ;
		$query_result = mysqli_query($db_conf, $query);

		$query_fetch = mysqli_fetch_array($query_result);

		if ( $query_fetch['IS_CREATED'] == 0 ) {
			return 0 ;
		} elseif ( $query_fetch['IS_CREATED'] == 1 ) {
			return 1 ;
		}
	}

	function fm_check_keyword ($target_keyword, $unique_id, $db_conf){

		$query = "SELECT COUNT(*) AS `IS_CREATED` FROM `GROUP_FUNCTION` WHERE UNIQUE_ID='" . $unique_id . "' AND KEYWORD='" . $target_keyword . "'";
		$query_result = mysqli_query($db_conf, $query);
		$query_fetch = mysqli_fetch_array($query_result);

		if ( $query_fetch['IS_CREATED'] == 0 ) {
			return 0 ;
		} elseif ( $query_fetch['IS_CREATED'] == 1 ) {
			return 1 ;
		}

	}

	function fm_check_keyword_available ($unique_id, $db_conf){

		$query = "SELECT COUNT(*) AS `IS_CREATED` FROM `GROUP_FUNCTION` WHERE UNIQUE_ID='" . $unique_id . "'";
		$query_result = mysqli_query($db_conf, $query);
		$query_fetch = mysqli_fetch_array($query_result);
		return $query_fetch['IS_CREATED'];

	}


	function fm_check_pass ($target_pass, $group_id, $db_conf){

		$query = "SELECT COUNT(*) AS 'IS_PASS_MATCH' FROM `GROUP_INFORMATION` WHERE PASS='" . $target_pass . 
			"' AND GROUP_ID='" . $group_id . "'" ;
		$query_result = mysqli_query($db_conf, $query);
		$query_fetch = mysqli_fetch_array($query_result);

		return $query_fetch ;

	}

	function fm_check_group_information ($group_id, $db_conf){

		$query = "SELECT COUNT(*) AS `IS_REGISTERED` FROM `GROUP_INFORMATION` WHERE GROUP_ID='" . $group_id . "'" ;
		$query_result = mysqli_query($db_conf, $query);
		$query_fetch = mysqli_fetch_array($query_result);

		return $query_fetch ;

	}

	///////////////////
	// Insert Query //
	/////////////////

	function fm_insert_group_information ($pass, $group_id, $group_description, $db_conf){

		$query = "INSERT INTO GROUP_INFORMATION (`GROUP_ID`, `PASS`, `GROUP_DESCRIPTION`) VALUES ('" .
			$group_id . "','" . $pass . "','" . $group_description . "')";
		
		mysqli_query($db_conf, $query);

	}

	function fm_insert_group_function ($new_keyword, $unique_id, $db_conf){

		$query = "INSERT INTO `GROUP_FUNCTION` (`UNIQUE_ID`, `ID_FUNCTION`, `KEYWORD`) VALUES ('" .
			$unique_id . "','" . 1 . "','" . $new_keyword . "')";
		
		mysqli_query($db_conf, $query);

	}

	function fm_insert_linked_acc ($target_gf_id, $personal_Id, $db_conf){

		$query = "INSERT INTO `LINKED_ACC` (`PERSONAL_ID`, `GF_ID`) VALUES ('" .
			$personal_Id . "','" . $target_gf_id . "')" ;
		
		mysqli_query($db_conf, $query);

	}

	///////////////////
	// Delete Query //
	/////////////////

	function fm_delete_info_via_gf_id ($gf_id, $target_table, $db_conf){

		if ($target_table == "GROUP_FUNCTION") {
			$query = "DELETE FROM GROUP_FUNCTION WHERE GF_ID='" . $gf_id . "'" ;
		} elseif ($target_table == "LINKED_ACC") {
			$query = "DELETE FROM LINKED_ACC WHERE GF_ID='" . $gf_id . "'" ;
		} 
		
		mysqli_query($db_conf, $query);

	}

	function fm_delete_info_via_unique_id ($unique_id, $target_table, $db_conf){

		if ($target_table == "GROUP_FUNCTION") {
			$query = "DELETE FROM GROUP_FUNCTION WHERE UNIQUE_ID='" . $unique_id . "'" ;
		} elseif ($target_table == "GROUP_INFORMATION") {
			$query = "DELETE FROM GROUP_INFORMATION WHERE UNIQUE_ID='" . $unique_id . "'" ;
		} 
		
		mysqli_query($db_conf, $query);

	}


	///////////////////
	// Update Query //
	/////////////////

	function fm_update_pass ($unique_id, $new_pass, $db_conf){

		$query = "UPDATE GROUP_INFORMATION SET PASS='" . $new_pass . "' WHERE UNIQUE_ID='" . $unique_id . "'" ;
		
		mysqli_query($db_conf, $query);

	}

	function fm_update_description ($unique_id, $new_name, $db_conf){

		$query = "UPDATE GROUP_INFORMATION SET GROUP_DESCRIPTION='" . $new_name . "' WHERE UNIQUE_ID='" . $unique_id . "'" ;
		
		mysqli_query($db_conf, $query);

	}

	function fm_update_keyword ($unique_id, $old_name, $new_name, $db_conf){

		$query = "UPDATE `GROUP_FUNCTION` SET KEYWORD='" . $new_name . "' WHERE UNIQUE_ID='" . $unique_id . "' AND KEYWORD='" . $old_name . "'" ;
		
		mysqli_query($db_conf, $query);

	}
?>