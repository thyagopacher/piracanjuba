<?php
	class AnalyticsReport {
		private $service, $siteID;
		public function __construct($service, $siteID)
		{
			$this->service = $service;
			$this->siteID = $siteID;
		}
		public function query($query)
		{
			$cacheFile = APP_PATH_PREFIX."cache/analytics/".$query->getQueryID() . ".dat";
			if(Document::hasFile($cacheFile) && Document::getModTime($cacheFile) >= time()-(24*(60*60)))
			{
				return unserialize(Document::openFile($cacheFile));
			}
			else {
				$data = $this->service->data_ga->get("ga:".$this->siteID, $query->getStartDate(), $query->getEndDate(), $query->getMetric(), $query->getOtherArr());	
				$cache = serialize($data);
				
				Document::writeFile($cacheFile, $cache);
				
				return $data;
			}
		}
	}
?>