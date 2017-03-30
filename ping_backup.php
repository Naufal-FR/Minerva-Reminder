											// In Interactive Function
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
							                                	
							                                	'text' => "You're going to mention" . PHP_EOL . "> " . $final_content[1] . PHP_EOL . 
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


										// In core function
										case '..ping':
											if (!isset($exploded_Message[1])) {
												$text_response = 'Not enough information to mention.' . PHP_EOL . 'Need mention name' ;
											} else {
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
												                                'text' =>  "~NEW MESSAGE~" . PHP_EOL . PHP_EOL . 
												                                "FROM : " . PHP_EOL . "> " . $target_name . PHP_EOL . 
												                                // "ID : " . $group_unique_id . PHP_EOL . 
												                                "SUBJECT : " . $exploded_Message[1] . PHP_EOL . PHP_EOL .
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

													            if (isset($additional_Message)) {
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
											break;


					// In postback Event											
					case 'groupPing':
						file_put_contents('./temp/' . $event['source']['groupId'] . '.txt', '..ping' . PHP_EOL , LOCK_EX);
        				$client->replyMessage(array(
	                        'replyToken' => $event['replyToken'],
	                        'messages' => array(
	                            array(
	                                'type' => 'text',
	                                'text' => 'Please enter the mention name now'
	                            )
	                        )
	                	));
						break;
