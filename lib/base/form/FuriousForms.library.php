<?php

class FuriousForms extends FuriousFormContainner {
	protected $validators, $formName, $tag;
	public $uploadFields = array();
	
	public $isUploader = false;
	
	
	public function __construct($formName, $action, $method){
		$this->formName = $formName;
		
		$this->tag = new htmlElement("form");
		$this->tag->setAttributes(array("name" => $formName, "id" => "Form".$formName, "action" => $action, "method" => $method));
	}
	
	public function addWidget($widget){

		parent::addWidget($widget);
		
		if($widget->isUploader())
		{
			$this->isUploader = true;
			$this->uploadFields[] = $widget->getName();
			
			$this->tag->setAttribute("method", "post");
			$this->tag->setAttribute("enctype", "multipart/form-data");
		}
	}
	
	public function addValidator($field, $validator){
		$this->validators[$field] = $validator;
	}
	public function addValidators(array $validators)
	{
		foreach($validators as $field => $validator)
		{
			$this->addValidator($field, $validator);
		}
	}
	
	public function __toString()
	{
		$fieldset = new htmlElement("fieldset");
		$fieldset->setContent($this->renderContents()."\n");
		$this->tag->setContent(((string)$fieldset));
		return (string)$this->tag;
	}
	public function getField($fieldName)
	{
		return $this->widgets[$fieldName];
	}
	public function getFields()
	{
		return $this->widgets;
	}
	public function appendValues(array $values){
		foreach($values as $key => $value)
		{
			if($widget = $this->getField($key)){
				$widget->setValue($value);
			}
			//$this->widgets[$key]->setValue($value);
		}
	}
	public function appendFiles(array $files)
	{
		$filesArr = array();
		foreach($files["tmp_name"] as $fieldName => $fieldTmpName)
		{
			if(!$files["error"][$fieldName] != 0 )
			{
				$fileObj = new StdClass();
				$fileObj->tmpName = $fieldTmpName;
				$fileObj->type = $files["type"][$fieldName];
				$fileObj->name = $files["name"][$fieldName];
				$fileObj->size = $files["size"][$fieldName];
				$filesArr[$fieldName] = $fileObj;
			} else {
				$filesArr[$fieldName] = false;
			}
		}
		
		foreach($filesArr as $key => $value)
		{
			if($widget = $this->getField($key)){
				$widget->setFile($value);
			}
		}
	}
	public function getValues(){
		$values = array();
		foreach($this->getFields() as $field)
		{
			if($field->getName() != "BtnSubmit")
			{
				$values[$field->getName()] = $field->getValue();
			}
		}
		return $values;
	}
	public function isValid()
	{
		if($this->validate() === true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function validate()
	{
		$errors = array();
		if(isset($this->validators) && count($this->validators) > 0)
		{
			foreach($this->validators as $field => $validator)
			{
				
				$value = $this->getField($field)->getValue();
				$name = $this->getField($field)->getLabelName();
				//$validation = $validator->validate($value);
				$validation = $validator->validate($this->getField($field));
				

				if($validation !== true)
				{
					$errors[$name] = $validation;
				}
			}
			if(count($errors) < 1)
			{
				return true;
			}
			else
			{
				return $errors;
			}
		}
		return true;
	}
	public function validationErrors($startTag = "\n\t<li>", $endTag = "</li>")
	{
		$problems = $this->validate();
		$html = "";
		foreach($problems as $field => $validations)
		{
			foreach($validations as $validation => $message)
			{
				$html .= sprintf($startTag."%s %s".$endTag, $field, $message);
			}
		}
		return $html;
	}
}

?>