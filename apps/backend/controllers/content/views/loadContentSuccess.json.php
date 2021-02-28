<?php
$ret = new StdClass();

if(!empty($this->itens[0]))
{
	$ret->status = "SUCCESS";
	$ret->itens = array();
	foreach($this->itens as $item)
	{
		$it = new StdClass();
		$it->ID = $item->getCNTID();
		$it->tit = $item->getCNTTIT();
		$it->url = $item->getURL();
		$it->date = $item->getCNTDTA();
		
		$ret->itens[] = $it;
	}
} else {
	$ret->status = "ERROR";
}
echo(json_encode($ret));
?>