<?php
require_once(APP_PATH_PREFIX."lib/base/customcommands.library.php");
class Autoloader {
	//const PREFIXDIR = "../";
	public static $loader;
	public static function init(){
		if(self::$loader == null){
			self::$loader = new Autoloader();
		}
		return self::$loader;
	}
	public function __construct(){
		spl_autoload_register(array($this,'form2'));
		spl_autoload_register(array($this,'model'));
		spl_autoload_register(array($this,'form'));
		spl_autoload_register(array($this,'helper'));
		spl_autoload_register(array($this,'library'));
		spl_autoload_register(array($this,'database'));
		spl_autoload_register(array($this,'validations'));
		spl_autoload_register(array($this,'schemas'));
		spl_autoload_register(array($this,'criteria'));
		spl_autoload_register(array($this,'exceptions'));
		spl_autoload_register(array($this,'activeObjects'));
		spl_autoload_register(array($this,'templates'));
		spl_autoload_register(array($this,'other'));
		
	}
	public function other($class){
		$path = APP_PATH_PREFIX."lib/other/{$class}.php";
		
		if(file_exists($path)){
			require_once($path);
		}
	}
	public function model($class){
		$path = APP_PATH_PREFIX."lib/model/models/{$class}.model.php";

		if(file_exists($path)){
			require_once($path);
		}
	}
	public function controller($class){
		$controllerFolder = str_replace("controller", "", strtolower($class));
		$controller = strtolower($class);
		$path = APP_PATH_PREFIX."apps/".APP_NAME."/controllers/{$controllerFolder}/actions/{$controller}.controller.php";
		
		if(file_exists($path)){
			require_once($path);
		} else {
			throw new RequestException("Page not Found");
		}
	}
	public function block($class){
		$blockFolder = str_replace("block", "", strtolower($class));
		$block = strtolower($class);
		$path = APP_PATH_PREFIX."apps/".APP_NAME."/controllers/{$blockFolder}/actions/{$block}.block.php";
		
		if(file_exists($path)){
			require_once($path);
		} else {
			throw new RequestException("Page not Found");
		}
	}
	
	public function helper($class){
		$path = APP_PATH_PREFIX."lib/helpers/{$class}.helper.php";
		if(file_exists($path)){
			require_once($path);
		}
	}
	public function templates($class){
		$path = APP_PATH_PREFIX."lib/templates/{$class}.library.php";
		if(file_exists($path)){
			require_once($path);
		}
	}
	public function library($class){
		$path = APP_PATH_PREFIX."lib/base/{$class}.library.php";
		if(file_exists($path)){
			require_once($path);
		}
	}
	public function form($class){
		$path = APP_PATH_PREFIX."lib/base/form/{$class}.library.php";
		if(file_exists($path)){
			require_once($path);
		}
	}
	public function form2($class){
		$path = APP_PATH_PREFIX."lib/form/{$class}.library.php";
		if(file_exists($path)){
			require_once($path);
		}
	}
	public function validations($class){
		$path = APP_PATH_PREFIX."lib/base/validations/{$class}.library.php";
		if(file_exists($path)){
			require_once($path);
		}
	}
	public function schemas($class){
		$path = APP_PATH_PREFIX."lib/base/schemas/{$class}.library.php";
		if(file_exists($path)){
			@require_once($path);
		}
	}
	public function criteria($class){
		$path = APP_PATH_PREFIX."lib/base/criteria/{$class}.library.php";
		if(file_exists($path)){
			require_once($path);
		}
	}
	public function exceptions($class){
		$path = APP_PATH_PREFIX."lib/base/exceptions/{$class}.library.php";
		if(file_exists($path)){
			require_once($path);
		}
	}
	public function database($class){
		$path = APP_PATH_PREFIX."lib/base/dbDrivers/{$class}.database.php";
		if(file_exists($path)){
			require_once($path);
		}
	}
	public function activeObjects($class)
	{
		$path = APP_PATH_PREFIX."lib/model/activeobjects/{$class}.activeobject.php";
		if(file_exists($path)){
			require_once($path);
		}
	}
}
