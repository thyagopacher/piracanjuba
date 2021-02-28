<?php
	class AnalyticsQuery{
		private $metric, $start_date, $end_date, $siteID;
		private $otherArr = array();
		public function __construct($siteId, $metric, $start_date, $end_date)
		{
			$this->siteID = $siteId;
			$this->metric = $metric;
			$this->start_date = $start_date;
			$this->end_date = $end_date;
		}
		public function addFilters($filters)
		{
			$this->otherArr['filters'] = $filters;
		}
		public function addDimensions($dimensions)
		{
			$this->otherArr['dimensions'] = $dimensions;
		}
		
		public function getStartDate()
		{
			return $this->start_date;
		}
		public function getEndDate()
		{
			return $this->end_date;
		}
		public function getMetric()
		{
			return $this->metric;
		}
		public function getOtherArr()
		{
			return $this->otherArr;
		}
		public function getQueryID(){
			$str = $this->metric . $this->start_date . $this->end_date . $this->siteID . serialize($this->otherArr);
			
			return md5(serialize($str));
		}
	}
?>