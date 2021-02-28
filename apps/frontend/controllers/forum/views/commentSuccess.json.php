<?php 
$ret = new StdClass();
$ret->status = "ERROR";
$ret->msg = "{Invalid request}";
if(!empty($this->msg))
{
	$ret->msg = $this->msg;
}
if(!empty($this->msg) && $this->msg == "{Content Saved}")
{
	$ret->status = "SUCCESS";
}
echo(json_encode($ret));
?>