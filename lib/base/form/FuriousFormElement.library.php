<?php

abstract class FuriousFormElement
{
	public $containner, $label, $input, $value, $name;
	protected $widgets, $formatR;
	protected $hasUpload = false;
	// Get Name
	
	public function isUploader(){
		return $this->hasUpload;
	}
	public function getName(){
			if(!isset($this->name)){
				return $this->input->getAttribute("id");
			} else {
				return $this->name;
			}
			
	}
	public function &getLabel()
	{
		return $this->label;
	}
	public function getLabelName(){
			return $this->name;		
	}
	// Get Value
	public function getValue()
	{
		return $this->value;
	}
	// Set Attribute
	public function setAttribute($key, $value){
		if($key == "id"){
			if(isset($this->label)){
				$this->label->setAttribute("for", $value);
			}
		}
		$this->input->setAttribute($key, $value);
		return $this;
	}
	// Set Attributes
	public function setAttributes($attributes){
		foreach( $attributes as $key => $value)
		{
			$this->setAttribute($key, $value);
		}
		return $this;
	}
	public function removeAttribute( $attribute )
	{
		$this->input->removeAttribute( $attribute );
		return $this;
	}
	// Set Content
	public function setContent( $v ){
		$this->input->setContent( $v );
	}
	public function setMultiple($value = TRUE)
	{
		$this->isMultiple = $value;
		return $this;
	}
	// Set Form Containner
	public function setFormContainer($containner, $i = NULL, $name = NULL)
	{
		
		$name = ($name != NULL)? $name : $this->name;
		
		$contName = $containner;
		//$this->containner = $containner;
		
		
		if($i !== NULL){
			$contName = sprintf("%s[%s]", $containner, $i);
		}
		if($this->input->getAttribute("name") != false)
		{
			$this->name = $this->input->getAttribute("name");
			$str = (!isset($this->isMultiple) || $this->isMultiple == FALSE)?$contName."[%s]":$contName."[%s][]";
			$this->setAttribute("name", sprintf($str, $name));
		}
		return $this;
	}
	// Set Value
	public function setValue( $v )
	{
		$this->value = $v;
	}
	
	public function renderValues(){
		$this->setAttribute("value", $this->value);
	}
	public function setFormatRender($renderF){
		$this->formatR = $renderF;
	}
	public function returnFormatRenderer()
	{
		$pregs = array("/%INPUT%/i" => "\n {$this->input}");
		if(isset($this->label))
		{
			$pregs["/%LABEL%/i"] = "\n {$this->label} ";
		}
		
		$str = preg_replace(array_keys($pregs), array_values($pregs), $this->formatR);
		
		return $str;	
	}
	// String Convertion
	public function __toString(){
		if(isset($this->value))
		{
			$this->renderValues();
		}
		if(isset($this->widgets))
		{
			$this->setContent(sprintf("\n%s", $this->renderContents()));
		}
		if(isset($this->formatR))
		{
			return $this->returnFormatRenderer();
		}
		
		if(isset($this->label))
		{
			return "\n".$this->label." \n".$this->input."<br />";
		} 
		else
		{
			return "\n".$this->input;
		}
		
	}
	protected function renderContents(){
		$html = "";
		foreach($this->widgets as $widget)
		{
			$html .= sprintf("\t".$widget."\n");
		}
		return $html;
	}
	public function addWidget($widget){
		//$widget->setFormContainer($this->formName);
		$this->widgets[] = $widget;
	}
	public function addWidgets(array $widgets){
		foreach($widgets as $widget)
		{
			$this->addWidget($widget);
		}
	}
}
?>