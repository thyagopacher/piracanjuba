<?php	
	class Database2 extends Database {
		static $db;
		static function init(){
			if(self::$db == null || !isset(self::$db)){
				self::$db = new Database2(Configurator::getConfig("database"));
			}
			return self::$db;
		}
		public function __construct($params){
			parent::__construct($params['host'], $params['user'], $params['pass'], $params['dbname'], $params['driver']);
			
		}
		static function getDB(){
			if(self::$db == null || !isset(self::$db)){
				self::init();
			}
			return self::$db;
		}
	}