<?php
class FuriousPasswordInput extends FuriousFormElement {
 
	public function __construct($name, $label, array $params = null){
		$this->name = $name;
		
		$this->label = new htmlElement("label");
		$this->label->setContent($label);
		
		$this->input = new htmlElement("input");
		$this->input->setAttribute("type", "password");
		$this->input->setAttribute("name", $name);
		
		if(isset($params))
		{
			foreach($params as $key => $value)
			{
				$this->input->setAttribute($key, $value);
			}
		}
	}
}
?>