<?php
/*
Delete Criteria 
Usage:

$criteria = new FuriousDeleteCriteria();
$criteria->addFields(array("`sys_cars`.`id`", "`sys_cars`.`client_id`", "`sys_cars`.`out_time`"));
$criteria->setTable("sys_cars");
$criteria->add("`sys_cars`.`client_id`", 1, FuriousExpressionsDB::NOT_EQUAL);
$criteria->add("`sys_cars`.`manufacturer`", 1, FuriousExpressionsDB::EQUAL);

*/
class FuriousDeleteCriteria extends FuriousExpressionsDB {
	protected $type, $offset = NULL, $limit = NULL, $from;
	protected $fields = array();
	protected $filters = array();
	protected $orderCriteria = array();
	
	public function __construct($type = FuriousExpressionsDB::DELETE){
		$this->type = $type;
	}
	
	// Return Current Table
	public function getTable(){
		return $this->table;
	}
	
	// Return SELECT string
	private function returnDelete(){
		
		$query = $this->type.FuriousExpressionsDB::SQL_FROM.$this->getTable();
		
		// Joins
		
		// Where (Filters)
		$query .= $this->renderWhere();
		
		// Order
		$query .= $this->renderOrder();
		
		// Limit
		$query .= $this->renderLimit();
		
		// Offset
		$query .= $this->renderOffset();
	
		// Return
		return $query;
	}
	
	// Return String
	public function __toString(){
		return $this->returnDelete();
	}
}

?>