<?php
	class FuriousTranslator
	{
		private $translations = null;
		static $translator = null;
		static function init($vars = null)
		{
			if(empty(self::$translator))
			{
				self::$translator = new FuriousTranslator();
			}
			return self::$translator;
		}
		private function __construct()
		{
			$this->translations = Document::openFile(APP_PATH_PREFIX."/lib/languages/".APP_LANGUAGE.".ko");
			$this->translations = explode("\n", $this->translations);
			if($this->translations[(count($this->translations)-1)] == ""){
				unset($this->translations[(count($this->translations)-1)]);
			}
		}
		public function translate($txt, $format)
		{
			foreach($this->translations as $trans):
				$parts = explode("=", $trans);
				$safe = array("(" => "\(",
							  ")" => "\)",
							  "." => "\.",
							 "+" => "\+",
							"*" => "\*");
				$part = str_replace(array_keys($safe), array_values($safe), $parts[0]);
				$rep = trim($parts[1]);
				if($format == "json")
				{
					$rep = utf8_encode($rep);
				}
				$txt = preg_replace("/(\{(".$part.")\})/", $rep, $txt);
			endforeach;

			return $txt;
		}
	}
?>
