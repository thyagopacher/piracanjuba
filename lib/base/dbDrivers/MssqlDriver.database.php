<?php 
	//include_once("databaseDriver.interface.php");
	class MssqlDriver implements DatabaseDriver {
		private $con;
		function connect($host, $user, $pass, $dbname){
			
			$this->con = mssql_connect($host, $user, $pass) or die("Coldn't connect to database $host");
			mssql_select_db($dbname, $this->con) or die("Coldn't select database $dbname");
			
		}
		public function close(){
			mssql_close($this->con);
		}
		public function executeQuery( $sql )
		{
			$query =  mssql_query($sql, $this->con);
			if(!$query){
				return false;
			} else {
				return $query;
			}
		}
		public function fetch_object ( $res )
		{
			$row = mssql_fetch_object($res);
			return $row;
		}
		public function nextResult ( $res )
		{
			return mssql_next_result($res);
		}
	}
?>