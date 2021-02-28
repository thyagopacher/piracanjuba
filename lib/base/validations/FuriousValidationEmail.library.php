<?php
class FuriousValidationEmail extends FuriousValidationString
{
	public function __construct (array $params = null)
	{
		parent::__construct($params);
		$this->messages["Default"] = "Este e-mail não é Válido!";
	}
	public function validateDefault ( $v )
	{
		parent::validateDefault( $v );
		
		preg_match("/([a-z_.-]+)+([@])+([a-z_-]+)+([.])+([a-z]{0,3})/i", $v, $matches);
		
		if(count($matches) > 0)
		{
			return true;
		}
		return false;
	}
}
?>