<?php
	class Destaques extends ActiveObject {
		protected $FID = "DTQ_ID";
		protected $activeModel = "DestaquesModel";
		public function getID()
		{
			return $this->getDTQID();
		}
		public function __set($key, $value)
		{
			if($key == "DTQ_ORD")
			{
				$this->params[$key] = ($value < 0)?0:$value;
			} else {
				$this->params[$key] = $value;
			}
		}
		public function getDTQID()
		{
			return $this->returnKey("DTQ_ID");
		}
		public function getDTQSIT(){
			return $this->returnKey("DTQ_SIT");
		}
		public function getDTQCID()
		{
			return $this->returnKey("DTQ_CID");
		}
		public function getDTQORD()
		{
			return $this->returnKey("DTQ_ORD");
		}

		public function getDTQMNU()
		{
			return $this->returnKey("DTQ_MNU");
		}

		public function getDTQTIP()
		{
			return $this->returnKey("DTQ_TIP");
		}

		public function getDTQEDT()
		{
			return $this->returnKey("DTQ_EDT");
		}

		public function getDTQCNL()
		{
			return $this->returnKey("DTQ_CNL");
		}

		public function getDTQTIT()
		{
			return htmlentities($this->returnKey("DTQ_TIT"), ENT_QUOTES, "ISO-8859-1");
		}

		public function getDTQTXT()
		{
			return $this->returnKey("DTQ_TXT");
		}
		public function getDTQEMB()
		{
			return $this->returnKey("DTQ_EMB");
		}
		public function getDTQEMB2()
		{
			return $this->returnKey("DTQ_EMB2");
		}

		public function getDTQIMG()
		{
			return $this->returnKey("DTQ_IMG");
		}

		public function getDTQLNK()
		{
			return $this->returnKey("DTQ_LNK");
		}

		public function getDTQTGT()
		{
			return $this->returnKey("DTQ_TGT");
		}

		public function getDTQINI()
		{
			return $this->returnKey("DTQ_INI");
		}

		public function getDTQFIM()
		{
			return $this->returnKey("DTQ_FIM");
		}

		public function getDTQILI()
		{
			return $this->returnKey("DTQ_ILI");
		}

		public function getDTQSTS()
		{
			return $this->returnKey("DTQ_STS");
		}
		public function getStatus()
		{
			return $this->getDTQSTS();
		}
		public function getDTQLTX()
		{
			return $this->returnKey("DTQ_LTX");
		}
		public function getDTQIRE()
		{
			return $this->returnKey("DTQ_IRE");
		}
		public function getDTQLN2()
		{
			return $this->returnKey("DTQ_LN2");
		}
		public function getDTQCAT()
		{
			return $this->returnKey("DTQ_CAT");
		}
		public function getDTQDTP()
		{
			return $this->returnKey("DTQ_DTP");
		}
		public function getDTQDTA()
		{
			return $this->returnKey("DTQ_DTA");
		}
		public function getProperties()
		{
			return $this->params;
		}
		public function getDTA()
		{
			return $this->getDTQINI();
		}

		public function getDTQFTO($relation = "THB_DTQ")
		{
			$oldThumbRelations = ArquivoconteudoModel::getContentRelations($this->getDTQID(), $relation);
			if(!empty($oldThumbRelations[0]))
			{
				return $oldThumbRelations[0];
			}
			return false;
		}
		public function getDTQFTO2()
		{
			$oldThumbRelations = ArquivoconteudoModel::getContentRelations($this->getDTQID(), "THB_DTQ2");
			if(!empty($oldThumbRelations[0]))
			{
				return $oldThumbRelations[0];
			}
			return false;
		}
		public function getGal()
		{
			$gal = GaleriaModel::getOne($this->getDTQIRE());
			if(!empty($gal[0]))
			{
				return $gal[0];
			}
			return false;
		}
		public function getEdt()
		{
			$edt = CategoriasModel::getOne($this->getDTQCAT());
			if(!empty($edt[0]))
			{
				return $edt[0];
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
			$fto = $this->getDTQFTO();
			if($fto != false)
			{
				$ret->dtq_fto = $fto->toJSON();
			}
			$fto2 = $this->getDTQFTO("THB_DTQ2");
			if($fto2 != false)
			{
				$ret->dtq_fto2 = $fto2->toJSON();
			}
			$fto3 = $this->getDTQFTO("THB_DTQ3");
			if($fto3 != false)
			{
				$ret->dtq_fto3 = $fto3->toJSON();
			}
			if(!empty($this->params['DTQ_IRE']))
			{
				$gal = $this->getGal();
				if($gal != false)
				{
					$ret->dtq_gal = $gal->toJSON();
				}
			}
			/*
			if(!empty($this->params['DTQ_CAT']))
			{
				$edt = $this->getEdt();
				if($edt != false)
				{
					$news = $edt->getEdtNews();
					$ret->cat_itens = array();
					if(!empty($news[0]))
					{
						foreach($news as $article)
						{
							$ret->cat_itens[] = $article->toJSONLimited();
						}
					}
				}
			}*/
			return $ret;
		}
		protected function getDTQConfigs()
		{
			if(!empty($this->params['DTQ_EDT']) && !empty($this->params['DTQ_TIP']))
			{
				$criteria = new FuriousSelectCriteria();
				$criteria->add("`w11_produto_menu`.`MNU_IPR`", addslashes($this->params['DTQ_EDT']), FuriousExpressionsDB::EQUAL);
				$criteria->add("`w11_produto_menu`.`MNU_TIP`", addslashes($this->params['DTQ_TIP']."/index"), FuriousExpressionsDB::EQUAL);
				$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
				$criteria->setLimit(1);
				$itens = ProdutomenuModel::doSelect($criteria);

				if(!empty($itens[0]))
				{
					$edt = ProdutoModel::getOne($this->params['DTQ_EDT']);
					if(!empty($edt[0]))
					{
						$edt = $edt[0];
						$this->site = $edt->getSite();
						$this->type = $this->params['DTQ_TIP'];
						// Set Configs
						$this->configs = $itens[0];
						return true;
					}
				}
			}
			return false;
		}
		public function generateJSON()
		{

			if(empty($this->configs) && empty($this->type))
			{
				$this->getDTQConfigs();
			}

			if(!empty($this->configs) && !empty($this->type))
			{
				$criteria = new FuriousSelectCriteria();
				$criteria->add("`cnt_destaques`.`DTQ_EDT`", $this->configs->getMNUIPR(), FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_destaques`.`DTQ_TIP`", $this->type, FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
				//$criteria->add("`cnt_destaques`.`DTQ_FIM`", date("Y-m-d H:i:s"), FuriousExpressionsDB::GREATER_THAN);
				//$criteria->add("`cnt_destaques`.`DTQ_INI`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_THAN);
				$criteria->addAscendingOrder("`cnt_destaques`.`DTQ_CID`");
				$criteria->addDescendingOrder("`cnt_destaques`.`DTQ_INI`");
				$itens = DestaquesModel::doSelect($criteria);
				//echo($criteria);
				$ret = new StdClass();
				$ret->items = array();

				if(!empty($itens[0]))
				{
					foreach($itens as $item)
					{
						$ret->items[] = $item->toJSON();
					}
				}

				if(!empty($ret))
				{
					$dir = Document::renderDirStructure($this->configs->getMNUID(), APP_JSON_PATH);

					if($dir != false)
					{
						$siteID = $this->site->getPDTID();
						Document::writeFile($dir."DTQ_{$siteID}_".($this->configs->getMNUID()).".json", json_encode($ret));
					}
				}

			}
		}
		public function delete()
		{
			$this->params['DTQ_STS'] = 9;
			return $this->save();
		}
		public function save()
		{
		  return parent::save();
		}
	}
?>
