<?php
	$ret = new StdClass();
	$ret->status = "ERROR";
	if(!empty($this->itens))
	{
		$ret->status = "SUCCESS";
		$ret->data = array();
		
		foreach($this->itens as $item)
		{
			$ret->data[] = $item->toSmallJSON();
		}
		
	}
	echo(json_encode($ret));
?>