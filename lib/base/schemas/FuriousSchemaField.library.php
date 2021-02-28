<?php
class FuriousSchemaField extends FuriousSchemaElement {
	protected $BasicValidation;
	protected $tableName;
	public function __construct(SimpleXMLElement $XML, $tableName){
		parent::__construct($XML);
		if($this->getAttribute("type"))
		{
			$MaxLength = ($this->getAttribute("length"))? $this->getAttribute("length") : 255;
			switch($this->getAttribute("type")){
				case "varchar":
					$this->BasicValidation = new FuriousValidationString(array("MinLength" => 1, "MaxLength" => $MaxLength));
				break;
				case "int":
					$this->BasicValidation = new FuriousValidationInteger();
				break;
			}
			if($this->getName() == "email"){
				$this->BasicValidation = new FuriousValidationEmail(array("MinLength" => 1, "MaxLength" => $MaxLength));
			}
			if($this->getAttribute("extra") == "auto_increment")
			{
				unset($this->BasicValidation); 
			}
			if(isset($tableName)){
				$this->tableName = $tableName;
			}
			if($this->getAttribute("allowNulls") && $this->getAttribute("allowNulls") == "yes")
			{
				unset($this->BasicValidation);
			}
		}
	}
	public function hasValidation()
	{
		if(isset($this->BasicValidation))
		{
			return true;
		}
		return false;
	}
	public function getValidation()
	{
		return $this->BasicValidation;
	}
	public function isReference()
	{
		if($this->getAttribute("foreignReference") && $this->getAttribute("foreignTable"))
		{
			return true;
		}
		return false;
	}
	public function getType(){
		return $this->getAttribute("type");
	}
	public function getForeignTableName(){
		return $this->getAttribute("foreignTable");
	}
	public function getForeignReferenceName(){
		return $this->getAttribute("foreignReference");
	}
	
	public function getLength()
	{
		return $this->getAttribute("length");
	}
	
	public function getFieldBbName(){
		if(isset($this->tableName))
		{
			return sprintf("`%s`.`%s`", $this->tableName, $this->getName());
		}
		return $this->getName();
	}
	public function __toString()
	{
		return "`".$this->tableName."`.`".$this->getName()."`";
	}
	
	
	public function getSQL()
	{
		$str = "`" . $this->getName() . "` ";
		
		switch($this->getType())
		{
			case "int":
				$str .= $this->getType();
			break;
			case "varchar":
				$str .= $this->getType() . "(".$this->getLength().")";
			break;
			case "text":
				$str .= $this->getType();
			break;
			default:
				$str .= $this->getType();
			break;
		}
		
		if($this->getAttribute("defaultValue"))
		{
			$str .= " DEFAULT " . $this->getAttribute("defaultValue");
		}
		
		if(!$this->getAttribute("allowNulls") || $this->getAttribute("allowNulls") == "no")
		{
			$str .= " NOT NULL";
		}
		if($this->getAttribute("extra"))
		{
			$str .= " ".(strtoupper($this->getAttribute("extra")))." ";
		}
		return $str;
	} 
}
?>