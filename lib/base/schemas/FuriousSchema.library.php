<?php
	class FuriousSchema {
		static $schema;
		const cacheTablesFile = "cache/furiousSchema.tables.cache.dat";
		protected $schema_file, $SchemaXML, $tables;
		
		static function init(){
			if(self::$schema == null || !isset(self::$schema))
			{
				self::$schema = new FuriousSchema();
				return self::$schema;
			} else {
				return self::$schema;
			}
		}
		public function __construct(){
			$schema = Configurator::getConfig("schema");
			
				$this->schema_file = APP_PATH_PREFIX.$schema["schema_file"];
				if(!file_exists(APP_PATH_PREFIX.self::cacheTablesFile))
				{
					$this->SchemaXML = SimpleXML_load_file($this->schema_file);
					
					foreach($this->SchemaXML->table as $tableXML){
						$table = new FuriousSchemaTable($tableXML);
						$this->tables[$table->getName()] = $table;
					}
					$cache = serialize($this->tables);
					Document::writeFile(APP_PATH_PREFIX.self::cacheTablesFile, $cache);
				} else {
					$cache = Document::openFile(APP_PATH_PREFIX.self::cacheTablesFile);
					$this->tables = unserialize($cache);
				}
				
		}
		public function getTable( $tableName )
		{
			if(isset($this->tables[$tableName]))
			{
				return $this->tables[$tableName];
			} else {
				return false;
			}
		}
		
		public function getTablesNames()
		{
			if(isset($this->tables))
			{
				$names = array();
				foreach($this->tables as $name => $table)
				{
					$names[] = $name;
				}
				return $names;
			}
			return false;
		}
	}
?>