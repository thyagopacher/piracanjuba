<?php
$ret = new StdClass();
$ret->status = (!empty($this->msg))?"SUCCESS":"ERROR";
if(!empty($this->msg))
{
	$ret->item = $this->msg->toJSON();
	
}
echo(json_encode($ret));
?>