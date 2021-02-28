<?php
	$response = new StdClass();
	if(!empty($this->tags[0]))
	{

		$response->status = "SUCCESS";
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