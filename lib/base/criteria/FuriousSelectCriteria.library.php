<?php
/*

Furious Select Criteria
User:

$criteria = new FuriousSelectCriteria();
$criteria->addFields(array("`sys_cars`.`id`", "`sys_cars`.`client_id`", "`sys_cars`.`manufacturer`", "`sys_cars`.`model`", "`sys_cars`.`year`", "`sys_cars`.`license_plate`", "`sys_cars`.`in_time`", "`sys_cars`.`out_time`"));
$criteria->add("`sys_cars`.`client_id`", 1, FuriousExpressionsDB::NOT_EQUAL);
$criteria->add("`sys_cars`.`manufacturer`", 1, FuriousExpressionsDB::EQUAL);

$criteria->addDescendingOrder("`sys_cars`.`manufacturer`");
$criteria->addAscendingOrder("`sys_cars`.`year`");
$criteria->setLimit(1);
$criteria->setOffset(1);

print($criteria);

*/

class FuriousSelectCriteria extends FuriousExpressionsDB {
	protected $type, $offset = NULL, $limit = NULL, $from;
	protected $fields = array();
	protected $filters = array();
	protected $count_rows = false;
	protected $count_rows_return = false;
	protected $orderCriteria = array();
	protected $hasJoin = false;
	protected $joins = array();
	
	public function __construct($type = FuriousExpressionsDB::SELECT){
		$this->type = $type;
	}
	
	public function addField($field){
		if($field != self::COUNT)
		{
			$this->fields[] = "`{$field}`";
		} else {
			$this->fields[] = "{$field}";
		}
		
	}

	public function addField2($field){
		$this->fields[] = "{$field}";
	}
	
	// Adjust Filters in Array
 /*
function adjustFilters(){
		$filtersArr = array();
		foreach($this->filters as $filter){
			$filtersArr[] = $filter["field"].$filter["criteria"].$filter["value"];
		}
		return $filtersArr;
	}
*/
	public function addCountRowsReturn(){
		$this->count_rows_return = true;
	}
	public function addCountRows(){
		$this->count_rows = true;
	}	
	public function renderJoins ()
	{
		return join(" ", $this->joins);
	}
	// Return SELECT string
	private function returnSelect(){
		
		$query = $this->type." ";
		if($this->count_rows) {
			$query .= " SQL_CALC_FOUND_ROWS ";
		}
		
		if($this->count_rows_return == false)
		{
			$query .= $this->adjustFields().FuriousExpressionsDB::SQL_FROM.$this->getTable();
			
			if($this->hasJoin == true)
			{
				$query .= $this->renderJoins();
			}
			
			
			// Where (Filters)
			$query .= $this->renderWhere();

			
			// Group
			$query .= $this->renderGroup();

			// Order
			$query .= $this->renderOrder();

			// Limit
			$query .= $this->renderLimit();

			// Offset
			$query .= $this->renderOffset();	
		} else {
			$query .= "  FOUND_ROWS() as total";
		}
		
		// Return
		return $query;
	}
	public function addJoin($type, $table, $key1, $key2){
		$this->hasJoin = true;
		$replaces = array(
			"%type%" => $type,
			"%table%" => $table,
			"%key1%" => $key1,
			"%key2%" => $key2
		);
		$this->joins[] = str_replace(array_keys($replaces), $replaces, FuriousExpressionsDB::JOIN_SYNTAX);
		
	}
	// Return String
	public function __toString(){
		return $this->returnSelect();
	}
}

?>