<?php

require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class MigrationController extends AppController{
	
	public function q1(){
		$this->setFlash('Question: Migration of data to multiple DB table');
		if (!empty($_FILES["file"]["name"])) {
			$fileName = $_FILES["file"]["name"];
			$fileTmp = $_FILES["file"]["tmp_name"];

			if(pathinfo($fileName, PATHINFO_EXTENSION) == "xlsx"){
				$target_dir = "uploads/";
				$target_file = $target_dir . basename($fileName);
				if(move_uploaded_file($fileTmp, $target_file)){
					$inputFileType = 'Xlsx';
					$inputFileName = $target_file;
					// $sheetName = 'Sheet2';

					$reader = IOFactory::createReader($inputFileType);
					$spreadsheet = $reader->load($inputFileName);

					$worksheet = $spreadsheet->getActiveSheet();
					// Get the highest row number and column letter referenced in the worksheet
					$highestRow = $worksheet->getHighestRow(); // e.g. 10
					$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
					// Increment the highest column letter
					$highestColumn++;

					$members = array();
					$membersColumns = array();
					$transaction = array();
					$transactionColumns = array();
					// $item = array();
					// $itemColumns = array();
					// Iterate each row
					// echo $highestRow;
					for ($row = 1; $row <= $highestRow; ++$row) {
						for ($col = 'A'; $col != $highestColumn; ++$col) {
							$value = $worksheet->getCell($col . $row)->getValue();
							// Push related columns into appropriate databases
							if($row == 1){
								// Push member related columns into array
								if($value == 'Member Name' | $value == 'Member No' || $value == 'Member Company'){
									// echo "TEST";
									array_push($membersColumns, $col);
								}
								// Push transaction related columns into array
								if($worksheet == 'Member Name' | $value == 'Member Pay Type' || $value == 'Member Company' || $value == 'Date' || $value == 'Ref No.' || $value == 'Receipt No' || $value == 'Payment By' || $value == 'Batch No' || $value == 'Cheque No' || $value == 'Payment Description' || $value == 'Renewal Year' || $value == 'subtotal' || $value == 'totaltax' || $value == 'total'){
									array_push($transactionColumns, $col);
								}
							}else{
								if(in_array($col, $membersColumns)){
									// Check if current column matches "Member No"
									if($col == $membersColumns[1]){
										$memberNo = explode(" ", $value);
										// Push first index as type
										array_push($members, $memberNo[0]);
										// Push second index as no
										array_push($members, $memberNo[1]);
									}else{
										array_push($members, $value);
									}
								}
								if(in_array($col, $transactionColumns)){
									array_push($transaction, $value);
								}
							}
						}
					}

					// echo json_encode($members);
					
					foreach($members as $key=>$value)
						$this->Member->create();
						$this->Member->save([
							'name' => $members[0],
							'type' => $members[1],
							 'no' => $members[2],
							 'company' => $members[3],
							 'valid' => 1,
							 'created' => date("Y-m-d H:i:s"),
							 'modified' => date("Y-m-d H:i:s")
						]);
					}
					// $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, null);

					// echo json_encode($sheetData);
					// $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
					// $reader->setReadDataOnly(true);
					// $spreadsheet = $reader->load($target_file);

					// $filterSubset = new MyReadFilter();

					// $spreadsheet->getActiveSheet();
						
					// $csvContents = file($target_file, FILE_IGNORE_NEW_LINES);
					// print_r(str_replace(" ", ",", $csvContents));
					// $uploadedFile = fopen($target_file, 'r');
					// $contents = fgetcsv($uploadedFile, 0, "\r");

					// foreach($contents as $key=>$worksheet){
					// 	$lineValues = explode(",", $worksheet);
					// 	if($key != '0'){
					// 		$this->FileUpload->create();
					// 		$this->FileUpload->save([
					// 			'name' => $lineValues[0],
					// 			'email' => $lineValues[1],
					// 		]);
					// 	}
					// }
				// }else{
				// 	$this->setFlash('Error Uploading File Contents');
				// }
			} else {
				$this->setFlash('File is not of CSV format');
			}
		}
// 		$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
	}

	public function q1_instruction(){
		$this->setFlash('Question: Migration of data to multiple DB table');
// 		$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
	}
	
}
