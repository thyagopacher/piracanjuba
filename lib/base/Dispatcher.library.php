<?php

	class Dispatcher {
		const BASE_URL = "";
		const CACHED_SITE = true;
		const CACHE_DIR = "cache/url/";
		const CACHE_LIFETIME = 20;
		const VARIABLE_PREFIX = ':';
		static $dispatcher = null;
		static $routes = array();
		static $Autoloader = null;
		static $matches;
		static $session;
		static $calledRoute;
		static $siteID = APP_DEFAULT_EDITORIAL;

		static $calledController, $calledMethod , $calledFormat, $params;

		static function getSite()
		{
			return self::$siteID;
		}
		static function setSite($siteID)
		{
			self::$siteID = $siteID;
		}
		// Add Routes
		static function addRoutes($preg, $controller, $method, $format = "html", $useDefaultEdt = true, $isCached = true, $variables = NULL)
		{
			$params = array("PREG" => $preg, "CONTROLLER" => $controller, "METHOD" => $method, "CACHE" => $isCached, "FORMAT" => $format, "VARS" => $variables);
			if(!is_bool($useDefaultEdt))
			{
			  $params["EDITORIA"] = $useDefaultEdt;
			}

			self::$routes[] = $params;
		}
		// Start Object
		static function init(){
			if(self::$dispatcher == null || !isset(self::$dispatcher)){
				self::$dispatcher = new Dispatcher();
			}
			return self::$dispatcher;
		}
		static function getRAWURL()
		{
			$url = $_SERVER["REQUEST_URI"];
			$url = str_replace(self::BASE_URL, "", $url);
			if(!empty($_SERVER["REDIRECT_QUERY_STRING"])){
				$url = str_replace("?".$_SERVER["REDIRECT_QUERY_STRING"], "", $url);
			}

			return $url;
		}
		static function getCacheLoc()
		{
			$url = self::getRAWURL();
			$cacheCode = APP_PATH_PREFIX . Dispatcher::CACHE_DIR . (md5($url));
			if(Dispatcher::isAjax())
			{
				$cacheCode .= ".ajax.tmp.cache.dat";
			} else {
				$cacheCode .= ".tmp.cache.dat";
			}
			return $cacheCode;
		}
		// Construct Route
		public function __construct()
		{
			self::$Autoloader = Autoloader::init();

			$configs = Configurator::getConfig("security");

			$url = self::getRAWURL();

			if($configs['isSecure'] == true) {
				preg_match("/(" . $configs['loginController'] . ")/i", $url, $match );
			}

			//print_r($match);

			if(($configs['isSecure'] == true && !self::isUserLogged()) &&  ( empty($match[1]) ||  $match[1] != $configs['loginController']) )
			{
				self::forward($configs['loginController'], $configs['loginMethod']);
			}

			foreach( self::$routes as $route )
			{
				if(preg_match($route["PREG"], $url))
				{



					preg_match($route["PREG"], $url, self::$matches);
					$controller = ucfirst( $this->isVariable( $route["CONTROLLER"] ) ) . "Controller";
					$method = $this->isVariable( $route["METHOD"] );
					$format = $this->isVariable( $route["FORMAT"] );

					$params = array();
					$params[] = self::$matches;
					$params['pgFormat'] = $format;

					$params["GET"] = $_GET;
					if(!empty($route['VARS']))
					{
						foreach($route['VARS'] as $key => $value )
						{
							$params['VARS'][$key] = $this->isVariable( $route["VARS"][$key] );
						}
					}
					//$params["VARS"] = $route["VARS"];


					if(Configurator::getConfig("cache") && APP_NAME != 'backend' && $route['CACHE'])
					{
						$cacheCode = self::getCacheLoc();

						if(Document::hasFile($cacheCode) && (Document::getModTime($cacheCode) >= (time() - self::CACHE_LIFETIME)))
						{
							include($cacheCode);
							echo "<!-- Furious Cache Date: ".(date("d/m/Y H\h i ", Document::getModTime($cacheCode))) . "-->";
							exit(0);
						}
					}

					self::$calledController = $controller;
					self::$calledMethod = $method;
					self::$calledFormat = $format;
					self::$calledRoute = $route;
					self::$params = $params;

					try {

						self::$Autoloader->controller($controller);

						$cont = new $controller($method, $params);
						$cont->$method($params);

					}
					catch (RequestException $e)
					{

						var_dump($e);
						self::renderError();
					}
					break;
				}
			}

			if( empty(self::$calledController) )
			{

				self::renderError();
			}
		}
		static function getCalledPage(){
			$arr = array("CONTROLLER" => self::$calledController, "METHOD" => self::$calledMethod);
			return $arr;
		}
		static private function renderError(){
			self::$calledController = "DefaultController";
			self::$calledMethod = "error404";
			self::$calledFormat = "html";

			$cont = new DefaultController(self::$calledMethod, null);
			$cont->error404();
		}
		private function isVariable( $v )
		{
			if(preg_match("/" . self::VARIABLE_PREFIX . "([0-9]+)/i", $v ))
			{
				preg_match("/" . self::VARIABLE_PREFIX . "([0-9]+)/i", $v, $vars );
				return self::$matches[(((int)$vars[1])+1)];
			}
			return $v;
		}
		static function isInterna()
		{
			return (self::$calledController!="home" && self::$calledMethod!="index");
		}

		static function forwardRaw ($url)
		{
			header("Location: http://{$_SERVER['HTTP_HOST']}".$url);
		}
		// Forward User
		static function forward ($controller, $action, $format = "html")
		{
			$url = self::generateURL($controller, $action, $format = "html");

			header("Location: http://{$_SERVER['HTTP_HOST']}".$url);
		}
		// Generate URL
		static function generateURL($controller, $action, $format = "html")
		{
			if(APP_NAME == "backend" && $format == "html"){
				$format = "php";
			}
			return sprintf("%s%s/%s.%s", APP_WEB_PREFIX, $controller, $action, $format);
		}
		static function getCurrentPageVars()
		{
			return self::$params;
		}
		/*
		static function getMatches()
		{
			return $this->matches;
		}
		*/
		static function getEditorialID()
		{
			if(!empty(self::$calledRoute["EDITORIA"]))
			{
				return self::$calledRoute['EDITORIA'];
			}
			if(preg_match("/([0-9]+)+(-)+([a-z0-9+_-]+)(?:(\/))?/i", self::$matches[0])){
				return self::$matches[1];
			}
			if(APP_NAME == "backend"){
				return APP_DEFAULT_EDITORIAL;
			}
			return false;
		}
		static function generateEditorialURL($params, $params2 = null)
		{
			$editorialID = self::getEditorialID();
			$edt = ProdutoModel::getOne($editorialID);
			$edt = $edt[0];

			$url = APP_WEB_PREFIX . $edt->getPDTID() . "-" . Slugfy($edt->getPDTNOM()) . "/";

			$tot = count($params);
			$vCont = 1;
			foreach($params as $param)
			{
				$url .= $param;

				$ext = (APP_NAME == "backend")? ".php" : ".html";

				$url .= ($vCont < ($tot) )? "/" : $ext;

				$vCont++;
			}

			if($params2 != null)
			{
				$url .= "?";
				$vars = array();

				foreach($params2 as $key => $value)
				{
					$vars[] = $key."=".$value;
				}
				$url .= join("&", $vars);
			}

			return $url;
		}
		// Check if is Ajax
		static function isAjax()
		{
			return ((!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") && empty($_GET['withTemplate']));
		}
		// Get POST Variables
		static function getPostValues($containner)
		{
			if(isset($_POST[$containner]))
			{
				return $_POST[$containner];
			}
			return false;
		}
		// Get Uploaded Files
		static function getFiles($containner)
		{
			if(isset($_FILES[$containner]))
			{
				return $_FILES[$containner];
			}
			return false;
		}
		// Init Sessions
		static function initSession(){
			if(!isset(self::$session))
			{
				session_start();
				self::$session = true;
			}
		}
		// Set Session Value
		static function setSessionValue($key, $value)
		{
			self::initSession();
			$_SESSION[$key] = $value;
		}
		static function unsetSessionValue($key)
		{
			self::initSession();
			unset( $_SESSION[$key] );
			//print_r($_SESSION[$key]);
		}
		// Get Session Value
		static function getSessionValue($key)
		{
			self::initSession();
			if(isset($_SESSION[$key]))
			{
				return $_SESSION[$key];
			}
			return false;
		}
		// Set User Session
		static function setUserSession($user)
		{
			self::initSession();
			self::setSessionValue("user", $user);
		}
		// Get User Session
		static function getUserSession()
		{
			if(self::getSessionValue("user"))
			{
				return self::getSessionValue("user");
			}
			return false;
		}
		static function unsetUser()
		{
			self::unsetSessionValue("user");
		}
		// Is user logged?
		static function isUserLogged()
		{
			$session = self::getUserSession();

			if(empty( $session ) ||  $session == null || $session == false)
			{
			  return false;
			}
			return self::getUserSession();
		}
	}
