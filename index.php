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

	    	// Standard Message Event 
	        case 'message':
	            $message = $event['message'];

	            switch ($message['type']) {
	                case 'text':

	                	// Explode The Message So We Can Get The First Words
	               		$exploded_Message = explode(" ", $message['text']);
						
						try {
							usleep(1000000);

							////////////////////////////////////	
							// Only Works On Personal Account//
							//////////////////////////////////

							if (isset($event['source']['userId'])) {

								// For Private Debugging
								if ($event['source']['userId'] == 'Uc7871461db4f5476b1d83f71ee559bf0') {

									switch ($exploded_Message[0]) {

										case '..debugChat':
											$additional_Message = explode(" ", $message['text'],2);
											$messages_to_send = $additional_Message[1] ;
						                    $client->replyMessage(array(
						                        'replyToken' => $event['replyToken'],
						                        'messages' => array(
						                        	// First Message
						                            array(
						                                'type' => 'text',
						                                'text' => $messages_to_send
						                            ),

						                            // Second Message
						                            array(
						                                'type' => 'text',
						                                'text' => $additional_Message[0]
						                            ) 
						                        )
						                    ));
											break;

										case '..debugConf':
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
											break;
										
										case '..debugButton':
						                    $client->replyMessage(array(
						                        'replyToken' => $event['replyToken'],
						                        'messages' => array(

						                        	// First Message
						                            array(
						                                'type' => 'template',

						                                'altText' => 'Only applicable in LINE Mobile',

						                                // The Button Content
						                                'template' => array(

						                                	'type' => "buttons",
						                                	'title' => "Big Title",
						                                	'text' => "Placeholder Menu",

						                                	// Action to take between two
						                                	'actions' => array(
						                                		array(
						                                			'type' => 'message',
						                                			'label' => 'Menu 1',
						                                			'text' => 'I choose Menu 1'
						                                		),
						                                		array(
						                                			'type' => 'message',
						                                			'label' => 'Menu 2',
						                                			'text' => 'I choose Menu 2'	
						                                		)
						                                	)
						                                )
						                            )
						                        )
						                    ));
											break;

										case '..debugCar':
						                    $client->replyMessage(array(
						                        'replyToken' => $event['replyToken'],
						                        'messages' => array(

						                        	// First Message
						                            array(
						                                'type' => 'template',

						                                'altText' => 'Only works on Mobile LINE',

						                                // Carousel Header
						                                'template' => array(

						                                	'type' => "carousel",

						                                	// Carousel Object
						                                	'columns' => array(
						                                		
						                                		// Carousel First Object
						                                		array(
						                                			'title' => 'The Title 1',
						                                			'text' => 'This is explanation for Title 1',

						                                			// Action inside of carousel 1
								                                	'actions' => array(
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Menu 1',
								                                			'text' => 'I choose Menu 1 from Title 1'
								                                		),
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Menu 2',
								                                			'text' => 'I choose Menu 2 from Title 1'	
								                                		)
								                                	)
						                                		),
						                                		
						                                		// Carousel Second Object
						                                		array(
						                                			'title' => 'The Title 2',
						                                			'text' => 'This is explanation for Title 2',

						                                			// Action inside of carousel 1
								                                	'actions' => array(
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Menu 1',
								                                			'text' => 'I choose Menu 1 from Title 2'
								                                		),
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Menu 2',
								                                			'text' => 'I choose Menu 2 from Title 2'	
								                                		)
								                                	)
						                                		)

						                                	)
						                                )
						                            )
						                        )
						                    ));
											break;

										case '..debugCarMax':
						                    $client->replyMessage(array(
						                        'replyToken' => $event['replyToken'],
						                        'messages' => array(

						                        	// First Message
						                            array(
						                                'type' => 'template',

						                                'altText' => 'Only works on Mobile LINE',

						                                // Carousel Header
						                                'template' => array(

						                                	'type' => "carousel",

						                                	// Carousel Object
						                                	'columns' => array(
						                                		
						                                		// Carousel First Object
						                                		array(
						                                			'title' => 'Title 1',
						                                			'text' => 'This is explanation for Title 1',

						                                			// Action inside of carousel 1
								                                	'actions' => array(
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Menu 1',
								                                			'text' => 'I choose Menu 1 from Title 1'
								                                		),
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Menu 2',
								                                			'text' => 'I choose Menu 2 from Title 1'	
								                                		)
								                                	)
						                                		),
						                                		
						                                		// Carousel Second Object
						                                		array(
						                                			'title' => 'Title 2',
						                                			'text' => 'This is explanation for Title 2',

						                                			// Action inside of carousel 1
								                                	'actions' => array(
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Menu 1',
								                                			'text' => 'I choose Menu 1 from Title 2'
								                                		),
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Menu 2',
								                                			'text' => 'I choose Menu 2 from Title 2'	
								                                		)
								                                	)
						                                		),

						                                		// Carousel Third Object
						                                		array(
						                                			'title' => 'Title 3',
						                                			'text' => 'This is explanation for Title 3',

						                                			// Action inside of carousel 1
								                                	'actions' => array(
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Menu 1',
								                                			'text' => 'I choose Menu 1 from Title 3'
								                                		),
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Menu 2',
								                                			'text' => 'I choose Menu 2 from Title 3'	
								                                		)
								                                	)
						                                		),

						                                		// Carousel Fourth Object
						                                		array(
						                                			'title' => 'Title 4',
						                                			'text' => 'This is explanation for Title 4',

						                                			// Action inside of carousel 1
								                                	'actions' => array(
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Menu 1',
								                                			'text' => 'I choose Menu 1 from Title 4'
								                                		),
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Menu 2',
								                                			'text' => 'I choose Menu 2 from Title 4'	
								                                		)
								                                	)
						                                		),

						                                		// Carousel Fifth Object
						                                		array(
						                                			'title' => 'Title 5',
						                                			'text' => 'This is explanation for Title 5',

						                                			// Action inside of carousel 1
								                                	'actions' => array(
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Menu 1',
								                                			'text' => 'I choose Menu 1 from Title 5'
								                                		),
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Menu 2',
								                                			'text' => 'I choose Menu 2 from Title 5'	
								                                		)
								                                	)
						                                		)

						                                	)
						                                )
						                            )
						                        )
						                    ));
											break;

										case '..response':
											$additional_Message = explode(" ", $message['text'],2);
											$messages_to_send = $additional_Message[1] ;
											$client->pushMessage(array(
						                        'to' => 'C7103388573d2a713748de24a7396a662',
						                        'messages' => array(
						                            array(
						                                'type' => 'text',
						                                'text' => $messages_to_send
						                            )
						                        )
						                    ));
											break;

									}	

								}

								if (file_exists('./temp/' . $event['source']['userId'] . '.txt')) {
									$file_content = file('./temp/' . $event['source']['userId'] . '.txt') ;

									if (count($file_content) == 1) {
										$group_id = $exploded_Message[0] ;
										file_put_contents('./temp/' . $event['source']['userId'] . '.txt', $group_id . PHP_EOL , FILE_APPEND | LOCK_EX);

										if (trim($file_content[0]) == "..link") {
											$detail = "link" ;
										} elseif (trim($file_content[0]) == "..unlink") {
											$detail = "unlink" ;
										} 
										
										$client->pushMessage(array(
					                        'to' => $event['source']['userId'],
					                        'messages' => array(
					                            array(
					                                'type' => 'text',
					                                'text' => "Please enter the ping name you want to " . $detail . " now"
					                            )
					                        )
					                    ));
									} elseif (count($file_content) == 2) {
										$ping_name = $exploded_Message[0] ;
										file_put_contents('./temp/' . $event['source']['userId'] . '.txt', $ping_name . PHP_EOL , FILE_APPEND | LOCK_EX);
										
										$final_content = file('./temp/' . $event['source']['userId'] . '.txt') ;
										$execute_link = trim( preg_replace( '/\s+/' , ' ', ( implode(" ", $final_content) ) ) ) ;

										if (trim($final_content[0]) == "..link") {
											$execute_type = "link to" ;
										} elseif (trim($final_content[0]) == "..unlink") {
											$execute_type = "unlink from" ;
										} 

										$client->pushMessage(array(
					                        'to' => $event['source']['userId'],
					                        'messages' => array(

					                        	// First Message
					                            array(
					                                'type' => 'template',

					                                'altText' => 'Only applicable in LINE Mobile',

					                                // The Confirm Content
					                                'template' => array(

					                                	'type' => "confirm",
					                                	
					                                	'text' => "You're going to " . $execute_type .  ";" . PHP_EOL . PHP_EOL .
					                                				"Group ID : " . $final_content[1] .  
					                                				"Ping Name : " . $final_content[2] . PHP_EOL . 
					                                				"Is this correct ?",

					                                	// Action to take between two
					                                	'actions' => array(
					                                		array(
					                                			'type' => 'message',
					                                			'label' => 'Yes',
					                                			'text' => $execute_link
					                                		),
					                                		array(
					                                			'type' => 'postback',
					                                			'label' => 'No',
					                                			'data' => 'cancel',
					                                			'text' => 'No'
					                                		)
					                                	)
					                                )
					                            )
					                        )
					                    ));
									
										unlink('./temp/' . $event['source']['userId'] . '.txt');
									
									}

								}

								switch ($exploded_Message[0]) {		
									case 'menu':
						                    $client->replyMessage(array(
						                        'replyToken' => $event['replyToken'],
						                        'messages' => array(

						                        	// First Message
						                            array(
						                                'type' => 'template',

						                                'altText' => "If you use LINE in PC, type '..help' command to view this menu",

						                                // The Button Content
						                                'template' => array(

						                                	'type' => "buttons",
						                                	'title' => "Personal Command Menu",
						                                	'text' => "Here's the list of all command you can give me here ~",

						                                	// Action to take between the three
						                                	'actions' => array(
						                                		array(
						                                			'type' => 'message',
						                                			'label' => 'My Link',
						                                			'text' => '..mylink'
						                                		),
						                                		array(
						                                			'type' => 'postback',
						                                			'label' => 'Link',
						                                			'data' => 'personalLink'				                                				
						                                		),
						                                		array(
						                                			'type' => 'postback',
						                                			'label' => 'Unlink',
						                                			'data' => 'personalUnlink'	
						                                		),
						                                		array(
						                                			'type' => 'message',
						                                			'label' => 'Help',
						                                			'text' => '..help'	
						                                		)
						                                	)
						                                )
						                            )
						                        )
						                    ));
											break;

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
													$text_response = "Can't find group with that ID" ;
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
														// Loop through all the that group keyword
														while ($keyword_list = mysqli_fetch_array($check_result)) {
															if ($keyword_list['KEYWORD'] == $exploded_Message[2]) {
																$target_gf_id = $keyword_list['GF_ID'] ;
															}
														}

														if (!isset($target_gf_id)) {
															$text_response = "There's no keyword with that name" ;
														} else {
															// Find GF_ID in Linked Acc to see if it's already linked
															$check_gf_result = "SELECT `GF_ID` FROM `LINKED_ACC` WHERE PERSONAL_ID='" .
																$event['source']['userId'] . "' AND GF_ID='" . $target_gf_id . "'";

															$gf_result = mysqli_query($db, $check_gf_result);
															$gf_result_id = mysqli_fetch_array($gf_result);
															// If there's already the value here, reject the link command
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

									default:
										# code...
										break;

								}	
								
							}

							//////////////////////////////////
							// Only Works On Group Account //
							////////////////////////////////

							if (isset($event['source']['groupId'])) {

								if (file_exists('./temp/' . $event['source']['groupId'] . '.txt')) {
									$file_content = file('./temp/' . $event['source']['groupId'] . '.txt') ;

									if (count($file_content) == 1) {

										switch (trim($file_content[0])) {
											case '..ping':
												file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', $exploded_Message[0] . PHP_EOL , FILE_APPEND | LOCK_EX);
												$final_content = file('./temp/' . $event['source']['groupId'] . '.txt') ;
												$execute_ping = trim( preg_replace( '/\s+/' , ' ', ( implode(" ", $final_content) ) ) ) ;
												$client->pushMessage(array(
							                        'to' => $event['source']['groupId'],
							                        'messages' => array(

							                        	// First Message
							                            array(
							                                'type' => 'template',

							                                'altText' => 'Only applicable in LINE Mobile',

							                                // The Confirm Content
							                                'template' => array(

							                                	'type' => "confirm",
							                                	
							                                	'text' => "You're going to ping ;" . PHP_EOL . PHP_EOL .
							                                				"Ping Name : " . $final_content[1] . PHP_EOL . 
							                                				"Is this correct ?",

							                                	// Action to take between two
							                                	'actions' => array(
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'Yes',
							                                			'text' => $execute_ping
							                                		),
							                                		array(
							                                			'type' => 'postback',
							                                			'label' => 'No',
							                                			'data' => 'cancel',
							                                			'text' => 'No'
							                                		)
							                                	)
							                                )
							                            )
							                        )
							                    ));

												unlink('./temp/' . $event['source']['groupId'] . '.txt');
												
												break;

											case '..create':
												# code...
												break;

											case '..delete':
												# code...
												break;

											case '..rename':
												# code...
												break;

											case '..chgpass':
												# code...
												break;

											case '..chgname':
												# code...
												break;

											case '..revoke':
												# code...
												break;

										}

									} elseif (count($file_content) == 2) {
										
									}

								}
									
								switch ($exploded_Message[0]) {		
									case 'menu':
					                    $client->replyMessage(array(
					                        'replyToken' => $event['replyToken'],
					                        'messages' => array(

					                        	// First Message
					                            array(
					                                'type' => 'template',

					                                'altText' => "If you use LINE in PC, type '..help' command to view this version menu",

					                                // Carousel Header
					                                'template' => array(

					                                	'type' => "carousel",

					                                	// Carousel Object
					                                	'columns' => array(
					                                		
					                                		// Carousel First Object
					                                		array(
					                                			'title' => "Group Menu (1 of 4)",
					                                			'text' => 'Common function of me ~',

					                                			// Action inside of carousel 1
							                                	'actions' => array(
							                                		array(
							                                			'type' => 'postback',
							                                			'label' => 'Ping!',
							                                			'data' => 'groupPing'
							                                		),
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'Ping List',
							                                			'text' => '..list'	
							                                		),
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'Help',
							                                			'text' => '..help'	
							                                		)
							                                	)
					                                		),
					                                		
					                                		// Carousel Second Object
					                                		array(
					                                			'title' => "Group Menu (2 of 4)",
					                                			'text' => 'Command used for Group Management',

					                                			// Action inside of carousel 2
							                                	'actions' => array(
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'Group Info',
							                                			'text' => '..info'
							                                		),
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'Change Callsign',
							                                			'text' => 'To be change callsign function'	
							                                		),
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'Change Pass',
							                                			'text' => 'To be change pass function'	
							                                		)
							                                	)
					                                		),

					                                		// Carousel Third Object
					                                		array(
					                                			'title' => "Group Menu (3 of 4)",
					                                			'text' => 'Command used for Ping Management',

					                                			// Action inside of carousel 3
							                                	'actions' => array(
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'Create Ping',
							                                			'text' => 'To be create ping function'
							                                		),
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'Rename Ping',
							                                			'text' => 'To be rename ping function'	
							                                		),
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'Delete Ping',
							                                			'text' => 'To be delete ping function'	
							                                		)
							                                	)
					                                		),

					                                		// Carousel Fourth Object
					                                		array(
					                                			'title' => "Group Menu (4 of 4)",
					                                			'text' => 'Command used for Group Setup and Feedback',

					                                			// Action inside of carousel 4
							                                	'actions' => array(
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'Revoke',
							                                			'text' => 'To be revoke command function'
							                                		),
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'About Me',
							                                			'text' => 'Information about me'	
							                                		),
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'Feedback Me',
							                                			'text' => 'You can feedback me from one of the following way :'	
							                                		)
							                                	)
					                                		)

					                                	)
					                                )
					                            )
					                        )
					                    ));
										break;

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

											} elseif (!isset($exploded_Message[1]) OR !isset($exploded_Message[2])) {
												$text_response = 'Not enough information to request.' . PHP_EOL . 'Need group callsign and group pass' ;

												$client->replyMessage(array(
							                        'replyToken' => $event['replyToken'],
							                        'messages' => array(
							                            array(
							                                'type' => 'text',
							                                'text' => $text_response
							                            )
							                        )
							                	));
											
											} else {
												$word_count = count($exploded_Message) ;
												$group_pass = $exploded_Message[$word_count-1];
												
												unset($exploded_Message[$word_count-1]);
												unset($exploded_Message[0]);
												
												$callsign = implode(" ", $exploded_Message);

												$query = "INSERT INTO GROUP_INFORMATION (`GROUP_ID`, `PASS`, `GROUP_DESCRIPTION`) VALUES ('" .
													$event['source']['groupId'] . "','" . $group_pass . "','" . $callsign . "')";
												
												mysqli_query($db, $query);

												$registered_id = (int) fm_get_unique_id($event['source']['groupId'], $db) ;

					                    		$client->replyMessage(array(
								                        'replyToken' => $event['replyToken'],
								                        'messages' => array(
								                            array(
								                                'type' => 'text',
								                                'text' => 'Successfully registered'
								                            ), 
								                            array(
								                                'type' => 'text',
								                                'text' => 'Callsign : ' . $callsign . PHP_EOL . 
								                                'Group ID : ' . $registered_id . PHP_EOL . 
								                                'Group Pass : ' . $group_pass
								                            ), 
								                            array(
								                                'type' => 'text',
								                                'text' => 'You can access this again with ..showId'
								                            ) 
								                        )
								                ));
											}

						                    mysqli_close($db);
										
										}
										
										break;

									case '..info' :
										if (isset($event['source']['groupId'])) {

											$search_id_res = (int) fm_get_unique_id( $event['source']['groupId'], $db) ;

				                    		
				                    		if ( $search_id_res === 0 ) {
				                    			$text_response = array(
				                    				'type' => 'text',
							                        'text' => 'Your group is not registered yet'
							                    );

					                    		$client->replyMessage(array(
							                        'replyToken' => $event['replyToken'],
							                        'messages' => array($text_response)
								                ));

				                    		} else {
				                    			$group_callsign = "Callsign : " . fm_get_group_description($event['source']['groupId'], $db);
			                    				$group_id = "ID : " . $search_id_res ;
			                    				$group_pass = "Pass : " . fm_get_pass($event['source']['groupId'], $db);
			                    				
			                    				$format_text1 = $group_callsign . PHP_EOL . $group_id . PHP_EOL . $group_pass ;

			                    				$client->replyMessage(array(
							                        'replyToken' => $event['replyToken'],
							                        'messages' => array(
							                        	// First Message
							                            array(
							                                'type' => 'text',
							                                'text' => $format_text1
							                            ),

							                            // Second Message
							                            array(
							                                'type' => 'text',
							                                'text' => "Here's your group information ~"
							                            ) 
							                        )
							                    ));
				                    		}

				                    		mysqli_close($db);
												
										}
										
										break;

									case '..create' :
										if (isset($event['source']['groupId'])) {
											if (!isset($exploded_Message[1]) OR !isset($exploded_Message[2])) {
												$text_response = 'Not enough information to create one.' . PHP_EOL . 'Need keyword and group pass' ;
											} elseif (count($exploded_Message) == 3) {
												$group_status = fm_check_unique_id($event['source']['groupId'], $db) ;
												if ( $group_status == 0 ) {
													$text_response = "Your group isn't registered yet" ;
												} else {
													$group_pass = fm_check_pass($exploded_Message[2], $event['source']['groupId'], $db);
													if ($group_pass['IS_PASS_MATCH'] == 1) {
														$unique_id = fm_get_unique_id($event['source']['groupId'], $db);
														$check_result = fm_check_keyword($exploded_Message[1], $unique_id, $db);
														if ($check_result == 0) {
															fm_insert_group_function($exploded_Message[1], $unique_id, $db);
															$text_response = "New Ping Created" ;
														} elseif($check_result == 1) {
															$text_response = "Duplicate keyword detected" ;
														}
													} elseif ($group_pass['IS_PASS_MATCH'] == 0) {
														$text_response = 'You entered the wrong password' ;
													} 
												}
											} elseif (count($exploded_Message) > 3){
												$text_response = "Sorry, you can only create keyword with the length of one word. You might want to use underscore instead for the space";
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

									case '..delete':
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
														$check_function = fm_check_gf_id_secure($target_keyword, $group_unique_id, $db);

														if ($check_function['IS_GF_CREATED'] == 0) {
															$text_response = "There's no ping with that keyword" ;
														} elseif ($check_function['IS_GF_CREATED'] == 1) {
															$target_gf_id = fm_get_gf_id_secure($target_keyword, $group_unique_id, $db);
															
															fm_delete_info_via_gf_id($target_gf_id, "LINKED_ACC", $db);
															fm_delete_info_via_gf_id($target_gf_id, "GROUP_FUNCTION", $db);
															
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

									case '..list' :
										if (isset($event['source']['groupId'])) {

											$search_id_res = fm_get_unique_id($event['source']['groupId'], $db) ;
											
											if ($search_id_res === 0) {
												$text_response = "Your group is not registered yet" ;

												$client->replyMessage(array(
									                        'replyToken' => $event['replyToken'],
									                        'messages' => array(
									                            array(
									                                'type' => 'text',
									                                'text' => $text_response
									                            )
									                        )
									            ));
												
											} else {
												$available = fm_check_keyword_available($search_id_res, $db);

												if ($available > 0){
													$text_response = "Registered Keyword" . PHP_EOL . PHP_EOL ;

													$query_result = fm_get_keyword ($search_id_res, $db);

													while ( $query_fetch = mysqli_fetch_array($query_result) ) {
														$text_response .= "> " . $query_fetch['KEYWORD'] . PHP_EOL ;
													}
						                    		
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
												} elseif ($available == 0) {
													$text_response = "Your group does not have any ping yet"; 

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
											}

				                    		mysqli_close($db);
		
										}
										
										break;

									case '..ping':
										if (isset($event['source']['groupId'])) {

											if (!isset($exploded_Message[1])) {
												$text_response = 'Not enough information to ping.' . PHP_EOL . 'Need ping keyword' ;
											} else {
												$register_status = fm_check_group_information($event['source']['groupId'], $db);

												if ($register_status['IS_REGISTERED'] == 1) {
													$group_unique_id = (int) fm_get_unique_id($event['source']['groupId'], $db) ;
													$keyword_status = fm_check_keyword_available($group_unique_id, $db); 

													if ($keyword_status > 0) {
														$target_gf_id = fm_get_gf_id_secure($exploded_Message[1], $group_unique_id, $db);

														if ($target_gf_id == 0) {
															$text_response = "Umm ... no keyword with that name in this group" ;
														} else {

															$personal_id_list = fm_get_personal_id($target_gf_id, $db);

															if ($personal_id_list === 0) {
																$text_response = "Sorry, looks like nobody linked to that ping yet" ;
															} else {
																$target_name = fm_get_group_description($event['source']['groupId'], $db) ;
																$number_of_ping = 0 ;

																if (isset($exploded_Message[2])) {
																	$additional_Message = explode(" ", $message['text'],3);
																	$messages_to_send = $additional_Message[2] ;
																} else {
																	$messages_to_send = "- - Nothing Included - - " ;
																}

																while ($id_to_ping = mysqli_fetch_array($personal_id_list)) {
												                    $client->pushMessage(array(
												                        'to' => $id_to_ping['PERSONAL_ID'],
												                        'messages' => array(
												                            array(
												                                'type' => 'text',
												                                'text' =>  "<NEW PING RECEIVED>" . PHP_EOL . PHP_EOL . 
												                                "From : " . PHP_EOL . "> " . $target_name . PHP_EOL . 
												                                "ID : " . $group_unique_id . PHP_EOL . 
												                                "To : " . $exploded_Message[1] . PHP_EOL . PHP_EOL .
												                                "Message : " . PHP_EOL . $messages_to_send
												                            ),
												                            array(
												                                'type' => 'text',
												                                'text' => "You have a new ping ~"
												                            )
												                        )
												                    ));
												                    $number_of_ping += 1 ;
													            }

													            if (isset($additional_Message)) {
													            	$send_status = "Ping success to " . $number_of_ping . " linked account with additional messages" ;
																} else {
																	$send_status = "Ping success to " . $number_of_ping . " linked account" ;
																}

													            $client->pushMessage(array(
											                        'to' => $event['source']['groupId'],
											                        'messages' => array(
											                            array(
											                                'type' => 'text',
											                                'text' => $send_status
											                            )
											                        )
											                    ));

													            $send_success = 1 ;

															}

														}

													} elseif ($keyword_status == 0) {
														$text_response = "Your group doesn't have any ping yet" ;

													}


												} elseif ($register_status['IS_REGISTERED'] == 0) {
													$text_response = "Your Group Is Not Registered Yet" ;
												}	

											}

						                    mysqli_close($db);

											if (!isset($send_success)) {
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

										}

										break;

									case '..wholink' :
										if (isset($event['source']['groupId'])) {
											if (!isset($exploded_Message[1])) {
												$text_response = 'Not enough information to know who is linked.' . PHP_EOL . 'Need keyword' ;
											} else {
												$check_group = fm_check_unique_id($event['source']['groupId'], $db);
												if ( $check_group == 0 ) {
													$text_response = "Your Group Isn't Registered Yet" ;
												} else {
													$unique_id = fm_get_unique_id($event['source']['groupId'], $db);
													$target_keyword = $exploded_Message[1] ;
													$search_result = fm_get_keyword_secure($target_keyword, $unique_id, $db);
													if ( $search_result === 0) {
														$text_response = "No ping with that name in this group";
														$return_var = 1 ;
													} else {
														$fetch_gf_id = fm_get_gf_id_secure($search_result, $unique_id, $db) ;
														$is_linked_exist = fm_check_linked_id($fetch_gf_id, $db);
														if ($is_linked_exist == 0) {
															$text_response = "Nobody linked to this ping yet" ;
															$return_var = 1 ;
														} elseif ($is_linked_exist == 1) {
															$personal_id_list = fm_get_personal_id($fetch_gf_id, $db);
															$text_response = "People linked to " . $target_keyword . PHP_EOL . PHP_EOL;
															while ($profile_id_to_search = mysqli_fetch_array($personal_id_list)) {
																$result = $client->getProfile($profile_id_to_search['PERSONAL_ID']);
																$result = json_decode($result, true);
																$text_response .= "> " . $result['displayName'] . PHP_EOL;
															}
															$return_var = 2 ;
														}
													}
												}
											}
				                    		mysqli_close($db);

				                    		if ($return_var == 2) {
					                    		$client->replyMessage(array(
								                        'replyToken' => $event['replyToken'],
								                        'messages' => array(
								                            array(
								                                'type' => 'text',
								                                'text' => $text_response
								                            ),
								                            array(
								                                'type' => 'text',
								                                'text' => "Here's all the people linked to that ping~"
								                            )
								                        )
								                ));
				                    		} elseif ($return_var == 1) {
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
										}
										
										break;

									case '..revoke':
										if (isset($event['source']['groupId'])) {
											
											if (!isset($exploded_Message[1])) {
												$text_response = 'Not enough information to remove account.' . PHP_EOL . 'Need group pass' ;
											} else {											
												$inserted_pass = $exploded_Message[1] ;
												$check_status = fm_check_group_information($event['source']['groupId'], $db);

												if ($check_status['IS_REGISTERED'] == 0) {
													$text_response = "Your group is not registered yet" ;

												} elseif ($check_status['IS_REGISTERED'] == 1) {
													$fetch_pass = fm_check_pass($inserted_pass, $event['source']['groupId'], $db);

													if ($fetch_pass['IS_PASS_MATCH'] == 0) {
														$text_response = "You entered the wrong password. Please check again" ;
													} elseif ($fetch_pass['IS_PASS_MATCH'] == 1) {
														$target_unique_id = fm_get_unique_id($event['source']['groupId'], $db);
														$target_gf_id_list = fm_get_gf_id_array($target_unique_id, $db);

														while ($gf_to_delete = mysqli_fetch_array($target_gf_id_list)) {
															fm_delete_info_via_gf_id($gf_to_delete['GF_ID'], "LINKED_ACC", $db);
														}
														fm_delete_info_via_unique_id($target_unique_id, "GROUP_FUNCTION", $db);
														fm_delete_info_via_unique_id($target_unique_id, "GROUP_INFORMATION", $db);
														
														$text_response = "Group Successfully Removed";	
													
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
									
									default:
										# code...
										break;
								}	

							}

							/////////////////////////////////////////	
							// Works On Personal and Group Account//
							///////////////////////////////////////

							switch ($exploded_Message[0]) {
								
								///////////////////////////////////////////////////////////
								// Content Following The Account Type (Personal / Group)//
								/////////////////////////////////////////////////////////

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
					                                'text' => "~COMMAND EXPLANATION~" . PHP_EOL . PHP_EOL . $text_response
					                            ),
					                            array(
					                                'type' => 'text',
					                                'text' => "Here's the explanation of commands i can do here ~"
					                            )
					                        )
					                ));

									break;
								
								//////////////////////////////
								// When nothing is similar //
								////////////////////////////

								// default: 
								// 	if (isset($event['source']['userId'])) {
								// 		$client->replyMessage(array(
							 //                        'replyToken' => $event['replyToken'],
							 //                        'messages' => array(
							 //                            array(
							 //                                'type' => 'text',
							 //                                'text' => $confused_reaction[rand(0, $number_of_reaction - 1)]
							 //                            )
							 //                        )
							 //                ));
								// 	} 
									
								// 	break;
							}

							if (substr($message['text'], 0, 2) === "..") {
								fm_create_log_data($event['source'], $message['text']);		
							}
						
							if (is_resource($db) && get_resource_type($db) === 'mysql link') {
								mysqli_close($db);
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

            // Postback Event
        	case 'postback':
        		switch ($event['postback']['data']) {
        			// For Personal User
        			case 'personalLink':
        				file_put_contents('./temp/' . $event['source']['userId'] . '.txt', '..link' . PHP_EOL , LOCK_EX);
        				$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => 'Please enter your group ID now'
	                            )
	                        )
	                	));
        				break;

    				case 'personalUnlink':
					  	file_put_contents('./temp/' . $event['source']['userId'] . '.txt', '..unlink' . PHP_EOL , LOCK_EX);
        				$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => 'Please enter your group ID now'
	                            )
	                        )
	                	));
    					break;

					// For Group User
					case 'groupPing':
						file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', '..ping' . PHP_EOL , LOCK_EX);
        				$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => 'Please enter the ping name now'
	                            )
	                        )
	                	));
						break;

					// Universal Cancel Postback        			
					case 'cancel':
						$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => 'Okay, please pick the menu again to input a new one'
	                            )
	                        )
	                	));
						break;

        			default:
        				# code...
        				break;
        		}
        		break;
	
	        default:
	            error_log("Unsupporeted event type: " . $event['type']);
	            break;
	    }
	};
	
?>