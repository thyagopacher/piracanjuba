<?php
abstract class FuriousExpressionsDB {
	
	const SELECT = "SELECT ";
	const INSERT = "INSERT INTO ";
	const UPDATE = "UPDATE ";
	const DELETE = "DELETE ";
	
	const FieldSeparator = ", ";
	
	const SQL_WHERE = " WHERE ";
	const SQL_FROM = " FROM ";
	
	const SQL_AND = " AND ";
	const SQL_OR = " OR ";
	
	const EQUAL = " = ";
	const REGEXP = " REGEXP ";
	const NOT_REGEXP = " NOT REGEXP ";
	
	const NOT_EQUAL = " <> ";
	const GREATER_THAN = " > ";
	const MINOR_THAN = " < ";
	const GREATER_EQUAL = " >= ";
	const MINOR_EQUAL = " <= ";
	const IS_NULL = " IS NULL ";
	const IS_NOT_NULL = " IS NOT NULL ";
	const LIKE = " LIKE ";
	const ILIKE = " ILIKE ";
	const IN = " IN ";
	const NOT_IN = " NOT IN ";
	
	
	const GROUP_BY = " GROUP BY {value} ";
	
	const COUNT = " COUNT(*) as total";

	const ORDER = " ORDER BY ";
	const ORDER_DESC = " {value} DESC";
	const ORDER_ASC = " {value} ASC";
	
	const STR_VALUE = "{value}";
	
	const LIMIT = " LIMIT {value} ";
	const OFFSET = " OFFSET {value} ";
	
	const INNER_JOIN = " INNER JOIN ";
	const LEFT_JOIN = " LEFT JOIN ";
	const RIGHT_JOIN = " RIGHT JOIN ";
	const FULL_JOIN = " FULL JOIN ";
	
	
	
	const JOIN_SYNTAX = ' %type% %table% ON (%key1% = %key2%) ';
	
	protected $values, $table, $group, $complexFilters;

	public function addFieldValue($field, $value)
	{
		$this->fields[] = $field;
		$this->values[] = ($value == '' && $field == "id")? 'null' : sprintf("'%s'", addslashes($value));
	}
	
	public function setLimit( $v )
	{
		$this->limit = $v;
	}
	public function setOffset( $v )
	{
		$this->offset = $v;
	}
	public function setTable($table){
		$this->table = $table;
	}
	// Add Filter
	public function add($fieldName, $value, $criteria){
		$array = array();
		$array["field"] = $fieldName;
		if($criteria != self::IN && $criteria != self::NOT_IN && $criteria != self::IS_NULL && $criteria != self::IS_NOT_NULL)
		{
			$array["value"] = "'$value'";
		} else {
			$array["value"] = "{$value}";
		}
		
		$array["criteria"] = $criteria;
		
		
		$this->filters[] = $array;
	}
	// Complex Filters
	public function addComplexFilter($fieldName1, $value1, $criteria1, $fieldName2, $value2, $criteria2, $JoinType = self::SQL_AND){
		$array1 = array();
		$array1["field"] = $fieldName1;
		$array1["value"] = ($criteria1 != self::IN && $criteria1 != self::NOT_IN)?"'$value1'":"{$value1}";
		$array1["criteria"] = $criteria1;
		
		$array2 = array();
		$array2["field"] = $fieldName2;
		$array2["value"] = ($criteria2 != self::IN && $criteria2 != self::NOT_IN)?"'$value2'":"{$value2}";
		$array2["criteria"] = $criteria2;
		
		$array = array();
		$array["SQL1"] = $array1;
		$array["SQL2"] = $array2;
		$array["JOIN"] = $JoinType;
		
		$this->complexFilters[]  = $array;
	}
	
	
	// Add Fields
	public function addFields(array $fields) {
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
	public function addGroupBy($field)
	{
		$this->group = str_replace(FuriousExpressionsDB::STR_VALUE, $field, FuriousExpressionsDB::GROUP_BY);
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
	// Adjust Filters in Array
	protected function adjustFilters(){
		$filtersArr = array();
		if(!empty($this->filters))
		{
			foreach($this->filters as $filter){
				$filtersArr[] = $this->adjustFilter($filter);
			}
		}
		return $filtersArr;
	}
	// Adjust Complex Filters in Array
	protected function adjustComplexFilters(){
		$filtersArr = array();
		if(!empty($this->complexFilters))
		{
			foreach($this->complexFilters as $filter){

				$filtersArr[] = "(".$this->adjustFilter($filter["SQL1"])." " . $filter["JOIN"]. " " . $this->adjustFilter($filter["SQL2"]).")";
			}
		}
		return $filtersArr;
	}
	protected function adjustFilter($filter)
	{
		return $filter["field"].$filter["criteria"].$filter["value"];
	}
	// Return Current Table
	public function getTable(){
		return $this->table;
	}
	protected function renderWhere()
	{
		$filters = $this->adjustFilters();
		$complex = $this->adjustComplexFilters();
		
		$query = "";
		if(count($filters) > 0 || count($complex) > 0){
			$query .= FuriousExpressionsDB::SQL_WHERE;
		}
		
		if(count($filters) > 0){
			$query .= join(FuriousExpressionsDB::SQL_AND, $filters);
		}
		
		if(count($complex) > 0){
				if($query != FuriousExpressionsDB::SQL_WHERE)
				{
					$query .= FuriousExpressionsDB::SQL_AND . " ";
				}
				$query .= join(FuriousExpressionsDB::SQL_AND, $complex);
		}
		
		return $query;
	}
	protected function renderOrder(){
		if(count($this->orderCriteria) > 0){
			$query = FuriousExpressionsDB::ORDER;
			$query .= join(FuriousExpressionsDB::FieldSeparator, $this->orderCriteria);
			return $query;
		}
		
	}
	protected function renderLimit()
	{
		if($this->limit != NULL){
			$query = str_replace(FuriousExpressionsDB::STR_VALUE, $this->limit, FuriousExpressionsDB::LIMIT);
			return $query;
		}
	}
	protected function renderOffset()
	{
		if($this->offset != NULL){
			$query = str_replace(FuriousExpressionsDB::STR_VALUE, $this->offset, FuriousExpressionsDB::OFFSET);
			return $query;
		}
	}
	protected function renderGroup()
	{
		if($this->group != NULL){
			return $this->group;
		}
	}
	// Return Fields with comma separated
	protected function adjustFields(){
		return join(FuriousExpressionsDB::FieldSeparator, $this->fields);
	}
	// Return Fields with comma separated
	protected function adjustValues(){
		return join(FuriousExpressionsDB::FieldSeparator, $this->values);
	}
}
?>