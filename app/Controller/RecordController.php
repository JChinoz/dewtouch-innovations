<?php
	class RecordController extends AppController{
		
		public function index(){
			ini_set('memory_limit','256M');
			set_time_limit(0);

			// $controllerName = $parameters = if(isset($this->request->getAttribute('iDisplayLength'));
			// echo json_encode($controllerName);
			// $displayLength = $this->request->getParam('iDisplayLength');
			// echo json_encode($displayLength);

			// $data = $_POST['data'];
			// echo $data);

			$this->setFlash('Listing Record page too slow, try to optimize it.');
			
			// if(!empty($_GET['iDisplayStart']) && !empty($_GET['iDisplayLength'])){
			// 	$limit = $_GET['iDisplayStart'] . ', ' . $_GET['iDisplayLength'];
			// 	$records = $this->Record->find('all', array(
			// 			'limit' => $limit
			// 	));
			// }else{
			if($this->request->isPost()){
				$num_rows =  $this->request->data['num_rows'];
				$records = $this->Record->find('all',[
					'limit' => $num_rows
				]);
			} else {
				$records = $this->Record->find('all');
			}
			// }
			$this->set('records',$records);
			
			
			$this->set('title',__('List Record'));
		}
		
// 		public function update(){
// 			ini_set('memory_limit','256M');
			
// 			$records = array();
// 			for($i=1; $i<= 1000; $i++){
// 				$record = array(
// 					'Record'=>array(
// 						'name'=>"Record $i"
// 					)			
// 				);
				
// 				for($j=1;$j<=rand(4,8);$j++){
// 					@$record['RecordItem'][] = array(
// 						'name'=>"Record Item $j"		
// 					);
// 				}
				
// 				$this->Record->saveAssociated($record);
// 			}
			
			
			
// 		}
	}