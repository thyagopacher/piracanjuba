<?php
class ValidatorException extends Exception {
	public function __construct($message)
	{
		$this->message = $message;
	}
	
}
?>