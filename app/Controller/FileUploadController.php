<?php

class FileUploadController extends AppController {
	public function index() {
		$this->set('title', __('File Upload Answer'));

		// $this->FileUpload->deleteAll();
		// echo $_FILES["file"]["name"];

		// if (!empty($_FILES["file"]["name"])) {
		// 	echo "TESTING";
		// }
		// else{
		// 	echo "NOT WORKING";
		// }

		if (!empty($_FILES["file"]["name"]) && empty($this->FileUpload->find('all'))) {
			$fileName = $_FILES["file"]["name"];
			$fileTmp = $_FILES["file"]["tmp_name"];
			// $type = $file['type'];
			// $extension = pathinfo($fileName, PATHINFO_EXTENSION);
			
			// echo $fileName;
			// echo $extension;

			if(pathinfo($fileName, PATHINFO_EXTENSION) == "csv"){
				$target_dir = "uploads/";
				$target_file = $target_dir . basename($fileName);
				if(move_uploaded_file($fileTmp, $target_file)){
					// $csvContents = file($target_file, FILE_IGNORE_NEW_LINES);
					// print_r(str_replace(" ", ",", $csvContents));

					$uploadedFile = fopen($target_file, 'r');
					$contents = fgetcsv($uploadedFile, 0, "\r");

					foreach($contents as $key=>$value){
						$lineValues = explode(",", $value);
						if($key != '0'){
							$this->FileUpload->create();
							$this->FileUpload->save([
								'name' => $lineValues[0],
								'email' => $lineValues[1],
							]);
						}
					}
				}else{
					$this->setFlash('Error Uploading File Contents');
				}
			} else {
				$this->setFlash('File is not of CSV format');
			}
		}
		$file_uploads = $this->FileUpload->find('all');
		
		$this->set(compact('file_uploads'));
	}
}