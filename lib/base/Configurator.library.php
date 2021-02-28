<?php
 class Configurator {
	static $config;
	private $ini, $view;
	const CONFIGFILE =  "config/config.php";
	const VIEWCONFIG = "config/views.php";
	static function init(){
		if(self::$config == null){
			self::$config = new Configurator();
		}
		return self::$config;
	}
	public function __construct()
	{
		include(APP_PATH_PREFIX . self::CONFIGFILE);
		
		//$this->ini = $this->openConfigs(APP_PATH_PREFIX . self::CONFIGFILE);
		
		//$this->view = $this->openConfigs(APP_PATH_PREFIX . "apps/" . APP_NAME . self::VIEWCONFIG);
		include(APP_PATH_PREFIX . "apps/" . APP_NAME . "/". self::VIEWCONFIG);
	}
	public function addIniConfig($configs){
		$this->ini = $configs;
	}
	public function addViewConfig($configs){
		$this->view = $configs;
	}
	protected function openConfigs($configFile)
	{
		$configs_str = Document::openFile($configFile);
		$config = unserialize($configs_str);
		return $config;
	}
	public static function getConfig($confName)
	{
		if(self::$config != null)
		{
			//print($confName);
			return ($confName != "security")? self::$config->ini[$confName][APP_MODE] : self::$config->ini[APP_NAME][$confName][APP_MODE];
		}
	}
	public function getViewConfig($confName)
	{
		if(self::$config != null)
		{
			$config = self::$config;
			$views = $config->view;
			 if(isset($views[$confName]))
			{
			 		return self::$config->view[$confName];
			}
			else
			{ 
					return array();
			}
		}
	}
}
