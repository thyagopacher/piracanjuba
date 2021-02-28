<?php
$ret = new StdClass();
$ret->status = (!empty($this->itens))?"SUCCESS":"ERROR";
if(!empty($this->itens))
{
	$ret->data = $this->itens->toJSON();
}
echo(json_encode($ret));
?>