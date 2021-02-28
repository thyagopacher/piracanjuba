<?php

class HtmlInspect {
	static function getAttribute($attr, $html){
		$preg = "/".$attr."=\"([a-zA-Z0-9.:\/_?()-]+)\"/i";
		if(preg_match($preg, $html)){
			preg_match($preg, $html, $matches, PREG_OFFSET_CAPTURE);
			return $matches[1][0];
		} else {
			return false;
		}
	}
	static function getAttributes($attr, $html){
		$preg = "/".$attr."=\"([a-zA-Z0-9.:\/_?()-]+)\"/i";
		preg_match_all($preg, $html, $counts);
		if(count($counts[1]) > 0){
			return $counts[1];
		}
	}
	static function hasAttribute($attr, $html){
		$preg = "/".$attr."=\"([a-zA-Z0-9.:\/_?-]+)\"/i";
		if(preg_match($preg, $html)){
			return true;
		} else {
			return false;
		}
	}
}


?>