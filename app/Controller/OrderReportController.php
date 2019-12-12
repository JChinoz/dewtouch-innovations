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

			for($i = 0; $i < sizeof($cumulativeOrderArray); $i++){
				for($j = 0; $j < sizeof($cumulativeOrderArray[$i]); $j++){
					for($k = 0; $k < sizeof($itemIdArrays); $k++){
						if($cumulativeOrderArray[$i][$j]['item_id'] == $itemIdArrays[$k]['item_id']){
							$ingredients = array();
							for($l = 0; $l < sizeof($itemIdArrays[$k]['parts']); $l++){
								$sumValue = $itemIdArrays[$k]['parts'][$l]['value'] * $cumulativeOrderArray[$i][$j]['quantity'];
								// echo $sumValue;
								array_push($ingredients, array($itemIdArrays[$k]['parts'][$l]['part_name'] => $sumValue));
							}
							array_push($ingredientArrays, $ingredients);
						}
					}
				}
			}

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

			echo json_encode($ingredientArrays);

			// foreach($ingredientArrays as $key=>$value){
				
			// }
			
			// foreach($orderArrays as $key=>$value){
			// 	$orderReportObjects[$key]->$orderArrays[$key] = $ingredientArrays[$key];
			// }

			// echo json_encode($orderReportObjects);
			// echo json_encode($ingredientArrays);

			// To Do - write your own array in this format
			$order_reports = array('Order 1' => array(
										'Ingredient A' => 1,
										'Ingredient B' => 12,
										'Ingredient C' => 3,
										'Ingredient G' => 5,
										'Ingredient H' => 24,
										'Ingredient J' => 22,
										'Ingredient F' => 9,
									),
								  'Order 2' => array(
								  		'Ingredient A' => 13,
								  		'Ingredient B' => 2,
								  		'Ingredient G' => 14,
								  		'Ingredient I' => 2,
								  		'Ingredient D' => 6,
								  	),
								);

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