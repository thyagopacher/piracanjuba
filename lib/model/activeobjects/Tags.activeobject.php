<?php
	class Tags extends ActiveObject {
		protected $activeModel = "TagsModel";
		protected $FID = "TAG_ID";
		public function getTAGID()
		{
			return $this->returnKey("TAG_ID");
		}

		public function getTAGNOM()
		{
			return $this->returnKey("TAG_NOM");
		}

		public function getTAGSLU()
		{
			return $this->returnKey("TAG_SLU");
		}

		public function geTAGSTS()
		{
			return $this->returnKey("TAG_STS");
		}

		public function getProperties()
		{
			return $this->params;
		}
		public function toJSON()
		{
			$tag = new StdClass();
			foreach($this->getProperties() as $prop => $value)
			{
				$tag->$prop = utf8_encode($value);
			}
			return $tag;
		}
		public function generateJSON()
		{
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_tags`.`TAG_STS`", 1, FuriousExpressionsDB::EQUAL);
			$itens = TagsModel::doSelect($criteria);
			if(!empty($itens[0]))
			{
				$ret = array();
				foreach($itens as $item)
				{
					$tags[] = $item->toJSON();
				}
				Document::writeFile(APP_JSON_PATH."TAGS.json", json_encode($tags));
			}
		}
		public function save()
		{
			$ret = parent::save();
			$this->generateJSON();
			return $ret;
		}
	}
?>