<?php 
$response = new StdClass();
$response->status = (!empty($this->success))?"SUCCESS":"ERROR";
if(!empty($this->content)){
	$response->data = $this->content->toJSON();
}
echo(json_encode($response));
?>