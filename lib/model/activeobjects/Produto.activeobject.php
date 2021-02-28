<?php
	class Produto extends ActiveObject {
		protected $activeModel = "ProdutoModel";
		protected $FID = "PDT_ID";
		protected $PdtsChildren = array();
		public function getPDTID()
		{
			return $this->returnKey("PDT_ID");
		}

		public function getPDTPAI()
		{
			return $this->returnKey("PDT_PAI");
		}

		public function getPDTORD()
		{
			return $this->returnKey("PDT_ORD");
		}

		public function getPDTICO()
		{
			return $this->returnKey("PDT_ICO");
		}

		public function getPDTNOM()
		{
			return $this->returnKey("PDT_NOM");
		}

		public function getPDTTIT()
		{
			return $this->returnKey("PDT_TIT");
		}

		public function getPDTDES()
		{
			return $this->returnKey("PDT_DES");
		}

		public function getPDTKEY()
		{
			return $this->returnKey("PDT_KEY");
		}

		public function getPDTURL()
		{
			return $this->returnKey("PDT_URL");
		}

		public function getPDTRSS()
		{
			return $this->returnKey("PDT_RSS");
		}
		public function getPDTOMN()
		{
			return $this->returnKey("PDT_OMN");
		}

		public function getPDTSTS()
		{
			return $this->returnKey("PDT_STS");
		}
		public function getName()
		{
			return $this->getPDTNOM();
		}
		public function getId()
		{
			return $this->getPDTID();
		}
		private function childrens()
		{
			if(empty($this->PdtsChildren))
			{
				$user = Dispatcher::getUserSession();
				
				$criteria = new FuriousSelectCriteria();
				$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_grupo`", "`w11_produto_grupo`.`SEC_IPR`", "`w11_produto`.`PDT_ID`");
				$criteria->add("`w11_produto_grupo`.`SEC_IGR`", ((int)$user->getUSUGRP()), FuriousExpressionsDB::EQUAL);
				$criteria->add("`w11_produto`.`PDT_PAI`", ((int)$this->getPDTID()), FuriousExpressionsDB::EQUAL);
				$criteria->add("`w11_produto`.`PDT_URL`", "", FuriousExpressionsDB::NOT_EQUAL);
				$criteria->add("`w11_produto`.`PDT_STS`", 1, FuriousExpressionsDB::EQUAL);
				$criteria->addAscendingOrder("`w11_produto`.`PDT_ORD`");

				$this->PdtsChildren = ProdutoModel::doSelect($criteria);
			}
		}
	
		public function hasChildren()
		{
			if(empty($this->PdtsChildren))
			{
				$this->childrens();
			}
			if(!empty($this->PdtsChildren[0]))
			{
				return true;
			}
			return false;
		}
		public function getChildren()
		{
			if(empty($this->PdtsChildren))
			{
				$this->childrens();
			}			
			return $this->PdtsChildren;
		}
		public function getSite($id = null)
		{
			
			if(empty($this->params['PDT_PAI']) || $this->params['PDT_PAI'] == '0' || $this->getPDTID() == "0")
			{
				return $this;
			}
			$edt = ProdutoModel::getOne($this->getPDTPAI());
			$edt = $edt[0];
			if(!empty($edt))
			{
				return $edt->getSite();
			}
		}
		public function getAllEditorials()
		{
			$editorials = array();
			$editorials[] = $this;
			if($this->hasChildren())
			{
				
				
				foreach($this->getChildren() as $child)
				{
					
					$arr = $child->getAllEditorials();
					
					
					
					$editorials = array_merge($editorials, $arr);
				}
			}
			
			return $editorials;
		}
		public function getURL()
		{
			return APP_WEB_PREFIX.($this->getPDTID())."-".(Slugfy($this->getPDTNOM()))."/";
		}
		public function getProperties()
		{
			return $this->params;
		}
		
		public function getEditorialMenu()
		{
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`w11_produto_menu`.`MNU_IPR`", $this->getPDTID(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
			$menus = ProdutomenuModel::doSelect($criteria);
			
			if(empty($menus[0]))
			{
				return false;
			}
			return $menus;			
		}
		public function toJSON()
		{
			$pdt = new StdClass();
			foreach($this->getProperties() as $prop => $value)
			{
				$pdt->$prop = utf8_encode($value);
			}
			
			
			$menu = $this->getMenu();
			$pdt->menu = array();
			
			if(!empty($menu[0]))
			{
				foreach($menu as $item)
				{
					
					$mnuTip = $item->getMNUTIP();
					if(preg_match("/(([a-z0-9]{2})|([a-z0-9]{3}))\/index/i", $mnuTip))
					{
						
						preg_match("/(([a-z0-9]{2})|([a-z0-9]{3}))\/index/i", $mnuTip, $matches);
						
						
						$mnu = new StdClass();
						$mnu->ID = $item->getMNUID();
						$mnu->tit = utf8_encode($item->getMNUGRP() . " - " . $item->getMNUTIT());
						$prop = $item->getMNUTIP();
						$prop = Slugfy(str_replace("/index", "", $prop));
						
						if(!empty($pdt->menu[$prop]))
						{
							$prop = $prop."-".$matches[1];
						}
						$pdt->menu[utf8_encode($prop)] = $mnu;
					}
					
				}
			}
			return $pdt;
		}
		public function generatePDTJSON()
		{
			$ret = $this->toJSON();
			
			$dir = Document::renderDirStructure($this->getPDTID(), APP_JSON_PATH);
			if($dir != false)
			{
				$site = $this->getSite();
				$siteID = $site->getPDTID();
				
				return Document::writeFile($dir."PDT_{$siteID}_".($this->getPDTID()).".json", json_encode($ret));
			}
			return false;
		}
		public function getMenu(){
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`w11_produto_menu`.`MNU_IPR`", $this->getPDTID(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
			
			$menu = ProdutomenuModel::doSelect($criteria);
			return $menu;
		}
		public function save()
		{
		 	return parent::save();
		}
	}
?>