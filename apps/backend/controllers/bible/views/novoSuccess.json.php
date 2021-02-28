<?php
$ret = new StdClass();
$ret->status = (!empty($this->item))?"SUCCESS":"ERROR";
if(!empty($this->item))
{
	$ret->item = $this->item->toJSON();
	
}
echo(json_encode($ret));
?>