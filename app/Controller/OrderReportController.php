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


			$orderArrays = array();
			$orderReportObjects = array();
			$ingredientArrays = array();
			$singleOrderArray = array();
			$cumulativeOrderArray = array();
			$itemIdArrays = array();
			$partIdArrays = array();

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

			// Merging Orders and Portions together
			$ingredientTotal = array();
			for($i = 0; $i < sizeof($cumulativeOrderArray); $i++){
				$ingredientArrays = array();
				for($j = 0; $j < sizeof($cumulativeOrderArray[$i]); $j++){
					for($k = 0; $k < sizeof($itemIdArrays); $k++){
						$item_parts = array();
						if($cumulativeOrderArray[$i][$j]['item_id'] == $itemIdArrays[$k]['item_id']){
							$ingredients = array();
							for($l = 0; $l < sizeof($itemIdArrays[$k]['parts']); $l++){
								$sumValue = $itemIdArrays[$k]['parts'][$l]['value'] * $cumulativeOrderArray[$i][$j]['quantity'];
								$ingredients[$itemIdArrays[$k]['parts'][$l]['part_name']] = $sumValue;
							}
							
							foreach($ingredients as $key=>$value){
								$cumulativeOrderArray[$i][$j]['parts'][$key] = $value;
							}
							array_push($ingredientArrays, $ingredients);	
						}
					}
				}			
				array_push($ingredientTotal, $ingredientArrays);
			}
			
			// foreach($orderArrays as $key=>$value){
			// 	$orderReportObjects[$key]->$orderArrays[$key] = $cumulativeOrderArray[$key];
			// }

			// Add up all similar keys in ingredients array
			$ingredients3 = array();
			foreach($ingredientTotal as $key=>$value){
				$ingredientsFinal = array();
				foreach($ingredientTotal[$key] as $key2=>$value2){
					foreach($ingredientTotal[$key][$key2] as $key3=>$value3){
						if(array_key_exists($key3, $ingredientsFinal)){
							$ingredientsFinal[$key3] += $value3;
						}else{
							$ingredientsFinal[$key3] = $value3;
						}
					}
				}
				array_push($ingredients3, $ingredientsFinal);
			}

			// Sort keys alphabetically
			foreach($ingredients3 as $key=>$value){
				$ingredientsObject = new ArrayObject($ingredients3[$key]);
				$ingredientsObject->ksort();
				$ingredients3[$key] = $ingredientsObject;
			}

			// Populate into order_reports
			$order_reports = array();
			foreach($orderArrays as $key=>$value){
				$order_reports[$orderArrays[$key]] = $ingredients3[$key];
			}

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