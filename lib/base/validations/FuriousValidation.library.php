<?php
abstract class FuriousValidation
{
	protected $params, $messages, $field;
	public function __construct (array $params = null)
	{
		if(isset($params))
		{
			$this->params = $params;
		}
	}
	public function validate( $field )
	{
		$errors = array();
		
		$v = $field->getValue();
		$this->field = $field;
		
		if(isset($this->params))
		{
			
			
			foreach($this->params as $key => $value)
			{
				$keyMethod = "validate".$key;
				if(!$this->$keyMethod($v, $value)){
					$errors[$key] = $this->messages[$key];
				}
				
			}
			
		}
		
		if(!$this->validateDefault( $v )){
			$errors[] = $this->messages["Default"];
		}

		if(count($errors) >= 1)
		{
			return $errors;
		} 
		else 
		{
			return true;
		}
		
	}
}
?>