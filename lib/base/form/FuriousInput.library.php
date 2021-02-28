<?php
class FuriousInput extends FuriousFormElement {
 
	public function __construct($name, $label, array $params = null){
		$this->name = $name;
		
		$this->label = new htmlElement("label");
		$this->label->setContent($label);
		$this->label->setAttribute("for", $name);
		
		$this->input = new htmlElement("input");
		$this->input->setAttribute("type", "text");
		$this->input->setAttribute("name", $name);
		//$this->input->setAttribute("id", $this->name);
		
		
		
		if(isset($params))
		{
			foreach($params as $key => $value)
			{
				$this->input->setAttribute($key, $value);
			}
		}
	}
	public function setValue($v)
	{
		parent::setValue($v);
	}
}
?>