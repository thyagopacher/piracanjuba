<?php
	class Enquete extends ActiveObject {
		protected $FID = "id";
		protected $activeModel = "EnqueteModel";
		
		public function __set($key, $value)
		{			
			$this->params[$key] = $value;			
		}
		public function getID()
		{
			return $this->returnKey("id");
		}
		public function getName()
		{
			return $this->returnKey("name");
		}
		public function getValue1()
		{
			return $this->returnKey("value1");
		}
		public function getValue2()
		{
			return $this->returnKey("value2");
		}
		public function getValue3()
		{
			return $this->returnKey("value3");
		}
		public function getValue4()
		{
			return $this->returnKey("value4");
		}
		public function getValue5()
		{
			return $this->returnKey("value5");
		}
		public function getVoto1()
		{
			$return = $this->returnKey("voto1");			
			return ($return)?$return:0;
		}
		public function getVoto2()
		{
			$return = $this->returnKey("voto2");			
			return ($return)?$return:0;
		}
		public function getVoto3()
		{
			$return = $this->returnKey("voto3");			
			return ($return)?$return:0;
		}
		public function getVoto4()
		{
			$return = $this->returnKey("voto4");			
			return ($return)?$return:0;
		}
		public function getVoto5()
		{
			$return = $this->returnKey("voto5");			
			return ($return)?$return:0;
		}

		public function getIMG()
		{
			return $this->returnKey("file_id");
		}

		public function getSite()
		{
			return $this->returnKey("site_id");
		}

		public function getSTS()
		{
			return $this->returnKey("status");
		}
		public function getStatus()
		{
			return $this->getSTS();
		}
		public function getProperties()
		{
			return $this->params;
		}
		
		public function getFTO($relation = "THB_ENQ")
		{
			$oldThumbRelations = ArquivoconteudoModel::getContentRelations($this->getID(), $relation);
			if(!empty($oldThumbRelations[0]))
			{
				return $oldThumbRelations[0];
			}
			return false;
		}
		public function toJSON()
		{
			$ret = new StdClass();
			foreach($this->getProperties() as $prop => $value)
			{
				$ret->$prop = utf8_encode($value);
			}
			$fto = $this->getFTO();
			if($fto != false)
			{
				$ret->dtq_fto = $fto->toJSON();
			}
			/*
			if(!empty($this->params['DTQ_IRE']))
			{
				$gal = $this->getGal();
				if($gal != false)
				{
					$ret->dtq_gal = $gal->toJSON();
				}
			}
			*/
			return $ret;
		}
		public function generateJSON()
		{
			$ret = new StdClass();
			
			$dir = Document::renderDirStructure($this->getSite(), APP_JSON_PATH);
			
			if($dir != false)
			{
				$siteID = $this->getSite();
				
				$criteria = new FuriousSelectCriteria();
				$criteria->add("`enquetes`.`status`", 1, FuriousExpressionsDB::EQUAL);		
				$criteria->add("`enquetes`.`site_id`", $siteID, FuriousExpressionsDB::EQUAL);
				$criteria->addAscendingOrder("`enquetes`.`name`");
				
				$itens = EnqueteModel::doSelect($criteria);
				
				$ret->items = array();
				if(!empty($itens[0]))
				{
					foreach($itens as $item)
					{
						$ret->items[] = $item->toJSON();						
					}
				}
				
				return Document::writeFile($dir."ENQUETES_{$siteID}.json", json_encode($ret));
			}
		}
		public function delete()
		{
			$this->params['status'] = 9;
			return $this->save();
		}
		public function save()
		{
		  return parent::save();
		}
	}
?>