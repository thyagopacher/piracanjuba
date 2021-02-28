<?php

class htmlElement {
	private $tagName, $content;
	private $attributes = array();
	// Construct 
	public function __construct($tagName){
		$this->tagName = $tagName;		
	}
	public function getAttribute($attribute)
	{
		if(isset($this->attributes[$attribute]))
		{
			return $this->attributes[$attribute];
		} else {
			return false;
		}
	}
	public function removeAttribute( $attribute )
	{
		unset($this->attributes[$attribute]);
	}
	// Set Attribute
	public function setAttribute($attribute, $value){
		$this->attributes[$attribute] = $value;
	}
	// Set Attributes
	public function setAttributes($attributes){
		foreach( $attributes as $key => $value)
		{
			$this->setAttribute($key, $value);
		}
	}
	
	public function renderAttributes()
	{
		$html = "";
		foreach($this->attributes as $key => $value){
			$html .= " {$key}=\"{$value}\"";
		}
		return $html;
	}
	// Set Content
	public function setContent($content)
	{
		$this->content = $content;
	}
	public function getContent()
	{
		return $this->content;
	}
	public function __toString()
	{
		if( !isset($this->content) )
		{
			return sprintf("<%s%s />", $this->tagName, $this->renderAttributes());
		} else {
			if(!empty($this->content) && $this->content != " "){
				return sprintf("<%s%s>%s</%s>", $this->tagName, $this->renderAttributes(), $this->content, $this->tagName);
			} 
			return sprintf("<%s%s></%s>", $this->tagName, $this->renderAttributes(), $this->tagName);
		}
	}
}



?>