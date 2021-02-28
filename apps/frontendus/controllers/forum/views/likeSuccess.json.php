<?php
$ret = new StdClass();
$ret->status = "ERROR";
if(!empty($this->content))
{
	$ret->status = "SUCCESS";
	$ret->data = $this->content->toJSON();
	$ret->nota = $this->nota;
}
if(!empty($this->message))
{
	$ret->data = $this->message;
}
echo(json_encode($ret));
?>