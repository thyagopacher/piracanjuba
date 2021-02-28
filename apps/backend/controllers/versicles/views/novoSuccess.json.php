<?php
$ret = new StdClass();
$ret->status = (!empty($this->item))?"SUCCESS":"ERROR";
if(isset($this->sts) && $this->sts == false)
{
	$ret->status = "ERROR";
	$ret->msg = $this->error;
}
if(!empty($this->item))
{
	$ret->item = $this->item->toJSON();
	
}
echo(json_encode($ret));
?>