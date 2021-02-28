<?php
abstract class FuriousSchemaElement
{
	protected $attributes;
	public function __construct(SimpleXMLElement $XML){
		// Save Attributes 
		foreach($XML->attributes() as $attribute => $value){
			$this->attributes[sprintf($attribute)] = sprintf($value);
		}		
	}
	public function getName(){
		return $this->getAttribute( "name" );
	}
	public function getAttribute( $attribute )
	{
		if(isset($this->attributes[$attribute]))
		{
			return $this->attributes[$attribute];
		}
		return false;
	}
} 
?>