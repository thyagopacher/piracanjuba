<?php
	class Agenda extends Conteudo {
		protected $activeModel = "AgendaModel";
		protected $FID = "CNT_ID";
		public function __construct()
		{
			$this->CNT_TIP = "CA";
		}

		public function getCNTDTF()
		{
			return $this->returnKey("CNT_DTF");
		}
		public function getCNTLOC()
		{
			return $this->returnKey("CNT_LOC");
		}
		public function toJSONLimited()
		{
			$news = new StdClass();
			foreach($this->getProperties() as $prop => $value)
			{
				$news->$prop = utf8_encode($value);
			}
			$fto = $this->getDTQFTO();
			if($fto != false)
			{
				$news->thb_fto = $fto->toJSON();
			}
			return $news;
		}
		public function toJSON()
		{
			$news = new StdClass();
			foreach($this->getProperties() as $prop => $value)
			{
				$news->$prop = utf8_encode($value);
			}
			// Foto
			$fto = $this->getDTQFTO();
			if($fto != false)
			{
				$news->thb_fto = $fto->toJSON();
			}
			return $news;
		}
		public function generateJSON()
		{
			/*$news = $this->toJSON();
			$dir = Document::renderDirStructure($this->getCNTID(), "json");

			if($dir != false)
			{
				$site = ProdutoModel::getOne(Dispatcher::getEditorialID());
				$site = $site[0];
				$site = $site->getSite();

				$siteID = $site->getPDTID();
				Document::writeFile($dir."CNT_{$siteID}_".($this->getCNTID()).".json", json_encode($news));
			}*/
		}

		public function generateSiteList()
		{
			//
			// $site = ProdutoModel::getOne(Dispatcher::getEditorialID());
			// $site = $site[0];
			// $site = $site->getSite();
			//
			// $siteID = $site->getPDTID();
			//
			// $t = $site->toJSON();
			//
			// $criteria = new FuriousSelectCriteria();
			// $criteria->add("`cnt_conteudo`.`CNT_TIP`", "CA", FuriousExpressionsDB::EQUAL);
			// $criteria->add("`cnt_conteudo`.`CNT_SIT`", $siteID, FuriousExpressionsDB::EQUAL);
			// $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
			// $criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
			// $criteria->addAscendingOrder("`cnt_conteudo`.`CNT_DTF`");
			// $criteria->setLimit(1000);
			// $news = AgendaModel::doSelect($criteria);
			// $t->news = array();
			// if(!empty($news[0]))
			// {
			// 	foreach($news as $article)
			// 	{
			// 		$t->news[] = $article->toJSONLimited();
			// 	}
			// 	Document::writeFile("json/SITE_{$siteID}_CA.json", json_encode($t));
			// }
			// *

		}
		public function generateJsonLists()
		{
			$this->generateSiteList();
		}
		public function save()
		{
			$email = $this->getCNTEMA();
			$status = $this->getCNTSTS();

			if(empty($email) && $status == 1)
			{
				if(file_exists("../lib/other/Facebook/src/facebook.php"))
				{
					include("../lib/other/Facebook/src/facebook.php");
					$facebook = new Facebook(array("appId" => ConfigurationsModel::getConfig("FB_APP_ID"), "secret" => ConfigurationsModel::getConfig("FB_APP_SECRET")));
					$configToken = ConfigurationsModel::getConfig("facebookToken");
					$token = $configToken->getValue();
					$pageIDToken = ConfigurationsModel::getConfig("facebookPageID");
					$pageID = $pageIDToken->getValue();
					if(!empty($token) && !empty($pageID))
					{
						$facebook->setAccessToken($token);

						$params = array("name" => html_entity_decode(strip_tags($this->getCNTTIT())), "start_time" => date("Y-m-d\TH:i:s-0300", (strtotime($this->getCNTDTF())+((60*60)*5))), "end_time" => date("Y-m-d\TH:i:s-0300", (strtotime($this->getCNTDTF())+(3600+((60*60)*5)))), "description" => html_entity_decode(strip_tags($this->getCNTTXT())), "location" => html_entity_decode(strip_tags($this->getCNTLOC())) );
						$return = $facebook->api("/".$pageID."/events", "POST", $params);
						if(!empty($return['id']))
						{
							$this->params['CNT_EMA'] = $return['id'];
						}
					}
				}
			}
			return parent::save();
		}

	}
?>
