<?php
$ret = new StdClass();
$ret->status = "ERROR";
if(!empty($this->itens))
{
	$ret->status = "SUCCESS";
	$ret->data = $this->itens->toJSON();
}
echo(json_encode($ret));
?>