<?php
	abstract class FuriousFormBase
	{
		protected $name, $method, $url, $form;
		protected $fields = array();
		protected $validators = array();
		protected $excludes = array();
		
		public function __construct($url, $method = "post", $values = NULL, $files = NULL)
		{
			$this->method = $method;
			$this->url = $url;
			//$this->form = new FuriousForms("for", $action, $method)
		}
		public function addValidation($field, $validator)
		{
			$this->validators[$field] = $validator;
		}
		public function addValidations(array $validators)
		{
			foreach($validators as $field => $validator)
			{
				$this->addValidation($field, $validator);
			}
		}
		public function addWidget($widget){
			$this->fields[$widget->getName()] = $widget;
		}
		public function addWidgets(array $widgets){
			foreach($widgets as $widget)
			{
				$this->addWidget($widget);
			}
		}
		public function configure(){
			$this->addWidget(new FuriousSubmit());
			$this->form = new FuriousForms($this->name, $this->url, $this->method);
			foreach($this->fields as $field)
			{
				$this->form->addWidget($field);
			}
			foreach($this->validators as $Field => $validator)
			{
				$this->form->addValidator($Field, $validator);
			}
		}
		public function __toString()
		{
			if(!isset($this->form))
			{
				$this->configure();
			}
			return (string)$this->form;
		}
		public function getName()
		{
			return $this->name;
		}
		public function appendValues (array $values)
		{
			if(!isset($this->form))
			{
				$this->configure();
			}
			$this->form->appendValues($values);
		}
		public function appendFiles(array $files)
		{
			if(!isset($this->form))
			{
				$this->configure();
			}
			$this->form->appendFiles($files);
		}
		public function getValues()
		{
			if(!isset($this->form) || $this->form === NULL || $this->form === FALSE)
			{
				$this->configure();
			}
			
			return $this->form->getValues();
		}
		public function isValid()
		{
			return $this->form->isValid();
		}
		public function validationErrors()
		{
			return $this->form->validationErrors();
		}
		public function saveFiles()
		{
			foreach($this->form->uploadFields as $fieldName)
			{
				$field = $this->fields[$fieldName];
				$field->save();
			}
		}
		public function save(){
			if( $this->form->isUploader ) 
			{
				$this->saveFiles();
			}
			
			$values = $this->getValues();
			$class = $this->class;
			
			$obj = new $class();
			foreach($values as $key => $value)
			{
				if(!in_array($key, $this->excludes)){
					$obj->$key = $value;
				}
			}
			$obj->save();
			
		}
	}
?>