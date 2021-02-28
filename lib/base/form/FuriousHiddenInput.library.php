<?php
class FuriousHiddenInput extends FuriousFormElement {
 
	public function __construct($name, $label, $value = null, $attributes = null){
		$this->name = $name;
		
		$this->input = new htmlElement("input");
		$this->input->setAttribute("type", "hidden");
		$this->input->setAttribute("name", $name);
		$this->input->setAttribute("id", $name);
		
		if($value != null)
		{
			$this->input->setAttribute("value", $value);
		}
		
		if($attributes != null)
		{
			foreach($attributes as $key => $value)
			{
				$this->input->setAttribute($key, $value);
			}
		}
	}
	
}
?>