<?php
namespace App;
/** 
* Utility function to generate Excel sheet
* \Excel Object -uses MatwebExcel - LARAVEL
*/
Class ExcelHelper{

	private $excelHeaders = [];
	private $excelData = [];
	private $columnsOptions = [];
	private $CellsToMerge = [];
	private $excelAlignmentRTL = false;
	protected $excel;
	
	public function __construct(){
		$this->excel = new \Excel;
	}
	
	public function help(){
		$string ='===============================Setters - Chaining Example ====================================<br/><br/>';
		$string .= '$excelHelper->setColumnOptions([\'A4:J4\'=>[\'size\'=> \'12\',\'bold\'=>true],\'A1:A2\'=>[\'size\'=> \'13\',\'bold\'=>true]])
	->setExcelAlignmentRTL(true);
	->setExcelHeader([$quiz->qz_title.\'(\'.$quiz->qz_code.\')\'])
	->setExcelHeader([$type])
	->setExcelHeader([\'slno\',\'Name\',\'Email\',\'User submission number\',\'Duration (Mins)\'])
	->setExcelData([array])
	->createExcel($download (Bool)[optional], $fileName(String)[optional], $data(Array)[optional] );';
		
		$string.='<br/><br/>================================Getters ===================================<br/><br/>';
		$string.='$data1 = $excelHelper->getExcelHeaders();<br/>';
		$string.='$data2 = $excelHelper->getExcelData();<br/>'; 
		echo '<pre>';
		$reflection = new \ReflectionClass($this);
		echo $reflection->getDocComment();
		echo '<h2>Properties</h2>';
		print_r($reflection->getProperties());
		echo '<h2>Methods</h2>';
		print_r($reflection->getMethods());
		// pre($string);
		
	}

	public function setExcelHeader($data){
		if(!$data || !is_array($data)){
			die('Arguement data must be an array');	
		}
		
		$this->excelHeaders[] = $data;
		return $this;
	}
	
	public function setColumnOptions($data){
		if(!$data){
			die('Arguement data must be an array');	
		}
		
		$this->columnsOptions = $data;
		return $this;
	}
	
	public function getColumnOptions(){
		
		return $this->columnsOptions;
	}
	
	public function setCellsToMerge($data){
		
		if(!$data){
			die('Arguement data must be an array');		
		}
		
		$this->CellsToMerge = $data;
		return $this;
	}
	
	public function getCellsToMerge(){
		
		return $this->CellsToMerge;
	}
	
	public function setExcelAlignmentRTL($bool){
		$this->excelAlignmentRTL = $bool;
	}
	
	public function setExcelData($data){
		
		if(!$data){
			die('Arguement data must be an array');	
		}
		
		$this->excelData[] = $data;
		return $this;
	}
	
	public function getExcelHeaders(){
		return $this->excelHeaders;
	}
	
	public function getExcelData(){
		return $this->excelData;
	}
	
	public function getExcelHeadersAndData(){
		return array_merge($this->getExcelHeaders(), $this->getExcelData());
	}
	
	public function createExcel($download=true,$fileName=null,$allData = null){
	
		if(empty($fileName)){
			$fileName = 'ExportData-'.date('d-M-Y');
		}
		
		if(empty($allData)){
			$allData = $this->getExcelHeadersAndData();
		}
		// pre(\Excel);
		$excelObj = \Excel::create($fileName.' '.date('Y').rand(), function($excel) use($allData) {
			$excel->sheet('sheet1', function($sheet) use($allData) {
			$sheet->with($allData)
					->setOrientation('portrait')
					->setRightToLeft($this->excelAlignmentRTL)
					->removeRow(1,1);
			
				if(!empty($this->getColumnOptions())) {
					
					foreach($this->getColumnOptions() as $column => $options){
						$sheet->cells($column, function($cells) use($options) {
							$leftOrRight = ($this->excelAlignmentRTL) ? 'right' : 'left';
							if(!empty($options)){
								$cells->setFont($options)
									->setAlignment($leftOrRight);
							}
						});
					}
				}
				
				if(!empty($this->getCellsToMerge())){
					foreach($this->getCellsToMerge() as $cellsRange){
						$sheet->mergeCells($cellsRange);
						$sheet->cells($cellsRange, function($cells) {
								$cells->setAlignment('center');
						});
						
					}
				}
			});
		});
		if($download){
			return $excelObj->download('xlsx');
		}
		else{
			return $excelObj;
		}
	
	}
		
	
}