<?php
class FuriousCriteria extends FuriousExpressionsDB {
	private $type, $offset = NULL, $limit = NULL, $from;
	private $fields = array();
	private $filters = array();
	private $orderCriteria = array();
	
	public function __construct($type = FuriousExpressionsDB::SELECT){
		$this->type = $type;
	}
	
	// Add Fields
	public function addFields($fields) {
		if(is_array($fields)){
			foreach($fields as $field){
				$this->addField($field);
			}
		} else {
			return false;
		}
	}
	
	// Add Field
	public function addField($field){
		$this->fields[] = $field;
	}
	
	// Add Filter
	public function add($fieldName, $value, $criteria){
		$this->filters[] = array("field" => $fieldName, "value" => "'$value'", "criteria" => $criteria);
	}
	
	// Order Desc
	public function addDescendingOrder($fieldName){
		$criteria = str_replace(FuriousExpressionsDB::STR_VALUE, $fieldName, FuriousExpressionsDB::ORDER_DESC);
		$this->orderCriteria[] = $criteria;
	}
	
	// Order ASC
	public function addAscendingOrder($fieldName){
		$criteria = str_replace(FuriousExpressionsDB::STR_VALUE, $fieldName, FuriousExpressionsDB::ORDER_ASC);
		$this->orderCriteria[] = $criteria;
	}
	
	// Set Limit
	public function setLimit($limit){
		$this->limit = $limit;
	}
	
	// Set OFFSET
	public function setOffset($offset){
		$this->offset = $offset;
	}
	
	// Adjust Filters in Array
	private function adjustFilters(){
		$filtersArr = array();
		foreach($this->filters as $filter){
			$filtersArr[] = $filter["field"].$filter["criteria"].$filter["value"];
		}
		return $filtersArr;
	}
	
	// Return Fields with comma separated
	private function adjustFields(){
		return join(FuriousExpressionsDB::FieldSeparator, $this->fields);
	}
	
	// Return Current Table
	public function getTable(){
		$preg = "/\`([a-z0-9_-]+)\`\./i";
		preg_match($preg, $this->fields[0], $matches, PREG_OFFSET_CAPTURE);

		$match = $matches[1][0];
		return "`$match`";
	}
	
	// Return SELECT string
	private function returnSelect(){
		
		$query = $this->type." ".$this->adjustFields().FuriousExpressionsDB::SQL_FROM.$this->getTable();
		
		// Joins
		
		// Where (Filters)
		$filters = $this->adjustFilters();
		if(count($filters) > 0){
			$query .= FuriousExpressionsDB::SQL_WHERE;
			$query .= join(FuriousExpressionsDB::SQL_AND, $filters);
		}
		// Order's
		if(count($this->orderCriteria) > 0){
			$query .= FuriousExpressionsDB::ORDER;
			$query .= join(FuriousExpressionsDB::FieldSeparator, $this->orderCriteria);
		}
		
		// Limit's
		if($this->limit != NULL){
			$query .= str_replace(FuriousExpressionsDB::STR_VALUE, $this->limit, FuriousExpressionsDB::LIMIT);
		}
		// Offset
		if($this->offset != NULL){
			$query .= str_replace(FuriousExpressionsDB::STR_VALUE, $this->offset, FuriousExpressionsDB::OFFSET);
		}
		
		// Return
		return $query;
	}
	
	// Return String
	public function __toString(){
		return $this->returnSelect();
	}
}

?>