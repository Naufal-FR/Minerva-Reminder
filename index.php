<?php

	require_once( __DIR__ . '/src/LINEBotTiny.php');

	require_once( __DIR__ . '/conf/channel_key.php');
	require_once( __DIR__ . '/conf/db_connection.php');
	
	require_once( __DIR__ . '/func/func_main.php');
	require_once( __DIR__ . '/func/func_db.php');

	require_once( __DIR__ . '/text/help_personal.php');
	require_once( __DIR__ . '/text/help_group.php');
	require_once( __DIR__ . '/text/confused_reaction.php');

	set_error_handler('exceptions_error_handler');
	
	$client = new LINEBotTiny($channelAccessToken, $channelSecret);

	foreach ($client->parseEvents() as $event) {

	    switch ($event['type']) {

	        case 'message':
	            $message = $event['message'];

	            switch ($message['type']) {
	                case 'text':

	                	// Explode The Message So We Can Get The First Words
	               		$exploded_Message = explode(" ", $message['text']);
						
						try {
							usleep(1250000);

							if ($exploded_Message[0] == "..debugProfile") {	
								$result = $client->getProfile($event['source']['userId']);
								$result = json_decode($result, true);

			                    $client->replyMessage(array(
			                        'replyToken' => $event['replyToken'],
			                        'messages' => array(
			                            array(
			                                'type' => 'text',
			                                'text' => $result['displayName']
			                            ),
			                            array(
			                                'type' => 'text',
			                                'text' => "So ... your status now is " . PHP_EOL . PHP_EOL . $result['statusMessage'] . PHP_EOL . PHP_EOL . "I wonder what i should do with that :3"
			                            )
			                        )
			                    ));
			                    
								$exec_command = "debug2" ;
							}

							if ($exploded_Message[0] == "..debugChat") {		
								$result = "Not in the mood" ;
								$result2 = "Really" ;

			                    $client->replyMessage(array(
			                        'replyToken' => $event['replyToken'],
			                        'messages' => array(
			                        	// First Message
			                            array(
			                                'type' => 'text',
			                                'text' => $result
			                            ),

			                            // Second Message
			                            array(
			                                'type' => 'text',
			                                'text' => $result2
			                            ) 
			                        )
			                    ));
			                
								$exec_command = "debugChat" ;
							}
	
							if ($exploded_Message[0] == "..debugConf") {	

			                    $client->replyMessage(array(
			                        'replyToken' => $event['replyToken'],
			                        'messages' => array(

			                        	// First Message
			                            array(
			                                'type' => 'template',

			                                'altText' => 'Only applicable in LINE Mobile',

			                                // The Confirm Content
			                                'template' => array(

			                                	'type' => "confirm",
			                                	
			                                	'text' => "You choose Blue or Red ?",

			                                	// Action to take between two
			                                	'actions' => array(
			                                		array(
			                                			'type' => 'message',
			                                			'label' => 'Blue',
			                                			'text' => 'You choose Blue'
			                                		),
			                                		array(
			                                			'type' => 'message',
			                                			'label' => 'Red',
			                                			'text' => 'You choose Red'	
			                                		)
			                                	)
			                                )
			                            )
			                        )
			                    ));
			                
							}

							switch ($exploded_Message[0]) {

								// Works Only On Group Account
								case '..request':
									if (isset($event['source']['groupId'])) {

										$search_id_res = (int) fm_get_unique_id( $event['source']['groupId'], $db) ;

										if ($search_id_res != 0) {
											$client->replyMessage(array(
						                        'replyToken' => $event['replyToken'],
						                        'messages' => array(
						                            array(
						                                'type' => 'text',
						                                'text' => 'Your group is already registered ... '
						                            )
						                        )
						                	));

										} else {
											$query = "INSERT INTO GROUP_INFORMATION (`GROUP_ID`, `PASS`) VALUES ('" .
												$event['source']['groupId'] . "','" . 12345 . "')";
											
											mysqli_query($db, $query);

											$registered_id = (int) fm_get_unique_id($event['source']['groupId'], $db) ;
											$group_pass = fm_get_pass($event['source']['groupId'], $db);

				                    		mysqli_close($db);

				                    		$client->replyMessage(array(
							                        'replyToken' => $event['replyToken'],
							                        'messages' => array(
							                            array(
							                                'type' => 'text',
							                                'text' => 'Successfully registered'
							                            ), 
							                            array(
							                                'type' => 'text',
							                                'text' => 'Group ID : ' . $registered_id . PHP_EOL . 'Group Pass : ' . $group_pass
							                            ), 
							                            array(
							                                'type' => 'text',
							                                'text' => 'You can access this again with ..showId'
							                            ) 
							                        )
							                ));
										}
									
									}
									
									break;

								case '..showId' :
									if (isset($event['source']['groupId'])) {

										$search_id_res = (int) fm_get_unique_id( $event['source']['groupId'], $db) ;

		                    			$text_response = $search_id_res ;
			                    		
			                    		if ( $search_id_res === 0 ) {
			                    			$text_response = 'Your group is not registered yet' ;
			                    		}

			                    		mysqli_close($db);

			                    		$client->replyMessage(array(
						                        'replyToken' => $event['replyToken'],
						                        'messages' => array(
						                            array(
						                                'type' => 'text',
						                                'text' => $text_response
						                            )
						                        )
						                ));
											
									}
									
									break;

								case '..createPing' :
									if (isset($event['source']['groupId'])) {
										$text_response = 'No message';

										if (!isset($exploded_Message[1]) OR !isset($exploded_Message[2])) {
											$text_response = 'Not enough information to create one.' . PHP_EOL . 'Need keyword and group pass' ;
										
										} else {
											$registered_id = (int) fm_get_unique_id($event['source']['groupId'], $db) ;

											if ( $registered_id == 0 ) {
												$text_response = "Your group isn't registered yet" ;
											} else {
												$group_pass = fm_get_pass($event['source']['groupId'], $db);	
												
												if ($group_pass == $exploded_Message[2]) {

													$check_result = fm_check_keyword($exploded_Message[1], $registered_id, $db);

													if ($check_result == 0) {
														fm_insert_group_function($exploded_Message[1], $registered_id, $db);
														$text_response = "New Ping Created" ;
													} elseif($check_result == 1) {
														$text_response = "Duplicate keyword detected" ;
													}

												
												} elseif ($group_pass != $exploded_Message[2]) {
													$text_response = 'You entered the wrong password' ;
												
												} 
											}

											
										}
										
			                    		mysqli_close($db);

			                    		$client->replyMessage(array(
						                        'replyToken' => $event['replyToken'],
						                        'messages' => array(
						                            array(
						                                'type' => 'text',
						                                'text' => $text_response
						                            )
						                        )
						                ));
											
									}
									
									break;
								// Could use some fixing
								case '..deletePing':
									if (isset($event['source']['groupId'])) {
										
										if (!isset($exploded_Message[1]) OR !isset($exploded_Message[2])) {
											$text_response = 'Not enough information to delete ping.' . PHP_EOL . 'Need keyword and group pass' ;
										} else {											
											$target_keyword = $exploded_Message[1] ;
											$target_pass = $exploded_Message[2] ;

											$check_status = fm_check_group_information($event['source']['groupId'], $db);

											if ($check_status['IS_REGISTERED'] == 0) {
												$text_response = "Your group is not registered yet" ;

											} elseif ($check_status['IS_REGISTERED'] == 1) {
												$fetch_pass = fm_check_pass($target_pass, $event['source']['groupId'], $db);

												if ($fetch_pass['IS_PASS_MATCH'] == 0) {
													$text_response = "You entered the wrong password. Please check again" ;
												} elseif ($fetch_pass['IS_PASS_MATCH'] == 1) {

													$group_unique_id = fm_get_unique_id($event['source']['groupId'], $db);
													
													$check_delete = "SELECT COUNT(*) AS `IS_CREATED`, GF_ID FROM `GROUP_FUNCTION` WHERE UNIQUE_ID='" . 
														$group_unique_id . "' AND KEYWORD='" . $target_keyword . "'" ;

													$check_result = mysqli_query($db, $check_delete); 
													$check_status = mysqli_fetch_array($check_result);

													if ($check_status['IS_CREATED'] == 0) {
														$text_response = "There's no ping with that keyword" ;
													} elseif ($check_status['IS_CREATED'] == 1) {
														$delete_query_linked_acc = "DELETE FROM LINKED_ACC WHERE GF_ID='" . $check_status['GF_ID'] . "'" ;
														mysqli_query($db, $delete_query_linked_acc);

														$delete_query_group_function = "DELETE FROM GROUP_FUNCTION WHERE GF_ID='" . $check_status['GF_ID'] . "'";
														mysqli_query($db, $delete_query_group_function);
														
														$text_response = "Ping Successfully Deleted" ;	
													}
												}
												
											}


										}
										
			                    		mysqli_close($db);

			                    		$client->replyMessage(array(
						                        'replyToken' => $event['replyToken'],
						                        'messages' => array(
						                            array(
						                                'type' => 'text',
						                                'text' => $text_response
						                            )
						                        )
						                ));

									}
									break;

								case '..listPing' :
									if (isset($event['source']['groupId'])) {

										$search_id_res = (int) fm_get_unique_id($event['source']['groupId'], $db) ;

			                    		$container = $search_id_res ;
										
										if ($container === 0) {
											$text_response = "Your group is not registered yet" ;
											
										} else {
											$query_result = fm_get_keyword($container, $db);

											if ( mysqli_num_rows($query_result) == 0 ) {
												$text_response = "Your group does not have any ping yet" ; 
											} else {
												$text_response = "Registered Keyword" . PHP_EOL . PHP_EOL ;
												while ( $query_fetch = mysqli_fetch_array($query_result) ) {
													$text_response .= "> " . $query_fetch['KEYWORD'] . PHP_EOL ;
												}
											}
										}

			                    		mysqli_close($db);

			                    		$client->replyMessage(array(
						                        'replyToken' => $event['replyToken'],
						                        'messages' => array(
						                            array(
						                                'type' => 'text',
						                                'text' => $text_response
						                            ),
						                            array(
						                                'type' => 'text',
						                                'text' => "Here's the list of keyword on this group~"
						                            )
						                        )
						                ));
											
									}
									
									break;

								case '..ping':
									if (isset($event['source']['groupId'])) {

										if (!isset($exploded_Message[1])) {
											$text_response = 'Not enough information to ping.' . PHP_EOL . 'Need ping keyword' ;
										} else {
											$register_status = fm_check_group_information($event['source']['groupId'], $db);

											if ($register_status['IS_REGISTERED'] == 1) {
												$target_id = (int) fm_get_unique_id($event['source']['groupId'], $db) ;
												$target_name = fm_get_group_description($event['source']['groupId'], $db) ;

												// Get personal ID
												$query_ping = "SELECT `PERSONAL_ID` FROM LINKED_ACC WHERE `GF_ID` IN (" .
													"SELECT `GF_ID` FROM `GROUP_FUNCTION` " .
														"WHERE UNIQUE_ID='" . $target_id . "' AND KEYWORD='" . $exploded_Message[1] . "')" ;

												$ping_result = mysqli_query($db, $query_ping);
												$number_of_ping = 0 ;

												while ($id_to_ping = mysqli_fetch_array($ping_result)) {
								                    $client->pushMessage(array(
								                        'to' => $id_to_ping['PERSONAL_ID'],
								                        'messages' => array(
								                            array(
								                                'type' => 'text',
								                                'text' =>  "> Source" . PHP_EOL . $target_name . PHP_EOL . "Group ID : " . $target_id
								                            ),
								                            array(
								                                'type' => 'text',
								                                'text' => "You have a new ping ~"
								                            )
								                        )
								                    ));
								                    $number_of_ping += 1 ;
								                }

								                $text_response = "Ping Success to " . $number_of_ping . " linked account" ;

											} elseif ($register_status['IS_REGISTERED'] == 0) {
												$text_response = "Your Group Is Not Registered Yet" ;
											}	

										}


					                    mysqli_close($db);

					                    $client->replyMessage(array(
						                        'replyToken' => $event['replyToken'],
						                        'messages' => array(
						                            array(
						                                'type' => 'text',
						                                'text' => $text_response
						                            )
						                        )
						                ));

									}

									break;

								// Works Only On Personal Account
								case '..mylink' :
									if (isset($event['source']['userId'])) {

										$showId_query = "SELECT GF.UNIQUE_ID, GF.KEYWORD, GI.GROUP_DESCRIPTION FROM GROUP_FUNCTION GF, LINKED_ACC LA, GROUP_INFORMATION GI ". 
											"WHERE GF.GF_ID = LA.GF_ID AND GI.UNIQUE_ID = GF.UNIQUE_ID AND LA.PERSONAL_ID ='" . 
											$event['source']['userId'] . "'" ;

										$query_result = mysqli_query($db, $showId_query);

										if ( mysqli_num_rows($query_result) == 0 ) {
											$text_response = "You Don't Have Any Linked Ping" ;
										} else {
											$text_response = "Linked Ping" . PHP_EOL . PHP_EOL ;

											$query_fetch = mysqli_fetch_array($query_result) ;
											$current_id = $query_fetch['UNIQUE_ID'];
											$current_desc = $query_fetch['GROUP_DESCRIPTION'];

											$text_response .= $current_desc . PHP_EOL . "Group ID : " . $current_id . PHP_EOL ;
											do {
												if ($current_id == $query_fetch['UNIQUE_ID']) {
													$text_response .= "- " . $query_fetch['KEYWORD'] . PHP_EOL ;
												} else {
													$current_id = $query_fetch['UNIQUE_ID'] ;
													$current_desc = $query_fetch['GROUP_DESCRIPTION'];
													$text_response .= PHP_EOL . $current_desc . PHP_EOL . "Group ID : " . $current_id . PHP_EOL . "- " . $query_fetch['KEYWORD'] . PHP_EOL; 
												}
											} while ($query_fetch = mysqli_fetch_array($query_result)) ;
										}

			                    		mysqli_close($db);

			                    		$client->replyMessage(array(
						                        'replyToken' => $event['replyToken'],
						                        'messages' => array(
						                            array(
						                                'type' => 'text',
						                                'text' => $text_response
						                            ),
						                            array(
						                                'type' => 'text',
						                                'text' => "Here's all your personal link~"
						                            )
						                        )
						                ));
											
									}
									
									break;

								case '..link' :
									if (isset($event['source']['userId'])) {
										// 1 = Group Unique ID | 2 = Keyword
										if (!isset($exploded_Message[1]) OR !isset($exploded_Message[2])) {
											$text_response = 'Not enough information to link.' . PHP_EOL . 'Need keyword and group unique id' ;
										
										} else {
											// Query to check if unique group id provided exist
											$query = "SELECT `UNIQUE_ID`, `PASS` FROM `GROUP_INFORMATION` WHERE UNIQUE_ID = '" .
												$exploded_Message[1] . "'";
												$query_result = mysqli_query($db, $query) ;

											// If doesn't exist, stop the process
											if ( mysqli_num_rows($query_result) == 0 ) {
												$text_response = "That group isn't registered yet" ;
											} else {
												// If it exist, take the unique_id value and find all the keyword   
												$query_fetch = mysqli_fetch_array($query_result);
												$check_value = "SELECT `KEYWORD`, `GF_ID` FROM `GROUP_FUNCTION` WHERE UNIQUE_ID='" .
													$query_fetch['UNIQUE_ID'] . "'";
												$check_result = mysqli_query($db, $check_value) ;

												// If there's no result even though group account registered
												if (mysqli_num_rows($check_result) == 0) {
													$text_response = "Your group doesn't have any ping yet" ;
												} else {
													
													while ($keyword_list = mysqli_fetch_array($check_result)) {
														if ($keyword_list['KEYWORD'] == $exploded_Message[2]) {
															$target_gf_id = $keyword_list['GF_ID'] ;
														}
													}

													if (!isset($target_gf_id)) {
														$text_response = "There's no keyword with that name" ;
													} else {
														$check_gf_result = "SELECT `GF_ID` FROM `LINKED_ACC` WHERE PERSONAL_ID='" .
															$event['source']['userId'] . "'";

														$gf_result = mysqli_query($db, $check_gf_result);
														$gf_result_id = mysqli_fetch_array($gf_result);

														if ($target_gf_id == $gf_result_id['GF_ID']) {
															$text_response = "Your account already linked to that group ping keyword" ;
														} else {
															fm_insert_linked_acc($target_gf_id, $event['source']['userId'], $db);
															$text_response = "Successfully Linked" ;	
														}
													}

												}

												
											}

											
										}
										
			                    		mysqli_close($db);

			                    		$client->replyMessage(array(
						                        'replyToken' => $event['replyToken'],
						                        'messages' => array(
						                            array(
						                                'type' => 'text',
						                                'text' => $text_response
						                            )
						                        )
						                ));
											
									}
									
									break;
								
								case '..unlink' :
									if (isset($event['source']['userId'])) {
										if (!isset($exploded_Message[1]) OR !isset($exploded_Message[2])) {
											$text_response = 'Not enough information to unlink.' . PHP_EOL . 'Need group unique id and keyword' ;
										
										} else {
											$target_unique_id = $exploded_Message[1] ;
											$target_keyword = $exploded_Message[2] ;

											$get_query = "SELECT `GF_ID` FROM `GROUP_FUNCTION` WHERE UNIQUE_ID='" . $target_unique_id . "' AND KEYWORD='" . $target_keyword . "'" ;
											$get_result = mysqli_query($db, $get_query) ;
											$counter = mysqli_num_rows($get_result);
											if ($counter == 0) {
												$text_response = "There's no group with that ID or with that specific keyword" ;
											} else {
												$get_fetch = mysqli_fetch_array($get_result) ;
												$check_delete = "SELECT COUNT(*) AS `IS_LINKED` FROM LINKED_ACC WHERE GF_ID ='" . 
													$get_fetch['GF_ID'] . "' AND PERSONAL_ID ='" . $event['source']['userId'] . "'" ;

												$check_result = mysqli_query($db, $check_delete); 
												$check_status = mysqli_fetch_array($check_result);

												if ($check_status['IS_LINKED'] == 0) {
													$text_response = "You're not linked with that ping yet" ;
												} elseif ($check_status['IS_LINKED'] == 1) {
													$delete_query = "DELETE FROM LINKED_ACC WHERE GF_ID ='" . $get_fetch['GF_ID'] . "' AND PERSONAL_ID ='" . $event['source']['userId'] . "'" ;
													$delete_result = mysqli_query($db, $delete_query);
													$text_response = "Unlink Success" ;	
												}

											}

										}
										
			                    		mysqli_close($db);

			                    		$client->replyMessage(array(
						                        'replyToken' => $event['replyToken'],
						                        'messages' => array(
						                            array(
						                                'type' => 'text',
						                                'text' => $text_response
						                            )
						                        )
						                ));
											
									}
									
									break;
												
								// Content Following The Account Type (Personal / Group)
								case '..help':
									if (isset($event['source']['userId'])) {
										$text_response = $help_personal ;
									} elseif (isset($event['source']['groupId'])) {
										$text_response = $help_group ;
									} else {
										$text_response = "No help available for this room type" ;
									}

		                    		mysqli_close($db);

		                    		$client->replyMessage(array(
					                        'replyToken' => $event['replyToken'],
					                        'messages' => array(
					                            array(
					                                'type' => 'text',
					                                'text' => "~ LIST OF SERVICES ~" . PHP_EOL . PHP_EOL . $text_response
					                            ),
					                            array(
					                                'type' => 'text',
					                                'text' => "Here's the list of what i can do here~"
					                            )
					                        )
					                ));

									break;

								// For fun only
								case '..response':
									$client->pushMessage(array(
				                        'to' => 'C7103388573d2a713748de24a7396a662',
				                        'messages' => array(
				                            array(
				                                'type' => 'text',
				                                'text' => "I choose 1"
				                            )
				                        )
				                    ));
									break;

								default: // When nothing is similar
									if (isset($event['source']['userId'])) {
										$client->replyMessage(array(
							                        'replyToken' => $event['replyToken'],
							                        'messages' => array(
							                            array(
							                                'type' => 'text',
							                                'text' => $confused_reaction[rand(0, $number_of_reaction - 1)]
							                            )
							                        )
							                ));
									} 
									
									break;
							}

							if (!empty($exec_command)) {
								// fm_create_log_data($event['source'], $exec_command);
							}


						} catch (Exception $e) {
	                		$text_response = "Sorry, An Error Just Occured" . PHP_EOL . $e->getMessage();	
						}
	                    break;
	            
	                default:
	                    error_log("Unsupporeted message type: " . $message['type']);
	                    break;
	            }
	            break;
	
	        default:
	            error_log("Unsupporeted event type: " . $event['type']);
	            break;
	    }
	};
	
?>