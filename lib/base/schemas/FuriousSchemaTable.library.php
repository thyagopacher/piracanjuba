<?php
	class FuriousSchemaTable extends FuriousSchemaElement
	{
		protected $attributes, $fields = array();
		public function __construct(SimpleXMLElement $XML){
			parent::__construct($XML);
			// Render Fields
			foreach($XML->field as $fieldXML)
			{
				$field = new FuriousSchemaField($fieldXML, $this->getName());
				$name = $field->getName();
				$this->fields[$name] = $field;
			}
		}
		
		public function getPrimaryKey()
		{
			if(isset($this->attributes["primaryKey"]))
			{
				return $this->attributes["primaryKey"];
			}
				return false;
		}
		public function getEngine()
		{
			if(isset($this->attributes["engine"]))
			{
				return $this->attributes["engine"];
			}
				return false;
		}
		public function getField ( $fieldName )
		{
			if(isset($this->fields[$fieldName]))
			{
				return $this->fields[$fieldName];
			}
			return false;
		}
		public function getFields()
		{
			return $this->fields;
		}
		
		public function getSQL()
		{
			$sql = "CREATE TABLE IF NOT EXISTS `" . ($this->getName()) . "` (";
			$fieldArr = array();
			foreach($this->fields as $field)
			{
				$fieldArr[] = $field->getSQL();
			}

			$sql .= implode(", ", $fieldArr);
			
			if($this->getPrimaryKey())
			{
				
				$sql .= ", PRIMARY KEY (".($this->getPrimaryKey()).")";
			}
			if($this->getEngine() && strtolower($this->getEngine()) != "myisam")
			{
				$sql .= " ENGINE=".$this->getEngine();
			}
			
			$sql .= ")";
			return $sql;
		}
	}
?>