<?php 
$ret = new StdClass();
$ret->status = (!empty($this->files))?"SUCCESS":"FALSE";
$ret->data = $this->files->toJSON();
echo(json_encode($ret));
?>