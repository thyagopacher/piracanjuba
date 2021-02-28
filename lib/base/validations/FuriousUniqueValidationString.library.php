<?php
	class FuriousUniqueValidationString extends FuriousValidationString
	{
		public function __construct ($ActiveModel, $field, array $params = null)
		{
			$this->ActiveModel = $ActiveModel;
			$this->Field = $field;
			
			parent::__construct($params);
			$this->messages["MaxLength"] = "A string possui mais caracteres que a quantidade máxima";
			$this->messages["MinLength"] = "A string não possui a quantidade mínima de caracteres";
			$this->messages["Default"] = "Este valor não é único";
		}
		public function validateMinLength ( $v, $min )
		{
			if(strlen(trim($v)) >= $min)
			{
				return true;
			}
			return false;
		}
		public function validateMaxLength ( $v, $max )
		{
			if(strlen(trim($v)) <= $max)
			{
				return true;
			}
			return false;
		}
		public function validateDefault ( $v )
		{
			if(parent::validateDefault( $v ))
			{			
				$criteria = new FuriousSelectCriteria();
				$criteria->add($this->Field, $v, FuriousExpressionsDB::EQUAL);
				$criteria->setLimit(1);
				$obj = call_user_func("{$this->ActiveModel}::doSelect", $criteria);
				
				if(isset($obj[0]) && ($obj[0] !== NULL || $obj[0] !== FALSE))
				{
					return false;
				} else {
					return true;
				}
			} else {
				return false;
			}
		}
	}
?>