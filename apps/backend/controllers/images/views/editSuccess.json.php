<?php
$return = new StdClass();
$return->status = (count($this->itens) <= 0)?"ERROR":"SUCCESS";
if(count($this->itens) > 0)
{
	$return->files = array();
	foreach($this->itens as $item)
	{
		$return->files[] = $item->toJSON();
	}
}
echo(json_encode($return));
?>