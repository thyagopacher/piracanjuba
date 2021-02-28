<?php
/*

Furious Insert Criteria

Usage:
$criteria = new FuriousInsertCriteria();
$criteria->setTable("sys_cars");
$criteria->addFields(array("name" => "Ford Escort", "model" => "2008"));
print($criteria);

*/
class FuriousInsertCriteria extends FuriousExpressionsDB {
	protected $type, $offset = NULL, $limit = NULL, $from, $table;
	protected $fields = array();
	protected $filters = array();
	protected $orderCriteria = array();
	protected $values;
	
	public function __construct($type = FuriousExpressionsDB::INSERT){
		$this->type = $type;
	}
	
	public function addFields(array $fields)
	{
		foreach ( $fields as $field => $value)
		{
			$this->addFieldValue($field, $value);
		}
	}
	// Return Insert string
	private function returnInsert(){
		
		$query = $this->type.$this->getTable();
		
		$query .= sprintf(" \n (%s) \n VALUES (%s)", $this->adjustFields(), $this->adjustValues());
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
	// Return Fields with comma separated
	protected function adjustFields(){
		foreach($this->fields as $key => $field)
		{
			$this->fields[$key] = sprintf("`%s`", $field);
		}
		return join(FuriousExpressionsDB::FieldSeparator, $this->fields);
	}
	public function addField($field){
		$this->fields[] = "`".$field."`";
	}
	// Return String
	public function __toString(){
		return $this->returnInsert();
	}
}

?>