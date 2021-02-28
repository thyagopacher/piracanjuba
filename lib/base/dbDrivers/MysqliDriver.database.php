<?php
	//include_once("databaseDriver.interface.php");
	class MysqliDriver implements DatabaseDriver {
		private $con, $autocommit = true;
		function connect($host, $user, $pass, $dbname){
			$this->con = @new Mysqli($host, $user, $pass, $dbname);
			if($this->con->connect_errno){
				throw new Exception("Database connection error:".$this->con->connect_error);
			}
			if(APP_NAME == "frontend"){
				//$this->con->query("SET NAMES 'utf8'");
				//$this->con->query('SET character_set_connection=utf8');
				//$this->con->query('SET character_set_client=utf8');
				//$this->con->query('SET character_set_results=utf8');
			}

		}
		public function close(){
			if($this->con){
				$this->con->close();
			}
		}
		public function executeQuery( $sql )
		{
			$query =  $this->con->query($sql);
			if(!$query){
				//printf("Error message: %s", $this->con->error);
				return false;
			} else {
				return $query;
			}
		}
		public function query( $sql )
		{
			if($this->autocommit == true)
			{
				$this->disableAutoCommit();
			}
			$query =  $this->con->query($sql);
			return $query;
		}
		public function hasError(){
			if($this->con->connect_errno){
				return true;
			} else {
				return false;
			}
		}
		public function Error()
		{
			return $this->con->error;
		}
		public function lastInserId()
		{
			return $this->con->insert_id;
		}
		public function fetch_object ( $res, $class = "stdClass" )
		{

			if($res)
			{
				$row = $res->fetch_object($class);
				return $row;
			}
			return false;
		}
		public function createStmt()
		{
			$stmt = $this->con->stmt_init();
			return $stmt;
		}
		public function prepareStmt($stmt, $sql, Array $params = null)
		{
			if($params){
				print_r($params);
			}
			$stmt->prepare($sql);
			$types = join("", array_keys($params));
			$stmt->bind_param($types, array_shift($params));
			return $stmt;
		}
		public function bindStmtResult ( $stmt, $names ){
			$stmt->bind_result( array_shift( $names ) );
			return $stmt;
		}
		public function disableAutoCommit()
		{
			if($this->autocommit == TRUE)
			{
				$this->con->autocommit(FALSE);
			}
		}
		public function enableAutoCommit()
		{
			if($this->autocommit == FALSE)
			{
				$this->con->autocommit(TRUE);
			}
		}
		public function beginTransaction()
		{
			if($this->autocommit == TRUE)
			{
				$this->disableAutoCommit();
			}
		}
		public function commit()
		{
			$this->con->commit();
		}
		public function rollBack()
		{
			$this->con->rollback();
		}
		public function executeStmt ($stmt){
			$stmt->execute();
			return $stmt;
		}
	}
