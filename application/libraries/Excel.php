<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Excel {
	public function __construct() {
	}
	
	public function writeXLSX($path = '', $title='', $name_file ='', $header = array(), $body = array()) {
		if(empty($header)) {
			return false;
		}
		
		$title = empty($title) ? 'Sin título' : $title;
		$name_file = empty($name_file) ? 'sin_nombre' : $name_file;
		
		$spreadsheet = new Spreadsheet();
		
		$spreadsheet
		->setActiveSheetIndex(0);
		
		$currentRow = 1;
		foreach($header as $key => $value) {
			$spreadsheet
			->setActiveSheetIndex(0)
			->setCellValueByColumnAndRow($currentRow, 1, $value);
			$currentRow += 1;
		}
		
		$currentRow = 2;
		foreach($body as $row) {
			$currentColumn = 1;
			foreach($row as $column) {
				$spreadsheet
				->setActiveSheetIndex(0)
				->setCellValueByColumnAndRow($currentColumn, $currentRow, $column);
				$currentColumn += 1;
			}
			$currentRow += 1;
		}
		
		
		$spreadsheet
		->getActiveSheet()
		->setTitle($title);
		
		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

		if(empty($path)) {
			// Redirect output to a client’s web browser (Xlsx)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="' . $name_file .'.xlsx"');
			header('Cache-Control: max-age=0');
			$writer->save('php://output');	
		} else{
			$writer->save($path);
		}
		
		return true;
	}
	
	public function readXLSX($path = '', $header = false) {
		if(empty($path)) {
			return array();
		}
		
		$reader = new XlsxReader();
		$spreadsheet = $reader->load($path);
		$sheetData = $spreadsheet->getSheet(0)->toArray(null, true, true, true);
		$header = empty($header) ? array_values($sheetData[1]) : $header;
		$data = array_slice($sheetData, 1);
	
		if(!empty($header)) {
			$new_data = array();
			foreach($data as $key => $row) {
				$current = 0;
				$new_row = array();
				foreach($row as $value) {
					if(!empty($header[$current])) {
						$new_row[$header[$current]] = $value;
					}
					$current += 1;
				}
				$new_data[$key + 2] = $new_row;
			}
		}
		return $new_data;
	}
}