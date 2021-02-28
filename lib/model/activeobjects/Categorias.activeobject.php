<?php
	class Categorias extends ActiveObject {
		protected $activeModel = "CategoriasModel";
		protected $FID = "CAT_ID";
		protected $parentCat, $childrens, $news;
		public function getId()
		{
			return $this->getCATID();
		}
		public function getName()
		{
			return $this->getCATNOM();
		}
		public function getCATID()
		{
			return $this->returnKey("CAT_ID");
		}

		public function getCATPAI()
		{
			return $this->returnKey("CAT_PAI");
		}

		public function getCATTIP()
		{
			return $this->returnKey("CAT_TIP");
		}

		public function getCATORD()
		{
			return $this->returnKey("CAT_ORD");
		}

		public function getCATNOM()
		{
			return $this->returnKey("CAT_NOM");
		}

		public function getCATCOR()
		{
			return $this->returnKey("CAT_COR");
		}

		public function getCATQTD()
		{
			return $this->returnKey("CAT_QTD");
		}

		public function getCATSTS()
		{
			return $this->returnKey("CAT_STS");
		}

		public function getCATDESC()
		{
			return $this->returnKey("CAT_DESC");
		}


		public function getCATTXT()
		{
			return $this->returnKey("CAT_TXT");
		}

		public function getCATTITULO()
		{
			return $this->returnKey("CAT_TITULO");
		}

		public function getCATLIVRE()
		{
			return $this->returnKey("CAT_LIVRE");
		}

        public function getCATFTO()
        {

            $oldThumbRelations = ArquivoconteudoModel::getContentRelations($this->getCATID(), "CAT");

            if(!empty($oldThumbRelations[0]))
            {

                return $oldThumbRelations[0];
            }
            return false;
        }
		public function getEdtNews($limit = 10)
		{
			if(!empty($this->news[0]))
			
			{
				return $this->news;
			}
			
			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
			$criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`", $this->getCATID(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`", "NT", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", "1", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_THAN);
			
			$criteria->setLimit($limit);
			
			$this->news = NoticiaModel::doSelect($criteria);
			
			if(!empty($this->news[0]))
			
			{
				return $this->news;
			}
			return false;
		}
		public function getProperties()
		{
			return $this->params;
		}
		public function getChildren()
		{
			if(!empty($this->childrens))
			{
				return $this->childrens;
			}
			
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_categorias`.`CAT_PAI`", $this->getCATID(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$childrens = CategoriasModel::doSelect($criteria);
			if(!empty($childrens[0]))
			{
				$this->childrens = $childrens;
				return $this->childrens;
			}
			return false;
		}
		public function hasChildren()
		{
			return (!$this->getChildren())?FALSE:TRUE;
		}
		public function renderChildrenIDSQuery()
		{
			$ids = array();
			
			$ids[$this->getCATID()] = $this->getCATID();
			
			if($this->hasChildren())
			{
				$childs = $this->getChildren();
				foreach($childs as $child)
				{
					$res = $child->renderChildrenIDSQuery();
					$ids = $ids + $res;
				}
			}
			return $ids;
		}
		public function getParent()
		{
			$catPai = $this->getCATPAI();
			if(!empty($catPai) && empty($this->parentCat))
			{
				$cat = CategoriasModel::getOne($catPai);
				$this->parentCat = $cat[0];
				
				return $this->parentCat;
			}
			if(!empty($this->parentCat))
			{
				return $this->parentCat;
			}
			return false;
		}
		public function hasParent()
		{
			if(empty($this->parentCat))
			{
				$this->getParent();
			}
			if(!empty($this->parentCat))
			{
				return true;
			}
			return false;
		}
		public function toJSON()
		{
			$cat = new StdClass();
			foreach($this->getProperties() as $prop => $value)
			{
				$cat->$prop = utf8_encode($value);
			}
			return $cat;
		}
		public function generateJSON()
		{
			$site = ProdutoModel::getOne(Dispatcher::getEditorialID());
			$site = $site[0];
			$site = $site->getSite();
			$siteID = $site->getPDTID();
			
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias`.`CAT_TIP`", $siteID, FuriousExpressionsDB::EQUAL);
			
			$itens = CategoriasModel::doSelect($criteria);
			if(!empty($itens[0]))
			{
				$arr = array();
				foreach($itens as $item):
					$arr[] = $item->toJSON();
				endforeach;
				var_dump($arr);
				Document::writeFile("json/EDITORIALS_{$siteID}.json", json_encode($arr));
			}
			
		}
		public function save()
		{
			$ret =  parent::save();
			//$this->generateJSON();
		  	return $ret;
		}
		public function getConteudos($type = null, $limit = null){

					$criteria = new FuriousSelectCriteria();
					$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
					$criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`",  $this->getCATID(), FuriousExpressionsDB::EQUAL);
					$criteria->add("`cnt_categorias_conteudos`.`CCL_STS`",  1, FuriousExpressionsDB::EQUAL);
					if($type){
						$criteria->add("`cnt_conteudo`.`CNT_TIP`",  $type, FuriousExpressionsDB::EQUAL);
					}
					$criteria->add("`cnt_conteudo`.`CNT_STS`",  1, FuriousExpressionsDB::EQUAL);
					$criteria->addGroupBy("`cnt_conteudo`.`CNT_ID`");
					if($limit){
						$criteria->setLimit($limit);
					}
					$outrosProdutos = ConteudoModel::doSelect($criteria);

					return $outrosProdutos;
				}
	}
?>