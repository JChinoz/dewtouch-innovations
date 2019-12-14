<?php

App::uses('AppController', 'Controller');
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class MembersController extends AppController{
    public function q1(){
        $file_uploads = $this->Member->find('all');
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
                            $membersRow = array();
                            $transactionRow = array();
							// Push related columns into appropriate databases
							if($row == 1){
								// Push member related columns into array
								if($value == 'Member Name' | $value == 'Member No' || $value == 'Member Company'){
									// echo "TEST";
									array_push($membersColumns, $col);
								}
								// Push transaction related columns into array
								if($value == 'Member Name' | $value == 'Member Pay Type' || $value == 'Member Company' || $value == 'Date' || $value == 'Ref No.' || $value == 'Receipt No' || $value == 'Payment By' || $value == 'Batch No' || $value == 'Cheque No' || $value == 'Payment Description' || $value == 'Renewal Year' || $value == 'subtotal' || $value == 'totaltax' || $value == 'total'){
									array_push($transactionColumns, $col);
								}
                            }
                            // else{
							// 	if(in_array($col, $membersColumns)){
                            //         $membersSize = sizeof($membersRow);
                            //         $membersRow[$membersSize] = $value;
                            //         if($membersSize == sizeof($membersColumns)){
                            //             array_push($members, $membersRow);
                            //         }
							// // 		// Check if current column matches "Member No"
							// // 		if($col == $membersColumns[1]){
							// // 			$memberNo = explode(" ", $value);
							// // 			// Push first index as type
							// // 			array_push($members, $memberNo[0]);
							// // 			// Push second index as no
							// // 			array_push($members, $memberNo[1]);
							// // 		}else{
							// // 			array_push($members, $value);
							// // 		}
							// 	}
							// 	if(in_array($col, $transactionColumns)){
							// // 		array_push($transaction, $value);
							// 	}
							// }
						}
                    }
                    // echo json_encode($transactionColumns);
                    
                    // Skip the first line for title and allocate the row accordingly
                    for ($row = 2; $row <= $highestRow; ++$row) {
                        $membersRow = array();
                        foreach($membersColumns as $key=>$value){
                                $valueCell = $worksheet->getCell($value . $row)->getValue();
                                $membersRow[$key] = $valueCell;
                                if(sizeof($membersRow) == sizeof($membersColumns)){
                                    array_push($members, $membersRow);
                                }
                            }
                        }
                    }

                    // Explode memberNo into two fields and add into table accordingly
                    foreach($members as $key=>$value){
                        $memberNo = explode(" ", $value[1]);
                        $this->Member->create();
                        $this->Member->save([
                            'name' => $value[0],
                            'type' => $memberNo[0],
                            'no' => $memberNo[1],
                            'company' => $value[2],
                            'valid' => 1,
                            'created' => date("Y-m-d H:i:s"),
                            'modified' => date("Y-m-d H:i:s")
                        ]);
                    }

                    // Do the same for transaction table
                    for ($row = 2; $row <= $highestRow; ++$row) {
                        $transactionRow = array();
                        foreach($transactionColumns as $key=>$value){
                                $valueCell = $worksheet->getCell($value . $row)->getValue();
                                // if($key == 0){
                                //     $worksheet->setCellValue('P3', '=YEAR('.$value . $row.')');
                                //     $worksheet->setCellValue('P2', '=MONTH('.$value . $row.')');
                                //     $worksheet->setCellValue('P1', '=DAY('.$value . $row.')');
                                //     $dayValue = $worksheet->getCell('P1')->getCalculatedValue();
                                //     $monthValue = $worksheet->getCell('P2')->getCalculatedValue();
                                //     $yearValue = $worksheet->getCell('P3')->getCalculatedValue();
                                //     // echo $dayValue;
                                //     // echo $monthValue;
                                //     // echo $yearValue;
                                //     $transactionRow[$key] = date('Y-m-d',strtotime($yearValue.'-'.$monthValue.'-'.$dayValue));
                                //     // echo $yearValue.'-'.$monthValue.'-'.$dayValue;
                                //     // echo $transactionRow[$key];
                                // // break;
                                //     // echo $yearValue;
                                // }else{
                                    $transactionRow[$key] = $value;
                                // }
                                // break;
                                // $valueCell = $worksheet->getCell($value . $row)->getValue();
                                // echo $valueCell;
                                $transactionRow[$key] = $valueCell;
                                if(sizeof($transactionRow) == sizeof($transactionColumns)){
                                    array_push($transaction, $transactionRow);
                                }
                            }
                        }
                    }

                    // echo json_encode($transaction);
                    $this->loadModel('Transaction');

                    foreach($transaction as $key=>$value){
                        // $date = new DateTime($value[0]);
                        // echo json_encode(date('Y-m-d', strtotime($value[0])));
                        $this->Transaction->create();
                        $this->Transaction->save([
                            'member_name' => $value[2],
                            'member_paytype' => $value[3],
                            'member_company' => $value[4],
                            'date' => date('Y-m-d', strtotime($value[0])),
                            'year' => date('Y', strtotime($value[0])),
                            'month' => date('m', strtotime($value[0])),
                            'ref_no' => $value[1],
                            'receipt_no' => $value[7],
                            'payment_method' => $value[5],
                            'batch_no' => $value[6],
                            'cheque_no' => $value[8],
                            'payment_type' => $value[9],
                            'renewal_year' => date('Y', strtotime($value[0])),
                            'remarks' => null,
                            'subtotal' => $value[11],
                            'tax' => $value[12],
                            'total' => $value[13],
                            'valid' => 1,
                            'created' => date("Y-m-d H:i:s"),
                            'modified' => date("Y-m-d H:i:s")
                        ]);
                    }

                    
                    
                    // echo json_encode($memberArray);
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
        }
        $this->set(compact('file_uploads'));
// 		$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
	}

	public function q1_instruction(){
		$this->setFlash('Question: Migration of data to multiple DB table');
// 		$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
	}
	
}
