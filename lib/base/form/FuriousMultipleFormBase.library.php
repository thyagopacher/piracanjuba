<?php
	abstract class FuriousMultipleFormBase extends FuriousFormBase
	{
		protected $totItens = 1;
		protected $values;
		
		public function appendValues(array $values)
		{
			$this->totItens = count($values);
			$this->values = $values;
			parent::appendValues($values);
		}
		public function configure()
		{
			$this->form = new FuriousMultipleForms($this->totItens, $this->name, $this->url, $this->method);
			foreach($this->fields as $field)
			{
				$this->form->addWidget($field);
			}
			foreach($this->validators as $Field => $validator)
			{
				$this->form->addValidator($Field, $validator);
			}
		}
		public function addWidget($widget){
			//$widget->setFormContainer($this->formName);
			$this->fields[$widget->getName()] = $widget;
			
			if($widget->isUploader())
			{
				$this->isUploader = true;
				$this->uploadFields[] = $widget->getName();
				
				$this->tag->setAttribute("method", "post");
				$this->tag->setAttribute("enctype", "multipart/form-data");
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
			
			//foreach($filesArr as $key => $value)
			//{
			//	if($widget = $this->getField($key)){
			//		$widget->setFile($value);
			//	}
			//}
		}
	}
?>