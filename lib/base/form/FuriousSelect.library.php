<?php
class FuriousSelect extends FuriousFormElement {
 	
	public function __construct($name, $label, array $options, array $params = NULL){
		$this->name = $name;
		$this->value = "";
		$this->isMultiple = false;
		
		$this->label = new htmlElement("label");
		$this->label->setAttribute("for", $this->name);
		$this->label->setContent($label);
		
		$this->input = new htmlElement("select");
		$this->input->setAttribute("name", $name);
		$this->input->setAttribute("id", $this->name);
		$this->input->setContent(" ");
		
		foreach($options as $value => $labelOption)
		{
			$option = new htmlElement("option");
			$option->setAttribute("value", $value);
			$option->setContent($labelOption);
			
			$this->addWidget($option);
		}
		if($params != NULL){
			foreach($params as $paramName => $paramValue)
			{
				$this->input->setAttribute($paramName, $paramValue);
			}
		}
		return $this;
	}
	public function &getLabel()
	{
		return $this->label;
	}
	public function setSelected($value)
	{
		foreach($this->widgets as $widget)
		{
			if($widget->getAttribute("value") == $value)
			{
				$widget->setAttribute("selected", "selected");
			} else {
				$widget->removeAttribute("selected");
			}
		}
		return $this;
	}
	public function setValue( $v )
	{

		if(!empty($this->widgets))
		{
			$this->setSelected($v);
		} else {
			$this->value = $v;
		}
		return $this;
	}
	public function getValue ()
	{
		if(!empty($this->widgets))
		{
			foreach($this->widgets as $widget)
			{
				if($widget->getAttribute("selected"))
				{
					return ($widget->getAttribute("value"));
				}
			}
		} else{
			return $this->value;
		}
		
		return null;
	}
}
?>