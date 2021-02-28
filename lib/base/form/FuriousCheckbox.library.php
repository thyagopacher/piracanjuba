<?php
class FuriousCheckbox extends FuriousFormElement {
 
	public function __construct($name, $label, $value, array $params = null){
		$this->name = $name;
		
		$this->label = new htmlElement("label");
		$this->label->setContent($label);
		$this->label->setAttribute("for", $this->name);
		
		$this->initValue = $value;
		
		$this->input = new htmlElement("input");
		$this->input->setAttribute("type", "checkbox");
		$this->input->setAttribute("name", $name);
		$this->input->setAttribute("value", $value);
		$this->input->setAttribute("id", $this->name);
		
		if(isset($params))
		{
			foreach($params as $key => $value)
			{
				$this->input->setAttribute($key, $value);
			}
		}
		$this->setFormatRender("%INPUT% %LABEL%");
	}
	public function setValue( $v )
	{
		if($v == $this->initValue)
		{
			parent::setValue($v);
			$this->input->setAttribute("checked", "checked");
		}
	}
	public function getValue()
	{
		if($this->input->getAttribute("checked"))
		{
			$val = parent::getValue();
			return $val;
		}
		return false;
	}
}
?>