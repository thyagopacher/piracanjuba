<?php
class FuriousPasswordInput2 extends FuriousFormElement {
 
	public function __construct($name, $label, array $params = null){
		$this->name = $name;
		
		$this->label = new htmlElement("label");
		$this->label->setAttribute("class", "hidden");
		$this->label->setContent($label);
		$this->label->setAttribute("for", $this->name);
		
		$this->input = new htmlElement("input");
		$this->input->setAttribute("type", "password");
		$this->input->setAttribute("name", $name);
		$this->input->setAttribute("placeholder", $label);
		
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