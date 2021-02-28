<?php

class HtmlCleanner {
	static function cleanBreakedAttributes($html){
		return self::cleanAttributes(preg_replace( "/( ((?!(src|href))[a-z]+(=)+([a-zA-Z0-9 %#;:,-]+)))/i", "", $html));
	}
	static function replaceStr($src, $search, $replace){
		return str_replace($search, $replace, $src);
	}
	static function cleanAttributes($html){
		return preg_replace( "/( ((?!(src|href))[a-z]+(=\")+([a-zA-Z0-9 %#;:,-]+)+(\")))/i", "", $html);
	}
	static function removeTags($html, $deniedBlockFull=null, $justClean=null){
		$str = $html;
		foreach($deniedBlockFull as $removeFull){
			$preg = '/<('.$removeFull.' [ a-zA-Z0-9=_:?".\/-]+)>(.+)<\/'.$removeFull.'>/i';
			$str = preg_replace($preg, "", $str);
		}
		foreach($justClean as $tags){
			$preg1 = '/<'.$tags.'[ a-zA-Z0-9=".?:\/]>/i';
			$str = preg_replace($preg1, "", $str);
			
			$preg2 = '/<'.$tags.'>/i';
			$str = preg_replace($preg2, "", $str);
			
			$preg3 = '/<\/'.$tags.'>/i';
			$str = preg_replace($preg3, "", $str);
			
		}
		return $str;
	}
}
?>