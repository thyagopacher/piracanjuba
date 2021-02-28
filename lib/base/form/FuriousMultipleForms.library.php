<?php

class FuriousMultipleForms extends FuriousForms {
	protected $totItens;
	protected $baseFields;
	
	public function __construct($contItens, $formName, $action, $method){
		$this->totItens = $contItens;
		parent::__construct($formName, $action, $method);
	}
	public function __toString()
	{
		
		$str = "";
		
		$str .= $this->renderContents();
		
		$submit = new FuriousSubmit();
		$str .= $submit;
			
		$this->tag->setContent($str);
		
		return (string)$this->tag;
	}
	protected function renderContents($i = NULL){
		if(empty($this->widgets))
		{
			$this->generateFields();
		}
		$htm = "";
		
		
		foreach($this->widgets as $int => $group)
		{
			$fieldset = new htmlElement("fieldset");
			$fieldset->setAttribute("class", "multipleForm");
			$html = "";
			
			foreach($group as $fieldName => $widget){
				
				
				$widget->setFormContainer($this->formName, (int)($int));
				
				$html .= str_replace("\n", "\n\t", $widget);
			}
			$fieldset->setContent($html."\n");
			$htm .= (string)$fieldset;
			
		}
		return $htm;
		
	}
	public function addWidget($widget){

		$this->baseFields[$widget->getName()] = $widget;
		
		if($widget->isUploader())
		{
			$this->isUploader = true;
			$this->uploadFields[] = $widget->getName();
			
			$this->tag->setAttribute("method", "post");
			$this->tag->setAttribute("enctype", "multipart/form-data");
		}
	}
	public function generateFields(){
		for($i=1; $i<=$this->totItens; $i++){
			$inpt = array();
			
			foreach($this->baseFields as $name => $field)
			{
				$inpt[$name] = clone $field;
			}
			$this->widgets[] = $inpt;
		}
		
	}
	public function appendValues(array $values){
		if(empty($this->widgets)){
			$this->generateFields();
		}
		
		
		foreach($values as $FieldInt => $fields)
		{
			foreach($fields as $fieldName => $value)
			{
				if($widget = &$this->getField($fieldName, $FieldInt)){
					$widget->setValue($value);
				}
				
			}
			//
		}
	}
	public function getValues(){
		$values = array();
		foreach($this->getFields() as $fieldInt)
		{
			foreach($fieldInt as $field){
				if($field->getName() != "BtnSubmit")
				{
					$values[$field->getName()] = $field->getValue();
				}
			}
			
		}
		return $values;
	}
	
	public function &getField($fieldName, $int = NULL)
	{
		
		return $this->widgets[$int][$fieldName];
	}
}

?>