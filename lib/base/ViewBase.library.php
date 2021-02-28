<?php
	class ViewBase  {
		public static $js = array();
		public static $css = array();
		static function addJS($path)
		{
			self::$js[] = $path;
		} 
		static function addCSS($path)
		{
			self::$css[] = $path;
		}
	}
?>