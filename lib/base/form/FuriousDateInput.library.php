<?php
class FuriousDateInput extends FuriousInput {
 	public function getValue()
	{
		return strtotime($this->value);
	}
	public function setValue( $v )
	{
		if(preg_match("/\-/i", $v))
		{
			$this->value = $v;
		} else {
			if($v != ""){
				$this->value = date("d-m-Y H:i", $v);
			} else {
				$this->value = date("d-m-Y H:i", time());
			}
		}
	}
}
?>