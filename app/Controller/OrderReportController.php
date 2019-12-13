<?php
	class OrderReportController extends AppController{

		public function index(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));
			// debug($orders);exit;

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
			// debug($portions);exit;

			// echo json_encode($orders);

			$orderArrays = array();
			$orderReportObjects = array();
			$ingredientArrays = array();
			// $quantityArrays = array();
			$singleOrderArray = array();
			$cumulativeOrderArray = array();
			$itemIdArrays = array();
			$partIdArrays = array();

			$partIdUnique = array();

			// Extract order arrays for naming
			for($i = 0; $i < sizeof($orders); $i++){
				$singleOrderArray = array();
				foreach($orders[$i] as $key=>$value){
					if($key == 'Order'){
						foreach($orders[$i][$key] as $key2=>$value2){
							if($key2 == 'name'){
								array_push($orderArrays, $value2);
								array_push($orderReportObjects, new Object());
							}
						}
					}
					else if($key == "OrderDetail"){
						foreach($orders[$i][$key] as $key2=>$value2){
							array_push($singleOrderArray, array('order_id' => $value2['order_id'], 'item_id' => $value2['item_id'], 'quantity' => $value2['quantity']));
						}
						array_push($cumulativeOrderArray, $singleOrderArray);
					}
				}
			}

			// Get Portions and Ingredients
			for($j = 0; $j < sizeof($portions); $j++){
				foreach($portions[$j] as $key=>$value){
					if($key == "Portion"){
						array_push($itemIdArrays, array('portion_id' => $value['id'], 'item_id' => $value['item_id']));
					}
					if($key == "PortionDetail"){
						foreach($portions[$j][$key] as $key2=>$value2){
							// echo json_encode($value2['value']);
							// if(!in_array($value2['part_id'], $partIdUnique)){
								array_push($partIdArrays, array('portion_id' => $value2['portion_id'], 'part_id' => $value2['part_id'], 'value' => $value2['value'], 'part_name' => $value2['Part']['name']));
								// array_push($partIdUnique, $value2['part_id']);
							// }
						}
					}
				}
			}
			
			// echo json_encode($orders);
			// echo json_encode($portions);
			
			// echo json_encode($partIdArrays);

			// echo json_encode($orderReportObjects);
			// echo json_encode($cumulativeOrderArray);

			// Merging Parts and Portions together
			for($i = 0; $i < sizeof($itemIdArrays); $i++){
				$partsArrays = array();
				for($j = 0; $j < sizeof($partIdArrays); $j++){
					if($itemIdArrays[$i]['portion_id'] == $partIdArrays[$j]['portion_id']){
						array_push($partsArrays, array('part_id' => $partIdArrays[$j]['part_id'], 'value'=> $partIdArrays[$j]['value'], 'part_name' => $partIdArrays[$j]['part_name']));
					}
				}
				$itemIdArrays[$i]['parts'] = $partsArrays;
			}

			// echo json_encode($itemIdArrays);

			// Merging Orders and Portions together
			// $order_reports = array();
			$ingredientTotal = array();
			$ingredientKeyArray = array();
			$ingredientValueArray = array();
			for($i = 0; $i < sizeof($cumulativeOrderArray); $i++){
				$ingredientArrays = array();
				for($j = 0; $j < sizeof($cumulativeOrderArray[$i]); $j++){
					for($k = 0; $k < sizeof($itemIdArrays); $k++){
						$item_parts = array();
						if($cumulativeOrderArray[$i][$j]['item_id'] == $itemIdArrays[$k]['item_id']){
							$ingredients = array();
							for($l = 0; $l < sizeof($itemIdArrays[$k]['parts']); $l++){
								$sumValue = $itemIdArrays[$k]['parts'][$l]['value'] * $cumulativeOrderArray[$i][$j]['quantity'];
								// echo $sumValue;
								// array_push($ingredients, array($itemIdArrays[$k]['parts'][$l]['part_name'] => $sumValue));
								// array_push($ingredients, array($itemIdArrays[$k]['parts'][$l]['part_name'] => $sumValue));
								// $ingredients[$itemIdArrays[$k]['parts'][$l]['part_name']] = $sumValue;
								$ingredients[$itemIdArrays[$k]['parts'][$l]['part_name']] = $sumValue;
								// $cumulativeOrderArray[$i][$j]['parts'] = $sumValue;	
							}
							
							// echo json_encode($ingredients);

							// echo json_encode(" ? ");

							foreach($ingredients as $key=>$value){
								$cumulativeOrderArray[$i][$j]['parts'][$key] = $value;
								// echo json_encode($key);
							}
							// echo json_encode($ingredients);
							array_push($ingredientArrays, $ingredients);	
							// echo json_encode($ingredientArrays[0]);
							// array_push($ingredientArrays, array_merge($ingredientArrays, $ingredients));	
							// foreach($ingredients as $key=>$value){
							// 	$ingredientTotal[$i][$j] = $value;
							// }
						}
						// array_push();
						// echo json_encode($ingredientArrays);
						// echo json_encode($ingredientArrays);
						// echo json_encode($ingredientArrays[0]);
						// foreach($ingredientArrays as $key=>$value){
							// 	echo json_encode($value);
							// 		// $ingredientTotal = array_merge($ingredientTotal, $ingredientArrays);
							// }
							// array_push($ingredientTotal, $ingredientArrays);
						}
						// Accumulate all the parts for each order

				}
				// echo json_encode($cumulativeOrderArray);
				// echo json_encode(" | ");
				// echo json_encode($ingredientArrays);
				// // array_push($ingredientTotal, $ingredientArrays);
				
				// $ingredients2 = array();
				$ingredientsKey = array();
				$ingredientsValue = array();
				// echo json_encode($ingredientArrays);
				foreach($ingredientArrays as $key=>$value){
					// $ingredientTotal = array();
					foreach($ingredientArrays[$key] as $key2=>$value2){
						// array_push($ingredientTotal, array($key2=>$value2));
						array_push($ingredientsKey, $key2);
						array_push($ingredientsValue, $value2);
						// array_push($ingredients2)
						// $ingredients2[$key2] = $value2;
						// echo json_encode($key2);
						// echo json_encode($value2);
					}
					
					// foreach($ingredientTotal as $key=>$value){
						// 	foreach($ingredientTotal[$key] as $key2=>$value2){
							
									// $ingredients2 = array_merge($ingredients2, $key2);
							// 	}
				// 			// }
				// 			// echo json_encode($ingredientsValue);
				// 			// array_merge($ingredients, $value);
				// 			// echo json_encode($value);
				// 			// array_push( , $value)
				// 			// $ingredients2[$key] = $value;
				// 			// $ingredientTotal = array_merge($ingredientTotal[$key]);
				// 			// $ingredientTotal->$key = $value;
							// $ingredientTotal[$key2] = $value2;
							// echo json_encode($ingredientsKey);
							// echo json_encode($ingredientsValue);
					// }
					array_push($ingredientKeyArray, $ingredientsKey);
					array_push($ingredientValueArray, $ingredientsValue);
					// echo json_encode($ingredientTotal);
				}
				array_push($ingredientTotal, $ingredientArrays);
				// echo json_encode($ingredientArrays);
				// $orderReportObjects[$i]->$orderArrays[$i] = array($ingredientsKey);

				// echo json_encode($ingredientsKey);
				// echo json_encode($ingredientsValue);
				// foreach($ingredientsKey as $key=>$value){
				// 	$ingredientsKey = $ingredientsValue[$key];
				// }

				// foreach($ingredientsKey as $key=>$value){
				// 	$matchingKeys = array_keys($ingredientsKey, $value);
				// 	$sumValue = 0;
				// 	$arraySimilar = array();
				// 	for($i = 0; $i < sizeof($matchingKeys); $i++){
				// 		$sumValue += $ingredientsValue[$matchingKeys[$i]];
				// 	}
				// 	$ingredientsValue[$key] = $sumValue;

				// 	foreach($matchingKeys as $key=>$value){
				// 		if(sizeof($matchingKeys) > 1){
				// 			array_push($arraySimilar, $value);
				// 		}
				// 	}

				// 	foreach($arraySimilar as $key=>$value){
				// 		if($key > 0){
				// 			unset($ingredientsKey[$arraySimilar[$key]]);
				// 			unset($ingredientsValue[$arraySimilar[$key]]);
				// 		}
				// 	}
				// }
				// echo json_encode(array_combine($ingredientsKey, $ingredientsValue));
				// echo json_encode($ingredientsKey);
				// echo json_encode($ingredientsValue);
				// for($i = 0; $i < sizeof($ingredientsKey); $i++){
					// echo json_encode(array_keys($ingredientsKey ,$ingredientsKey[$i]));
					// }
				// $ingredientTotal = array();
				// foreach($ingredientsKey as $key=>$value){
				// 	array_push($ingredientTotal, array($ingredientsKey[$key] => $ingredientsValue[$key]));
				// }
				
				// echo json_encode($ingredientsKey);
				// echo json_encode($ingredientsValue);
				// echo $ingredientsKey[0];
				// echo array_search($ingredientsKey[1], $ingredientsKey);
					// array_push($ingredientTotal, array_combine($ingredientsKey,$ingredientsValue));
				// foreach($ingredientTotal as $key=>$value){
					// $ingredientsTotal = array_merge($ingredientsTotal, $ingredientsTotal[$key]);
				// }
				// foreach($ingredientTotal as $key=>$value){
				// 	$ingredients2[$key] = $value;
				// }
					// echo json_encode($ingredientTotal);
					// array_push($ingredients2, array($ingredientsKey=>$ingredientsValue));
					// echo json_encode(" | ");
			}

			// foreach($ingredients2 as $key=>$value){
			// 	foreach($ingredients2[$key] as $key2=>$value2){
			// 		$ingredients = array_merge($ingredients2[$key][$key2], $value2);
			// 	}
			// }
			// echo json_encode($ingredients);

			// echo array_search($ingredientsKey[1], $ingredientsKey);
			// echo json_encode($ingredientTotal);

			// foreach($cumulativeOrderArray as $key=>$value){
			// 	// echo json_encode($value);
			// 	foreach($cumulativeOrderArray[$key] as $key2 => $value2){
			// 		for($i = 0; $i < sizeof($itemIdArrays); $i++){
			// 			// echo json_encode($cumulativeOrderArray[0][$key2]);
			// 			// if($cumulativeOrderArray[$key2]['item_id'] == $itemIdArrays[$i]['item_id']){
			// 			// 	for($j = 0; $j < sizeof($itemIdArrays[$i]['parts']); $j++){
			// 			// 		$sumValue = double_val($itemIdArrays[$i]['parts'][$j]['value'] * $cumulativeOrderArray[$key2]['quantity']);
			// 			// 		array_push($ingredientArrays, array($itemIdArrays[$i]['parts'][$j]['name'] => $sumValue));
			// 			// 	}
			// 			// }
			// 		}
			// 	}
			// }

			// echo json_encode($ingredientTotal);

			// echo json_encode($testArray);
			
			foreach($orderArrays as $key=>$value){
				// echo json_encode($cumulativeOrderArray[$key]);	
				// $orderReportObjects[$key]->$orderArrays[$key] = array($ingredientsKey[$i] => $ingredientsValue[$i]);	
				// foreach($value['parts'])
				$orderReportObjects[$key]->$orderArrays[$key] = $cumulativeOrderArray[$key];
			}

			// $ingredientsFinal = array();
			// for($i = 0; $i < sizeof($ingredientsKey); $i++){
			// 	if(array_key_exists($ingredientsKey[$i], $ingredientsFinal)){
			// 		$ingredientsFinal[$ingredientsKey[$i]] += $ingredientsValue[$i];
			// 	}else{
			// 		$ingredientsFinal[$ingredientsKey[$i]] = $ingredientsValue[$i];
			// 	}
			// }

			// for($i = 0; $i < sizeof($ingredientsKey); $i++){
			// 	if(array_key_exists($ingredientsKey[$i], $ingredientsFinal)){
			// 		$ingredientsFinal[$ingredientsKey[$i]] += $ingredientsValue[$i];
			// 	}else{
			// 		$ingredientsFinal[$ingredientsKey[$i]] = $ingredientsValue[$i];
			// 	}
			// }

			// echo json_encode($ingredientArrays);
			// echo json_encode($ingredientsFinal);

			// echo json_encode($orderReportObjects);
			$ingredients3 = array();
			foreach($ingredientTotal as $key=>$value){
				$ingredientsFinal = array();
				foreach($ingredientTotal[$key] as $key2=>$value2){
					// echo json_encode($value2);
					foreach($ingredientTotal[$key][$key2] as $key3=>$value3){
						// echo json_encode($key3);
						// echo json_encode($value3);
						if(array_key_exists($key3, $ingredientsFinal)){
							$ingredientsFinal[$key3] += $value3;
						}else{
							$ingredientsFinal[$key3] = $value3;
						}
						// echo json_encode($ingredientsFinal);
					}
				}
				array_push($ingredients3, $ingredientsFinal);
				// echo json_encode(" | ");
			}
			// echo json_encode($ingredients3);

			// $ingredientsObject = new ArrayObject($ingredients3);
			// $ingredientsObject->ksort();

			foreach($ingredients3 as $key=>$value){
				$ingredientsObject = new ArrayObject($ingredients3[$key]);
				$ingredientsObject->ksort();
				$ingredients3[$key] = $ingredientsObject;
			}
			$order_reports = array();
			foreach($orderArrays as $key=>$value){
				// echo json_encode($cumulativeOrderArray[$key]);	
				// $orderReportObjects[$key]->$orderArrays[$key] = array($ingredientsKey[$i] => $ingredientsValue[$i]);	
				// foreach($value['parts'])
				$order_reports[$orderArrays[$key]] = $ingredients3[$key];
			}

			// echo json_encode($order_reports);
			// echo json_encode($ingredients3);

			// To Do - write your own array in this format
			// $order_reports = array('Order 1' => array(
			// 							'Ingredient A' => 1,
			// 							'Ingredient B' => 12,
			// 							'Ingredient C' => 3,
			// 							'Ingredient G' => 5,
			// 							'Ingredient H' => 24,
			// 							'Ingredient J' => 22,
			// 							'Ingredient F' => 9,
			// 						),
			// 					  'Order 2' => array(
			// 					  		'Ingredient A' => 13,
			// 					  		'Ingredient B' => 2,
			// 					  		'Ingredient G' => 14,
			// 					  		'Ingredient I' => 2,
			// 					  		'Ingredient D' => 6,
			// 					  	),
			// 					);

			// ...
			// echo json_encode($order_reports);

			$this->set('order_reports',$order_reports);

			$this->set('title',__('Orders Report'));
		}

		public function Question(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));

			// debug($orders);exit;

			$this->set('orders',$orders);

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
				
			// debug($portions);exit;

			$this->set('portions',$portions);

			$this->set('title',__('Question - Orders Report'));
		}

	}