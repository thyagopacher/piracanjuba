<?php
$ret = new StdClass();
$ret->status = (!empty($this->itens[0]))?"SUCCESS":"ERROR";
$ret->totalItens = utf8_encode($this->totalItens);
$ret->currentPage = $this->currentPage;
$ret->totalPages = $this->totalPages;
if(!empty($this->itens[0])):
	$ret->data = array();
	foreach($this->itens as $item):
		$ret->data[] = $item->toJSON();
	endforeach;
endif;

echo(json_encode($ret));
?>