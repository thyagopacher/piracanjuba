<?php
class FuriousFormSchema {
	protected $schema, $table, $form;
	public function __construct(FuriousSchemaTable $tableSchema, $url, $method = "POST")
	{
		$this->schema = $tableSchema;
		
		$this->form = new FuriousForms($this->schema->getName(), $url, $method);
		
		foreach($this->schema->getFields() as $field)
		{
			switch($field->getType()){
				case "int":
					if($field->getName() == "id")
					{
						$this->renderHiddenField($field);
					}
					else 
					{
						$this->renderTextField($field);
					}
				break;
				case "varchar":
					$this->renderTextField($field);
				break;
				case "float":
					$this->renderTextField($field);
				break;
				case "text":
					$this->renderTextArea($field);
				break;
			}
			if($field->hasValidation())
			{
				$this->addValidator($field);
			}
		}
		$this->renderSubmit();
	}
	public function addField($field)
	{
		$this->form->addWidget($field);
	}
	public function renderTextField($field){
		$fieldElement = new FuriousInput($field->getName(), $this->renderUserLabel($field->getName()).":");
		$fieldElement->setAttribute("id", $field->getName());;
		
		$this->addField($fieldElement);
	}
	public function renderHiddenField($field){
		$fieldElement = new FuriousHiddenInput($field->getName(), $this->renderUserLabel($field->getName()).":");
		$fieldElement->setAttribute("id", $field->getName());;
		
		$this->addField($fieldElement);
	}
	protected function renderUserLabel($label){
		return ucfirst(str_replace("_", " ", $label));
	} 
	public function renderTextArea($field){
		$fieldElement = new FuriousTextarea($field->getName(), ucfirst($field->getName()).":");
		$fieldElement->setAttributes(array("id" => $field->getName()));
		
		$this->addField($fieldElement);
	}
	public function renderSubmit()
	{
		$inputSubmit = new FuriousSubmit();
		$this->addField($inputSubmit);
	}
	public function addValidator($field)
	{
		$this->form->addValidator($field->getName(), $field->getValidation());
	}
	public function __toString()
	{
		return sprintf($this->form);
	}
	public function appendValues (array $values)
	{
		$this->form->appendValues($values);
	}
	public function isValid()
	{
		return $this->form->isValid();
	}
	public function validationErrors()
	{
		return $this->form->validationErrors();
	}
}
?>