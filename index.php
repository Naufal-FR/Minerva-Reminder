<!DOCTYPE html>
<html>
<head>
	<meta name="dicoding:email" content="amx.idproject28@gmail.com">
</head>
</html>

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
							// usleep(1000000);

							usleep(250000);

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

						                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

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

						                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

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

						                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

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

										case '..response2':
											$additional_Message = explode(" ", $message['text'],2);
											$messages_to_send = $additional_Message[1] ;
											$client->pushMessage(array(
						                        'to' => 'Cbb634a613ad4c12b24c73398f9f38687',
						                        'messages' => array(
						                            array(
						                                'type' => 'text',
						                                'text' => $messages_to_send
						                            )
						                        )
						                    ));
											break;

										case '..simg':
											switch ($exploded_Message[1]) {
												case 'pulang':
													$ori = 'https://i.imgur.com/WyVgDvF.jpg' ;
													$ori_preview = 'https://i.imgur.com/WyVgDvFt.jpg' ;
													break;

												case 'angry':
													$ori = 'https://i.imgur.com/ySDiUST.jpg' ;
													$ori_preview = 'https://i.imgur.com/ySDiUSTt.jpg' ;
													break;

												case 'deal':
													$ori = 'https://i.imgur.com/D9bZ383.jpg' ;
													$ori_preview = 'https://i.imgur.com/D9bZ383t.jpg' ;
													break;

												case 'sorry':
													$ori = 'https://i.imgur.com/UG6QclK.jpg' ;
													$ori_preview = 'https://i.imgur.com/UG6QclK.jpg' ;
													break;

												case 'myself':
													$ori = 'https://i.imgur.com/uCGFC0l.jpg' ;
													$ori_preview = 'https://i.imgur.com/uCGFC0lt.jpg' ;
													break;

												case 'dazed':
													$ori = 'https://i.imgur.com/WI4k3QL.jpg' ;
													$ori_preview = 'https://i.imgur.com/WI4k3QLt.jpg' ;
													break;
											}

											$client->pushMessage(array(
						                        'to' => 'Cbb634a613ad4c12b24c73398f9f38687',
						                        'messages' => array(
						                            array(
						                                'type' => 'image',
						                                'originalContentUrl' => $ori,
						                                'previewImageUrl' => $ori_preview
						                            )
						                        )
						                    ));
											break;

										case 'test1':
											$client->pushMessage(array(
						                        'to' => $event['source']['userId'],
						                        'messages' => array(
						                            array(
						                                'type' => 'text',
						                                'text' => $group_array_help[0]
						                            )
						                        )
						                    ));
											break;

									}	

								}

								// Interactive Component
								if (file_exists('./temp/' . $event['source']['userId'] . '.txt')) {
									$file_content = file('./temp/' . $event['source']['userId'] . '.txt') ;

									if (count($file_content) == 1) {
										$group_id = $exploded_Message[0] ;
										file_put_contents('./temp/' . $event['source']['userId'] . '.txt', $group_id . PHP_EOL , FILE_APPEND | LOCK_EX);

										if (trim($file_content[0]) == "..subs") {
											$detail = "subs" ;
										} elseif (trim($file_content[0]) == "..unsubs") {
											$detail = "unsubs" ;
										} 
										
										$client->pushMessage(array(
					                        'to' => $event['source']['userId'],
					                        'messages' => array(
					                            array(
					                                'type' => 'text',
					                                'text' => "Please enter the subscription name you want to " . $detail . " now"
					                            )
					                        )
					                    ));

									} elseif (count($file_content) == 2) {
										$mention_name = $exploded_Message[0] ;
										file_put_contents('./temp/' . $event['source']['userId'] . '.txt', $mention_name . PHP_EOL , FILE_APPEND | LOCK_EX);
										
										$final_content = file('./temp/' . $event['source']['userId'] . '.txt') ;
										$execute_link = trim( preg_replace( '/\s+/' , ' ', ( implode(" ", $final_content) ) ) ) ;

										if (trim($final_content[0]) == "..subs") {
											$execute_type = "subs to" ;
										} elseif (trim($final_content[0]) == "..unsubs") {
											$execute_type = "unsubs from" ;
										} 

										$client->pushMessage(array(
					                        'to' => $event['source']['userId'],
					                        'messages' => array(

					                        	// First Message
					                            array(
					                                'type' => 'template',

					                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

					                                // The Confirm Content
					                                'template' => array(

					                                	'type' => "confirm",
					                                	
					                                	'text' => "You're going to " . $execute_type .  ";" . PHP_EOL . PHP_EOL .
					                                				"Group ID : " . $final_content[1] .  
					                                				"Subscription Name :" . PHP_EOL . $final_content[2] . PHP_EOL . 
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

								// Core Function
								switch ($exploded_Message[0]) {		
									case 'menu':
						                    $client->replyMessage(array(
						                        'replyToken' => $event['replyToken'],
						                        'messages' => array(

						                        	// First Message
						                            array(
						                                'type' => 'template',

						                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

						                                // The Button Content
						                                'template' => array(

						                                	'type' => "buttons",
						                                	'title' => "Personal Command Menu",
						                                	'text' => "Here's the list of all command you can give me here ~",

						                                	// Action to take between the three
						                                	'actions' => array(
						                                		array(
						                                			'type' => 'message',
						                                			'label' => 'My Subscription',
						                                			'text' => '..mysubs'
						                                		),
						                                		array(
						                                			'type' => 'message',
						                                			'label' => 'Subscribe to',
						                                			'text' => '..personalSubs'				                                				
						                                		),
						                                		array(
						                                			'type' => 'message',
						                                			'label' => 'Unsubscribe',
						                                			'text' => '..personalUnsubs'	
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

									case '..mysubs' :
										$showId_query = "SELECT GF.UNIQUE_ID, GF.KEYWORD, GI.GROUP_DESCRIPTION FROM GROUP_FUNCTION GF, LINKED_ACC LA, GROUP_INFORMATION GI ". 
											"WHERE GF.GF_ID = LA.GF_ID AND GI.UNIQUE_ID = GF.UNIQUE_ID AND LA.PERSONAL_ID ='" . 
											$event['source']['userId'] . "'" ;

										$query_result = mysqli_query($db, $showId_query);

										if ( mysqli_num_rows($query_result) == 0 ) {
											$text_response = "You don't have any subscription yet" ;
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
											$text_response = "Subscription List" . PHP_EOL . PHP_EOL ;

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

				                    		$client->replyMessage(array(
							                        'replyToken' => $event['replyToken'],
							                        'messages' => array(
							                            array(
							                                'type' => 'text',
							                                'text' => $text_response
							                            ),
							                            array(
							                                'type' => 'text',
							                                'text' => "Here's all your personal subscription~"
							                            )
							                        )
							                ));
										}
				                    	
				                    	mysqli_close($db);

										break;

									case '..subs' :
										// 1 = Group Unique ID | 2 = Keyword
										if (!isset($exploded_Message[1]) OR !isset($exploded_Message[2])) {
											$text_response = 'Not enough information to subscribe.' . PHP_EOL . PHP_EOL . 'Need group ID and subscription name' ;
										
										} else {
											// Checks if the ID exist

											if ( fm_check_gf_id($exploded_Message[1], $db) == 0 ) {
												$text_response = "Can't find group with that ID" ;
											} else {
												// Get the number of mention on that ID
												$number_of_mention = fm_check_keyword_available($exploded_Message[1], $db);

												// If there's no result even though group account registered
												if ($number_of_mention == 0) {
													$text_response = "That group doesn't have any subscription yet" ;
												} else {
													// Loop through all the that group keyword
													$check_result = fm_get_keyword($exploded_Message[1], $db);
													$found = 0 ;
													while ($keyword_list = mysqli_fetch_array($check_result) AND $found == 0) {
														// If there's the same keyword with the one inputted, take the gf_id of that keyword
														if ($keyword_list['KEYWORD'] == $exploded_Message[2]) {
															$target_gf_id = fm_get_gf_id_secure($keyword_list['KEYWORD'], $exploded_Message[1], $db) ;
															$found = 1 ;
														}
													}
													if ($found == 0) {
														$text_response = "There's no subscription with that name" ;
													} else {
														// Checks the gf_id in the personal account to see if it's already subscribed
														$already_subscribed = fm_check_linked_id_secure($target_gf_id, $event['source']['userId'], $db);
														// If there's already the value here, reject the link command
														if ($already_subscribed == 1) {
															$text_response = "You already subscribed to it" ;
														} else {
															fm_insert_linked_acc($target_gf_id, $event['source']['userId'], $db);
															$text_response = "Successfully subscribed" ;	
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
										break;
									
									case '..unsubs' :
										if (!isset($exploded_Message[1]) OR !isset($exploded_Message[2])) {
											$text_response = 'Not enough information to unsubscribe.' . PHP_EOL . PHP_EOL . 'Need group ID and subscription name' ;
										
										} else {
											$target_unique_id = $exploded_Message[1] ;
											$target_keyword = $exploded_Message[2] ;

											$get_query = "SELECT `GF_ID` FROM `GROUP_FUNCTION` WHERE UNIQUE_ID='" . $target_unique_id . "' AND KEYWORD='" . $target_keyword . "'" ;
											$get_result = mysqli_query($db, $get_query) ;
											$counter = mysqli_num_rows($get_result);
											if ($counter == 0) {
												$text_response = "There's no group with that ID or that specific subscription" ;
											} else {
												$get_fetch = mysqli_fetch_array($get_result) ;
												$check_delete = "SELECT COUNT(*) AS `IS_LINKED` FROM LINKED_ACC WHERE GF_ID ='" . 
													$get_fetch['GF_ID'] . "' AND PERSONAL_ID ='" . $event['source']['userId'] . "'" ;

												$check_result = mysqli_query($db, $check_delete); 
												$check_status = mysqli_fetch_array($check_result);

												if ($check_status['IS_LINKED'] == 0) {
													$text_response = "You're not subscribed to it in the first place" ;
												} elseif ($check_status['IS_LINKED'] == 1) {
													$delete_query = "DELETE FROM LINKED_ACC WHERE GF_ID ='" . $get_fetch['GF_ID'] . "' AND PERSONAL_ID ='" . $event['source']['userId'] . "'" ;
													$delete_result = mysqli_query($db, $delete_query);
													$text_response = "Unsubscribe success" ;	
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
										break;

				        			case '..personalSubs':
				        				file_put_contents('./temp/' . $event['source']['userId'] . '.txt', '..subs' . PHP_EOL , LOCK_EX);
				        				$client->replyMessage(array(
					                        'replyToken' => $event['replyToken'],
					                        'messages' => array(
					                            array(
					                                'type' => 'text',
					                                'text' => 'Please enter the group ID now'
					                            )
					                        )
					                	));
				        				break;

				    				case '..personalUnsubs':
									  	file_put_contents('./temp/' . $event['source']['userId'] . '.txt', '..unsubs' . PHP_EOL , LOCK_EX);
				        				$client->replyMessage(array(
					                        'replyToken' => $event['replyToken'],
					                        'messages' => array(
					                            array(
					                                'type' => 'text',
					                                'text' => 'Please enter the group ID now'
					                            )
					                        )
					                	));
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

								// Interactive Component
								if (file_exists('./temp/' . $event['source']['groupId'] . '.txt')) {
									$file_content = file('./temp/' . $event['source']['groupId'] . '.txt') ;

									if (count($file_content) == 1) {

										switch (trim($file_content[0])) {
											case '..request':
												$new_group_name = $message['text'] ;
												file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', $new_group_name . PHP_EOL , FILE_APPEND | LOCK_EX);
												
												$client->pushMessage(array(
							                        'to' => $event['source']['groupId'],
							                        'messages' => array(
							                            array(
							                                'type' => 'text',
							                                'text' => "Please enter your new group pass now." . PHP_EOL . PHP_EOL . 
							                                "Notes :" . PHP_EOL .  
							                                "> You can only use ONE WORD LENGTH of pass for now." . PHP_EOL . 
							                                "> This will be used in some commands to avoid accidental execution." . PHP_EOL . 
							                                "> You can easily changes it later too."
							                            )
							                        )
							                    ));
												break;


											case '..create':
												$new_ping = $exploded_Message[0] ;
												file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', $new_ping . PHP_EOL , FILE_APPEND | LOCK_EX);
												
												$client->pushMessage(array(
							                        'to' => $event['source']['groupId'],
							                        'messages' => array(
							                            array(
							                                'type' => 'text',
							                                'text' => "Please enter your group pass now"
							                            )
							                        )
							                    ));
												break;

											case '..delete':
												$delete_ping = $exploded_Message[0] ;
												file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', $delete_ping . PHP_EOL , FILE_APPEND | LOCK_EX);
												
												$client->pushMessage(array(
							                        'to' => $event['source']['groupId'],
							                        'messages' => array(
							                            array(
							                                'type' => 'text',
							                                'text' => "Please enter your group pass now"
							                            )
							                        )
							                    ));
												break;

											case '..rename':
												$old_name = $exploded_Message[0] ;
												file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', $old_name . PHP_EOL , FILE_APPEND | LOCK_EX);
												
												$client->pushMessage(array(
							                        'to' => $event['source']['groupId'],
							                        'messages' => array(
							                            array(
							                                'type' => 'text',
							                                'text' => "Please enter the new mention name now (you cannot have a space in it)"
							                            )
							                        )
							                    ));
												break;

											case '..chgpass':
												$new_pass = $exploded_Message[0] ;
												file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', $new_pass . PHP_EOL , FILE_APPEND | LOCK_EX);
												
												$final_content = file('./temp/' . $event['source']['groupId'] . '.txt') ;
												$execute_ping = trim( preg_replace( '/\s+/' , ' ', ( implode(" ", $final_content) ) ) ) ;

												$client->pushMessage(array(
							                        'to' => $event['source']['groupId'],
							                        'messages' => array(

							                        	// First Message
							                            array(
							                                'type' => 'template',

							                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

							                                // The Confirm Content
							                                'template' => array(

							                                	'type' => "confirm",
							                                	
							                                	'text' => "You're going to change group pass into " . $final_content[1] . PHP_EOL . 
							                                				"Is it okay ?",

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
												break;

											case '..chgname':
												$new_nick = $message['text'] ;
												file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', $new_nick . PHP_EOL , FILE_APPEND | LOCK_EX);
												
												$client->pushMessage(array(
							                        'to' => $event['source']['groupId'],
							                        'messages' => array(
							                            array(
							                                'type' => 'text',
							                                'text' => "Please enter your group pass now"
							                            )
							                        )
							                    ));
												break;

											case '..revoke':
												file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', $exploded_Message[0] . PHP_EOL , FILE_APPEND | LOCK_EX);
												$final_content = file('./temp/' . $event['source']['groupId'] . '.txt') ;
												$execute_ping = trim( preg_replace( '/\s+/' , ' ', ( implode(" ", $final_content) ) ) ) ;
												$client->pushMessage(array(
							                        'to' => $event['source']['groupId'],
							                        'messages' => array(

							                        	// First Message
							                            array(
							                                'type' => 'template',

							                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

							                                // The Confirm Content
							                                'template' => array(

							                                	'type' => "confirm",
							                                	'text' => "[WARNING]" . PHP_EOL . "This command will delete all data about your group!" . PHP_EOL .
							                                				"Are you sure about this ?",

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

											case '..whosubs':
												file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', $exploded_Message[0] . PHP_EOL , FILE_APPEND | LOCK_EX);
												$final_content = file('./temp/' . $event['source']['groupId'] . '.txt') ;
												$execute_ping = trim( preg_replace( '/\s+/' , ' ', ( implode(" ", $final_content) ) ) ) ;
												$client->pushMessage(array(
							                        'to' => $event['source']['groupId'],
							                        'messages' => array(

							                        	// First Message
							                            array(
							                                'type' => 'template',

							                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

							                                // The Confirm Content
							                                'template' => array(

							                                	'type' => "confirm",
							                                	'text' => "This command will find all the people subbed to [" . $exploded_Message[0] . "]" . PHP_EOL .
							                                				"Confirm ?" . PHP_EOL . PHP_EOL . "*PS : This may take awhile depending on how many they are",

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
										}

									} elseif (count($file_content) == 2) {

										switch (trim($file_content[0])) {
											case '..request':
												file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', $exploded_Message[0] . PHP_EOL , FILE_APPEND | LOCK_EX);
												$final_content = file('./temp/' . $event['source']['groupId'] . '.txt') ;
												$execute_ping = trim( preg_replace( '/\s+/' , ' ', ( implode(" ", $final_content) ) ) ) ;
												$client->pushMessage(array(
							                        'to' => $event['source']['groupId'],
							                        'messages' => array(

							                        	// First Message
							                            array(
							                                'type' => 'template',

							                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

							                                // The Confirm Content
							                                'template' => array(

							                                	'type' => "confirm",
							                                	
							                                	'text' => "You're going to register your group with these information;" . PHP_EOL . PHP_EOL .
							                                				"Group Nickname : " . PHP_EOL . $final_content[1] . PHP_EOL . 
							                                				"Group Pass : " . PHP_EOL . $final_content[2] . PHP_EOL .
							                                				"Proceed ?",

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
												file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', $exploded_Message[0] . PHP_EOL , FILE_APPEND | LOCK_EX);
												$final_content = file('./temp/' . $event['source']['groupId'] . '.txt') ;
												$execute_ping = trim( preg_replace( '/\s+/' , ' ', ( implode(" ", $final_content) ) ) ) ;
												$client->pushMessage(array(
							                        'to' => $event['source']['groupId'],
							                        'messages' => array(

							                        	// First Message
							                            array(
							                                'type' => 'template',

							                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

							                                // The Confirm Content
							                                'template' => array(

							                                	'type' => "confirm",
							                                	
							                                	'text' => "You're going to create a new mention called ;" . PHP_EOL . PHP_EOL .
							                                				"New Mention : " . $final_content[1] . PHP_EOL . 
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

											case '..delete':
												file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', $exploded_Message[0] . PHP_EOL , FILE_APPEND | LOCK_EX);
												$final_content = file('./temp/' . $event['source']['groupId'] . '.txt') ;
												$execute_ping = trim( preg_replace( '/\s+/' , ' ', ( implode(" ", $final_content) ) ) ) ;
												$client->pushMessage(array(
							                        'to' => $event['source']['groupId'],
							                        'messages' => array(

							                        	// First Message
							                            array(
							                                'type' => 'template',

							                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

							                                // The Confirm Content
							                                'template' => array(

							                                	'type' => "confirm",
							                                	
							                                	'text' => "You're going to delete a mention called ;" . PHP_EOL . PHP_EOL .
							                                				"Mention Name : " . $final_content[1] . PHP_EOL . 
							                                				"Is this okay ?",

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

											case '..rename':
												$new_name = $exploded_Message[0] ;
												file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', $new_name . PHP_EOL , FILE_APPEND | LOCK_EX);
												
												$client->pushMessage(array(
							                        'to' => $event['source']['groupId'],
							                        'messages' => array(
							                            array(
							                                'type' => 'text',
							                                'text' => "Please enter your group pass now"
							                            )
							                        )
							                    ));
												break;

											case '..chgname':
												file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', $exploded_Message[0] . PHP_EOL , FILE_APPEND | LOCK_EX);
												$final_content = file('./temp/' . $event['source']['groupId'] . '.txt') ;
												$execute_ping = trim( preg_replace( '/\s+/' , ' ', ( implode(" ", $final_content) ) ) ) ;
												$client->pushMessage(array(
							                        'to' => $event['source']['groupId'],
							                        'messages' => array(

							                        	// First Message
							                            array(
							                                'type' => 'template',

							                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

							                                // The Confirm Content
							                                'template' => array(

							                                	'type' => "confirm",
							                                	
							                                	'text' => "You're going to change group nickname into ;" . PHP_EOL . PHP_EOL . 
							                                				"New Name : " . $final_content[1] . PHP_EOL . 
							                                				"Is it okay ?",

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
										}
									
									} elseif (count($file_content) == 3) {
										switch (trim($file_content[0])) {
											case '..rename':
												file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', $exploded_Message[0] . PHP_EOL , FILE_APPEND | LOCK_EX);
												$final_content = file('./temp/' . $event['source']['groupId'] . '.txt') ;
												$execute_ping = trim( preg_replace( '/\s+/' , ' ', ( implode(" ", $final_content) ) ) ) ;
												$client->pushMessage(array(
							                        'to' => $event['source']['groupId'],
							                        'messages' => array(

							                        	// First Message
							                            array(
							                                'type' => 'template',

							                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

							                                // The Confirm Content
							                                'template' => array(

							                                	'type' => "confirm",
							                                	
							                                	'text' => "You're going to change mention name ;" . PHP_EOL . PHP_EOL . 
							                                				"Old Name : " . $final_content[1] . PHP_EOL .
							                                				"New Name : " . $final_content[2] . PHP_EOL . 
							                                				"Is it okay ?",

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
										}
									
									}

								}
									
								// Core Function

								// @ Function, A Mirror Of Ping 
								if (substr($exploded_Message[0], 0, 1) == '@') {
									$removed_at = substr($exploded_Message[0], 1);

									if (isset($exploded_Message[1])) {
										$extra_message = explode(" ", $message['text'], 2);
										$exploded_Message = array('@', $removed_at, $extra_message[1]);
									} else {
										$exploded_Message = array('@', $removed_at);
									}

									$register_status = fm_check_group_information($event['source']['groupId'], $db);

									if ($register_status['IS_REGISTERED'] == 1) {
										$group_unique_id = (int) fm_get_unique_id($event['source']['groupId'], $db) ;
										$keyword_status = fm_check_keyword_available($group_unique_id, $db); 

										if ($keyword_status > 0) {
											$target_gf_id = fm_get_gf_id_secure($exploded_Message[1], $group_unique_id, $db);

											if ($target_gf_id == 0) {
												$text_response = "Umm ... no mention with that name in this group" ;
											} else {

												$personal_id_list = fm_get_personal_id($target_gf_id, $db);

												if ($personal_id_list === 0) {
													$text_response = "Sorry, looks like nobody subbed to that mention yet" ;
												} else {
													$target_name = fm_get_group_description($event['source']['groupId'], $db) ;
													$number_of_ping = 0 ;

													if (isset($extra_message[1])) {
														$messages_to_send = $extra_message[1] ;
													} else {
														$messages_to_send = "- - Nothing Included - - " ;
													}

													while ($id_to_ping = mysqli_fetch_array($personal_id_list)) {
									                    $client->pushMessage(array(
									                        'to' => $id_to_ping['PERSONAL_ID'],
									                        'messages' => array(
									                            array(
									                                'type' => 'text',
									                                'text' =>  "~NEW MESSAGE~" . PHP_EOL . PHP_EOL . 
									                                "Subject : " . $exploded_Message[1] . PHP_EOL .
									                                "From     : " . $target_name . PHP_EOL . PHP_EOL .
									                                // "ID : " . $group_unique_id . PHP_EOL . 
									                                "Message : " . PHP_EOL . $messages_to_send
									                            ),
									                            array(
									                                'type' => 'text',
									                                'text' => "You have a new mention~"
									                            )
									                        )
									                    ));
									                    $number_of_ping += 1 ;
										            }

										            if (isset($extra_message[1])) {
										            	$send_status = "Mention success to " . $number_of_ping . " subbed account with additional messages" ;
													} else {
														$send_status = "Mention success to " . $number_of_ping . " subbed account" ;
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
											$text_response = "Your group doesn't have any mention yet" ;

										}


									} elseif ($register_status['IS_REGISTERED'] == 0) {
										$text_response = "Your Group Is Not Registered Yet" ;
									}	

				                    mysqli_close($db);

									if (isset($send_success)) {
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

								// Standard Core Function
								} else {
									switch ($exploded_Message[0]) {		
										
										case 'menu':

											if (fm_check_unique_id($event['source']['groupId'], $db) == 0) {
							                    $client->replyMessage(array(
							                        'replyToken' => $event['replyToken'],
							                        'messages' => array(

							                        	// First Message
							                            array(
							                                'type' => 'template',

							                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

							                                // The Button Content
							                                'template' => array(

							                                	'type' => "buttons",
							                                	'title' => "Initial Group Menu",
							                                	'text' => "Please register your group first via this menu below~",

							                                	// Action to take between the three
							                                	'actions' => array(
							                                		array(
							                                			'type' => 'postback',
							                                			'label' => 'Register Group',
							                                			'data' => 'groupRegister'
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
											} else {

												$client->replyMessage(array(
								                        'replyToken' => $event['replyToken'],
								                        'messages' => array(

								                        	// First Message
								                            array(
								                                'type' => 'template',

								                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

								                                // The Button Content
								                                'template' => array(

								                                	'type' => "buttons",
								                                	'title' => "Groups Main Menu",
								                                	'text' => "Here's the list of command categories you can give~",

								                                	// Action to take between the three
								                                	'actions' => array(
								                                		array(
								                                			'type' => 'uri',
								                                			'label' => 'Video Guides',
								                                			'uri' => "https://www.youtube.com/watch?v=8Sc6oQ3kWi0&list=PLeYOjd5ex5m3_Nw9LaeL2hMsdPqMbMbpL"
								                                		),
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Manage Mention',
								                                			'text' => '..manageMention'				                                				
								                                		),
								                                		array(
								                                			'type' => 'message',
								                                			'label' => 'Group Settings',
								                                			'text' => '..manageGroup'	
								                                		),
								                                		array(
								                                			'type' => 'message',
								                                			'label' => "Help & Miscellaneous",
								                                			'text' => '..helpGroup'	
								                                		)
								                                	)
								                                )
								                            )
								                        )
								                    ));

											}

											break;

										case 'oldMenu':

											if (fm_check_unique_id($event['source']['groupId'], $db) == 0) {
							                    $client->replyMessage(array(
							                        'replyToken' => $event['replyToken'],
							                        'messages' => array(

							                        	// First Message
							                            array(
							                                'type' => 'template',

							                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

							                                // The Button Content
							                                'template' => array(

							                                	'type' => "buttons",
							                                	'title' => "Personal Command Menu",
							                                	'text' => "Here's the list of all command you can give me here ~",

							                                	// Action to take between the three
							                                	'actions' => array(
							                                		array(
							                                			'type' => 'postback',
							                                			'label' => 'Register Group',
							                                			'data' => 'groupRegister'
							                                		),
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'Help',
							                                			'text' => '..help'				                                				
							                                		),
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'About Me',
							                                			'text' => '..about'	
							                                		)
							                                	)
							                                )
							                            )
							                        )
							                    ));
											} else {
							                    $client->replyMessage(array(
							                        'replyToken' => $event['replyToken'],
							                        'messages' => array(

							                        	// First Message
							                            array(
							                                'type' => 'template',

							                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

							                                // Carousel Header
							                                'template' => array(

							                                	'type' => "carousel",

							                                	// Carousel Object
							                                	'columns' => array(
							                                		
							                                		// Carousel First Object
							                                		array(
							                                			'title' => "Group Menu (1 of 5)",
							                                			'text' => 'Most common command you might want to use',

							                                			// Action inside of carousel 1
									                                	'actions' => array(
									                                		array(
									                                			'type' => 'postback',
									                                			'label' => 'How To Mention ?',
									                                			'data' => 'howMention'
									                                		),
									                                		array(
									                                			'type' => 'message',
									                                			'label' => 'Mention List',
									                                			'text' => '..list'	
									                                		),
									                                		array(
									                                			'type' => 'message',
									                                			'label' => 'Group Info',
									                                			'text' => '..info'	
									                                		)
									                                	)
							                                		),
							                                		
							                                		// Carousel Second Object
							                                		array(
							                                			'title' => "Group Menu (2 of 5)",
							                                			'text' => 'Command used for Mention Management',

							                                			// Action inside of carousel 2
									                                	'actions' => array(
									                                		array(
									                                			'type' => 'postback',
									                                			'label' => 'Create Mention',
									                                			'data' => 'groupCreate'
									                                		),
									                                		array(
									                                			'type' => 'postback',
									                                			'label' => 'Rename Mention',
									                                			'data' => 'renamePing'	
									                                		),
									                                		array(
									                                			'type' => 'postback',
									                                			'label' => 'Delete Mention',
									                                			'data' => 'groupDelete'	
									                                		)
									                                	)
							                                		),

							                                		// Carousel Third Object
							                                		array(
							                                			'title' => "Group Menu (3 of 5)",
							                                			'text' => 'Additional Command for your group',

							                                			// Action inside of carousel 3
									                                	'actions' => array(
									                                		array(
									                                			'type' => 'postback',
									                                			'label' => 'Who Subs',
									                                			'data' => 'whoSubsTo'	
									                                		),
									                                		array(
									                                			'type' => 'postback',
									                                			'label' => 'Random Facts',
									                                			'data' => 'randomFact'	
									                                		),
									                                		array(
									                                			'type' => 'postback',
									                                			'label' => '~Reserved~',
									                                			'data' => "reserved"	
									                                		)
									                                	)
							                                		),

							                                		// Carousel Fourth Object
							                                		array(
							                                			'title' => "Group Menu (4 of 5)",
							                                			'text' => "Command used for Group Settings",

							                                			// Action inside of carousel 4
							                                			'actions' => array(
									                                		array(
									                                			'type' => 'postback',
									                                			'label' => 'Change Nickname',
									                                			'data' => 'changeNickname'	
									                                		),
									                                		array(
									                                			'type' => 'postback',
									                                			'label' => 'Change Pass',
									                                			'data' => 'changePass'	
									                                		),
									                                		array(
									                                			'type' => 'postback',
									                                			'label' => 'Delete Group',
									                                			'data' => 'groupRevoke'	
									                                		)
									                                	)
							                                		),

							                                		// Carousel Fifth Object
							                                		array(
							                                			'title' => "Group Menu (5 of 5)",
							                                			'text' => "Command used for Bot Feedback & Help",

							                                			// Action inside of carousel 5
									                                	'actions' => array(
									                                		array(
									                                			'type' => 'message',
									                                			'label' => 'Help',
									                                			'text' => '..helpPC'	
									                                		),
									                                		array(
									                                			'type' => 'message',
									                                			'label' => 'About Me',
									                                			'text' => '..about'	
									                                		),
									                                		array(
									                                			'type' => 'uri',
									                                			'label' => 'Feedback Me',
									                                			'uri' => "mailto:minerva.bot.developer@gmail.com?subject=Feedback%20For%20Minerva"	
									                                		)
									                                	)
							                                		)

							                                	)
							                                )
							                            )
							                        )
							                    ));

											}

											break;

										case '..manageMention':
											$client->replyMessage(array(
							                        'replyToken' => $event['replyToken'],
							                        'messages' => array(

							                        	// First Message
							                            array(
							                                'type' => 'template',

							                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

							                                // The Button Content
							                                'template' => array(

							                                	'type' => "buttons",
							                                	'title' => "Group Mention Management",
							                                	'text' => "List of commands used to manage your group mention~",

							                                	// Action to take between the three
							                                	'actions' => array(
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'Mention List',
							                                			'text' => '..list'	
							                                		),
							                                		array(
							                                			'type' => 'postback',
							                                			'label' => 'Create Mention',
							                                			'data' => 'groupCreate'
							                                		),
							                                		array(
							                                			'type' => 'postback',
							                                			'label' => 'Rename Mention',
							                                			'data' => 'renamePing'	
							                                		),
							                                		array(
							                                			'type' => 'postback',
							                                			'label' => 'Delete Mention',
							                                			'data' => 'groupDelete'	
							                                		)
							                                	)
							                                )
							                            )
							                        )
							                    ));
											break;

										case '..manageGroup':
											$client->replyMessage(array(
							                        'replyToken' => $event['replyToken'],
							                        'messages' => array(

							                        	// First Message
							                            array(
							                                'type' => 'template',

							                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

							                                // The Button Content
							                                'template' => array(

							                                	'type' => "buttons",
							                                	'title' => "Group Settings",
							                                	'text' => "List of commands to see and change your group setting~",

							                                	// Action to take between the three
							                                	'actions' => array(
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'Group Info',
							                                			'text' => '..info'	
							                                		),
							                                		array(
							                                			'type' => 'postback',
							                                			'label' => 'Change Nickname',
							                                			'data' => 'changeNickname'	
							                                		),
							                                		array(
							                                			'type' => 'postback',
							                                			'label' => 'Change Pass',
							                                			'data' => 'changePass'	
							                                		),
							                                		array(
							                                			'type' => 'postback',
							                                			'label' => 'Delete Group',
							                                			'data' => 'groupRevoke'	
							                                		)
							                                	)
							                                )
							                            )
							                        )
							                    ));
											break;

										case '..helpGroup':
											$client->replyMessage(array(
							                        'replyToken' => $event['replyToken'],
							                        'messages' => array(

							                        	// First Message
							                            array(
							                                'type' => 'template',

							                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

							                                // The Button Content
							                                'template' => array(

							                                	'type' => "buttons",
							                                	'title' => "Group Help Desk",
							                                	'text' => "Here's some helpful info for you~",

							                                	// Action to take between the three
							                                	'actions' => array(
							                                		array(
							                                			'type' => 'postback',
							                                			'label' => 'How To Mention ?',
							                                			'data' => 'howMention'
							                                		),
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'Command Explanation',
							                                			'text' => '..helpPC'	
							                                		),
							                                		array(
							                                			'type' => 'message',
							                                			'label' => 'About Me',
							                                			'text' => '..about'	
							                                		),
							                                		array(
							                                			'type' => 'uri',
							                                			'label' => 'Feedback Me',
							                                			'uri' => "mailto:minerva.bot.developer@gmail.com?subject=Feedback%20For%20Minerva"	
							                                		)
							                                	)
							                                )
							                            )
							                        )
							                    ));
											break;

										case '..request':
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

												fm_insert_group_information($group_pass, $event['source']['groupId'], $callsign, $db);

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
								                                'text' => 'Nickname : ' . $callsign . PHP_EOL . 
								                                'Group ID : ' . $registered_id . PHP_EOL . 
								                                'Group Pass : ' . $group_pass
								                            ), 
								                            array(
								                                'type' => 'text',
								                                'text' => 'You can access this again with ..info'
								                            ) 
								                        )
								                ));
											}

						                    mysqli_close($db);
											break;

										case '..info' :
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
				                    			$group_callsign = "Nickname : " . fm_get_group_description($event['source']['groupId'], $db);
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
							                                'text' => "Here's your group information~"
							                            ) 
							                        )
							                    ));
				                    		}

				                    		mysqli_close($db);
											break;

										case '..create' :
											if (!isset($exploded_Message[1]) OR !isset($exploded_Message[2])) {
												$text_response = 'Not enough information to create one.' . PHP_EOL . 'Need mention name and group pass' ;
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
															$text_response = "New mention created" ;
														} elseif($check_result == 1) {
															$text_response = "Duplicate mention detected" ;
														}
													} elseif ($group_pass['IS_PASS_MATCH'] == 0) {
														$text_response = 'You entered the wrong password' ;
													} 
												}
											} elseif (count($exploded_Message) > 3){
												$text_response = "Sorry, you can only create mention with the length of one word. You might want to use underscore instead for the space";
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
											break;

										case '..delete':
											if (!isset($exploded_Message[1]) OR !isset($exploded_Message[2])) {
												$text_response = 'Not enough information to delete mention.' . PHP_EOL . 'Need mentio name and group pass' ;
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
															$text_response = "There's no mention with that name" ;
														} elseif ($check_function['IS_GF_CREATED'] == 1) {
															$target_gf_id = fm_get_gf_id_secure($target_keyword, $group_unique_id, $db);
															
															fm_delete_info_via_gf_id($target_gf_id, "LINKED_ACC", $db);
															fm_delete_info_via_gf_id($target_gf_id, "GROUP_FUNCTION", $db);
															
															$text_response = "Mention Successfully Deleted" ;	
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
											break;

										case '..list' :
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
													$text_response = "Registered Mention" . PHP_EOL . PHP_EOL ;
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
									                                'text' => "Here's the list of mention on this group~"
									                            )
									                        )
									                ));
												} elseif ($available == 0) {
													$text_response = "Your group does not have any mention yet"; 

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
											break;

										case '..whosubs' :
											if (!isset($exploded_Message[1])) {
												$text_response = 'Not enough information to know who is subbed.' . PHP_EOL . 'Need mention name' ;
											} else {
												$check_group = fm_check_unique_id($event['source']['groupId'], $db);
												if ( $check_group == 0 ) {
													$text_response = "Your Group Isn't Registered Yet" ;
												} else {
													$unique_id = fm_get_unique_id($event['source']['groupId'], $db);
													$target_keyword = $exploded_Message[1] ;
													$search_result = fm_get_keyword_secure($target_keyword, $unique_id, $db);
													if ( $search_result === 0) {
														$text_response = "No mention with that name in this group";
														$return_var = 1 ;
													} else {
														$fetch_gf_id = fm_get_gf_id_secure($search_result, $unique_id, $db) ;
														$is_linked_exist = fm_check_linked_id($fetch_gf_id, $db);
														if ($is_linked_exist == 0) {
															$text_response = "Nobody subbed to this mention yet" ;
															$return_var = 1 ;
														} elseif ($is_linked_exist == 1) {
															$personal_id_list = fm_get_personal_id($fetch_gf_id, $db);
															$text_response = "People subbed to " . $target_keyword . PHP_EOL . PHP_EOL;
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
								                                'text' => "Here's all the people subbed to that mention~"
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
											break;

										case '..revoke':
											if (!isset($exploded_Message[1])) {
												$text_response = 'Not enough information to remove group.' . PHP_EOL . 'Need group pass' ;
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

														if ($target_gf_id_list !== 0) {
															while ($gf_to_delete = mysqli_fetch_array($target_gf_id_list)) {
																if (fm_check_linked_id($gf_to_delete['GF_ID'], $db) == 1) {
																	fm_delete_info_via_gf_id($gf_to_delete['GF_ID'], "LINKED_ACC", $db);
																}
															}
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
											break;
										
										case '..rename':
											if (!isset($exploded_Message[1]) OR !isset($exploded_Message[2]) OR !isset($exploded_Message[3])) {
												$text_response = 'Not enough information to rename mention.' . PHP_EOL . PHP_EOL . 'Need old mention name, new mention name and group pass' ;
											} elseif (count($exploded_Message) == 4) {
												$group_status = fm_check_unique_id($event['source']['groupId'], $db) ;
												if ( $group_status == 0 ) {
													$text_response = "Your group isn't registered yet" ;
												} else {
													$group_pass = fm_check_pass($exploded_Message[3], $event['source']['groupId'], $db);
													if ($group_pass['IS_PASS_MATCH'] == 1) {
														$unique_id = fm_get_unique_id($event['source']['groupId'], $db);
														$check_old = fm_check_keyword($exploded_Message[1], $unique_id, $db);
														if ($check_old == 1) {
															$check_new = fm_check_keyword($exploded_Message[2], $unique_id, $db);
															if ($check_new == 0) {
																fm_update_keyword($unique_id, $exploded_Message[1], $exploded_Message[2], $db);
																$text_response = "Mention Name Successfully Changed" ;
															} elseif ($check_new == 1) {
																$text_response = "A duplicate mention name on the new name detected. Please choose a different one" ;
															}
														} elseif($check_old == 0) {
															$text_response = "Your group doesn't have mention with that name" ;
														}
													} elseif ($group_pass['IS_PASS_MATCH'] == 0) {
														$text_response = 'You entered the wrong password. Please check again' ;
													} 
												}
											} elseif (count($exploded_Message) > 3){
												$text_response = "Sorry, you can only create mention name with the length of one word. You might want to use underscore instead for the space";
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
											break;

										case '..chgname':
											if (!isset($exploded_Message[1]) AND !isset($exploded_Message[2])) {
												$text_response = 'Not enough information to change group nickname.' . PHP_EOL . PHP_EOL . 'Need the new group name and group pass' ;
											} else {		
												$check_status = fm_check_group_information($event['source']['groupId'], $db);

												if ($check_status['IS_REGISTERED'] == 0) {
													$text_response = "Your group is not registered yet" ;

												} elseif ($check_status['IS_REGISTERED'] == 1) {
													$pass = $exploded_Message[count($exploded_Message)-1];
													$fetch_pass = fm_check_pass($pass, $event['source']['groupId'], $db);

													if ($fetch_pass['IS_PASS_MATCH'] == 0) {
														$text_response = "You entered the wrong password. Please check again" ;
													} elseif ($fetch_pass['IS_PASS_MATCH'] == 1) {
														
														$removed_command = explode(" ", $message['text'],2);
														$new_name_array = explode(" ", $removed_command[1],-1);
														$new_name = implode(" ", $new_name_array);
														
														if (fm_get_group_description($event['source']['groupId'], $db) == $new_name) {
															$text_response = "Hmm ... your old and new name is kinda the same. No need to change" ;
														} else {
															$unique_id = fm_get_unique_id($event['source']['groupId'], $db);
															fm_update_description($unique_id, $new_name, $db);
															$text_response = "Group Nickname Successfully Changed";
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
											break;

										case '..chgpass':
											if (!isset($exploded_Message[1])) {
												$text_response = 'Not enough information to change pass.' . PHP_EOL . PHP_EOL . 'Need the new pass' ;
											} else {
												$check_group = fm_check_unique_id($event['source']['groupId'], $db);
												if ( $check_group == 0 ) {
													$text_response = "Your Group Isn't Registered Yet" ;
												} else {
													$unique_id = fm_get_unique_id($event['source']['groupId'], $db);
													$new_pass = $exploded_Message[1] ;
													fm_update_pass($unique_id, $new_pass, $db);
													$text_response = "Group Pass Successfully Changed" ;
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
											break;

										default:
											# code...
											break;
									}	
									
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
										$client->replyMessage(array(
					                        'replyToken' => $event['replyToken'],
					                        'messages' => array(
					                            array(
					                                'type' => 'template',

					                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

					                                // The Button Content
					                                'template' => array(

					                                	'type' => "buttons",
					                                	'title' => "Personal Help Menu",
					                                	'text' => "What can i help you with ?",

					                                	// Action to take between the three
					                                	'actions' => array(
					                                		array(
					                                			'type' => 'message',
					                                			'label' => 'Command Explanation',
					                                			'text' => '..helpPC'				                                				
					                                		),
					                                		array(
					                                			'type' => 'uri',
					                                			'label' => 'Give Feedback',
					                                			'uri' => "mailto:minerva.bot.developer@gmail.com?subject=Feedback%20For%20Minerva"	
					                                		)
					                                	)
					                                )
					                            )
					                        )
						                ));

									} elseif (isset($event['source']['groupId'])) {
										$client->replyMessage(array(
					                        'replyToken' => $event['replyToken'],
					                        'messages' => array(
					                            array(
					                                'type' => 'template',

					                                'altText' => "If you use LINE PC type '..helpPC' to see all the available command",

					                                // The Button Content
					                                'template' => array(

					                                	'type' => "buttons",
					                                	'title' => "Group Help Menu",
					                                	'text' => "What can i help you with ?",

					                                	// Action to take between the three
					                                	'actions' => array(
					                                		array(
					                                			'type' => 'message',
					                                			'label' => 'About Me',
					                                			'text' => "Hello everyone, i'm Minerva your personal assistant in personal and group chat. I can keep you stay updated on the vast amount of message you receive everyday. Just sub to any mention created on group and i'll notify you when something with that mention posted"
					                                		),
					                                		array(
					                                			'type' => 'message',
					                                			'label' => 'Command Explanation',
					                                			'text' => '..helpPC'				                                				
					                                		),
					                                		array(
					                                			'type' => 'uri',
					                                			'label' => 'Video Tutorial',
					                                			'uri' => "https://www.youtube.com/watch?v=8Sc6oQ3kWi0&list=PLeYOjd5ex5m3_Nw9LaeL2hMsdPqMbMbpL"	
					                                		),
					                                		array(
					                                			'type' => 'uri',
					                                			'label' => 'Give Feedback',
					                                			'uri' => "mailto:minerva.bot.developer@gmail.com?subject=Feedback%20For%20Minerva"	
					                                		)
					                                	)
					                                )
					                            )
					                        )
						                ));
									}

		                    		mysqli_close($db);

									break;
								
								case '..helpPC':
									
									if (isset($event['source']['userId'])) {
										$help_array = $personal_array_help;
									}
									
									if (isset($event['source']['groupId'])) {
										$help_array = $group_array_help;	
									} 

									$header = "~COMMAND EXPLANATION~" . PHP_EOL . PHP_EOL ;
									$combined_help = $header . "1." . $help_array[0];
									$counter = 1 ;
									
									while ($counter < count($help_array)) {
										$combined_help .= PHP_EOL . PHP_EOL . $counter + 1 . $help_array[$counter] ;
										$counter += 1 ; 
									}
									
		                    		mysqli_close($db);

		                    		$client->replyMessage(array(
					                        'replyToken' => $event['replyToken'],
					                        'messages' => array(
					                            array(
					                                'type' => 'text',
					                                'text' => $combined_help
					                            ),
					                            array(
					                                'type' => 'text',
					                                'text' => "Here's all the command explanation of what you can do here"
					                            )
					                        )
					                ));
									break;

								case '..about':
									$client->replyMessage(array(
				                        'replyToken' => $event['replyToken'],
				                        'messages' => array(
				                            array(
				                                'type' => 'text',
				                                'text' => "Hello everyone, i'm Minerva your personal assistant in personal and group chat." . PHP_EOL . PHP_EOL . "I can keep you stay updated on the vast amount of message you receive everyday." . PHP_EOL . PHP_EOL . "Just subscribe to any mention created on group and i'll notify you when something with that mention posted"
				                            )
				                        )
				                	));
									break;

								case '..cuaca':
									$weather_key = "c91dbce1c0bf47f4a3e204431172905";
									$target_city = 'Malang';

							        $url ="http://api.apixu.com/v1/forecast.json?key=$weather_key&q=$target_city&=";

							        $ch = curl_init();  
							        curl_setopt($ch,CURLOPT_URL,$url);
							        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
							        
							        $json_output = curl_exec($ch);
							        $weather = json_decode($json_output);
							        
							        $days = $weather->forecast->forecastday;

							        $date = $days[0]->date ; 
							        // $value_on_6 = $days[0]->hour[5]->will_it_rain ;

							        // if ($value_on_6 == 0) {
							        // 	$status_on_6 = "Not Rain" ;
							        // } else {
							        // 	$status_on_6 = "Rain" ;
							        // }

							        $weather_header = $date . PHP_EOL . $target_city . PHP_EOL . PHP_EOL ;
							        // $weather_on_6 = "6AM : " $status_on_6 ;

							        $response = $weather_header  ; 

	                    			$client->replyMessage(array(
					                        'replyToken' => $event['replyToken'],
					                        'messages' => array(
					                            array(
					                                'type' => 'text',
					                                'text' => $response 
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

							///////////////////
							// Log Function //
							/////////////////
							
							// if (substr($message['text'], 0, 2) === "..") {
							// 	fm_create_log_data($event['source'], $message['text']);		
							// }

							// if (substr($message['text'], 0, 1) === "@") {
							// 	fm_create_log_data($event['source'], $message['text']);		
							// }

							// Double Check For Closing Database Connection
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

	        // Response When Joining Group
	        case 'join':
				$client->replyMessage(array(
                    'replyToken' => $event['replyToken'],
                    'messages' => array(
                        array(
                            'type' => 'text',
                            'text' => "Hello everyone, thank you very much for inviting me to your group :D" . PHP_EOL . PHP_EOL . "I'll try my best to help your group stay updated with all the important messages."
                        ),
                        array(
                            'type' => 'text',
                            'text' => "Please type 'menu' anytime when you want to interact with me"
                        )
                    )
            	));
	        	break;

			// Response When Leaving Group
	        case 'leave':
				$client->replyMessage(array(
                    'replyToken' => $event['replyToken'],
                    'messages' => array(
                        array(
                            'type' => 'text',
                            'text' => "Thank you very much for inviting me before. I hope we can work together again next time. Oh, and would you mind giving me some feedback to improve myself from the link below ? Any helps would be appreciated"
                        )
                    )
            	));
	        	break;	        

	        // Response When Followed By Personal Account
	        case 'follow':
				$client->replyMessage(array(
                    'replyToken' => $event['replyToken'],
                    'messages' => array(
                        array(
                            'type' => 'text',
                            'text' => "Hello there, thank you very much for adding me as your friend :D" . PHP_EOL . PHP_EOL . " I'll try my best to support you in keeping you updated with all the important messages you subscribed."
                        ),
                        array(
                            'type' => 'text',
                            'text' => "Please select 'My Menu' anytime when you want to interact with me" . PHP_EOL . PHP_EOL . "Oh, don't forget to check the video tutorial to know me more~"
                        )
                    )
            	));
	        	break;

	        // Response When Unfollowed By Personal Account -> Not Working Because API Limitation
	        case 'unfollow':
				$client->replyMessage(array(
                    'replyToken' => $event['replyToken'],
                    'messages' => array(
                        array(
                            'type' => 'text',
                            'text' => "Aww, it's a shame. I'm sorry if my help doesn't really helps you. Would you mind giving me some feedback to improve myself from the link below ? Any helps would be appreciated. Oh and before i go thank you very much for trying my services. I hope we can work together again next time"
                        ),
                        array(
                            'type' => 'template',

                            'altText' => "Email your feedback to :" . PHP_EOL . "minerva.bot.developer@gmail.com",

                            // The Button Content
                            'template' => array(

                            	'type' => "buttons",
                            	'title' => "Feedback",
                            	'text' => "Email your feedback via this button~",

                            	// Action to take between two
                            	'actions' => array(
	                        		array(
	                        			'type' => 'uri',
	                        			'label' => 'Feedback Me',
	                        			'uri' => "mailto:minerva.bot.developer@gmail.com?subject=Feedback%20For%20Minerva"	
	                        		)
                            	)

                            )
                        )
                    )
            	));
	        	break;

            // Postback Event
        	case 'postback':
        		switch ($event['postback']['data']) {
        			// For Personal User



					// For Group User
    				case 'groupRegister':
						file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', '..request' . PHP_EOL , LOCK_EX);
        				$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => "Please enter your new group nickname now." . PHP_EOL . PHP_EOL . 
		                                "Notes :" . PHP_EOL .  
		                                "> I suggest you use your own group name for easier identification." . PHP_EOL . 
		                                "> You can changes it later."
	                            )
	                        )
	                	));
    					break;

    				case 'howMention':
						$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => "Type '@' followed by one of your group created mention (without spaces) to inform peoples subscribed to it." . PHP_EOL . PHP_EOL .
	                                	"You can also add additional message by providing spaces after the mention." . PHP_EOL . PHP_EOL . 
	                                	"Examples : " . PHP_EOL . 
	                                	"> @news Extra Messages" . PHP_EOL . 
	                                	"> @members"
	                            )
	                        )
	                	));
						break;

					case 'groupRevoke':
						file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', '..revoke' . PHP_EOL , LOCK_EX);
        				$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => 'Please enter group pass now'
	                            )
	                        )
	                	));
						break;

					case 'groupCreate':
						file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', '..create' . PHP_EOL , LOCK_EX);
        				$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => 'Please enter the new mention name now'
	                            )
	                        )
	                	));
						break;

					case 'groupDelete':
						file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', '..delete' . PHP_EOL , LOCK_EX);
        				$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => 'Please enter the mention name you want to delete now'
	                            )
	                        )
	                	));
						break;

					case 'changePass':
						file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', '..chgpass' . PHP_EOL , LOCK_EX);
        				$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => 'Please enter the new pass now'
	                            )
	                        )
	                	));
						break;

					case 'changeNickname':
						file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', '..chgname' . PHP_EOL , LOCK_EX);
        				$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => 'Please enter the new nickname now'
	                            )
	                        )
	                	));
						break;

					case 'renamePing':
						file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', '..rename' . PHP_EOL , LOCK_EX);
        				$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => 'Please enter your old mention name now'
	                            )
	                        )
	                	));
						break;

					case 'whoSubsTo':
						file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', '..whosubs' . PHP_EOL , LOCK_EX);
        				$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => 'Please enter the mention name you want to know now'
	                            )
	                        )
	                	));
						break;

					case 'reserved':
						$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => 'Reserved for future update ;)'
	                            )
	                        )
	                	));
						break;

					case 'randomFact':
						$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => 'Still in development. Examples includes how long i have helped your group and how much mention i have sent'
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
	                                'text' => 'Okay, please pick the menu again to input the new information'
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