<?php
class FuriousSubmit extends FuriousFormElement {
 	
	public function __construct($value = "Enviar", $id = "BtnSubmit"){
		$this->input = new htmlElement("input");
		$this->input->setAttribute("type", "submit");
		$this->input->setAttribute("id", $id);
		$this->input->setAttribute("value", $value);
	}
}
?>