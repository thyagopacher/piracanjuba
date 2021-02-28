<?php
/*

Furious Update Criteria

Usage:

$criteria = new FuriousUpdateCriteria();
$criteria->setTable("sys_cars");
$criteria->addFields(array("name" => "Ford Escort", "model" => "2008"));
$criteria->add("sys_cars.name", "Escort", FuriousExpressionsDB::EQUAL);
$criteria->add("sys_cars.model", 2008, FuriousExpressionsDB::EQUAL);
$criteria->setLimit(2);
$criteria->setOffset(2);

print($criteria);

*/


class FuriousUpdateCriteria extends FuriousExpressionsDB {
	protected $type, $offset = NULL, $limit = NULL, $from, $table;
	protected $fields = array();
	protected $filters = array();
	protected $orderCriteria = array();
	
	public function __construct($type = FuriousExpressionsDB::UPDATE){
		$this->type = $type;
	}
	
	public function addFields(array $fields)
	{
		foreach ( $fields as $field => $value)
		{
			$this->addFieldValue($field, $value);
		}
	}
	
	public function mergeFieldsValues(){
		$values = array();
		for($i = 0; $i<count($this->fields); $i++)
		{
			$values[] = sprintf("`%s` %s %s", $this->fields[$i], self::EQUAL, $this->values[$i]);
		}
		return join(self::FieldSeparator, $values);
	}
	// Return Insert string
	private function returnUpdate(){
		
		$query = sprintf("%s `%s`", $this->type, $this->getTable());
		
		$query .= sprintf(" SET %s", $this->mergeFieldsValues());
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
		return $this->returnUpdate();
	}
}

?>