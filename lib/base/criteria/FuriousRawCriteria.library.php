<?php
	class FuriousRawCriteria extends FuriousExpressionsDB
	{
		protected $sql;
		public function __construct($SQL)
		{
			$this->sql = $SQL;
		}
		public function __toString()
		{
			return $this->sql;
		}
	}
?>