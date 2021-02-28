<?php
class FuriousTextarea extends FuriousFormElement {
 	
	public function __construct($name, $label, array $params){
		$this->name = $name;
		
		$this->label = new htmlElement("label");
		$this->label->setContent($label);
		
		$this->input = new htmlElement("textarea");
		$this->input->setAttribute("name", $name);
		$this->input->setContent(" ");
		
		if(!empty($params))
		{
			foreach($params as $key => $value)
			{
				$this->input->setAttribute($key, $value);
			}
		}
		
	}
	public function renderValues(){
		//$this->setAttribute("value", $this->value);
		$this->input->setContent($this->value);
	}
}
?>