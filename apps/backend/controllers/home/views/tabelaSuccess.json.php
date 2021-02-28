<?php
	$response = new StdClass();
	if(!empty($this->tags[0]))
	{
		
		$response->status = "SUCCESS";
		$response->contador = $_SESSION['count_tabela'] - 1;
		$tagsArr = array();
		foreach($this->tags as $tag):
			$tagsArr[] = $tag->toJSON();
		endforeach;


		$response->itens = $tagsArr;
	} else {
		$response->status = "ERROR";
	}



	echo(json_encode($response));
?>