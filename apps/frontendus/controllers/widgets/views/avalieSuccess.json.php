<?php
$ret = new StdClass();
$ret->status = "ERROR";
$ret->message = "Não foi possível salvar, tente novamente mais tarde";
if(!empty($this->content))
{
	$ret->status = "SUCCESS";
	$ret->message = "Nota salva";
	$ret->data = $this->content->toJSON();
}
echo(json_encode($ret));

?>