<?php
	class View extends ViewBase {
		private $configs;
		public function __construct($controller, $controllerName, $method, $format){

			$configs = Configurator::init();

			$view = new ViewPart();
			foreach(get_object_vars($controller) as $prop => $value){
				$view->$prop = $value;
			}

			$path = $this->generateViewPath($controllerName, $method, $format);

			$content = $view->template($path, $format);

			if(($format == "html" || $format == "htm") && !Dispatcher::isAjax()){

				$layout = new ViewPart();

				$title = (isset($controller->pageTitle))? $controller->pageTitle : $configs->getViewConfig("title");
				$this->contentType = (isset($controller->contentType))? $controller->contentType : "home";
				//var_dump($controller->contentType);

				$layout->pageTitle = $title;
				$keywords = (isset($controller->pageKeywords))? $controller->pageKeywords : $configs->getViewConfig("keywords");
				$description = (isset($controller->pageDescription))? $controller->pageDescription : $configs->getViewConfig("description");
				if(!empty($controller->classes)){
					$layout->classes = $controller->classes;
				}
				if(!empty($controller->IDs)){
					$layout->IDs = $controller->IDs;
				}
				if(!empty($controller->bodyClasses))
				{
					$layout->bodyClasses = $controller->bodyClasses;
				}

				if(!empty($controller->bodyId))
				{
					$layout->bodyId = $controller->bodyId;
				}
				if(!empty($controller->pageOminiture))
				{
					$layout->pageOminiture = $controller->pageOminiture;
				}
				if(!empty($controller->contentType))
				{
					$layout->contentType = $controller->contentType;
				}

				if(!empty($controller->Site))
				{
					$layout->Site = $controller->Site;
				}
				if(!empty($controller->logo))
				{
					$layout->logo = $controller->logo;
				}
				if(!empty($controller->background))
				{
					$layout->background = $controller->background;
				}
				if(!empty($controller->pageID))
				{
					$layout->pageID = $controller->pageID;
				}

				if(!empty($controller->heading))
				{
					$layout->heading = $controller->heading;
				}

				if(!empty($controller->layoutVars))
				{
					$layout->layoutVars = $controller->layoutVars;
				}

				$headers = "<title>{$title}</title>";
				//$headers .= "<meta name=\"description\" content=\"{$description}\"/>";
				//$headers .= "<meta name=\"keywords\" content=\"{$keywords}\"/>";
				$headers .= $this->returnCss();
				$headers .= $this->returnJs()."\n";

				$layout->content = $content;

				$layout->headers = $headers;

				$layoutF = (!empty($controller->useLayout))?$controller->useLayout:"default";

				$html = $layout->template(APP_PATH_PREFIX."apps/".APP_NAME."/layout/".$layoutF.".php");

				if(Configurator::getConfig("cache"))
				{
					Document::writeFile(Dispatcher::getCacheLoc(), $html);
				}
				if(APP_NAME != "frontend")
				{
					header("Content-type: text/html; charset=iso-8859-1");
				}
				//header("Content-type: text/html; charset=iso-8859-1");

				echo($html);

				/*echo "<pre>";
				print_r(Debugger::$querys);
				echo "</pre>";*/

			} else {
				if(Configurator::getConfig("cache"))
				{

					Document::writeFile(Dispatcher::getCacheLoc(), $content);
				}
				echo($content);
			}

		}
		static function hasViewFile($controller, $method, $format = "html")
		{
			if(file_exists(self::generatePath($controller, $method, $format)))
			{
				return true;
			}
			return false;
		}
		static function generatePath($controllerName, $method, $format)
		{
			$controllerFolder = str_replace("controller", "", strtolower($controllerName));
			$controller = strtolower($controllerName);
			$path = APP_PATH_PREFIX."apps/".APP_NAME."/controllers/{$controllerFolder}/views/{$method}Success.{$format}.php";
			return $path;
		}
		private function generateViewPath($controllerName, $method, $format)
		{
			$controllerFolder = str_replace("controller", "", strtolower($controllerName));
			$controller = strtolower($controllerName);
			$path = APP_PATH_PREFIX."apps/".APP_NAME."/controllers/{$controllerFolder}/views/{$method}Success.{$format}.php";
			return $path;
		}
		public function returnCss()
		{
			$configs = Configurator::init();

			$html = "";

			$css = $configs->getViewConfig("css");
			$strCache = $this->renderCacheStr();
			if( !empty ( $strCache ) )
			{
				$strCache = "?" . $strCache;
			}
			if(isset($css['view']))
			{
				foreach($css["view"] as $media => $path)
				{
					$html .= "\n\t<link rel=\"stylesheet\" href=\"{$path}{$strCache}\" type=\"text/css\" media=\"{$media}\" />";
				}
			}
			if(count(parent::$css) > 0)
			{
				foreach(parent::$css as $path)
				{
					$html .= "\n\t<link rel=\"stylesheet\" href=\"{$path}{$strCache}\" type=\"text/css\" media=\"{$media}\" />";
				}
			}
			return $html;
		}
		public function renderCacheStr()
		{
			$configs = Configurator::init();

			$cache = $configs->getConfig("cache");
			if( $cache === false )
			{
				return ((string)time());
			}
			return "";
		}
		public function returnJs()
		{
			$configs = Configurator::init();

			$html = "";
			$cfg = $configs->getViewConfig("scripts");
			if(isset($cfg[0]))
			{
				foreach($cfg as $path)
				{
					$html .= "\n\t<script src=\"{$path}\"></script>";
				}
			}

			if(count(ViewBase::$js) > 0)
			{
				foreach(ViewBase::$js as $path)
				{
					$html .= "\n\t<script src=\"{$path}\"></script>";
				}
			}
			return $html;
		}

	}
