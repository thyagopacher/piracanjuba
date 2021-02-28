<?php
	//require_once("errors.class.php");
	
	class Database {
		private $driverName, $con;
		const driversDir = "classes/dbDrivers/";
		public function __construct( $host, $user, $pass, $dbName, $dbType = "mysqli" )
		{
			// Load Database Driver
			//$this->loadDatabaseDriver( $dbType );

			// Set Driver Name
			$this->driverName = $this->setDriverName( $dbType );
			

			
			$this->con = new $this->driverName;

			try {
				$this->con->connect($host, $user, $pass, $dbName);
			} catch( Exception $e)
			{
				
				echo ($e->getMessage());
				die();
			}
			
			
			
		}
		private function loadDatabaseDriver( $Driver )
		{
			if(file_exists(self::driversDir.$Driver.".database.class.php"))
			{
				include_once(self::driversDir.$Driver.".database.class.php");
			} else {
				throw new Exception("Unable to load Database: ".self::driversDir.$Driver.".database.class.php");
			}
		}
		private function setDriverName( $Driver )
		{
			$str = ucfirst( $Driver );
			$str .= "Driver";

			return $str;
		}
		public function nextResult ( $res ) {
			return $this->con->nextResult( $res );
		}
		public function executeQuery ( $query )
		{
			return $this->con->executeQuery( $query );
		}
		public function query( $sql )
		{
			return $this->con->query($sql);
		}
		public function lastInsertId()
		{
			return $this->con->lastInserId();
		}
		public function Error()
		{
			return $this->con->Error();
		}
		public function createStmt ()
		{
			$stmt = $this->con->createStmt();
			return $stmt;
		}
		public function prepareStmt ($stmt, $sql, Array $params = null)
		{
			$stmt = $this->con->prepareStmt($stmt, $sql, $params);
			return $stmt;
		}
		public function executeStmt ($stmt)
		{
			$stmt = $this->con->executeStmt($stmt);
			return $stmt;
		}
		public function bindStmtResult ( $stmt, Array $names )
		{
			$stmt = $this->con->bindStmtResult ( $stmt, $names );
			return $stmt;
		}
		public function fetch_object( $res, $class = null )
		{
			if(isset($class))
			{
				$row = $this->con->fetch_object( $res, $class );
			} else {
				$row = $this->con->fetch_object( $res );
			}
			
			return $row;
		}
		
		public function disableAutoCommit()
		{
			$this->con->disableAutoCommit();
		}
		public function enableAutoCommit()
		{
			$this->con->enableAutoCommit();
		}
		public function beginTransaction()
		{
			$this->con->beginTransaction();
		}
		public function commit()
		{
			$this->con->commit();
		}
		public function rollBack()
		{
			$this->con->rollback();
		}
		
		public function hasError(){
			return $this->con->hasError();
		}
		public function close(){
			$this->con->close();
		}
	}
	// Define Driver's Interface
	interface DatabaseDriver {
		
		function connect($host, $user, $pass, $dbname);
		
		function executeQuery( $sql );
		
		function fetch_object ( $res );
		//function executeStmt(String $Query, Array $Values);
	}